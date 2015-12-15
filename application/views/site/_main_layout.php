<?php $this->load->view('site/_partials/header'); ?>

<div class="container container-main">
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
            <?php echo get_menu($menu); ?>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        <!-- Subiview -->
        <?php $this->load->view('templates/' . $subview); ?>

          <!--  search in blog -->
          <div class="col-md-4">
            <div class="well">
              <h4>Blog Search</h4>
			  <?= form_open('articles/search'); ?>
              <div class="input-group">
                <input type="text" class="form-control" name="search" required>
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-primary" value="search">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
			  <?= form_close(); ?>
            </div>


            <!-- widget -->
            <div class="well">
              <h4>Sidebar Widget</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>
          </div>
        </div>

</div><!-- ./ container -->

<?php $this->load->view('site/_partials/footer'); ?>