<!-- Content Header (Page header) -->
<style>
.dataTables_filter {
display: none;
}
</style>
<section class="content-header">
      <h1>
        No. Seri
        <small>Create No. Seri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>No. Seri</li>
        <li class="active">Create</li>
      </ol>
    </section>
    
    <section class="content">
        <?php $this->view('admin/message'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create No. Seri</h3>
                <div class="pull-right">
                    <button class="btn btn-warning btn-flat" onclick="reloadPage()"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="<?= base_url('generateseri') ?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="myinput1">Awal</label>
                    </div>
                    <div class="col-md-3">
                        <label for="myinput2">Akhir</label>
                    </div>
                </div>
                <div class="row">
                    <input class="form-control" value="56" type="hidden" id="tipe_meter"></input>
                    <div class="col-md-3">
                        <input class="form-control" type="text" id="myinput1" size="8" minlength="8" maxlength="8" autofocus onkeyup="generateNamaFile();"></input>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" id="myinput2" size="8" minlength="8" maxlength="8"></input>
                    </div>
                    <div class="col-md-3">
                        <button style="width:100%" class="btn btn-primary btn-flat" onclick="myFunction()">Generate Nomor Seri</button>
                    </div>
                    <div class="col-md-3">
                        <button style="width:100%" class="btn btn-success btn-flat" onclick="inputToTable()">Generate Table</button>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-7">
                        <input type="text" class="form-control" placeholder="Nama File Untuk (EXCEL / PDF)" id="nama-file"><br>
                        <table class="table table-bordered table-hover" id="no-seri-table">
                            <thead>
                                <tr>
                                    <th class="text-center noExport">No. Seri</th>
                                    <th class="text-center noExport">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <td></td>
                                <td></td>
                                
                                <td></td> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <table class="table table-bordered table-hover" id="no-seri-table-temp">
                            <thead>
                                <tr>
                                    <th class="text-center noExport">No.</th>
                                    <th class="text-center noExport">Awal</th>
                                    <th class="text-center noExport">Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <input type="text" class="form-control" placeholder="search nomor seri" id="searchBox">
                        <hr>
                        <label>Nama File Untuk Nedysis</label>
                        <input type="text" class="form-control" placeholder="Nama File Untuk Nedysis" id="nama-file-nedysis"><br>
                        <a href="#" style="width:100%" id="save-link" class="btn btn-success btn-flat">Generate Nedysis</a><br />
                    </div>
                </div>
            </div>
        </div>
      
    </section>
    
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.18/dist/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/generate_seri.js"></script>

    <script>
        var myinput1 = document.getElementById("myinput1");
        var myinput2 = document.getElementById("myinput2");

        $(document).ready(function(){
            
            function generateNamaFile()
            {
                var x = document.getElementById("myinput1");
                document.getElementById("nama-file").value = x.value;
            }
        });

        myinput1.onkeyup = function() {
            if (this.value.length === parseInt(this.attributes["maxlength"].value)) {
                myinput2.focus();
            }
        }

        function reloadPage()
        {
            location.reload();
        }

        $('#save-link').click(function ()
        {
            var retContent = [];
            var retString = '';
            var namaFileNedysis = '';
            var time = new Date();

            if ($("#nama-file-nedysis").val() == '')
            {
                namaFileNedysis = 'Nedysis | '+time.getFullYear()+'-'+time.toLocaleString('default', { month: 'long' })+'-'+time.getDate();
            }
            else
            {
                namaFileNedysis = $("#nama-file-nedysis").val() + ' | ' +time.getFullYear()+'-'+time.toLocaleString('default', { month: 'long' })+'-'+time.getDate();
            }

            $('tbody tr').each(function (idx, elem)
            {
                var elemText = [];
                $(elem).children('td').each(function (childIdx, childElem)
                {
                elemText.push($(childElem).text());
                });
                retContent.push(`(${elemText.join('')})`);
            });
            retString = retContent.join(',\r\n');
                var file = new Blob([retString], {type: 'text/plain'});
            var btn = $('#save-link');
            btn.attr("href", URL.createObjectURL(file));
            btn.prop("download", namaFileNedysis+".txt");
        })
        
    </script>