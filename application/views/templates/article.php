<div class="row">
  <div class="col-md-8">
        <div class="well blog-post">
          <?php if ($article) echo display_article($article); ?>
        </div>
    </div>

<?php $this->load->view('site/sidebar'); ?>