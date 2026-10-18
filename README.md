# Brezzo - Creative Digital Agency Website

A modern, responsive agency website built with PHP, featuring English/Arabic RTL support, 3D animations, and a comprehensive admin panel.

## Features

- **Modern Responsive Design**: Mobile-first approach with desktop side navigation and mobile bottom navigation
- **Multilingual Support**: Full English/Arabic support with RTL layout
- **3D Animations**: Creative 3D effects using Three.js and GSAP
- **Admin Panel**: Complete CRUD functionality for portfolio, blog, and packages
- **Performance Optimized**: Lazy loading, image optimization, and caching
- **Accessibility**: WCAG compliant with keyboard navigation and screen reader support
- **SEO Friendly**: Semantic HTML, meta tags, and structured data

## Technology Stack

- **Backend**: PHP 8.x with custom MVC framework
- **Database**: MySQL with XAMPP
- **Frontend**: Vanilla JavaScript, GSAP, Three.js
- **Styling**: Custom CSS with CSS Grid and Flexbox
- **Fonts**: Inter + Noto Sans Arabic for multilingual support

## Brand Colors

- Primary Blue: `#014fb6`
- Accent Purple: `#9857eb`
- White: `#ffffff`

## Installation Instructions

### Prerequisites

- XAMPP (with PHP 8.x and MySQL)
- Modern web browser
- Text editor (optional, for customization)

### Setup Steps

1. **Download and Extract**
   ```
   Download the project files and extract to:
   /Applications/XAMPP/xamppfiles/htdocs/brezzo/
   ```

2. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

3. **Import Database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create new database named `brezzo_db`
   - Import the SQL file: `database/brezzo_db.sql`

4. **Configure Database Connection**
   - Open `config/config.php`
   - Update database credentials if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'brezzo_db');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

5. **Set Permissions**
   ```bash
   chmod 755 public/uploads/
   chmod 755 public/uploads/portfolio/
   chmod 755 public/uploads/blog/
   chmod 755 public/uploads/thumbnails/
   ```

6. **Access the Website**
   - Frontend: http://localhost/brezzo
   - Admin Panel: http://localhost/brezzo/admin

### Default Admin Credentials

```
Username: admin
Password: password
```

**⚠️ IMPORTANT**: Change the default password immediately after first login!

## Project Structure

```
brezzo/
├── app/
│   ├── Controllers/          # MVC Controllers
│   ├── Core/                # Core framework files
│   ├── Helpers/             # Helper classes
│   ├── Lang/                # Language files (en.php, ar.php)
│   ├── Models/              # Database models
│   └── Views/               # Template files
├── config/
│   └── config.php           # Configuration settings
├── database/
│   └── brezzo_db.sql        # Database schema and sample data
├── public/
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   ├── images/              # Static images
│   └── uploads/             # User uploaded files
├── .htaccess                # URL rewriting rules
├── index.php                # Application entry point
└── README.md                # This file
```

## Admin Panel Features

### Portfolio Management
- Add/Edit/Delete projects
- Upload multiple images per project
- Set project categories and metadata
- Visibility controls

### Blog Management
- Create/Edit blog posts with rich text editor
- Featured images and categories
- Draft/Published status
- SEO meta descriptions

### Package Management
- Create service packages with pricing
- JSON-based feature lists
- Popular package highlighting
- Custom CTA buttons

### Settings
- Site configuration
- Contact information
- Social media links
- Email settings

## Customization Guide

### Adding New Languages

1. Create language file: `app/Lang/[code].php`
2. Add language to `config/config.php`:
   ```php
   define('SUPPORTED_LANGUAGES', ['en', 'ar', 'new_lang']);
   ```
3. Update language helper in `app/Helpers/Language.php`

### Modifying Brand Colors

Update CSS variables in `public/css/main.css`:
```css
:root {
  --primary-blue: #your-color;
  --accent-purple: #your-color;
  --brand-white: #your-color;
}
```

### Adding New Sections

1. Create controller: `app/Controllers/YourController.php`
2. Create view: `app/Views/your-section/index.php`
3. Add route in `index.php`
4. Add navigation link in `app/Views/layouts/main.php`

## Performance Optimization

### Image Optimization
- Use WebP format with fallbacks
- Implement lazy loading
- Generate thumbnails for uploads

### Caching
- Enable browser caching in `.htaccess`
- Consider implementing Redis for database caching
- Use CDN for static assets in production

### Security
- Always use prepared statements
- Sanitize user input
- Implement CSRF protection
- Use HTTPS in production
- Regular security updates

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check XAMPP MySQL service is running
   - Verify database credentials in `config/config.php`
   - Ensure `brezzo_db` database exists

2. **Images Not Loading**
   - Check upload directory permissions
   - Verify file paths in database
   - Ensure PHP file upload settings are correct

3. **Language Switching Not Working**
   - Check session configuration
   - Verify language files exist
   - Clear browser cookies

4. **Admin Panel Access Denied**
   - Verify admin user exists in database
   - Check session configuration
   - Clear browser cache and cookies

### Debug Mode

Enable debug mode in `config/config.php`:
```php
define('APP_ENV', 'development');
```

This will show detailed error messages for troubleshooting.

## Production Deployment

### Security Checklist

- [ ] Change default admin password
- [ ] Update database credentials
- [ ] Enable HTTPS
- [ ] Set `APP_ENV` to `production`
- [ ] Configure email settings
- [ ] Set up automated backups
- [ ] Configure monitoring

### Performance Checklist

- [ ] Enable Gzip compression
- [ ] Optimize images
- [ ] Set up CDN
- [ ] Configure caching headers
- [ ] Minify CSS/JS files
- [ ] Enable database query optimization

## Support and Documentation

### File Structure Reference

- **Controllers**: Handle business logic and user input
- **Models**: Database interactions and data manipulation
- **Views**: HTML templates with PHP integration
- **Core**: Framework foundation (Router, Database, etc.)
- **Helpers**: Utility classes (Language, Security, etc.)

### API Endpoints

- `POST /api/contact` - Contact form submission
- `POST /language/switch/[lang]` - Language switching

### Database Schema

Key tables:
- `users` - Admin authentication
- `projects` - Portfolio items
- `posts` - Blog articles
- `packages` - Service packages
- `settings` - Site configuration
- `contact_messages` - Contact form submissions

## License

This project is proprietary software developed for Brezzo Agency.

## Changelog

### Version 1.0.0
- Initial release
- Complete MVC framework
- Multilingual support (EN/AR)
- Admin panel with CRUD operations
- 3D animations and modern UI
- Responsive design
- SEO optimization

---

For technical support or customization requests, please contact the development team.
