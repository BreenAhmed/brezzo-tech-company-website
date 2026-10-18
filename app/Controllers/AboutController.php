<?php
require_once BASE_PATH . '/app/Core/Controller.php';

class AboutController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $this->view('about/index', [
                'title' => $this->language->translate('seo.about.title'),
                'metaDescription' => $this->language->translate('seo.about.description'),
                'metaKeywords' => $this->language->translate('seo.about.keywords'),
                'currentPage' => 'about',
                'language' => $this->language,
                'additionalCss' => ['about.css', 'hero-language-button.css'],
                'additionalJs' => ['about-simple.js']
            ]);
        } catch (Exception $e) {
            error_log('About page error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load page content.'
            ]);
        }
    }
}
?>
