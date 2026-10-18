<?php
// Include the main layout
$content = ob_start();
?>

<!-- Creative Hero Section with Typing Effect -->
<section class="hero-creative" id="hero">
    <!-- Language Switch Button -->
    <div class="hero-language-switch">
        <a href="<?php echo BASE_URL; ?>/language/<?php echo $lang === 'en' ? 'ar' : 'en'; ?>" class="hero-language-btn" data-lang="<?php echo $lang; ?>">
            <svg class="hero-language-icon" viewBox="0 0 24 24">
                <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
            </svg>
            <span class="hero-language-text"><?php echo $lang === 'en' ? 'عربي' : 'English'; ?></span>
        </a>
    </div>
    
    <div class="hero-background">
        <div class="code-rain">
            <div class="code-line">const creativity = 'infinite';</div>
            <div class="code-line">let innovation = new Promise();</div>
            <div class="code-line">function buildFuture() { return 'amazing'; }</div>
            <div class="code-line">class DigitalAgency { constructor() { this.vision = 'transform'; } }</div>
            <div class="code-line">const solutions = ['web', 'mobile', 'branding'];</div>
            <div class="code-line">export default { creativity, innovation, buildFuture };</div>
            <div class="code-line">const design = { responsive: true, modern: true };</div>
            <div class="code-line">let userExperience = 'seamless';</div>
            <div class="code-line">function createMagic() { return 'digital art'; }</div>
            <div class="code-line">class WebDevelopment { build() { return 'success'; } }</div>
            <div class="code-line">const technologies = ['React', 'Vue', 'Node.js'];</div>
            <div class="code-line">let performance = 'optimized';</div>
            <div class="code-line">function solveProblems() { return 'elegant solutions'; }</div>
            <div class="code-line">const branding = { identity: 'unique', impact: 'powerful' };</div>
            <div class="code-line">let digitalStrategy = 'data-driven';</div>
            <div class="code-line">function innovate() { return 'breakthrough'; }</div>
            <div class="code-line">class CreativeStudio { inspire() { return 'wow factor'; } }</div>
            <div class="code-line">const results = ['growth', 'engagement', 'conversion'];</div>
        </div>
        <div class="hero-gradient"></div>
    </div>
    
    <div class="container">
        <div class="hero-content-wrapper">
            <div class="hero-text-content">
                <h1 class="hero-title-typing">
                    <span class="typing-text" data-text="<?php echo $t('home.hero.title'); ?>"></span>
                    <span class="typing-cursor">|</span>
                </h1>
                
                <p class="hero-subtitle-animated">
                    <?php echo $t('home.hero.subtitle'); ?>
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="20">0</div>
                        <div class="stat-label"><?php echo $t('home.hero.stats.projects', 'Projects'); ?><span class="stat-suffix">+</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="98">0</div>
                        <div class="stat-label"><?php echo $t('home.hero.stats.satisfaction', 'Satisfaction'); ?>%</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="5">0</div>
                        <div class="stat-label"><?php echo $t('home.hero.stats.years', 'Years'); ?></div>
                    </div>
                </div>
                
                <div class="hero-actions-creative">
                    <a href="<?php echo BASE_URL; ?>/contact" class="btn-hero-primary">
                        <span class="btn-text"><?php echo $t('home.hero.cta.primary'); ?></span>
                        <span class="btn-icon">→</span>
                    </a>
                    <a href="<?php echo BASE_URL; ?>/portfolio" class="btn-hero-secondary">
                        <span class="btn-text"><?php echo $t('home.hero.cta.secondary'); ?></span>
                        <span class="btn-icon">👁</span>
                    </a>
                </div>
            </div>
            
            <div class="hero-visual-content">
            </div>
        </div>
    </div>
</section>

