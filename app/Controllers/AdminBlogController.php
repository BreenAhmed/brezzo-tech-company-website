<?php
require_once BASE_PATH . '/app/Controllers/AdminController.php';
require_once BASE_PATH . '/app/Models/BlogPostImage.php';

class AdminBlogController extends AdminController {
    private $blogImageModel;
    
    public function __construct() {
        parent::__construct();
        $this->blogImageModel = new BlogPostImage();
    }
    
    public function index() {
        $posts = $this->blogPostModel->getAll();
        
        $this->view('admin/blog/index', [
            'title' => 'Blog Management',
            'currentPage' => 'blog',
            'posts' => $posts
        ]);
    }
    
    public function create() {
        error_log("AdminBlogController::create() called");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                error_log("POST request received for blog creation");
                $data = [
                    'title' => $_POST['title'] ?? '',
                    'excerpt' => $_POST['excerpt'] ?? '',
                    'content' => $_POST['content'] ?? '',
                    'category' => $_POST['category'] ?? 'General',
                    'tags' => $_POST['tags'] ?? '',
                    'status' => $_POST['status'] ?? 'draft',
                    'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                    'meta_description' => $_POST['meta_description'] ?? ''
                ];
                
                // Handle featured image upload
                if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                    $filename = $this->uploadFile($_FILES['featured_image'], 'uploads/blog');
                    if ($filename) {
                        $data['featured_image'] = $filename;
                    } else {
                        $error = 'Failed to upload featured image. Please check directory permissions and try again.';
                        error_log("Featured image upload failed for blog post");
                    }
                }
                
                if (!isset($error)) {
                    $postId = $this->blogPostModel->create($data);
                    
                    if ($postId) {
                        // Handle additional images
                        $this->handleImageUploads($postId, 'blog_post_images');
                        
                        $_SESSION['success_message'] = 'Blog post created successfully!';
                        $this->redirect('/admin/blog');
                    } else {
                        $error = 'Failed to create blog post. Please check error log for details.';
                        error_log("Blog post creation failed. Data: " . print_r($data, true));
                    }
                }
            } catch (Exception $e) {
                error_log("Error in AdminBlogController::create(): " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                $error = 'Error creating blog post: ' . $e->getMessage();
            }
        }
        
        $this->view('admin/blog/create', [
            'title' => 'Create Blog Post',
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        $post = $this->blogPostModel->getById($id);
        if (!$post) {
            $_SESSION['error_message'] = 'Blog post not found';
            $this->redirect('/admin/blog');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'title_ar' => $_POST['title_ar'] ?? '',
                'excerpt' => $_POST['excerpt'] ?? '',
                'excerpt_ar' => $_POST['excerpt_ar'] ?? '',
                'content' => $_POST['content'] ?? '',
                'content_ar' => $_POST['content_ar'] ?? '',
                'category' => $_POST['category'] ?? 'General',
                'tags' => $_POST['tags'] ?? '',
                'status' => $_POST['status'] ?? 'draft',
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'meta_description' => $_POST['meta_description'] ?? '',
                'meta_description_ar' => $_POST['meta_description_ar'] ?? ''
            ];
            
            // Handle featured image upload
            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
                $filename = $this->uploadFile($_FILES['featured_image'], 'uploads/blog');
                if ($filename) {
                    // Delete old featured image
                    if ($post['featured_image']) {
                        $this->deleteFile($post['featured_image'], 'uploads/blog');
                    }
                    $data['featured_image'] = $filename;
                }
            }
            
            if ($this->blogPostModel->update($id, $data)) {
                // Handle additional images
                $this->handleImageUploads($id, 'blog_post_images');
                
                $_SESSION['success_message'] = 'Blog post updated successfully!';
                $this->redirect('/admin/blog');
            } else {
                $error = 'Failed to update blog post';
            }
        }
        
        $images = $this->blogImageModel->getByPostId($id);
        
        $this->view('admin/blog/edit', [
            'title' => 'Edit Blog Post',
            'post' => $post,
            'images' => $images,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        $post = $this->blogPostModel->getById($id);
        if (!$post) {
            $_SESSION['error_message'] = 'Blog post not found';
            $this->redirect('/admin/blog');
        }
        
        // Delete featured image
        if ($post['featured_image']) {
            $this->deleteFile($post['featured_image'], 'uploads/blog');
        }
        
        // Delete additional images
        $images = $this->blogImageModel->getByPostId($id);
        foreach ($images as $image) {
            $this->deleteFile($image['filename'], 'uploads/blog');
        }
        $this->blogImageModel->deleteByPostId($id);
        
        if ($this->blogPostModel->delete($id)) {
            $_SESSION['success_message'] = 'Blog post deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete blog post';
        }
        
        $this->redirect('/admin/blog');
    }
    
}
?>
