    <div class="row">
    <div class="col-md-6">
        <h1 class="page-header"><i class="glyphicon glyphicon-file"></i> Pages</h1>
    </div>
    <div class="col-md-6">
        <div class="btn-group actions">
            <a href="<?= base_url('admin/page/edit'); ?>" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>  New</a>
        </div>
    </div>
    </div>
    <ol class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="active">Pages</li>
    </ol>

    <?php $this->load->view('admin/_partials/flashes'); ?>

    <table  id="sort-table" class="table table-striped tablesorter">
    <thead>
        <tr>
            <th>Page Title <i class="glyphicon glyphicon-chevron-down"></i></th>
            <th>Parent</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php if(count($pages)): ?>
        <?php foreach($pages as $page): ?>
        <tr>
            <td><a href="<?= site_url("admin/page/edit/{$page->id}") ?>"><?= $page->title; ?></a></td>
            <td><?= $page->parent_slug; ?></td>
            <td><?= btn_edit("admin/page/edit/{$page->id}"); ?></td>
            <td><?= btn_delete("admin/page/delete/{$page->id}"); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <td colspan="3">We could not find any page.</td>
    <?php endif; ?>

    </tbody>
    </table>
<!--
    <ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
    </ul> -->

    </div>