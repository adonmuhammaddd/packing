<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        kWh Prabayar
        <small>kWh Prabayar data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">kWh Prabayar</li>
      </ol>
    </section>
    
    <section class="content">
        <?php $this->view('admin/message'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data kWh Prabayar</h3>
                <div class="pull-right">
                    <a href="<?= base_url('prabayar/create') ?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"></i> Create
                    </a>

                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Master</th>
                            <th>No. Seri</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
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
                                <td><?= $data->no_master?></td>
                                <td><?= $data->no_inner?></td>
                                <td><?= $data->tgl?></td>
                                <td><?= $data->waktu?></td>
                                <td>
                                    <a href="<?= base_url('prabayar/edit/'.$data->id) ?>" class="btn btn-warning btn-flat btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <!-- <a href="<?= base_url('prabayar/delete/'.$data->id) ?>" class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Are you sure wanna delete this data?')">
                                        <i class="fa fa-trash"></i>
                                    </a> -->
                                    <a href="#modal-delete" data-toggle="modal" class="btn btn-danger btn-flat btn-sm" onclick="$('#modal-delete #delete-data').attr('action', '<?= base_url('supplier/delete/'.$data->id)?>')">
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

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Are you sure wanna delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <form id="delete-data" action="" method="post">
                        <div class="text-center">
                            <button class="btn btn-flat btn-default" data-dismiss="modal">
                                No
                            </button>
                            <button class="btn btn-flat btn-danger" type="submit">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>