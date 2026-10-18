<?php
require_once BASE_PATH . '/app/Core/Controller.php';

class ContactController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        try {
            $this->view('contact/index', [
                'title' => $this->language->translate('seo.contact.title'),
                'metaDescription' => $this->language->translate('seo.contact.description'),
                'metaKeywords' => $this->language->translate('seo.contact.keywords'),
                'currentPage' => 'contact',
                'csrfToken' => $this->generateCsrfToken(),
                'additionalCss' => ['contact.css?v=' . time()],
                'additionalJs' => ['contact.js']
            ]);
        } catch (Exception $e) {
            error_log('Contact page error: ' . $e->getMessage());
            
            $this->view('errors/500', [
                'title' => 'Server Error',
                'error' => 'Unable to load contact page.'
            ]);
        }
    }
    
    public function submit() {
        if (!$this->isPost()) {
            $this->redirect('contact');
            return;
        }
        
        try {
            // CSRF protection
            $token = $this->input('csrf_token');
            if (!$this->validateCsrfToken($token)) {
                $this->json(['success' => false, 'message' => 'Invalid security token.'], 403);
                return;
            }
            
            // Get form data
            $name = $this->input('name');
            $email = $this->input('email');
            $subject = $this->input('subject');
            $message = $this->input('message');
            
            // Validate input
            $errors = $this->validate([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ], [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email',
                'subject' => 'required|min:5|max:200',
                'message' => 'required|min:10|max:2000'
            ]);
            
            if (!empty($errors)) {
                $this->json(['success' => false, 'message' => 'Please check your input and try again.', 'errors' => $errors], 400);
                return;
            }
            
            // Additional email validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->json(['success' => false, 'message' => 'Please enter a valid email address.', 'errors' => ['email' => 'Please enter a valid email address.']], 400);
                return;
            }
            
            // Sanitize input
            $name = Security::sanitizeInput($name);
            $email = Security::sanitizeInput($email);
            $subject = Security::sanitizeInput($subject);
            $message = Security::sanitizeInput($message);
            
            // Store in database
            $this->storeContactMessage($name, $email, $subject, $message);
            
            // Send email notification
            $this->sendContactNotification($name, $email, $subject, $message);
            
            $this->json([
                'success' => true, 
                'message' => $this->language->translate('contact.form.success')
            ]);
            
        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            
            $this->json([
                'success' => false, 
                'message' => $this->language->translate('contact.form.error')
            ], 500);
        }
    }
    
    private function storeContactMessage($name, $email, $subject, $message) {
        $db = Database::getInstance();
        
        $stmt = $db->prepare("
            INSERT INTO contact_messages (name, email, subject, message, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $name,
            $email,
            $subject,
            $message,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
    }
    
    private function sendContactNotification($name, $email, $subject, $message) {
        // Basic email notification - in production, use a proper email service
        $to = MAIL_TO;
        $emailSubject = "New Contact Form Submission: " . $subject;
        $emailMessage = "
            Name: {$name}
            Email: {$email}
            Subject: {$subject}
            
            Message:
            {$message}
            
            Sent from: " . BASE_URL . "
            IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "
            Time: " . date('Y-m-d H:i:s');
        
        $headers = "From: " . MAIL_FROM . "\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // In production, replace with proper email service
        @mail($to, $emailSubject, $emailMessage, $headers);
    }
}
?>
