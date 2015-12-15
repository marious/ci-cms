
        <footer>
            <p>Copyright <?= date('Y'); ?>, All Rights Reserved</p>
        </footer>
        <script src="<?= site_url('assets/js/bootstrap.js') ?>"></script>
        <script src="<?= site_url('assets/js/bootstrap-datepicker.js') ?>"></script>
        <script src="<?= site_url('assets/js/search.js'); ?>"></script>
        <script src="<?= site_url('assets/js/script.js') ?>"></script>
        <script src="<?= site_url('assets/js/upload.js') ?>"></script>


    <?php $this->load->view('admin/_partials/modal-upload'); ?>

    </body>
</html>