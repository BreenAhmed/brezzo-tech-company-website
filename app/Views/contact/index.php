<?php
$content = ob_start();
?>

<!-- New Contact Hero Section -->
<section class="contact-hero-modern">
    <!-- Language Switch Button -->
    <div class="hero-language-switch">
        <a href="<?php echo BASE_URL; ?>/language/<?php echo $lang === 'en' ? 'ar' : 'en'; ?>" class="hero-language-btn" data-lang="<?php echo $lang; ?>">
            <svg class="hero-language-icon" viewBox="0 0 24 24">
                <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
            </svg>
            <span class="hero-language-text"><?php echo $lang === 'en' ? 'عربي' : 'English'; ?></span>
        </a>
    </div>
    
    <div class="hero-background-modern">
        <div class="animated-elements">
        </div>
        
        <div class="gradient-mesh">
            <div class="mesh-circle circle-1"></div>
            <div class="mesh-circle circle-2"></div>
            <div class="mesh-circle circle-3"></div>
            <div class="mesh-circle circle-4"></div>
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content-modern">
            <div class="hero-text">
                <h1 class="hero-title-modern">
                    <span class="title-line"><?php echo $t('contact.hero.title'); ?></span>
                </h1>
                <p class="hero-subtitle-modern">
                    <?php echo $t('contact.hero.subtitle'); ?>
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">24h</div>
                        <div class="stat-label"><?php echo $t('contact.stats.response_time'); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label"><?php echo $t('contact.stats.free_consultation'); ?></div>
                    </div>
					<div class="stat-item">
						<div class="stat-number">20+</div>
						<div class="stat-label"><?php echo $t('contact.stats.happy_clients'); ?></div>
					</div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="contact-preview">
                    <div class="preview-header">
                        <div class="preview-dots">
                            <span class="dot red"></span>
                            <span class="dot yellow"></span>
                            <span class="dot green"></span>
                        </div>
                        <div class="preview-title"><?php echo $t('contact.form.title'); ?></div>
                    </div>
                    <div class="preview-content">
                        <div class="preview-field">
                            <div class="field-line"></div>
                            <span class="field-text"><?php echo $t('contact.form.name'); ?></span>
                        </div>
                        <div class="preview-field">
                            <div class="field-line"></div>
                            <span class="field-text"><?php echo $t('contact.form.email'); ?></span>
                        </div>
                        <div class="preview-field">
                            <div class="field-line"></div>
                            <span class="field-text"><?php echo $t('contact.form.message'); ?></span>
                        </div>
                        <div class="preview-button">
                            <span><?php echo $t('contact.form.submit'); ?></span>
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Creative Contact Content -->
<section class="creative-contact-content">
    <div class="container">
        <!-- Contact Methods Grid -->
        <div class="contact-methods-grid">
            <div class="contact-method-card">
                <div class="method-icon">
                    <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </div>
                <h3 class="method-title"><?php echo $t('contact.methods.email.title'); ?></h3>
                <p class="method-description"><?php echo $t('contact.methods.email.description'); ?></p>
                <a href="mailto:info@brezzo.co" class="method-link">info@brezzo.co</a>
            </div>
            
            <div class="contact-method-card">
                <div class="method-icon">
                    <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                </div>
                <h3 class="method-title"><?php echo $t('contact.methods.phone.title'); ?></h3>
                <p class="method-description"><?php echo $t('contact.methods.phone.description'); ?></p>
				<a href="tel:+9647515215455" class="method-link">+964 751 521 5455</a>
            </div>
            
			<div class="contact-method-card">
				<div class="method-icon">
					<svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24">
						<path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/>
					</svg>
				</div>
				<h3 class="method-title"><?php echo $t('contact.social.title'); ?></h3>
				<p class="method-description"><?php echo $t('contact.social.subtitle'); ?></p>
				<div class="social-follow-links" style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
					<a href="https://www.instagram.com/brezzo.ag/" class="social-link" aria-label="Instagram" title="Instagram" target="_blank" rel="noopener">
						<svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 3.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
						</svg>
						<span style="margin-inline-start:6px;">Instagram</span>
					</a>
					<a href="https://www.facebook.com/share/1A12bxxCXU/?mibextid=wwXIfr" class="social-link" aria-label="Facebook" title="Facebook" target="_blank" rel="noopener">
						<svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
						</svg>
						<span style="margin-inline-start:6px;">Facebook</span>
					</a>
				</div>
			</div>
        </div>
        
        <!-- Interactive Contact Form -->
        <div class="interactive-form-section">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="form-title"><?php echo $t('contact.form.create_title'); ?></h2>
                    <p class="form-subtitle"><?php echo $t('contact.form.create_subtitle'); ?></p>
                </div>
                
                <form id="contact-form" class="interactive-form" action="https://formspree.io/f/manaynjq" method="POST" data-formspree="true">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                    <input type="hidden" name="_subject" value="New contact message from Brezzo">
                    <input type="text" name="_gotcha" style="display:none">
                    
                    <div class="form-fields">
                        <div class="field-group">
                            <input type="text" id="name" name="name" class="form-field" required>
                            <label for="name" class="field-label"><?php echo $t('contact.form.name'); ?></label>
                            <div class="field-line"></div>
                        </div>
                        
                        <div class="field-group">
                            <input type="email" id="email" name="email" class="form-field" required>
                            <label for="email" class="field-label"><?php echo $t('contact.form.email'); ?></label>
                            <div class="field-line"></div>
                        </div>
                        
                        <div class="field-group">
                            <input type="text" id="subject" name="subject" class="form-field" required>
                            <label for="subject" class="field-label"><?php echo $t('contact.form.subject'); ?></label>
                            <div class="field-line"></div>
                        </div>
                        
                        <div class="field-group full-width">
                            <textarea id="message" name="message" class="form-field textarea-field" required></textarea>
                            <label for="message" class="field-label"><?php echo $t('contact.form.message'); ?></label>
                            <div class="field-line"></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">
                        <span class="button-text"><?php echo $t('contact.form.submit'); ?></span>
                        <div class="button-icon">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                            </svg>
                        </div>
                        <div class="button-ripple"></div>
                    </button>
                </form>
                
                <!-- Success Modal -->
                <div id="contact-success-modal" style="position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.5);z-index:9999;">
                    <div style="background:#fff;color:#111;max-width:520px;width:90%;border-radius:12px;padding:24px;box-shadow:0 10px 30px rgba(0,0,0,0.2);text-align:center;">
                        <h3 style="margin:0 0 8px;font-size:22px;"><?php echo $t('common.success'); ?></h3>
                        <p style="margin:0 0 16px;"><?php echo $t('contact.form.success'); ?></p>
                        <button id="contact-success-close" style="appearance:none;border:none;background:#014fb6;color:#fff;padding:10px 16px;border-radius:8px;cursor:pointer;">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Social Media Section -->
        <div class="social-section">
            <h3 class="social-title"><?php echo $t('contact.social.title'); ?></h3>
            <p class="social-subtitle"><?php echo $t('contact.social.subtitle'); ?></p>
            
			<div class="social-links">
				<a href="#" class="social-link">
					<div class="social-icon">
						<!-- Instagram -->
						<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 3.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
						</svg>
					</div>
					<span class="social-name">Instagram</span>
				</a>
				
				<a href="#" class="social-link">
					<div class="social-icon">
						<!-- Facebook -->
						<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
						</svg>
					</div>
					<span class="social-name">Facebook</span>
				</a>
				
				<a href="mailto:info@brezzo.co" class="social-link">
					<div class="social-icon">
						<!-- Email -->
						<svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
							<path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
						</svg>
					</div>
					<span class="social-name">Email</span>
				</a>
			</div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include BASE_PATH . '/app/Views/layouts/main.php';
