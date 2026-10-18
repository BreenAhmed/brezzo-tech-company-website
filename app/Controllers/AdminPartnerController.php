<?php
require_once BASE_PATH . '/app/Controllers/AdminController.php';
require_once BASE_PATH . '/app/Models/Partner.php';

class AdminPartnerController extends AdminController {
    
    public function __construct() {
        parent::__construct();
        $this->partnerModel = new Partner();
    }
    
    public function index() {
        $partners = $this->partnerModel->getAll();
        
        $this->view('admin/partners/index', [
            'title' => 'Partners Management',
            'currentPage' => 'partners',
            'partners' => $partners
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'website' => $_POST['website'] ?? '',
                'description' => $_POST['description'] ?? '',
                'is_visible' => isset($_POST['is_visible']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            // Handle logo upload
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $filename = $this->uploadFile($_FILES['logo'], 'uploads/partners');
                if ($filename) {
                    $data['logo'] = $filename;
                }
            }
            
            if ($this->partnerModel->create($data)) {
                $_SESSION['success_message'] = 'Partner created successfully!';
                $this->redirect('/admin/partners');
            } else {
                $error = 'Failed to create partner';
            }
        }
        
        $this->view('admin/partners/create', [
            'title' => 'Create Partner',
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        $partner = $this->partnerModel->getById($id);
        if (!$partner) {
            $_SESSION['error_message'] = 'Partner not found';
            $this->redirect('/admin/partners');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'website' => $_POST['website'] ?? '',
                'description' => $_POST['description'] ?? '',
                'is_visible' => isset($_POST['is_visible']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            // Handle logo upload
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $filename = $this->uploadFile($_FILES['logo'], 'uploads/partners');
                if ($filename) {
                    // Delete old logo
                    if ($partner['logo']) {
                        $this->deleteFile($partner['logo'], 'uploads/partners');
                    }
                    $data['logo'] = $filename;
                }
            }
            
            if ($this->partnerModel->update($id, $data)) {
                $_SESSION['success_message'] = 'Partner updated successfully!';
                $this->redirect('/admin/partners');
            } else {
                $error = 'Failed to update partner';
            }
        }
        
        $this->view('admin/partners/edit', [
            'title' => 'Edit Partner',
            'partner' => $partner,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        $partner = $this->partnerModel->getById($id);
        if (!$partner) {
            $_SESSION['error_message'] = 'Partner not found';
            $this->redirect('/admin/partners');
        }
        
        // Delete logo
        if ($partner['logo']) {
            $this->deleteFile($partner['logo'], 'uploads/partners');
        }
        
        if ($this->partnerModel->delete($id)) {
            $_SESSION['success_message'] = 'Partner deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete partner';
        }
        
        $this->redirect('/admin/partners');
    }
    
    public function toggleVisibility($id) {
        if ($this->partnerModel->toggleVisibility($id)) {
            $_SESSION['success_message'] = 'Partner visibility updated!';
        } else {
            $_SESSION['error_message'] = 'Failed to update partner visibility';
        }
        
        $this->redirect('/admin/partners');
    }
}
?>

