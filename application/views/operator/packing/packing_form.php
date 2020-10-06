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
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Packing kWh Prabayar</h3>
            <div class="pull-right">
                <button class="btn btn-warning btn-flat" onclick="reloadPage()"><i class="fa fa-refresh"></i> Refresh</button>
                <a href="<?php echo base_url('packing/indexTunggakan');?>" class="btn btn-primary btn-flat"><i class="fa fa-dropbox"></i> Tunggakan</a>
            </div>
        </div>
        <div class="box-body">
            <form action="#" id="formReguler" class="form-horizontal">
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
                            <input id="inner-1" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-11'))" autofocus></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-11" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-2'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>      
                
                    <div class="row">
                        <div class="col-md-6 inner-2">
                            <input id="inner-2" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-22'))"></input>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-22" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-3'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6 inner-3">
                            <input id="inner-3" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-33'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-33" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-4'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 inner-4">
                            <input id="inner-4" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-44'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-44" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-5'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">No. kWh</label>
                        </div>
                        <div class="col-md-6">
                            <label for="">No. Inner</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 inner-5">
                            <input id="inner-5" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-55'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-55" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-6'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 inner-6">
                            <input id="inner-6" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-66'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-66" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-7'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 inner-7">
                            <input id="inner-7" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-77'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-77" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-8'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 inner-8">
                            <input id="inner-8" class="form-control centerField _inner" type="text" name="no_inner[]" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('inner-88'))"></input>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-6">
                            <input id="inner-88" class="form-control centerField _inner" type="text" size="11" maxlength="11" autocomplete="off" onkeyup="moveOnMax(this,document.getElementById('master-1'))"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    
                            <div class="btn-group">
                                <input type="button" class="form-control btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="Hapus Field">
                                <div class="dropdown-menu">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove1" value="Hapus 1">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove2" value="Hapus 2">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove3" value="Hapus 3">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove4" value="Hapus 4">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove5" value="Hapus 5">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove6" value="Hapus 6">
                                <input type="button" class=" dropdown-item form-control btn btn-secondary btnRemove7" value="Hapus 7">
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
                            <input id="master-1" class="form-control centerField _inner" type="text" name="no_master" size="8" maxlength="8" autocomplete="off"></input>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <!--<button type="button" class="btn btn-warning form-control" onclick="onchange()"><i class="glyphicon glyphicon-check"></i> Check</button>-->
                            <button type="button" class="btn btn-primary btn-flat form-control" id="btnSave" onclick="save()"><i class="glyphicon glyphicon-check"></i> Simpan</button>
                        </div>
                    </div>
                <!-- </div> -->
            </form>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/packing/packing.js"></script>