<!-- Creative Services Section -->
<section class="creative-services" id="services">
    <div class="services-background">
        <div class="services-particles"></div>
        <div class="services-grid"></div>
    </div>
    
    <div class="container">
        <div class="services-header">
            <h2 class="services-title"><?php echo $t('home.services.title'); ?></h2>
            <p class="services-subtitle"><?php echo $t('home.services.subtitle'); ?></p>
        </div>
        
        <div class="services-grid-container">
            <!-- Graphic Design Service -->
            <div class="service-card creative-card" data-service="graphic-design">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon graphic-design-icon">
                            <img src="<?php echo BASE_URL; ?>/11.png" alt="Graphic Design" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">01</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.graphic_design.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.graphic_design.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.graphic_design.features.logo'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.graphic_design.features.brand'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.graphic_design.features.print'); ?></span>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.graphic_design.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Web Development Service -->
            <div class="service-card creative-card" data-service="web-development">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon web-development-icon">
                            <img src="<?php echo BASE_URL; ?>/22.png" alt="Web Development" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">02</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.web_development.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.web_development.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.web_development.features.responsive'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.web_development.features.ecommerce'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.web_development.features.apps'); ?></span>
                            <?php if (isset($lang) && $lang === 'en'): ?>
                                <span class="feature-tag"><?php echo $t('home.services.web_development.features.performance'); ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.web_development.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- AD Campaigns Service -->
            <div class="service-card creative-card" data-service="ad-campaigns">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon ad-campaigns-icon">
                            <img src="<?php echo BASE_URL; ?>/33.png" alt="AD Campaigns" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">03</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.ad_campaigns.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.ad_campaigns.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.ad_campaigns.features.social'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.ad_campaigns.features.google'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.ad_campaigns.features.analytics'); ?></span>
                            <?php if (isset($lang) && $lang === 'en'): ?>
                                <span class="feature-tag"><?php echo $t('home.services.ad_campaigns.features.retargeting'); ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.ad_campaigns.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- AI Agents Service -->
            <div class="service-card creative-card" data-service="ai-agents">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon ai-agents-icon">
                            <img src="<?php echo BASE_URL; ?>/44.png" alt="AI Agents" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">04</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.ai_agents.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.ai_agents.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.ai_agents.features.chatbots'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.ai_agents.features.automation'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.ai_agents.features.integration'); ?></span>
                            <?php if (isset($lang) && $lang === 'ar'): ?>
                                <span class="feature-tag"><?php echo $t('home.services.ai_agents.features.machine_learning'); ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.ai_agents.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SEO Improvement Service -->
            <div class="service-card creative-card" data-service="seo-improvement">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon seo-improvement-icon">
                            <img src="<?php echo BASE_URL; ?>/55.png" alt="SEO Improvement" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">05</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.seo_improvement.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.seo_improvement.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.seo_improvement.features.keywords'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.seo_improvement.features.technical'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.seo_improvement.features.content'); ?></span>
                            <?php if (isset($lang) && $lang === 'ar'): ?>
                                <span class="feature-tag"><?php echo $t('home.services.seo_improvement.features.local_seo'); ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.seo_improvement.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Marketing Consultations Service -->
            <div class="service-card creative-card" data-service="marketing-consultations">
                <div class="service-card-inner">
                    <div class="service-icon-container">
                        <div class="service-icon marketing-consultations-icon">
                            <img src="<?php echo BASE_URL; ?>/66.png" alt="Marketing Consultations" width="80" height="80" style="object-fit: contain;">
                        </div>
                        <div class="service-number">06</div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title"><?php echo $t('home.services.marketing_consultations.title'); ?></h3>
                        <p class="service-description"><?php echo $t('home.services.marketing_consultations.description'); ?></p>
                        <div class="service-features">
                            <span class="feature-tag"><?php echo $t('home.services.marketing_consultations.features.strategy'); ?></span>
                            <span class="feature-tag"><?php echo $t('home.services.marketing_consultations.features.growth'); ?></span>
                            <?php if (isset($lang) && $lang === 'en'): ?>
                                <span class="feature-tag"><?php echo $t('home.services.marketing_consultations.features.roi'); ?></span>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/packages" class="service-cta">
                            <span><?php echo $t('home.services.marketing_consultations.cta'); ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Brezzo Section -->
