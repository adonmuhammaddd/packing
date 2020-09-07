<script src="check.js"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Item
        <small>Item data</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item</li>
      </ol>
    </section>
    
    <section class="content">
        <?php $this->view('admin/message'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Item</h3>
                <div class="pull-right">
                    <a href="<?= base_url('item/create') ?>" class="btn btn-primary btn-flat">
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
                            <th>No. Inner</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php 
                            $no = 1;
                            foreach($row->result() as $key => $data)
                        { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= $data->barcode?> |
                                    <a href="<?= base_url('item/barcode_qrcode/'.$data->id) ?>" class="btn btn-warning btn-flat btn-xs">
                                        Generate <i class="fa fa-barcode"></i>
                                    </a>
                                </td>
                                <td><?= $data->name?></td>
                                <td><?= $data->categoryName?></td>
                                <td><?= $data->unitName?></td>
                                <td><?= $data->price?></td>
                                <td>
                                    <?php if ($data->image != null) { ?>
                                        <img src="<?= base_url('uploads/product/'.$data->image);?>" alt="<?= $data->name ?>" style="width:60px;"> 
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('item/edit/'.$data->id) ?>" class="btn btn-warning btn-flat btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('item/delete/'.$data->id) ?>" class="btn btn-danger btn-flat btn-sm" onclick="return confirm('Are you sure wanna delete this data?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?> -->
                    </tbody>
                </table>
            </div>
        </div>
      
    </section>

    <script>
        $(document).ready(function()
        {
            $('#mytable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?=site_url('kwh/get_ajax_prabayar')?>",
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": [3,4],
                        "className": 'text-right'
                    },
                    {
                        "targets": [0,1,2],
                        "className": 'text-center'
                    },
                ]
            })
        });
    </script>