<?php
class Controller {
    protected $view;
    protected $language;
    
    public function __construct() {
        // Ensure View class is available
        if (!class_exists('View')) {
            require_once BASE_PATH . '/app/Core/View.php';
        }
        
        try {
            $this->view = new View();
        } catch (Exception $e) {
            echo "Error creating View: " . $e->getMessage();
            $this->view = null;
        }
        
        try {
            if (!class_exists('Language')) {
                require_once BASE_PATH . '/app/Helpers/Language.php';
            }
            $this->language = new Language();
            $this->language->initialize();
        } catch (Exception $e) {
            // Fallback if language initialization fails
            $this->language = null;
        }
    }
    
    public function view($template, $data = []) {
        // Check if view is available
        if ($this->view === null) {
            // Try to create view again
            if (!class_exists('View')) {
                require_once BASE_PATH . '/app/Core/View.php';
            }
            $this->view = new View();
        }
        
        // Add global data
        if ($this->language) {
            $data['lang'] = $this->language->getCurrentLanguage();
            $data['isRtl'] = $this->language->isRtl();
            $data['t'] = function($key, $params = []) {
                return $this->language->translate($key, $params);
            };
        } else {
            // Fallback for admin pages
            $data['lang'] = 'en';
            $data['isRtl'] = false;
            $data['t'] = function($key, $params = []) {
                return $key; // Return key as-is if no translation
            };
        }
        
        $this->view->render($template, $data);
    }
    
    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function redirect($url) {
        $target = BASE_URL . '/' . ltrim($url, '/');
        // If Apache rewrite is off, ensure /index.php remains in URL
        if (strpos($url, 'index.php') !== 0 && !preg_match('#/index\.php/#', $url)) {
            // keep as is; callers can pass /index.php/... when needed
        }
        header('Location: ' . $target, true, 302);
        exit;
    }
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    protected function input($key, $default = null) {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }
    
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            $ruleList = explode('|', $rule);
            
            foreach ($ruleList as $singleRule) {
                if ($singleRule === 'required' && empty($value)) {
                    $errors[$field] = "The $field field is required.";
                    break;
                }
                
                if (strpos($singleRule, 'min:') === 0 && strlen($value) < substr($singleRule, 4)) {
                    $minLength = substr($singleRule, 4);
                    $errors[$field] = "The $field field must be at least $minLength characters.";
                    break;
                }
                
                if (strpos($singleRule, 'max:') === 0 && strlen($value) > substr($singleRule, 4)) {
                    $maxLength = substr($singleRule, 4);
                    $errors[$field] = "The $field field must not exceed $maxLength characters.";
                    break;
                }
                
                if ($singleRule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "The $field field must be a valid email address.";
                    break;
                }
            }
        }
        
        return $errors;
    }
    
    protected function generateCsrfToken() {
        if (!isset($_SESSION[CSRF_TOKEN_KEY])) {
            $_SESSION[CSRF_TOKEN_KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[CSRF_TOKEN_KEY];
    }
    
    protected function validateCsrfToken($token) {
        return isset($_SESSION[CSRF_TOKEN_KEY]) && hash_equals($_SESSION[CSRF_TOKEN_KEY], $token);
    }
}
?>