<section class="why-choose-brezzo" id="why-choose">
    <div class="why-choose-background">
        <div class="why-choose-particles"></div>
        <div class="why-choose-grid"></div>
    </div>
    
    <div class="container">
        <div class="why-choose-header">
            <h2 class="why-choose-title"><?php echo $t('home.why_choose.title'); ?></h2>
            <p class="why-choose-subtitle"><?php echo $t('home.why_choose.subtitle'); ?></p>
        </div>
        
        <div class="why-choose-grid-container">
            <!-- Experience Card -->
            <div class="why-choose-card" data-feature="experience">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon experience-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="why-choose-number"><?php echo $stats['experience']; ?>+</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.experience.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.experience.description'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Projects Card -->
            <div class="why-choose-card" data-feature="projects">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon projects-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/>
                                <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="why-choose-number"><?php echo $stats['projects']; ?>+</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.projects.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.projects.description'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Clients Card -->
            <div class="why-choose-card" data-feature="clients">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon clients-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                                <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke="currentColor" stroke-width="2"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="why-choose-number"><?php echo $stats['clients']; ?>+</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.clients.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.clients.description'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Card -->
            <div class="why-choose-card" data-feature="satisfaction">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon satisfaction-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="why-choose-number"><?php echo $stats['satisfaction']; ?>%</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.satisfaction.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.satisfaction.description'); ?></p>
                    </div>
                </div>
            </div>

            <!-- 24/7 Support Card -->
            <div class="why-choose-card" data-feature="support">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon support-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2"/>
                                <circle cx="12" cy="12" r="1" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="why-choose-number">24/7</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.support.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.support.description'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Fast Delivery Card -->
            <div class="why-choose-card" data-feature="delivery">
                <div class="why-choose-card-inner">
                    <div class="why-choose-icon-container">
                        <div class="why-choose-icon delivery-icon">
                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none">
                                <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" stroke="currentColor" stroke-width="2"/>
                                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="why-choose-number">48h</div>
                    </div>
                    <div class="why-choose-content">
                        <h3 class="why-choose-feature-title"><?php echo $t('home.why_choose.delivery.title'); ?></h3>
                        <p class="why-choose-description"><?php echo $t('home.why_choose.delivery.description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Our Valued Partners Section -->
<section class="valued-partners" id="partners">
    <div class="partners-background">
        <div class="partners-particles"></div>
        <div class="partners-grid"></div>
    </div>
    
    <div class="container">
        <div class="partners-header">
            <h2 class="partners-title"><?php echo $t('home.partners.title'); ?></h2>
            <p class="partners-subtitle"><?php echo $t('home.partners.subtitle'); ?></p>
        </div>
        
        <div class="partners-carousel">
            <div class="partners-track">
                <?php if (!empty($partners)): ?>
                    <?php foreach ($partners as $partner): ?>
                        <div class="partner-logo">
                            <?php if (!empty($partner['logo'])): ?>
                                <a href="<?php echo !empty($partner['website']) ? $partner['website'] : '#'; ?>" target="_blank" rel="noopener" class="partner-link">
                                    <img src="<?php echo BASE_URL; ?>/public/uploads/partners/<?php echo htmlspecialchars($partner['logo']); ?>" 
                                         alt="<?php echo htmlspecialchars($partner['name']); ?>" 
                                         title="<?php echo htmlspecialchars($partner['name']); ?>"
                                         class="partner-image">
                                </a>
                            <?php else: ?>
                                <div class="partner-placeholder">
                                    <div class="partner-name"><?php echo htmlspecialchars($partner['name']); ?></div>
                                    <?php if (!empty($partner['website'])): ?>
                                        <a href="<?php echo $partner['website']; ?>" target="_blank" rel="noopener" class="partner-website">
                                            Visit Website
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback placeholder partners when no real partners exist -->
                    <div class="partner-logo">
                        <div class="partner-placeholder">
                            <svg width="120" height="60" viewBox="0 0 120 60" fill="none">
                                <rect x="10" y="10" width="100" height="40" rx="8" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)"/>
                                <text x="60" y="35" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="Arial" font-size="12">Partner 1</text>
                            </svg>
                        </div>
                    </div>
                    <div class="partner-logo">
                        <div class="partner-placeholder">
                            <svg width="120" height="60" viewBox="0 0 120 60" fill="none">
                                <rect x="10" y="10" width="100" height="40" rx="8" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)"/>
                                <text x="60" y="35" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="Arial" font-size="12">Partner 2</text>
                            </svg>
                        </div>
                    </div>
                    <div class="partner-logo">
                        <div class="partner-placeholder">
                            <svg width="120" height="60" viewBox="0 0 120 60" fill="none">
                                <rect x="10" y="10" width="100" height="40" rx="8" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)"/>
                                <text x="60" y="35" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="Arial" font-size="12">Partner 3</text>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="partners-cta">
            <p><?php echo $t('home.partners.cta.text'); ?></p>
            <a href="<?php echo BASE_URL; ?>/contact" class="btn-partner">
                <span><?php echo $t('home.partners.cta.button'); ?></span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="faq-background">
        <div class="faq-particles"></div>
        <div class="faq-grid"></div>
    </div>
    
    <div class="container">
        <div class="faq-header">
            <h2 class="faq-title"><?php echo $t('home.faq.title'); ?></h2>
            <p class="faq-subtitle"><?php echo $t('home.faq.subtitle'); ?></p>
        </div>
        
        <div class="faq-container">
            <div class="faq-item" data-faq="1">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q1.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q1.answer'); ?></p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="2">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q2.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q2.answer'); ?></p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="3">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q3.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q3.answer'); ?></p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="4">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q4.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q4.answer'); ?></p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="5">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q5.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q5.answer'); ?></p>
                </div>
            </div>
            
            <div class="faq-item" data-faq="6">
                <div class="faq-question">
                    <h3><?php echo $t('home.faq.q6.question'); ?></h3>
                    <div class="faq-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="faq-answer">
                    <p><?php echo $t('home.faq.q6.answer'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="faq-cta">
            <p><?php echo $t('home.faq.cta.text'); ?></p>
            <a href="<?php echo BASE_URL; ?>/contact" class="btn-faq">
                <span><?php echo $t('home.faq.cta.button'); ?></span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- FAQ interactions handled in public/js/home.js -->

<?php
$content = ob_get_clean();
include BASE_PATH . '/app/Views/layouts/main.php';
?>
