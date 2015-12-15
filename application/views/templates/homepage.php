        <div id="myCarousel" class="carousel slide" data-ride="carousel">


          <?php echo get_carousel(); ?>



          <!-- Controls -->
          <div class="carousel-controls">
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
          </div>

        </div><!-- End Carousel -->

        <div class="row">
          <div class="col-md-8">
            <div class="well blog-post">
              <?php if ($articles[0]) echo get_excerpt($articles[0], 50); ?>
            </div>

            <div class="well blog-post">
              <?php if ($articles[1]) echo get_excerpt($articles[1], 50); ?>
            </div>

            <div class="well blog-post">
              <?php if ($articles[2]) echo get_excerpt($articles[2], 50); ?>
            </div>



            <!-- Pager -->
   <!--  <ul class="pager">
      <li class="previous">
        <a href="#">&larr; Older</a>
      </li>
      <li class="next">
        <a href="#">&rarr; Next</a>
      </li>
    </ul> -->
  </div>