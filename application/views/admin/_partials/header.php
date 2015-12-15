<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $meta_title; ?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= site_url('assets/css/bootstrap.css') ?>">
        <link rel="stylesheet" href="<?= site_url('assets/css/style.css') ?>">
        <?php if($status == 'admin'): ?>
        <link rel="stylesheet" href="<?= site_url('assets/css/admin.css') ?>">
        <link rel="stylesheet" href="<?= site_url('assets/css/datepicker.css') ?>">
        <?php endif; ?>
        <script src="<?= site_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
        <?php if (isset($sortable) && $sortable == true): ?>
          <script src="<?= site_url('assets/js/jquery-ui-1.11.4/jquery-ui.min.js'); ?>"></script>
          <script src="<?= site_url('assets/js/jquery-nested.js'); ?>"></script>
        <?php endif; ?>
        <script src="<?= site_url('assets/js/tinymce/tinymce.min.js'); ?>"></script>
        <script>
        tinymce.init({
               selector: ".editor",
               theme: "modern",
               plugins: [
                   "code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                   "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                   "save table contextmenu directionality emoticons template paste textcolor"
               ],
               content_css: "css/content.css",
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
               style_formats: [
                   {title: 'Bold text', inline: 'b'},
                   {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                   {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                   {title: 'Example 1', inline: 'span', classes: 'example1'},
                   {title: 'Example 2', inline: 'span', classes: 'example2'},
                   {title: 'Table styles'},
                   {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
               ]
           });


    </script>
    </head>
    <body>





