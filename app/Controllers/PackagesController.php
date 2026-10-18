<?php
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Models/ServicePackage.php';

class PackagesController extends Controller {
    private $packageModel;
    
    public function __construct() {
        parent::__construct();
        $this->packageModel = new ServicePackage();
    }
    
    public function index() {
        try {
            // Get all visible packages
            $packages = $this->packageModel->getVisible();
            
            $this->view('packages/index', [
                'title' => $this->language->translate('seo.packages.title'),
                'metaDescription' => $this->language->translate('seo.packages.description'),
                'metaKeywords' => $this->language->translate('seo.packages.keywords'),
                'currentPage' => 'packages',
                'packages' => $packages,
                'additionalCss' => ['packages.css?v=' . time()],
                'additionalJs' => ['packages.js']
            ]);
        } catch (Exception $e) {
            error_log('Packages page error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load packages.'
            ]);
        }
    }
}
?>
