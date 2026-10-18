# File Upload Fix Guide for Production

## Problem
File uploads work locally but fail on production server (e.g., Hostinger).

## Common Causes & Solutions

### 1. Directory Permissions (Most Common)

**Solution:** Set proper permissions on upload directories via FTP or cPanel File Manager:

```bash
# Required directories and permissions:
public_html/uploads/          → 755
public_html/uploads/blog/     → 755
public_html/uploads/portfolio/→ 755
public_html/uploads/thumbnails/→ 755
public_html/uploads/partners/ → 755
```

**How to fix via cPanel:**
1. Log into cPanel
2. Go to File Manager
3. Navigate to `public_html/uploads/`
4. Right-click each directory → Change Permissions
5. Set to **755** (Owner: Read/Write/Execute, Group: Read/Execute, Public: Read/Execute)
6. Check "Recurse into subdirectories" if available

**How to fix via FTP:**
1. Connect via FTP client (FileZilla, etc.)
2. Navigate to `public_html/uploads/`
3. Right-click each directory → File Permissions / CHMOD
4. Set to **755**

### 2. Directory Doesn't Exist

**Solution:** Create the directories manually if they don't exist:
- `public_html/uploads/`
- `public_html/uploads/blog/`
- `public_html/uploads/portfolio/`
- `public_html/uploads/thumbnails/`
- `public_html/uploads/partners/`

### 3. PHP Upload Settings

Check your PHP settings in cPanel:
- `upload_max_filesize` should be at least 5MB
- `post_max_size` should be larger than `upload_max_filesize`
- `file_uploads` should be `On`

**How to check:**
1. Create a file `phpinfo.php` in your public_html:
```php
<?php phpinfo(); ?>
```
2. Visit `yourdomain.com/phpinfo.php`
3. Search for "upload_max_filesize" and "post_max_size"

**How to fix (if you have access):**
- Via cPanel → Select PHP Version → Options → Set values
- Or create/edit `.htaccess` in public_html:
```apache
php_value upload_max_filesize 10M
php_value post_max_size 12M
```

### 4. Path Configuration

The code automatically detects `public` (local) vs `public_html` (production). Make sure:
- Your production files are in `public_html/` directory
- The config correctly detects this (it should automatically)

### 5. Check Error Logs

After attempting an upload, check the error log:
- Location: `error_log` file in your project root
- Or check cPanel → Error Log

Look for messages like:
- "Failed to create upload directory"
- "Upload directory not writable"
- "move_uploaded_file failed"

## Quick Fix Checklist

- [ ] Create all upload directories manually via FTP/cPanel
- [ ] Set all upload directories to 755 permissions
- [ ] Verify directories exist: `public_html/uploads/blog/`, `portfolio/`, etc.
- [ ] Check PHP upload settings (upload_max_filesize, post_max_size)
- [ ] Verify `public_html/uploads/` directory is writable
- [ ] Check error_log file for specific error messages
- [ ] Test upload after each fix

## Testing

After applying fixes:
1. Try uploading a small image (< 1MB) to blog
2. Check if file appears in `public_html/uploads/blog/`
3. Check error_log for any messages
4. If still failing, check specific error message in error_log

## Additional Notes

- Some hosting providers restrict `chmod` operations via PHP
- Manual permission setting via FTP/cPanel is more reliable
- Always use 755 for directories, 644 for files
- Never use 777 permissions (security risk)

## Contact Your Hosting Provider

If issues persist, contact your hosting provider with:
- Error messages from error_log
- Confirmation that directories exist and have 755 permissions
- PHP version and upload settings

