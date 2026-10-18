<?php
require_once BASE_PATH . '/app/Core/Model.php';

class Post extends Model {
    protected $table = 'posts';
    
    public function getPublished($page = 1, $limit = 10) {
        try {
            $offset = ($page - 1) * $limit;
            
            // Get total count
            $countQuery = "SELECT COUNT(*) as total FROM {$this->table} WHERE status = 'published'";
            $countResult = $this->db->query($countQuery);
            $totalPosts = $countResult->fetch()['total'];
            
            // Get posts with pagination
            $query = "SELECT * FROM {$this->table} 
                     WHERE status = 'published' 
                     ORDER BY publish_date DESC 
                     LIMIT :limit OFFSET :offset";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Process posts
            foreach ($posts as &$post) {
                $post = $this->processPost($post);
            }
            
            return [
                'items' => $posts,
                'current_page' => $page,
                'total_pages' => ceil($totalPosts / $limit),
                'total_posts' => $totalPosts,
                'per_page' => $limit
            ];
        } catch (Exception $e) {
            error_log('Error getting published posts: ' . $e->getMessage());
            return [
                'items' => [],
                'current_page' => 1,
                'total_pages' => 0,
                'total_posts' => 0,
                'per_page' => $limit
            ];
        }
    }
    
    public function findBySlug($slug) {
        try {
            $query = "SELECT * FROM {$this->table} WHERE slug = :slug";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':slug', $slug);
            $stmt->execute();
            
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($post) {
                return $this->processPost($post);
            }
            
            return null;
        } catch (Exception $e) {
            error_log('Error finding post by slug: ' . $e->getMessage());
            return null;
        }
    }
    
    public function getByCategory($category) {
        try {
            $query = "SELECT * FROM {$this->table} 
                     WHERE category = :category AND status = 'published' 
                     ORDER BY publish_date DESC";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':category', $category);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($posts as &$post) {
                $post = $this->processPost($post);
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Error getting posts by category: ' . $e->getMessage());
            return [];
        }
    }
    
    public function search($searchTerm) {
        try {
            $query = "SELECT * FROM {$this->table} 
                     WHERE status = 'published' 
                     AND (title LIKE :search OR excerpt LIKE :search OR content LIKE :search OR tags LIKE :search)
                     ORDER BY publish_date DESC";
            
            $stmt = $this->db->prepare($query);
            $searchPattern = '%' . $searchTerm . '%';
            $stmt->bindValue(':search', $searchPattern);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($posts as &$post) {
                $post = $this->processPost($post);
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Error searching posts: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getRecent($limit = 5) {
        try {
            $query = "SELECT * FROM {$this->table} 
                     WHERE status = 'published' 
                     ORDER BY publish_date DESC 
                     LIMIT :limit";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($posts as &$post) {
                $post = $this->processPost($post);
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Error getting recent posts: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getFeatured($limit = 3) {
        try {
            $query = "SELECT * FROM {$this->table} 
                     WHERE status = 'published' 
                     ORDER BY publish_date DESC 
                     LIMIT :limit";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($posts as &$post) {
                $post = $this->processPost($post);
            }
            
            return $posts;
        } catch (Exception $e) {
            error_log('Error getting featured posts: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getCategories() {
        try {
            $query = "SELECT DISTINCT category FROM {$this->table} 
                     WHERE status = 'published' AND category IS NOT NULL AND category != ''
                     ORDER BY category ASC";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $categories;
        } catch (Exception $e) {
            error_log('Error getting categories: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getTags() {
        try {
            $query = "SELECT tags FROM {$this->table} 
                     WHERE status = 'published' AND tags IS NOT NULL AND tags != ''";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $allTags = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!empty($row['tags'])) {
                    $tags = explode(',', $row['tags']);
                    foreach ($tags as $tag) {
                        $tag = trim($tag);
                        if (!empty($tag)) {
                            $allTags[] = $tag;
                        }
                    }
                }
            }
            
            $uniqueTags = array_unique($allTags);
            sort($uniqueTags);
            
            return $uniqueTags;
        } catch (Exception $e) {
            error_log('Error getting tags: ' . $e->getMessage());
            return [];
        }
    }
    
    private function processPost($post) {
        // Format publish date
        if (!empty($post['publish_date'])) {
            $post['formatted_date'] = date('M j, Y', strtotime($post['publish_date']));
        }
        
        // Process tags
        if (!empty($post['tags'])) {
            $post['tag_array'] = array_map('trim', explode(',', $post['tags']));
        } else {
            $post['tag_array'] = [];
        }
        
        // Generate excerpt if not provided
        if (empty($post['excerpt']) && !empty($post['content'])) {
            $post['excerpt'] = $this->generateExcerpt($post['content'], 150);
        }
        
        // Process content for display
        if (!empty($post['content'])) {
            $post['content'] = $this->processContent($post['content']);
        }
        
        return $post;
    }
    
    private function generateExcerpt($content, $length = 150) {
        // Remove HTML tags
        $text = strip_tags($content);
        
        // Remove extra whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);
        
        // Truncate if too long
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length);
            $text = substr($text, 0, strrpos($text, ' ')) . '...';
        }
        
        return $text;
    }
    
    private function processContent($content) {
        // Basic content processing
        // You can add more sophisticated content processing here
        
        // Convert line breaks to paragraphs
        $content = preg_replace('/\n\s*\n/', '</p><p>', $content);
        $content = '<p>' . $content . '</p>';
        
        // Convert single line breaks to <br>
        $content = nl2br($content);
        
        return $content;
    }
}
?>