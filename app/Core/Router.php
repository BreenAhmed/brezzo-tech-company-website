<?php
class Router {
    private $routes = [];
    
    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }
    
    public function dispatch() {
        $uri = $this->getUri();
        
        foreach ($this->routes as $route => $callback) {
            if ($this->match($route, $uri)) {
                return $this->execute($callback, $uri, $route);
            }
        }
        // Development logging to help diagnose 404s
        if (defined('APP_ENV') && APP_ENV === 'development') {
            error_log('[Router] No route matched. URI="' . $uri . '"');
            error_log('[Router] Known routes: ' . implode(', ', array_keys($this->routes)));
            error_log('[Router] BASE_URL=' . (defined('BASE_URL') ? BASE_URL : 'undefined'));
        }
        throw new Exception('Route not found: ' . $uri);
    }
    
    private function getUri() {
        // Support query-param routing (?r=admin/login) for environments without mod_rewrite or PATH_INFO
        if (!empty($_GET['r'])) {
            return trim($_GET['r'], '/');
        }
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Always strip configured BASE_URL path first (stable across pretty URLs)
        if (defined('BASE_URL')) {
            $basePath = parse_url(BASE_URL, PHP_URL_PATH) ?: '';
            $basePath = rtrim($basePath, '/');
            if ($basePath && strpos($uri, $basePath) === 0) {
                $uri = substr($uri, strlen($basePath));
            }
        }
        // Additionally strip the project folder name if present (e.g., "/brezzo")
        $projectFolder = '/' . basename(BASE_PATH);
        if ($projectFolder !== '/' && strpos($uri, $projectFolder) === 0) {
            $uri = substr($uri, strlen($projectFolder));
        }
        // Do NOT strip per-request script directory; it breaks nested paths like /brezzo/admin/*
        // Strip front controller if present
        if (strpos($uri, '/index.php') === 0) {
            $uri = substr($uri, strlen('/index.php'));
        }
        $uri = trim($uri, '/');
        return $uri;
    }
    
    private function match($route, $uri) {
        $pattern = preg_replace('/\([^)]+\)/', '([^/]+)', $route);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        return preg_match($pattern, $uri);
    }
    
    private function execute($callback, $uri, $route) {
        list($controller, $method) = explode('@', $callback);
        
        // Extract parameters from URI
        $pattern = preg_replace('/\([^)]+\)/', '([^/]+)', $route);
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        preg_match($pattern, $uri, $matches);
        array_shift($matches); // Remove full match
        
        // Include controller file
        $controllerFile = BASE_PATH . '/app/Controllers/' . $controller . '.php';
        if (!file_exists($controllerFile)) {
            throw new Exception('Controller not found: ' . $controller);
        }
        
        require_once $controllerFile;
        
        if (!class_exists($controller)) {
            throw new Exception('Controller class not found: ' . $controller);
        }
        
        $controllerInstance = new $controller();
        
        if (!method_exists($controllerInstance, $method)) {
            throw new Exception('Method not found: ' . $method);
        }
        
        return call_user_func_array([$controllerInstance, $method], $matches);
    }
}
?>
