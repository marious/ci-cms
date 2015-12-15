<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $meta_title; ?></title>
        <link rel="stylesheet" href="<?= site_url('assets/css/bootstrap.css') ?>">
        <link rel="stylesheet" href="<?= site_url('assets/css/style.css') ?>">
    </head>
    <body id="login">
       <div class="container">
            <?= form_open('', 'class="form-signin"'); ?>
              <h2 class="form-signin-heading text-center">AlphaCMS</h2>
              <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
              <?php $this->load->view('admin/_partials/flashes'); ?>
              <label for="inputEmail" class="sr-only">Email address</label>
              <?= form_input('email', set_value('email'), ['class' => 'form-control', 'placeholder' => 'Email Address']); ?>
              <label for="inputPassword" class="sr-only">Password</label>
              <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Password']); ?>
              <?= form_submit('submit', 'Sign in', 'class="btn btn-lg btn-primary btn-block"'); ?>
            <?= form_close(); ?>

          </div> <!-- /container -->

    <!-- Bootstrap Core JavaScript
    ========================================================================== -->
     <!-- jQUERY -->
     <script src="<?= site_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
     <!-- Bootstrap JS -->
     <script src="<?= site_url('assets/js/bootstrap.js') ?>"></script>
     <!-- Main js  -->
     <script src="<?= site_url('assets/js/bootstrap.js'); ?>"></script>
    </body>
</html>