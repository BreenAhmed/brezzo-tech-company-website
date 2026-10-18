<?php
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Models/AdminUser.php';
require_once BASE_PATH . '/app/Models/BlogPost.php';
require_once BASE_PATH . '/app/Models/PortfolioProject.php';
require_once BASE_PATH . '/app/Models/ServicePackage.php';

class AdminController extends Controller {
    protected $adminUserModel;
    protected $blogPostModel;
    protected $portfolioModel;
    protected $partnerModel;
    protected $packageModel;
    protected $db;
    
    public function __construct() {
        parent::__construct();
        
        // Initialize database connection
        try {
            require_once BASE_PATH . '/config/config.php';
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
        
        $this->adminUserModel = new AdminUser();
        $this->blogPostModel = new BlogPost();
        $this->portfolioModel = new PortfolioProject();
        $this->partnerModel = null; // partners table not in current schema
        $this->packageModel = new ServicePackage();
        
        // Enable auth guard with clean URL routing
        if (!$this->isLoggedIn() && !$this->isLoginPage()) {
            $this->redirect('/admin/login');
        }
    }
    
    private function isLoggedIn() {
        return isset($_SESSION['admin_user_id']) && !empty($_SESSION['admin_user_id']);
    }
    
    private function isLoginPage() {
        $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
        // Normalize by stripping base folder (e.g. /brezzoF)
        $projectFolder = '/' . basename(BASE_PATH);
        if ($projectFolder !== '/' && strpos($currentPath, $projectFolder) === 0) {
            $currentPath = substr($currentPath, strlen($projectFolder));
        }
        // Normalize by stripping /index.php prefix if present
        if (strpos($currentPath, '/index.php') === 0) {
            $currentPath = substr($currentPath, strlen('/index.php'));
        }
        // Normalize trailing slash
        $currentPath = rtrim($currentPath, '/');
        return $currentPath === '/admin/login' || $currentPath === 'admin/login';
    }
    
    protected function redirect($url) {
        // Clear any output buffer to prevent "headers already sent" error
        if (ob_get_level()) {
            ob_end_clean();
        }
        header("Location: " . BASE_URL . $url);
        exit;
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->adminUserModel->authenticate($username, $password);
            
        if ($user) {
                $_SESSION['admin_user_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_role'] = $user['role'];
        $this->redirect('/admin/dashboard');
            } else {
                $error = 'Invalid username or password';
            }
        }
        
        $this->view('admin/auth/login', [
            'title' => 'Admin Login',
            'error' => $error ?? null
        ]);
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/admin/login');
    }
    
    public function dashboard() {
        // Get statistics
        $stats = [
            'blog_posts' => $this->blogPostModel->count(),
            'portfolio_projects' => $this->portfolioModel->count(),
            'partners' => 0,
            'packages' => $this->packageModel->count()
        ];
        
        // Get recent content
        $recentPosts = $this->blogPostModel->getAll(5);
        $recentProjects = $this->portfolioModel->getAll(5);
        
        $this->view('admin/dashboard/index', [
            'title' => 'Admin Dashboard',
            'currentPage' => 'dashboard',
            'stats' => $stats,
            'recentPosts' => $recentPosts,
            'recentProjects' => $recentProjects
        ]);
    }
    
    public function uploadFile($file, $directory = 'uploads') {
        // Validate file upload
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            error_log("Upload failed - No tmp_name");
            return false;
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors = [
                UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
                UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
                UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'PHP extension stopped the upload'
            ];
            error_log("Upload failed - Error code " . $file['error'] . ": " . ($errors[$file['error']] ?? 'Unknown error'));
            return false;
        }
        
        // Validate file exists and is uploaded
        if (!is_uploaded_file($file['tmp_name'])) {
            error_log("File is not an uploaded file: " . $file['tmp_name']);
            return false;
        }
        
        // Prepare upload directory
        $uploadDir = PUBLIC_PATH . '/' . $directory . '/';
        if (!is_dir($uploadDir)) {
            // Use 0755 for production compatibility (works on most shared hosting)
            if (!mkdir($uploadDir, 0755, true)) {
                error_log("Failed to create upload directory: " . $uploadDir);
                error_log("Check if parent directory exists and is writable");
                return false;
            }
            // Try to set permissions, but don't fail if it doesn't work
            @chmod($uploadDir, 0755);
        }
        
