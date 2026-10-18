<?php
require_once BASE_PATH . '/app/Models/Package.php';

class ServicePackage extends Package {
    protected $table = 'packages';
    
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
    
    protected function normalizeData(array $data, $id = null): array {
        if (isset($data['features'])) {
            if (is_array($data['features'])) {
                $data['features'] = json_encode(array_values(array_filter($data['features'], function ($feature) {
                    return $feature !== null && $feature !== '';
                })));
            } elseif ($data['features'] === null) {
                $data['features'] = json_encode([]);
            }
        }
        
        if (isset($data['features_ar'])) {
            if (is_array($data['features_ar'])) {
                $data['features_ar'] = json_encode(array_values(array_filter($data['features_ar'], function ($feature) {
                    return $feature !== null && $feature !== '';
                })));
            } elseif ($data['features_ar'] === null) {
                $data['features_ar'] = json_encode([]);
            }
        }
        
        if (isset($data['is_visible'])) {
            $data['is_visible'] = (int) (bool) $data['is_visible'];
        }
        
        if (isset($data['is_popular'])) {
            $data['is_popular'] = (int) (bool) $data['is_popular'];
        }
        
        if (!empty($data['name'])) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $id);
        }
        
        if (!isset($data['currency']) || !$data['currency']) {
            $data['currency'] = 'USD';
        }
        
        if (!isset($data['cta_text']) || $data['cta_text'] === '') {
            $data['cta_text'] = 'Get Started';
        }
        
        return $data;
    }
    
    public function create($data) {
        $data = $this->normalizeData($data);
        return parent::create($data);
    }
    
    public function update($id, $data) {
        $data = $this->normalizeData($data, $id);
        return parent::update($id, $data);
    }
    
    public function getById($id) {
        $result = parent::getById($id);
        if ($result && isset($result['features']) && is_string($result['features'])) {
            $result['features'] = json_decode($result['features'], true);
        }
        if ($result && isset($result['features_ar']) && is_string($result['features_ar'])) {
            $result['features_ar'] = json_decode($result['features_ar'], true);
        }
        return $result;
    }
}

