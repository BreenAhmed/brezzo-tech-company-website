<?php
require_once BASE_PATH . '/app/Core/Model.php';

class BlogPostImage extends Model {
    protected $table = 'blog_post_images';
    
    public function getByPostId($postId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE post_id = ? ORDER BY sort_order ASC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addToPost($postId, $filename, $altText = '', $sortOrder = 0) {
        return parent::create([
            'post_id' => $postId,
            'filename' => $filename,
            'alt_text' => $altText,
            'sort_order' => $sortOrder
        ]);
    }
    
    public function updateSortOrder($id, $sortOrder) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET sort_order = ? WHERE id = ?");
        return $stmt->execute([$sortOrder, $id]);
    }
    
    public function deleteByPostId($postId) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE post_id = ?");
        return $stmt->execute([$postId]);
    }
}
?>
