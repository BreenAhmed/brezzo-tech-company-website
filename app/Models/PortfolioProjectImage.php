<?php
require_once BASE_PATH . '/app/Core/Model.php';

class PortfolioProjectImage extends Model {
    protected $table = 'project_images';
    
    public function getByProjectId($projectId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE project_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$projectId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addToProject($projectId, $filename, $altText = '', $sortOrder = 0) {
        return parent::create([
            'project_id' => $projectId,
            'filename' => $filename,
            'alt_text' => $altText,
            'sort_order' => $sortOrder
        ]);
    }
    
    public function updateSortOrder($id, $sortOrder) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET sort_order = ? WHERE id = ?");
        return $stmt->execute([$sortOrder, $id]);
    }
    
    public function deleteByProjectId($projectId) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE project_id = ?");
        return $stmt->execute([$projectId]);
    }
}
?>
