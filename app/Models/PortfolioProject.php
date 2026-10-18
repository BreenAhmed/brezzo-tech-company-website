<?php
require_once BASE_PATH . '/app/Core/Model.php';

class PortfolioProject extends Model {
    protected $table = 'projects';
    
    public function getVisible($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} WHERE visible = 1 ORDER BY sort_order ASC, created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFeatured($limit = 6) {
        $limit = (int)$limit;
        $sql = "SELECT * FROM {$this->table} WHERE visible = 1 ORDER BY sort_order ASC, created_at DESC LIMIT {$limit}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND visible = 1");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getByCategory($category, $limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE category = ? AND visible = 1 ORDER BY sort_order ASC, created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategories() {
        $stmt = $this->db->prepare("SELECT DISTINCT category FROM {$this->table} WHERE visible = 1 ORDER BY category");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function create($data) {
        $data['slug'] = $this->generateSlug($data['title']);
        return parent::create($data);
    }
    
    public function update($id, $data) {
        if (isset($data['title'])) {
            $data['slug'] = $this->generateSlug($data['title']);
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
