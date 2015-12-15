  <h1 class="article-header"><i class="glyphicon glyphicon-file"></i> <?php echo empty($article->id) ? 'Add New Paeg' : 'Edit article ' . $article->title;  ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li><a href="<?= site_url('admin/article'); ?>">Articles</a></li>
    <li class="active">article</li>
  </ol>

  <?php $this->load->view('admin/_partials/validation_errors'); ?>

  <?= form_open(); ?>

  <div class="form-group">
    <label>Publication date</label>
    <?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), ['class' => 'form-control datepicker']); ?>
  </div>

   <div class="form-group">
       <label for="">article Title</label>
       <?= form_input('title', set_value('title', $article->title), array('class' => 'form-control', 'placeholder' => 'Enter article title')); ?>
   </div>
   <div class="form-group">
       <label for="">article Slug</label>
       <?= form_input('slug', set_value('slug', $article->slug), array('class' => 'form-control', 'placeholder' => 'Enter article Slug')); ?>
   </div>

   <div class="form-group">
       <label for="">article Body</label>
      <?= form_textarea('body', $article->body, 'class="form-control editor"'); ?>
   </div>

  <button type="button" id="image-button" class="btn btn-default">Image</button>
 <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
 <?= anchor('admin/article', 'Cancel', 'class="btn btn-default"'); ?>

<br>
<br>

<div id="images">

  <div>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>Image:</label>
          <input type="text" id="img-data" name="image" value="<?= set_value('image', $article->image); ?>" class="form-control">
        </div>
      </div>
    </div>
  </div>
</form>

  <div id="image-list">
    <?php echo display_files($files); ?>
  </div>

  <div class="clear"></div>
   <div id="upload_progress"></div>
   <div id="uploaded"></div>
    <?php

     echo form_open_multipart("admin/upload/upload", 'id="upload-form"');
     echo form_upload("userfile", "", 'class="btn btn-default" id="file"');
     echo "<br>";
     echo form_submit("upload", "Upload", 'class="btn btn-primary" id="upload"');
     echo form_close();
    ?>
</div>



<script>
  $(function() {
      $('.datepicker').datepicker({ format:  'yyyy-mm-dd'});
  });
</script>
