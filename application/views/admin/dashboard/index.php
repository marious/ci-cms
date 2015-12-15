<div class="col-md-8">
    <h1 class="page-header"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h1>
    <h3>Recently modified articles</h3>
    <?php if (count($recent_articles)): ?>
        <ul>
    <?php foreach ($recent_articles as $article): ?>
        <li><?php echo anchor('admin/article/edit/' . $article->id, e($article->title)); ?> -
            <?php echo date('Y-m-d', strtotime($article->modified)); ?></li>
    <?php endforeach; ?>
    </ul>
      <?php endif; ?>
</div>