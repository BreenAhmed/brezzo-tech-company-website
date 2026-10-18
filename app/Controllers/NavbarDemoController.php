<?php
require_once BASE_PATH . '/app/Core/Controller.php';

class NavbarDemoController extends Controller {
    
    public function index() {
        $this->view('navbar-demo/index', [
            'title' => 'Navbar Design Options - Brezzo',
            'currentPage' => 'navbar-demo'
        ]);
    }
    
    public function implement($option) {
        if (!in_array($option, ['1', '2', '3', '4', '5', '6'])) {
            $this->redirect('navbar-demo');
            return;
        }
        
        // Read the current main.css file
        $mainCssPath = BASE_PATH . '/public/css/main.css';
        $optionsCssPath = BASE_PATH . '/public/css/navbar-options.css';
        
        if (!file_exists($optionsCssPath)) {
            $this->json(['success' => false, 'message' => 'Navbar options file not found.']);
            return;
        }
        
        try {
            // Read navbar options CSS
            $optionsContent = file_get_contents($optionsCssPath);
            
            // Extract the specific option styles
            $pattern = '/\/\* =+\s*OPTION ' . $option . ':.*?\*\/(.*?)(?=\/\* =+\s*OPTION|\Z)/s';
            preg_match($pattern, $optionsContent, $matches);
            
            if (empty($matches[1])) {
                $this->json(['success' => false, 'message' => 'Option styles not found.']);
                return;
            }
            
            $optionStyles = trim($matches[1]);
            
            // Create backup of current main.css
            $backupPath = BASE_PATH . '/public/css/main.css.backup.' . date('Y-m-d-H-i-s');
            copy($mainCssPath, $backupPath);
            
            // Read current main.css
            $mainContent = file_get_contents($mainCssPath);
            
            // Replace navbar styles
            $newMainContent = $this->replaceNavbarStyles($mainContent, $optionStyles, $option);
            
            // Write updated main.css
            file_put_contents($mainCssPath, $newMainContent);
            
            $this->json([
                'success' => true, 
                'message' => "Navbar Option {$option} has been applied successfully!",
                'backup' => basename($backupPath)
            ]);
            
        } catch (Exception $e) {
            error_log('Navbar implementation error: ' . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Error implementing navbar design.']);
        }
    }
    
    private function replaceNavbarStyles($mainContent, $optionStyles, $option) {
        // Convert option-specific classes to general navbar classes
        $optionStyles = str_replace('.navbar-option-' . $option, '.navbar', $optionStyles);
        
        // Find and replace existing navbar styles
        $pattern = '/\/\* Navigation Base Styles \*\/(.*?)(?=\/\* Main Content|\Z)/s';
        
        $newNavbarSection = "/* Navigation Base Styles */\n" . 
                           "/* Applied Navbar Option {$option} */\n" . 
                           $optionStyles . "\n\n";
        
        if (preg_match($pattern, $mainContent)) {
            $newContent = preg_replace($pattern, $newNavbarSection, $mainContent);
        } else {
            // If pattern not found, append to end
            $newContent = $mainContent . "\n\n" . $newNavbarSection;
        }
        
        return $newContent;
    }
    
    public function restore() {
        if (!$this->isPost()) {
            $this->json(['success' => false, 'message' => 'Invalid request method.']);
            return;
        }
        
        $backup = $this->input('backup');
        if (!$backup) {
            $this->json(['success' => false, 'message' => 'No backup specified.']);
            return;
        }
        
        $backupPath = BASE_PATH . '/public/css/' . $backup;
        $mainCssPath = BASE_PATH . '/public/css/main.css';
        
        if (!file_exists($backupPath)) {
            $this->json(['success' => false, 'message' => 'Backup file not found.']);
            return;
        }
        
        try {
            copy($backupPath, $mainCssPath);
            $this->json(['success' => true, 'message' => 'Original navbar design restored successfully.']);
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => 'Error restoring backup.']);
        }
    }
}
?>
