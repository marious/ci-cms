  <div class="row">
  <div class="col-md-8">
  <?php if (count($articles)): ?>
    <?php foreach ($articles as $article): ?>
      <div class="well blog-post">
    <?php if ($articles[0]) echo get_excerpt($article); ?>
  </div>
    <?php endforeach; ?>
  <?php else: ?>
  <div class="well blog-post">
	<p><em>No matches found</em></p>
  </div>
  <?php endif; ?>
  </div>

<?php $this->load->view('site/sidebar'); ?>