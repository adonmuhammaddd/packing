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
                            <th>Operator</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        
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
                    "url": "<?=site_url('packing/getDataNotComplete')?>",
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "orderable": false
                    }
                ]
            })
        });
    </script>