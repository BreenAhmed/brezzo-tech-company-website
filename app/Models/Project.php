<?php
require_once BASE_PATH . '/app/Core/Model.php';

class Project extends Model {
    protected $table = 'projects';
    
    public function getVisible($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE visible = 1 ORDER BY sort_order ASC, created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getByCategory($category) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE category = ? AND visible = 1 ORDER BY sort_order ASC, created_at DESC");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getImages($projectId) {
        $stmt = $this->db->prepare("SELECT * FROM project_images WHERE project_id = ? ORDER BY sort_order ASC, id ASC");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addImage($projectId, $filename, $altText = '', $sortOrder = 0) {
        $stmt = $this->db->prepare("INSERT INTO project_images (project_id, filename, alt_text, sort_order) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$projectId, $filename, $altText, $sortOrder]);
    }
    
    public function deleteImage($imageId) {
        $stmt = $this->db->prepare("DELETE FROM project_images WHERE id = ?");
        return $stmt->execute([$imageId]);
    }
    
    public function getCategories() {
        $stmt = $this->db->prepare("SELECT DISTINCT category FROM {$this->table} WHERE visible = 1 AND category IS NOT NULL ORDER BY category");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function getFeatured($limit = 6) {
        return $this->getVisible($limit);
    }
    
    public function generateUniqueSlug($title, $id = null) {
        $slug = Security::generateSlug($title);
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->slugExists($slug, $id)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    private function slugExists($slug, $excludeId = null) {
        $sql = "SELECT id FROM {$this->table} WHERE slug = ?";
        $params = [$slug];
        
        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() !== false;
    }
    
    public function search($query) {
        $searchTerm = '%' . $query . '%';
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE visible = 1 AND (
                title LIKE ? OR 
                description LIKE ? OR 
                content LIKE ? OR 
                category LIKE ?
            ) 
            ORDER BY sort_order ASC, created_at DESC
        ");
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function paginateVisible($page = 1, $perPage = 10, $orderBy = 'sort_order', $order = 'ASC') {
        $offset = ($page - 1) * $perPage;
        
        // Get total count of visible projects
        $countStmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE visible = 1");
        $countStmt->execute();
        $total = $countStmt->fetchColumn();
        
        $totalPages = ceil($total / $perPage);
        
        // Get visible projects with pagination
        $sql = "SELECT * FROM {$this->table} WHERE visible = 1 ORDER BY {$orderBy} {$order} LIMIT {$perPage} OFFSET {$offset}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'items' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'total_pages' => $totalPages,
            'has_next' => $page < $totalPages,
            'has_prev' => $page > 1,
            'next_page' => $page < $totalPages ? $page + 1 : null,
            'prev_page' => $page > 1 ? $page - 1 : null
        ];
    }
}
?>
