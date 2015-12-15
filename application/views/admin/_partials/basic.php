<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php $this->load->view('admin/_partials/sidenav') ?>
            </div>
            <div class="col-md-8">
                <?php
                    if (isset($subview)) {
                        $this->load->view($subview);
                    }
                ?>
            </div>
        </div>
    </div>
</section>
