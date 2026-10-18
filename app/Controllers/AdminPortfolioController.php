<?php
require_once BASE_PATH . '/app/Controllers/AdminController.php';
require_once BASE_PATH . '/app/Models/PortfolioProjectImage.php';

class AdminPortfolioController extends AdminController {
    private $portfolioImageModel;
    
    public function __construct() {
        parent::__construct();
        $this->portfolioImageModel = new PortfolioProjectImage();
    }
    
    public function index() {
        $projects = $this->portfolioModel->getAll();
        
        $this->view('admin/portfolio/index', [
            'title' => 'Portfolio Management',
            'currentPage' => 'portfolio',
            'projects' => $projects
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'content' => $_POST['content'] ?? '',
                'client' => $_POST['client'] ?? '',
                'category' => $_POST['category'] ?? 'Web Development',
                'location' => $_POST['location'] ?? '',
                'project_url' => $_POST['project_url'] ?? '',
                'start_date' => $_POST['start_date'] ?? null,
                'end_date' => $_POST['end_date'] ?? null,
                'result_metrics' => $_POST['result_metrics'] ?? '',
                'visible' => isset($_POST['is_visible']) ? 1 : 0,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            // Handle featured image upload
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                $filename = $this->uploadFile($_FILES['featured_image'], 'uploads/portfolio');
                if ($filename) {
                    $data['featured_image'] = $filename;
                }
            }
            
            $projectId = $this->portfolioModel->create($data);
            
            if ($projectId) {
                // Handle additional images
                $this->handlePortfolioImageUploads($projectId);
                
                $_SESSION['success_message'] = 'Portfolio project created successfully!';
                $this->redirect('/admin/portfolio');
            } else {
                $error = 'Failed to create portfolio project';
            }
        }
        
        $this->view('admin/portfolio/create', [
            'title' => 'Create Portfolio Project',
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        $project = $this->portfolioModel->getById($id);
        if (!$project) {
            $_SESSION['error_message'] = 'Portfolio project not found';
            $this->redirect('/admin/portfolio');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'description' => $_POST['description'] ?? '',
                'content' => $_POST['content'] ?? '',
                'client' => $_POST['client'] ?? '',
                'category' => $_POST['category'] ?? 'Web Development',
                'location' => $_POST['location'] ?? '',
                'project_url' => $_POST['project_url'] ?? '',
                'start_date' => $_POST['start_date'] ?? null,
                'end_date' => $_POST['end_date'] ?? null,
                'result_metrics' => $_POST['result_metrics'] ?? '',
                'visible' => isset($_POST['is_visible']) ? 1 : 0,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            // Handle featured image upload
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                $filename = $this->uploadFile($_FILES['featured_image'], 'uploads/portfolio');
                if ($filename) {
                    // Delete old featured image
                    if ($project['featured_image']) {
                        $this->deleteFile($project['featured_image'], 'uploads/portfolio');
                    }
                    $data['featured_image'] = $filename;
                }
            }
            
            if ($this->portfolioModel->update($id, $data)) {
                // Handle additional images
                $this->handlePortfolioImageUploads($id);
                
                $_SESSION['success_message'] = 'Portfolio project updated successfully!';
                $this->redirect('/admin/portfolio');
            } else {
                $error = 'Failed to update portfolio project';
            }
        }
        
        $images = $this->portfolioImageModel->getByProjectId($id);
        
        $this->view('admin/portfolio/edit', [
            'title' => 'Edit Portfolio Project',
            'project' => $project,
            'images' => $images,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        $project = $this->portfolioModel->getById($id);
        if (!$project) {
            $_SESSION['error_message'] = 'Portfolio project not found';
            $this->redirect('/admin/portfolio');
        }
        
        // Delete featured image
        if ($project['featured_image']) {
            $this->deleteFile($project['featured_image'], 'uploads/portfolio');
        }
        
        // Delete additional images
        $images = $this->portfolioImageModel->getByProjectId($id);
        foreach ($images as $image) {
            $this->deleteFile($image['filename'], 'uploads/portfolio');
        }
        $this->portfolioImageModel->deleteByProjectId($id);
        
        if ($this->portfolioModel->delete($id)) {
            $_SESSION['success_message'] = 'Portfolio project deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete portfolio project';
        }
        
        $this->redirect('/admin/portfolio');
    }
    
    public function handlePortfolioImageUploads($projectId) {
        if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
            $imageCount = count($_FILES['images']['name']);
            
            for ($i = 0; $i < $imageCount; $i++) {
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $file = [
                        'name' => $_FILES['images']['name'][$i],
                        'type' => $_FILES['images']['type'][$i],
                        'tmp_name' => $_FILES['images']['tmp_name'][$i],
                        'error' => $_FILES['images']['error'][$i],
                        'size' => $_FILES['images']['size'][$i]
                    ];
                    
                    try {
                        $filename = $this->uploadFile($file, 'uploads/portfolio');
                        if ($filename) {
                            $altText = $_POST['image_alt'][$i] ?? '';
                            $this->portfolioImageModel->addToProject($projectId, $filename, $altText, $i);
                        }
                    } catch (Exception $e) {
                        // Log error but don't stop the process
                        error_log("Image upload error: " . $e->getMessage());
                    }
                }
            }
        }
    }
}

