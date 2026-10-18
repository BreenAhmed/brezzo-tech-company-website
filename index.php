<?php
// Ensure session cookies are set with a stable root path to avoid path mismatches
$cookiePath = '/';
if (PHP_SESSION_ACTIVE !== session_status()) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => $cookiePath,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set('UTC');

// Include autoloader and configuration
require_once 'config/config.php';
require_once 'app/Core/Router.php';
require_once 'app/Core/Controller.php';
require_once 'app/Core/Model.php';
require_once 'app/Core/View.php';
require_once 'app/Core/Database.php';
require_once 'app/Helpers/Language.php';
require_once 'app/Helpers/Security.php';

// Initialize language
$language = new Language();
$language->initialize();

// Initialize router
$router = new Router();

// Define routes
$router->add('', 'HomeController@index');
$router->add('home', 'HomeController@index');
$router->add('about', 'AboutController@index');
$router->add('portfolio', 'PortfolioController@index');
$router->add('portfolio/([a-zA-Z0-9-]+)', 'PortfolioController@detail');
$router->add('packages', 'PackagesController@index');
$router->add('blog', 'BlogController@index');
$router->add('blog/([a-zA-Z0-9-]+)', 'BlogController@detail');
$router->add('contact', 'ContactController@index');
$router->add('contact/submit', 'ContactController@submit');
$router->add('language/([a-z]{2})', 'LanguageController@switch');

// Legal pages
$router->add('privacy', 'PagesController@privacy');
$router->add('terms', 'PagesController@terms');


// API routes for AJAX
$router->add('api/contact', 'ApiController@contact');

// Navbar demo routes
$router->add('navbar-demo', 'NavbarDemoController@index');
$router->add('navbar-demo/implement/([1-6])', 'NavbarDemoController@implement');
$router->add('navbar-demo/restore', 'NavbarDemoController@restore');

$router->add('admin/login', 'AdminController@login');
// Admin routes
$router->add('admin/logout', 'AdminController@logout');
$router->add('admin/dashboard', 'AdminController@dashboard');
$router->add('admin', 'AdminController@dashboard');

// Admin blog routes
$router->add('admin/blog', 'AdminBlogController@index');
$router->add('admin/blog/create', 'AdminBlogController@create');
$router->add('admin/blog/edit/([0-9]+)', 'AdminBlogController@edit');
$router->add('admin/blog/delete/([0-9]+)', 'AdminBlogController@delete');

// Admin portfolio routes
$router->add('admin/portfolio', 'AdminPortfolioController@index');
$router->add('admin/portfolio/create', 'AdminPortfolioController@create');
$router->add('admin/portfolio/edit/([0-9]+)', 'AdminPortfolioController@edit');
$router->add('admin/portfolio/delete/([0-9]+)', 'AdminPortfolioController@delete');

// Admin partners routes
$router->add('admin/partners', 'AdminPartnerController@index');
$router->add('admin/partners/create', 'AdminPartnerController@create');
$router->add('admin/partners/edit/([0-9]+)', 'AdminPartnerController@edit');
$router->add('admin/partners/delete/([0-9]+)', 'AdminPartnerController@delete');
$router->add('admin/partners/toggle-visibility/([0-9]+)', 'AdminPartnerController@toggleVisibility');

// Admin packages routes
$router->add('admin/packages', 'AdminPackageController@index');
$router->add('admin/packages/create', 'AdminPackageController@create');
$router->add('admin/packages/edit/([0-9]+)', 'AdminPackageController@edit');
$router->add('admin/packages/delete/([0-9]+)', 'AdminPackageController@delete');
$router->add('admin/packages/toggle-visibility/([0-9]+)', 'AdminPackageController@toggleVisibility');
$router->add('admin/packages/toggle-popular/([0-9]+)', 'AdminPackageController@togglePopular');


try {
    $router->dispatch();
} catch (Exception $e) {
    error_log($e->getMessage());
    
    // Show 404 page
    $controller = new Controller();
    $controller->view('errors/404', [
        'title' => '404 - Page Not Found',
        'error' => 'The requested page could not be found.'
    ]);
}
?>
