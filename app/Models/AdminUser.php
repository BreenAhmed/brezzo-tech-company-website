<?php
require_once BASE_PATH . '/app/Core/Model.php';

class AdminUser extends Model {
    protected $table = 'admin_users';
    
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE (username = ? OR email = ?)");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    public function create($data) {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['password']);
        
        return $this->insert($data);
    }
    
    public function updatePassword($userId, $newPassword) {
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password_hash = ?, updated_at = NOW() WHERE id = ?");
        return $stmt->execute([$passwordHash, $userId]);
    }
    
    public function getActiveUsers() {
        $stmt = $this->db->prepare("SELECT id, username, email, role, created_at, updated_at FROM {$this->table} ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

