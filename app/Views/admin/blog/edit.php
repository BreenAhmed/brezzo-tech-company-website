<?php
$content = ob_start();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit"></i> Edit Blog Post</h2>
    <a href="<?php echo BASE_URL; ?>/admin/blog" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Back to Blog Posts
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data" data-validate>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title (English) *</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">Title (Arabic)</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php echo htmlspecialchars($post['title_ar'] ?? ''); ?>" dir="rtl">
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt (English)</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3"><?php echo htmlspecialchars($post['excerpt']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt_ar" class="form-label">Excerpt (Arabic)</label>
                        <textarea class="form-control" id="excerpt_ar" name="excerpt_ar" rows="3" dir="rtl"><?php echo htmlspecialchars($post['excerpt_ar'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content (English) *</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content_ar" class="form-label">Content (Arabic)</label>
                        <textarea class="form-control" id="content_ar" name="content_ar" rows="10" dir="rtl"><?php echo htmlspecialchars($post['content_ar'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft" <?php echo $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                            <option value="archived" <?php echo $post['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="General" <?php echo $post['category'] === 'General' ? 'selected' : ''; ?>>General</option>
                            <option value="tech" <?php echo $post['category'] === 'tech' ? 'selected' : ''; ?>>Technology</option>
                            <option value="marketing" <?php echo $post['category'] === 'marketing' ? 'selected' : ''; ?>>Marketing</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description (English)</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3"><?php echo htmlspecialchars($post['meta_description']); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description_ar" class="form-label">Meta Description (Arabic)</label>
                        <textarea class="form-control" id="meta_description_ar" name="meta_description_ar" rows="3" dir="rtl"><?php echo htmlspecialchars($post['meta_description_ar'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <?php $isFeatured = !empty($post['featured']) || !empty($post['is_featured']); ?>
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" <?php echo $isFeatured ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_featured">
                                Featured Post
                            </label>
                        </div>
                    </div>
                    
                    <?php if (!empty($post['featured_image'])): ?>
                        <div class="mb-3">
                            <label class="form-label">Current Featured Image</label>
                            <div>
                                <img src="<?php echo BASE_URL; ?>/public/uploads/blog/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                     alt="Featured Image" 
                                     style="max-width: 200px; height: auto; border-radius: 4px; border: 2px solid #ddd; padding: 4px;">
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Project Images (1-5 photos)</label>
                        <div class="image-upload-area" onclick="document.getElementById('images').click()">
                            <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                            <p class="mb-0">Click to upload images or drag and drop</p>
                            <small class="text-muted">Supports JPG, PNG, GIF, WebP (Max 5MB each)</small>
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" style="display: none;">
                        <div class="image-preview mt-3"></div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo BASE_URL; ?>/admin/blog" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    const previewContainer = document.querySelector('.image-preview');
    
    // Clear previous previews
    previewContainer.innerHTML = '';
    
    if (files.length > 5) {
        alert('You can only upload up to 5 images.');
        return;
    }
    
    files.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'preview-item';
                imageDiv.style.cssText = `
                    display: inline-block;
                    margin: 8px;
                    position: relative;
                    border-radius: 8px;
                    overflow: hidden;
                    border: 2px solid #ddd;
                `;
                
                imageDiv.innerHTML = `
                    <img src="${e.target.result}" style="width: 120px; height: 120px; object-fit: cover;">
                    <div style="position: absolute; top: 4px; right: 4px; background: rgba(0,0,0,0.7); color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold;">
                        ${index + 1}
                    </div>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; padding: 4px; font-size: 12px; text-align: center;">
                        ${file.name.length > 15 ? file.name.substring(0, 15) + '...' : file.name}
                    </div>
                `;
                
                previewContainer.appendChild(imageDiv);
            };
            reader.readAsDataURL(file);
        }
    });
    
    if (files.length > 0) {
        const uploadArea = document.querySelector('.image-upload-area');
        uploadArea.innerHTML = `
            <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
            <p class="mb-0">${files.length} image(s) selected</p>
            <small class="text-muted">Click to change images</small>
        `;
    }
});

// Form validation
document.querySelector('form[data-validate]').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const images = document.getElementById('images').files;
    
    if (!title) {
        e.preventDefault();
        alert('Please enter a title for the blog post.');
        document.getElementById('title').focus();
        return;
    }
    
    if (!content) {
        e.preventDefault();
        alert('Please enter content for the blog post.');
        document.getElementById('content').focus();
        return;
    }
    
    if (images.length > 5) {
        e.preventDefault();
        alert('You can only upload up to 5 images.');
        return;
    }
});
</script>

<?php
$content = ob_get_clean();
include BASE_PATH . '/app/Views/admin/layouts/admin.php';
?>