        // Ensure directory is writable
        if (!is_writable($uploadDir)) {
            error_log("Upload directory not writable: " . $uploadDir . " (permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4) . ")");
            // Try to fix permissions, but don't fail if it doesn't work (common on shared hosting)
            @chmod($uploadDir, 0755);
            if (!is_writable($uploadDir)) {
                error_log("Directory still not writable. Please set permissions manually via FTP/cPanel: chmod 755 " . $uploadDir);
                // Return false only if we can't write - some servers allow writes even if is_writable returns false
                // So we'll try the upload anyway
            }
        }
        
        // Validate file type
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (!in_array($extension, $allowedTypes)) {
            error_log("Invalid file type: " . $extension . " (allowed: " . implode(', ', $allowedTypes) . ")");
            return false;
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $filepath = $uploadDir . $filename;
        
        // Try move_uploaded_file first
        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            error_log("Successfully uploaded file to: " . $filepath);
            @chmod($filepath, 0644);
            return $filename;
        }
        
        // Fallback: try copy if move_uploaded_file fails
        error_log("move_uploaded_file failed, trying copy as fallback");
        if (copy($file['tmp_name'], $filepath)) {
            error_log("Successfully copied file to: " . $filepath);
            @chmod($filepath, 0644);
            @unlink($file['tmp_name']);
            return $filename;
        }
        
        error_log("Both move_uploaded_file and copy failed. Source: " . $file['tmp_name'] . " -> Dest: " . $filepath);
        error_log("Source exists: " . (file_exists($file['tmp_name']) ? 'yes' : 'no'));
        error_log("Source readable: " . (is_readable($file['tmp_name']) ? 'yes' : 'no'));
        error_log("Dest dir exists: " . (is_dir($uploadDir) ? 'yes' : 'no'));
        error_log("Dest dir writable: " . (is_writable($uploadDir) ? 'yes' : 'no'));
        
        return false;
    }
    
    public function deleteFile($filename, $directory = 'uploads') {
        $filepath = PUBLIC_PATH . '/' . $directory . '/' . $filename;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }
    
    public function handleImageUploads($postId, $tableName) {
        error_log("handleImageUploads called with postId: $postId, tableName: $tableName");
        error_log("FILES array: " . print_r($_FILES, true));
        error_log("POST array: " . print_r($_POST, true));
        
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            error_log("No images found in FILES array");
            return;
        }
        
        $files = $_FILES['images'];
        $uploadDir = PUBLIC_PATH . '/uploads/blog/';
        if (!is_dir($uploadDir)) {
            if (mkdir($uploadDir, 0755, true)) {
                @chmod($uploadDir, 0755);
                error_log("Created upload directory: $uploadDir");
            } else {
                error_log("Failed to create upload directory: $uploadDir");
            }
        }
        
        $uploadedCount = 0;
        for ($i = 0; $i < count($files['name']); $i++) {
            if ($files['error'][$i] === UPLOAD_ERR_OK) {
                $extension = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (in_array($extension, $allowedTypes)) {
                    $filename = uniqid() . '_' . time() . '_' . $i . '.' . $extension;
                    $filepath = $uploadDir . $filename;
                    
                    if (move_uploaded_file($files['tmp_name'][$i], $filepath)) {
                        // Add to database
                        $stmt = $this->db->prepare("INSERT INTO {$tableName} (post_id, filename, alt_text, sort_order) VALUES (?, ?, ?, ?)");
                        $altText = $_POST['image_alt'][$i] ?? '';
                        $result = $stmt->execute([$postId, $filename, $altText, $i]);
                        
                        if ($result) {
                            $uploadedCount++;
                            error_log("Successfully uploaded and saved image: $filename");
                        } else {
                            error_log("Failed to save image to database: $filename");
                        }
                    } else {
                        error_log("Failed to move uploaded file: " . $files['name'][$i]);
                    }
                } else {
                    error_log("Invalid file type: " . $files['name'][$i] . " (extension: $extension)");
                }
            } else {
                error_log("Upload error for file $i: " . $files['error'][$i]);
            }
        }
        
        error_log("Total images uploaded: $uploadedCount");
    }
}
