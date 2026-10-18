<?php
require_once BASE_PATH . '/app/Core/Model.php';

class Partner extends Model {
    protected $table = 'partners';
    
    public function getVisible($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE is_visible = 1 ORDER BY sort_order ASC, created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAll($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} ORDER BY sort_order ASC, created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit} OFFSET {$offset}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateSortOrder($id, $sortOrder) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET sort_order = ? WHERE id = ?");
        return $stmt->execute([$sortOrder, $id]);
    }
    
    public function toggleVisibility($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_visible = NOT is_visible WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>