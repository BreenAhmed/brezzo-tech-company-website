<?php
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Models/BlogPost.php';
require_once BASE_PATH . '/app/Models/BlogPostImage.php';

class BlogController extends Controller {
    private $postModel;
    private $imageModel;
    
    public function __construct() {
        parent::__construct();
        $this->postModel = new BlogPost();
        $this->imageModel = new BlogPostImage();
    }
    
    public function index() {
        try {
            $page = intval($this->input('page', 1));
            $category = $this->input('category');
            $search = $this->input('search');
            
            // Get posts with pagination
            if ($search) {
                $posts = $this->postModel->getAll(); // Simple search for now
                $pagination = null;
            } elseif ($category) {
                $posts = $this->postModel->getByCategory($category);
                $pagination = null;
            } else {
                $posts = $this->postModel->getPublished(9);
                $pagination = null; // Simplified for now
            }
            
            // Add featured images (fallback to first post image if no featured image)
            foreach ($posts as &$post) {
                if (empty($post['featured_image'])) {
                    $images = $this->imageModel->getByPostId($post['id']);
                    if (!empty($images)) {
                        $post['featured_image'] = $images[0]['filename'];
                    }
                }
            }
            unset($post);
            
            // Get available categories for filter
            $categories = $this->postModel->getCategories();
            
            // Get recent posts for sidebar
            $recentPosts = $this->postModel->getPublished(5);
            
            // Add featured images to recent posts
            foreach ($recentPosts as &$post) {
                if (empty($post['featured_image'])) {
                    $images = $this->imageModel->getByPostId($post['id']);
                    if (!empty($images)) {
                        $post['featured_image'] = $images[0]['filename'];
                    }
                }
            }
            unset($post);
            
            $this->view('blog/index', [
                'title' => $this->language->translate('seo.blog.title'),
                'metaDescription' => $this->language->translate('seo.blog.description'),
                'metaKeywords' => $this->language->translate('seo.blog.keywords'),
                'currentPage' => 'blog',
                'posts' => $posts,
                'categories' => $categories,
                'recentPosts' => $recentPosts,
                'currentCategory' => $category,
                'currentSearch' => $search,
                'pagination' => $pagination,
                'additionalCss' => ['blog.css?v=' . time()],
                'additionalJs' => ['blog.js']
            ]);
        } catch (Exception $e) {
            error_log('Blog page error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load blog.'
            ]);
        }
    }
    
    public function detail($slug) {
        try {
            $post = $this->postModel->getBySlug($slug);
            
            if (!$post || $post['status'] !== 'published') {
                $this->view('errors/404', [
                    'title' => 'Post Not Found',
                    'error' => 'The requested blog post could not be found.'
                ]);
                return;
            }
            
            // Get related posts
            $relatedPosts = $this->postModel->getByCategory($post['category']);
            $relatedPosts = array_filter($relatedPosts, function($p) use ($post) {
                return $p['id'] !== $post['id'];
            });
            $relatedPosts = array_slice($relatedPosts, 0, 3);
            
            // Add featured images to related posts
            foreach ($relatedPosts as &$rPost) {
                if (empty($rPost['featured_image'])) {
                    $rImages = $this->imageModel->getByPostId($rPost['id']);
                    if (!empty($rImages)) {
                        $rPost['featured_image'] = $rImages[0]['filename'];
                    }
                }
            }
            unset($rPost);
            
            // Get recent posts for sidebar
            $recentPosts = $this->postModel->getPublished(5);
            
            // Add featured images to recent posts
            foreach ($recentPosts as &$rPost) {
                if (empty($rPost['featured_image'])) {
                    $rImages = $this->imageModel->getByPostId($rPost['id']);
                    if (!empty($rImages)) {
                        $rPost['featured_image'] = $rImages[0]['filename'];
                    }
                }
            }
            unset($rPost);
            
            // Get additional images for this post
            $images = $this->imageModel->getByPostId($post['id']);
            
            // If post doesn't have featured image, use first additional image
            if (empty($post['featured_image']) && !empty($images)) {
                $post['featured_image'] = $images[0]['filename'];
            }
            
            $localizedTitle = ($this->language && $this->language->getCurrentLanguage() === 'ar' && !empty($post['title_ar']))
                ? $post['title_ar']
                : $post['title'];
            
            $defaultMetaDesc = $this->language->getCurrentLanguage() === 'ar' 
                ? 'مقال عن التسويق الرقمي وتطوير المواقع من بريزو في أربيل، العراق.'
                : 'Digital marketing and web development article by Brezzo in Erbil, Iraq.';
            
            $postMetaDescription = !empty($post['meta_description']) 
                ? $post['meta_description'] 
                : (!empty($post['excerpt']) ? substr(strip_tags($post['excerpt']), 0, 155) : $defaultMetaDesc);

            $this->view('blog/detail', [
                'title' => $localizedTitle . ' | Brezzo Blog - Erbil, Iraq',
                'metaDescription' => $postMetaDescription,
                'metaKeywords' => ($post['tags'] ?? '') . ', digital marketing Erbil, web development Iraq, ' . ($post['category'] ?? '') . ' Erbil',
                'currentPage' => 'blog',
                'post' => $post,
                'images' => $images,
                'relatedPosts' => $relatedPosts,
                'recentPosts' => $recentPosts,
                'additionalCss' => ['blog.css?v=' . time()],
                'additionalJs' => ['blog.js']
            ]);
        } catch (Exception $e) {
            error_log('Blog detail error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load blog post.'
            ]);
        }
    }
}
?>
