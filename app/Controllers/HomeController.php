<?php
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Models/PortfolioProject.php';
require_once BASE_PATH . '/app/Models/BlogPost.php';
require_once BASE_PATH . '/app/Models/Package.php';
require_once BASE_PATH . '/app/Models/Partner.php';

class HomeController extends Controller {
    private $projectModel;
    private $postModel;
    private $packageModel;
    private $partnerModel;
    
    public function __construct() {
        parent::__construct();
        $this->projectModel = new PortfolioProject();
        $this->postModel = new BlogPost();
        $this->packageModel = new Package();
        $this->partnerModel = new Partner();
    }
    
    public function index() {
        try {
            // Get featured content
            $featuredProjects = $this->projectModel->getFeatured(6);
            $latestPosts = $this->postModel->getFeatured(3);
            $packages = $this->packageModel->getFeatured(3);
            $partners = $this->partnerModel->getVisible(12);
            // Get stats for counter animation
            $stats = [
                'projects' => 20,
                'clients' => 20, // This could be from a clients table
                'experience' => 5,
                'satisfaction' => 98
            ];
            
            $this->view('home/index', [
                'title' => $this->language->translate('seo.home.title'),
                'metaDescription' => $this->language->translate('seo.home.description'),
                'metaKeywords' => $this->language->translate('seo.home.keywords'),
                'currentPage' => 'home',
                'featuredProjects' => $featuredProjects,
                'latestPosts' => $latestPosts,
                'packages' => $packages,
                'partners' => $partners,
                'stats' => $stats,
                'additionalCss' => ['home.css'],
                'additionalJs' => ['home.js', 'hero-creative.js']
            ]);
        } catch (Exception $e) {
            error_log('Home page error: ' . $e->getMessage());
            
            // Show error page or minimal content
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load page content.'
            ]);
        }
    }
}
?>
