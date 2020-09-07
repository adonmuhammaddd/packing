<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Item
        <small>Create Item</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Item</li>
        <li class="active">Create</li>
      </ol>
    </section>
    
    <section class="content">
        <?php $this->view('admin/message'); ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create Item</h3>
                <div class="pull-right">
                    <a href="<?= base_url('item') ?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <?php echo form_open_multipart('item/store'); ?>
                            <div class="form-group">
                                <label for="barcode">Barcode *</label>
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <input type="text" name="barcode" value="<?= $row->barcode ?>" class="form-control" required>
                                <?= form_error('barcode')?>
                            </div>
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" name="name" value="<?= $row->name ?>" class="form-control" required>
                                <?= form_error('name')?>
                            </div>
                            <div class="form-group">
                                <label for="categoryId">Category *</label>
                                <?php echo form_dropdown('categoryId', $category, $selectedcategory, ['class' => 'form-control', 'required' => 'required']) ?>
                                <?= form_error('categoryId')?>
                            </div>
                            <div class="form-group">
                                <label for="unitId">Unit *</label>
                                <?php echo form_dropdown('unitId', $unit, $selectedunit, ['class' => 'form-control', 'required' => 'required']) ?>
                                <?= form_error('unitId')?>
                            </div>
                            <div class="form-group">
                                <label for="price">Price *</label>
                                <input type="number" name="price" value="<?= $row->price ?>" class="form-control" required>
                                <?= form_error('price')?>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label> <small> (Optional)</small>
                                <?php if ($page == 'edit')
                                {
                                    if ($row->image != null) 
                                    {
                                ?>
                                    <div style="margin-bottom:5px">
                                        <img src="<?= base_url('uploads/product/'.$row->image);?>" alt="<?= $row->name ?>" style="width:60px;"> 
                                    </div>
                                <?php
                                    }
                                }
                                ?>
                                <input type="file" name="image" class="form-control">
                                <?= form_error('image')?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-flat" type="submit" name="<?= $page ?>">
                                    <i class="fa fa-paper-plane"></i> Save
                                </button>
                                <button class="btn btn-default btn-flat" type="reset">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
      
    </section>