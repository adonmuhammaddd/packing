<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        User
        <small>User data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
      </ol>
    </section>
    
    <section class="content">
        <?php $this->view('admin/message'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data User</h3>
                <div class="pull-right">
                    <a href="<?= base_url('user/create') ?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"></i> Create
                    </a>

                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Addrress</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($row->result() as $key => $data)
                        { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->username?></td>
                                <td><?= $data->name?></td>
                                <td><?= $data->address?></td>
                                <td><?= $data->level == 1 ? "Admin" : "Kasir"?></td>
                                <td>
                                    <a href="<?= base_url('user/edit/'.$data->id) ?>" class="btn btn-warning btn-flat btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('user/delete/'.$data->id) ?>" class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Are you sure wanna delete this data?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
      
    </section>