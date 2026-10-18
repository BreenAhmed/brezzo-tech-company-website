<?php
require_once BASE_PATH . '/app/Core/Controller.php';

class LanguageController extends Controller {
    
    public function switch($lang) {
        // Validate language
        if (!in_array($lang, SUPPORTED_LANGUAGES)) {
            $this->redirect('');
            return;
        }
        
        // Set new language
        $this->language->setLanguage($lang);
        
        // Redirect back to previous page or home
        $referer = $_SERVER['HTTP_REFERER'] ?? BASE_URL;
        
        // Make sure we're redirecting to our own domain
        $refererHost = parse_url($referer, PHP_URL_HOST);
        $currentHost = parse_url(BASE_URL, PHP_URL_HOST);
        
        if ($refererHost === $currentHost) {
            header('Location: ' . $referer);
        } else {
            $this->redirect('');
        }
        
        exit;
    }
}
?>
