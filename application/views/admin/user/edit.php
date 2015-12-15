
    <h1 class="page-header"><i class="glyphicon glyphicon-file"></i> <?php echo empty($user->id) ? 'Add New User' : 'Edit User ' . $user->name; ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
            <li><a href="<?= site_url('admin/user'); ?>">Users</a></li>
            <li class="active">User</li>
        </ol>

        <?php $this->load->view('admin/_partials/validation_errors'); ?>

        <?php echo form_open(); ?>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="<?= set_value('name', $user->name); ?>">
            </div>
            <div class="form-group">
                <label for="email">Eamil Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?= set_value('email', $user->email); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id='password' placeholder="Enter Password" name="password">
            </div>

            <div class="form-group">
                <label for="veify_password">Confirm Password</label>
                <input type="password" class="form-control" id="veify_password" placeholder="Enter password Again" name="password_confirm">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
            &nbsp; &nbsp; <?= anchor('admin/user', 'Cancel', 'class="btn btn-default"'); ?>
        <?php echo form_close(); ?>