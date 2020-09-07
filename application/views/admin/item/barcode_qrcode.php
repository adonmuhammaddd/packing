<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Item
        <small>Create Barcode</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Item</li>
        <li class="active">Barcode</li>
      </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Barcode Generator</h3>
                <div class="pull-right">
                    <a href="<?= base_url('item') ?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '">';
                ?>
                <br><br>
                <a href="<?= base_url('item/print_pdf_barcode/'.$row->id) ?>" target="_blank" class="btn btn-app">
                    <i class="fa fa-barcode"></i><?= $row->barcode ?> Print
                </a>
                
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">QR-Code Generator</h3>
            </div>
            <div class="box-body">
                <?php
                    $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                    $qrCode->writeFile('uploads/qrcode/'.$row->name.''.$row->id.'.png');
                ?>
                <img src="<?= base_url('uploads/qrcode/'.$row->name.''.$row->id.'.png') ?>" style="width:200px">
                <br>
                <a href="<?= base_url('item/print_pdf_qrcode/'.$row->id) ?>" target="_blank" class="btn btn-default btn-flat btn-sm">
                    <i class="fa fa-print"></i>
                </a>
                <?= $row->barcode ?>
            </div>
        </div>
      
    </section>