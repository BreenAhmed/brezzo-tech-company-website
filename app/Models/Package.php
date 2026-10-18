<?php
require_once BASE_PATH . '/app/Core/Model.php';
require_once BASE_PATH . '/app/Helpers/Security.php';

class Package extends Model {
    protected $table = 'packages';
    
    public function getVisible() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_visible = 1 ORDER BY sort_order ASC, created_at ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPopular() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_visible = 1 AND is_popular = 1 ORDER BY sort_order ASC");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getFeatured($limit = 3) {
        $limit = (int)$limit;
        $sql = "SELECT * FROM {$this->table} WHERE is_visible = 1 ORDER BY is_popular DESC, sort_order ASC LIMIT {$limit}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFeatures($packageId) {
        $package = $this->find($packageId);
        if ($package && !empty($package['features'])) {
            return json_decode($package['features'], true);
        }
        return [];
    }
    
    public function setFeatures($packageId, $features) {
        $featuresJson = json_encode($features);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET features = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$featuresJson, $packageId]);
    }
    
    public function generateUniqueSlug($name, $id = null) {
        $slug = Security::generateSlug($name);
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
    
    public function formatPrice($price, $currency = 'USD') {
        switch ($currency) {
            case 'USD':
                return '$' . number_format($price, 0);
            case 'EUR':
                return '€' . number_format($price, 0);
            case 'GBP':
                return '£' . number_format($price, 0);
            default:
                return $currency . ' ' . number_format($price, 2);
        }
    }
    
    public function duplicate($packageId) {
        $package = $this->find($packageId);
        if (!$package) {
            return false;
        }
        
        // Remove id and update name/slug
        unset($package['id']);
        $package['name'] = $package['name'] . ' (Copy)';
        $package['slug'] = $this->generateUniqueSlug($package['name']);
        $package['is_visible'] = 0; // Make copy invisible by default
        
        return $this->create($package);
    }
    
    public function toggleVisibility($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_visible = NOT is_visible WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function togglePopular($id) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_popular = NOT is_popular WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
