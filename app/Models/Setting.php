<?php
require_once BASE_PATH . '/app/Core/Model.php';

class Setting extends Model {
    protected $table = 'settings';
    
    public function getValue($key, $default = null) {
        $stmt = $this->db->prepare("SELECT setting_value FROM {$this->table} WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['setting_value'] : $default;
    }
    
    public function setValue($key, $value, $type = 'text') {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (setting_key, setting_value, setting_type) 
            VALUES (?, ?, ?) 
            ON DUPLICATE KEY UPDATE 
            setting_value = VALUES(setting_value), 
            setting_type = VALUES(setting_type),
            updated_at = NOW()
        ");
        
        return $stmt->execute([$key, $value, $type]);
    }
    
    public function getMultiple($keys) {
        if (empty($keys)) {
            return [];
        }
        
        $placeholders = str_repeat('?,', count($keys) - 1) . '?';
        $stmt = $this->db->prepare("SELECT setting_key, setting_value FROM {$this->table} WHERE setting_key IN ($placeholders)");
        $stmt->execute($keys);
        
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['setting_key']] = $row['setting_value'];
        }
        
        return $result;
    }
    
    public function getAllSettings() {
        $stmt = $this->db->prepare("SELECT setting_key, setting_value, setting_type FROM {$this->table} ORDER BY setting_key");
        $stmt->execute();
        
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['setting_key']] = [
                'value' => $row['setting_value'],
                'type' => $row['setting_type']
            ];
        }
        
        return $result;
    }
    
    public function getContactInfo() {
        $keys = ['contact_email', 'contact_phone', 'contact_address'];
        return $this->getMultiple($keys);
    }
    
    public function getSocialLinks() {
        $keys = ['social_facebook', 'social_twitter', 'social_instagram', 'social_linkedin'];
        return $this->getMultiple($keys);
    }
    
    public function getSiteInfo() {
        $keys = ['site_title', 'site_description'];
        return $this->getMultiple($keys);
    }
    
    public function updateBatch($settings) {
        $this->db->beginTransaction();
        
        try {
            foreach ($settings as $key => $data) {
                $value = $data['value'] ?? $data;
                $type = $data['type'] ?? 'text';
                $this->setValue($key, $value, $type);
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
    
    public function deleteSetting($key) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE setting_key = ?");
        return $stmt->execute([$key]);
    }
}
?>
