<html>
    <head>
        <title></title>
    </head>
    <body>
    <?php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '">';
        echo "<br>";
        echo $row->name;
    ?>
    </body>
</html>