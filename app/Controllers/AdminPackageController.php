<?php
require_once BASE_PATH . '/app/Controllers/AdminController.php';

class AdminPackageController extends AdminController {
    
    public function index() {
        $packages = $this->packageModel->getAll();
        
        $this->view('admin/packages/index', [
            'title' => 'Packages Management',
            'currentPage' => 'packages',
            'packages' => $packages
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $features = [];
            if (isset($_POST['features']) && is_array($_POST['features'])) {
                $features = array_filter($_POST['features']); // Remove empty features
            }
            
            $features_ar = [];
            if (isset($_POST['features_ar']) && is_array($_POST['features_ar'])) {
                $features_ar = array_filter($_POST['features_ar']); // Remove empty features
            }
            
            $data = [
                'name' => $_POST['name'] ?? '',
                'name_ar' => $_POST['name_ar'] ?? '',
                'description' => $_POST['description'] ?? '',
                'description_ar' => $_POST['description_ar'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'currency' => $_POST['currency'] ?? 'USD',
                'features' => $features,
                'features_ar' => $features_ar,
                'is_popular' => isset($_POST['is_popular']) ? 1 : 0,
                'is_visible' => isset($_POST['is_visible']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            if ($this->packageModel->create($data)) {
                $_SESSION['success_message'] = 'Package created successfully!';
                $this->redirect('/admin/packages');
            } else {
                $error = 'Failed to create package';
            }
        }
        
        $this->view('admin/packages/create', [
            'title' => 'Create Package',
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        $package = $this->packageModel->getById($id);
        if (!$package) {
            $_SESSION['error_message'] = 'Package not found';
            $this->redirect('/admin/packages');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $features = [];
            if (isset($_POST['features']) && is_array($_POST['features'])) {
                $features = array_filter($_POST['features']); // Remove empty features
            }
            
            $features_ar = [];
            if (isset($_POST['features_ar']) && is_array($_POST['features_ar'])) {
                $features_ar = array_filter($_POST['features_ar']); // Remove empty features
            }
            
            $data = [
                'name' => $_POST['name'] ?? '',
                'name_ar' => $_POST['name_ar'] ?? '',
                'description' => $_POST['description'] ?? '',
                'description_ar' => $_POST['description_ar'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'currency' => $_POST['currency'] ?? 'USD',
                'features' => $features,
                'features_ar' => $features_ar,
                'is_popular' => isset($_POST['is_popular']) ? 1 : 0,
                'is_visible' => isset($_POST['is_visible']) ? 1 : 0,
                'sort_order' => $_POST['sort_order'] ?? 0
            ];
            
            if ($this->packageModel->update($id, $data)) {
                $_SESSION['success_message'] = 'Package updated successfully!';
                $this->redirect('/admin/packages');
            } else {
                $error = 'Failed to update package';
            }
        }
        
        $this->view('admin/packages/edit', [
            'title' => 'Edit Package',
            'package' => $package,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        $package = $this->packageModel->getById($id);
        if (!$package) {
            $_SESSION['error_message'] = 'Package not found';
            $this->redirect('/admin/packages');
        }
        
        if ($this->packageModel->delete($id)) {
            $_SESSION['success_message'] = 'Package deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete package';
        }
        
        $this->redirect('/admin/packages');
    }
    
    public function toggleVisibility($id) {
        if ($this->packageModel->toggleVisibility($id)) {
            $_SESSION['success_message'] = 'Package visibility updated!';
        } else {
            $_SESSION['error_message'] = 'Failed to update package visibility';
        }
        
        $this->redirect('/admin/packages');
    }
    
    public function togglePopular($id) {
        if ($this->packageModel->togglePopular($id)) {
            $_SESSION['success_message'] = 'Package popularity updated!';
        } else {
            $_SESSION['error_message'] = 'Failed to update package popularity';
        }
        
        $this->redirect('/admin/packages');
    }
}
?>

