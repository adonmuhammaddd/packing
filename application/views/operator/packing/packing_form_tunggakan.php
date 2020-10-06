<style>
    .modalDialog {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    }

    .modalContent {
    height: auto;
    min-height: 100%;
    border-radius: 0;
    }

    .warning 
    {
        background-color: #F99 !important;
    }

    .makeRed
    {
        border: 4px solid red;
    }

    .makeGreen
    {
        border: 4px solid green;
    }
</style>
<section class="content-header">
    <h1>
        kWh
        <small>kWh</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Packing</li>
    </ol>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="text-uppercase mt-4 mb-5">Halo <b><?= $this->fungsi->user_login()->name ?></b> 👋</h2>
        </div>
        <div class="panel-body">
            <p class="sansserif"><h3>Selamat bekerja, tetap semangat dan jangan lupa tersenyum hari ini 😉</h3></p>
        </div>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Packing kWh Prabayar (Tunggakan)</h3>
            <div class="pull-right">
                <button class="btn btn-warning btn-flat" onclick="reloadPage()"><i class="fa fa-refresh"></i> Refresh</button>
                <a href="<?php echo base_url('packing/index');?>" class="btn btn-default btn-flat"><i class="fa fa-chevron-left"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <form action="#" id="formTunggakan" class="form-horizontal">
                <input type="hidden" value="" name="id"/> 
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">No. kWh</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">No. Inner</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control centerField innerTunggakan mantap" id="innerTunggakan1" type="text" name="no_innerr" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('innerTunggakan11'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control centerField innerTunggakan mantap" id="innerTunggakan11" type="text" name="no_innerr" size="11" maxlength="11" autocomplete="off" onkeyup="lanjutOnMax(this)"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>      
                
                    <hr>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="">No. Master</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                                <input class="form-control centerField" id="masterTunggak" type="text" name="no_masterr" size="8" maxlength="8" disabled></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <!--<button type="button" class="btn btn-warning form-control" onclick="onchange()"><i class="glyphicon glyphicon-check"></i> Check</button>-->
                            <button type="button" class="btn btn-primary form-control" onclick="saveTunggakan()"><i class="glyphicon glyphicon-check"></i> Simpan</button>
                        </div>
                    </div>
                <!-- </div> -->
            </form>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/packing/packing.js"></script>