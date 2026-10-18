<?php
require_once BASE_PATH . '/app/Core/Model.php';

class BlogPost extends Model {
    protected $table = 'posts';
    
    public function getPublished($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'published' ORDER BY publish_date DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFeatured($limit = 3) {
        $limit = (int)$limit;
        $sql = "SELECT * FROM {$this->table} WHERE status = 'published' ORDER BY publish_date DESC LIMIT {$limit}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND status = 'published'");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getByCategory($category, $limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE category = ? AND status = 'published' ORDER BY publish_date DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategories() {
        $stmt = $this->db->prepare("SELECT DISTINCT category FROM {$this->table} WHERE status = 'published' ORDER BY category");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function incrementViewCount($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET view_count = view_count + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function create($data) {
        $data['slug'] = $this->generateSlug($data['title']);
        if ($data['status'] === 'published' && empty($data['publish_date'])) {
            $data['publish_date'] = date('Y-m-d H:i:s');
        }
        
        return parent::create($data);
    }
    
    public function update($id, $data) {
        if (isset($data['title'])) {
            $data['slug'] = $this->generateSlug($data['title']);
        }
        if ($data['status'] === 'published' && empty($data['publish_date'])) {
            $data['publish_date'] = date('Y-m-d H:i:s');
        }
        
        return parent::update($id, $data);
    }
    
    private function generateSlug($title) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    private function slugExists($slug) {
        $stmt = $this->db->prepare("SELECT id FROM {$this->table} WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch() !== false;
    }
}
?>
