<?php
require_once BASE_PATH . '/app/Core/Controller.php';

class PagesController extends Controller {
    public function privacy() {
        $this->view('pages/privacy', [
            'title' => $this->language ? $this->language->translate('legal.privacy.title') : 'Privacy Policy',
            'currentPage' => 'privacy'
        ]);
    }

    public function terms() {
        $this->view('pages/terms', [
            'title' => $this->language ? $this->language->translate('legal.terms.title') : 'Accessibility Statement',
            'currentPage' => 'terms'
        ]);
    }
}
?>


