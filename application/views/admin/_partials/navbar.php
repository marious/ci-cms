<nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html">AlphaCMS</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
              <?php
                $controllers = [
                  'admin/dashboard' => 'Dashboard',
                  'admin/page' => 'Pages',
                  'admin/page/order' => 'Order Pages',
                  'admin/article' => 'News Articles',
                  'admin/user' => 'Users',
                ];
              ?>
              <?php foreach ($controllers as $key => $value): ?>
                <li class="<?= make_active($key) ?>"><?= anchor($key, $value) ?></li>
              <?php endforeach; ?>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input class="form-control search-form" placeholder="Search" type="text">
                </div>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('admin/user/logout') ?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                <li><a href="/" title="">Site</a></li>
              </ul>
            </div>
          </div>
        </nav>
