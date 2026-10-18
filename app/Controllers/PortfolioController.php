<?php
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Models/PortfolioProject.php';
require_once BASE_PATH . '/app/Models/PortfolioProjectImage.php';

class PortfolioController extends Controller {
    private $projectModel;
    private $imageModel;
    
    public function __construct() {
        parent::__construct();
        $this->projectModel = new PortfolioProject();
        $this->imageModel = new PortfolioProjectImage();
    }
    
    public function index() {
        try {
            $page = intval($this->input('page', 1));
            $category = $this->input('category');
            $search = $this->input('search');
            
            // Get projects with pagination
            if ($search) {
                $projects = $this->projectModel->getVisible(); // Simple search for now
                $pagination = null;
            } elseif ($category) {
                $projects = $this->projectModel->getByCategory($category);
                $pagination = null;
            } else {
                $projects = $this->projectModel->getVisible();
                $pagination = null; // Simplified for now
            }
            
            // Get available categories for filter
            $categories = $this->projectModel->getCategories();
            
            $this->view('portfolio/index', [
                'title' => $this->language->translate('seo.portfolio.title'),
                'metaDescription' => $this->language->translate('seo.portfolio.description'),
                'metaKeywords' => $this->language->translate('seo.portfolio.keywords'),
                'currentPage' => 'portfolio',
                'projects' => $projects,
                'categories' => $categories,
                'currentCategory' => $category,
                'currentSearch' => $search,
                'pagination' => $pagination,
                'additionalCss' => ['portfolio.css?v=' . time()],
                'additionalJs' => ['portfolio.js?v=' . time()]
            ]);
        } catch (Exception $e) {
            error_log('Portfolio page error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load portfolio.'
            ]);
        }
    }
    
    public function detail($slug) {
        try {
            $project = $this->projectModel->getBySlug($slug);
            
            if (!$project || !$project['visible']) {
                $this->view('errors/404', [
                    'title' => 'Project Not Found',
                    'error' => 'The requested project could not be found.'
                ]);
                return;
            }
            
            // Get project images
            $images = $this->imageModel->getByProjectId($project['id']);
            
            // Get related projects
            $relatedProjects = $this->projectModel->getByCategory($project['category']);
            $relatedProjects = array_filter($relatedProjects, function($p) use ($project) {
                return $p['id'] !== $project['id'];
            });
            $relatedProjects = array_slice($relatedProjects, 0, 3);
            
            $projectDescription = !empty($project['description']) ? substr(strip_tags($project['description']), 0, 155) : ($this->language->getCurrentLanguage() === 'ar' ? 'مشروع تطوير المواقع والتسويق الرقمي في أربيل، العراق من بريزو.' : 'Web development and digital marketing project in Erbil, Iraq by Brezzo.');
            
            $this->view('portfolio/detail', [
                'title' => $project['title'] . ($this->language->getCurrentLanguage() === 'ar' ? ' - مشروع أعمال | بريزو أربيل، العراق' : ' - Portfolio Project | Brezzo Erbil, Iraq'),
                'metaDescription' => $projectDescription . ($this->language->getCurrentLanguage() === 'ar' ? ' خدمات احترافية في تطوير المواقع والتسويق الرقمي في أربيل، العراق.' : ' Professional web development and digital marketing services in Erbil, Iraq.'),
                'metaKeywords' => $project['title'] . ($this->language->getCurrentLanguage() === 'ar' ? ', تطوير المواقع أربيل, التسويق الرقمي العراق, ' : ', web development Erbil, digital marketing Iraq, ') . ($project['category'] ?? '') . ($this->language->getCurrentLanguage() === 'ar' ? ' أربيل, مشروع أعمال كردستان' : ' Erbil, portfolio project Kurdistan'),
                'currentPage' => 'portfolio',
                'project' => $project,
                'images' => $images,
                'relatedProjects' => $relatedProjects,
                'additionalCss' => ['portfolio.css?v=' . time()],
                'additionalJs' => ['portfolio.js?v=' . time()]
            ]);
        } catch (Exception $e) {
            error_log('Portfolio detail error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load project details.'
            ]);
        }
    }
}
?>
