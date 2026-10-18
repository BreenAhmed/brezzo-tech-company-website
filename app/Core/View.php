<?php
class View {
    private $templatePath;
    
    public function __construct() {
        $this->templatePath = BASE_PATH . '/app/Views/';
    }
    
    public function render($template, $data = []) {
        $templateFile = $this->templatePath . $template . '.php';
        
        if (!file_exists($templateFile)) {
            throw new Exception('Template not found: ' . $template);
        }
        
        // Extract data to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include template
        include $templateFile;
        
        // Get content
        $content = ob_get_clean();
        
        // Output content
        echo $content;
    }
    
    public function partial($partial, $data = []) {
        $partialFile = $this->templatePath . 'partials/' . $partial . '.php';
        
        if (!file_exists($partialFile)) {
            throw new Exception('Partial not found: ' . $partial);
        }
        
        // Extract data to variables
        extract($data);
        
        // Include partial
        include $partialFile;
    }
    
    public function asset($path) {
        return BASE_URL . '/public/' . ltrim($path, '/');
    }
    
    public function url($path = '') {
        return BASE_URL . '/' . ltrim($path, '/');
    }
    
    public function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    
    public function formatDate($date, $format = 'M j, Y') {
        if (is_string($date)) {
            $date = new DateTime($date);
        }
        return $date->format($format);
    }
    
    public function truncate($text, $length = 100, $suffix = '...') {
        if (strlen($text) <= $length) {
            return $text;
        }
        
        return substr($text, 0, $length) . $suffix;
    }
}
?>
