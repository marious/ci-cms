  <h1 class="page-header"><i class="glyphicon glyphicon-file"></i> <?php echo empty($page->id) ? 'Add New Paeg' : 'Edit Page ' . $page->title;  ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li><a href="<?= site_url('admin/page'); ?>">Pages</a></li>
    <li class="active">Page</li>
  </ol>

  <?php $this->load->view('admin/_partials/validation_errors'); ?>

  <?= form_open(); ?>

  <div class="form-group">
    <label>Parent</label>
    <?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post->parent_id : $page->parent_id ,['class' => 'form-control']); ?>
  </div>

  <div class="form-group">
    <label>Template</label>
    <?php echo form_dropdown('template', array('page' => 'page', 'posts_archive' => 'posts Archive', 'homepage' => 'Homepage'), set_value('template', $page->template) , ['class' => 'form-control']); ?>
  </div>

   <div class="form-group">
       <label for="">Page Title</label>
       <?= form_input('title', set_value('title', $page->title), array('class' => 'form-control', 'placeholder' => 'Enter page title')); ?>
   </div>
   <div class="form-group">
       <label for="">Page Slug</label>
       <?= form_input('slug', set_value('slug', $page->slug), array('class' => 'form-control', 'placeholder' => 'Enter page Slug')); ?>
   </div>
   <div class="form-group">
       <label for="">Page Body</label>
      <?= form_textarea('body', $this->input->post('body') ? $this->input->post('body') : $page->body, 'class="form-control editor"'); ?>
   </div>



 <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
 <?= anchor('admin/page', 'Cancel', 'class="btn btn-default"'); ?>
</form>