?>
<script>
(function () {
    const form = document.getElementById('contact-form');
    if (!form) return;
    const modal = document.getElementById('contact-success-modal');
    const closeBtn = document.getElementById('contact-success-close');
    
    function showModal() {
        if (modal) modal.style.display = 'flex';
    }
    function hideModal() {
        if (modal) modal.style.display = 'none';
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', hideModal);
    }
    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) hideModal();
        });
    }
    
    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const submitBtn = form.querySelector('button[type="submit"] .button-text');
        const originalText = submitBtn ? submitBtn.textContent : '';
        if (submitBtn) submitBtn.textContent = "<?php echo $t('contact.form.sending'); ?>";
        
        try {
            const formData = new FormData(form);
            // Provide a unified "name" field for Formspree
            if (!formData.has('name') && formData.get('full_name')) {
                formData.set('name', formData.get('full_name'));
            }
            const res = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });
            // Treat 2xx and 3xx as success to avoid default redirect pages
            if ((res.status >= 200 && res.status < 300) || (res.status >= 300 && res.status < 400)) {
                form.reset();
                showModal();
            } else {
                // Try to parse error for diagnostics but still avoid redirect
                try { await res.json(); } catch (_) {}
                // Show success modal for consistent UX per requirement
                form.reset();
                showModal();
            }
        } catch (err) {
            // Network or CORS error - still show thank you per requirement
            form.reset();
            showModal();
        } finally {
            if (submitBtn) submitBtn.textContent = originalText || "<?php echo $t('contact.form.submit'); ?>";
        }
    }, { passive: false });
})();
</script>