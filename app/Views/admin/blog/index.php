<?php
$content = ob_start();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-blog"></i> Blog Posts</h2>
    <a href="<?php echo BASE_URL; ?>/admin/blog/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Blog Post
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (!empty($posts)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($post['featured_image'])): ?>
                                            <img src="<?php echo BASE_URL; ?>/public/uploads/blog/<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                                 class="me-3" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-0"><?php echo htmlspecialchars($post['title']); ?></h6>
                                            <small class="text-muted"><?php echo htmlspecialchars($post['slug']); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($post['category']); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo $post['status'] === 'published' ? 'success' : ($post['status'] === 'draft' ? 'warning' : 'secondary'); ?>">
                                        <?php echo ucfirst($post['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php $isFeatured = !empty($post['featured']) || !empty($post['is_featured']); ?>
                                    <?php if ($isFeatured): ?>
                                        <i class="fas fa-star text-warning"></i>
                                    <?php else: ?>
                                        <i class="fas fa-star text-muted"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small><?php echo date('M j, Y', strtotime($post['created_at'])); ?></small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo BASE_URL; ?>/admin/blog/edit/<?php echo $post['id']; ?>" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>/admin/blog/delete/<?php echo $post['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Are you sure you want to delete this blog post?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No blog posts found</h5>
                <p class="text-muted">Get started by creating your first blog post.</p>
                <a href="<?php echo BASE_URL; ?>/admin/blog/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create First Blog Post
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include BASE_PATH . '/app/Views/admin/layouts/admin.php';
?>

