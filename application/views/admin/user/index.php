 <div class="row">
                            <div class="col-md-6">
                                <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Users</h1>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group actions">
                                    <a href="<?= site_url('admin/user/edit'); ?>" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>  New</a>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb">
                            <li><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
                            <li class="active">Users</li>
                        </ol>

                        <?php $this->load->view('admin/_partials/flashes'); ?>

                         <table  id="sort-table" class="table table-striped tablesorter">
                            <thead>
                               <tr>
                                    <th>Name <i class="glyphicon glyphicon-chevron-down"></i></th>
                                    <th>Email <i class="glyphicon glyphicon-chevron-down"></i></th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php if (count($users)): ?>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= anchor('admin/user/edit/' . $user->id, $user->name); ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td><?= btn_edit("admin/user/edit/{$user->id}") ?></td>
                                    <td><?= btn_delete("admin/user/delete/{$user->id}"); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <td colspan="3">We could not find any users.</td>
                            <?php endif; ?>

                            </tbody>
                        </table>

                       <!--  <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul> -->

                    </div>
                </div><!-- ./ row -->