<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Supplier
        <small>Create Supplier</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Supplier</li>
        <li class="active">Create</li>
      </ol>
    </section>
    
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create Supplier</h3>
                <div class="pull-right">
                    <a href="<?= base_url('supplier') ?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form action="<?= base_url('supplier/store');?>" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <input type="text" name="name" value="<?= $row->name ?>" class="form-control" required>
                                <?= form_error('name')?>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" value="<?= $row->phone ?>" class="form-control" required>
                                <?= form_error('phone')?>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" required><?= $row->address ?></textarea>
                                <?= form_error('address')?>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control"><?= $row->description ?></textarea>
                                <?= form_error('description')?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-flat" type="submit" name="<?= $page ?>">
                                    <i class="fa fa-paper-plane"></i> Save
                                </button>
                                <button class="btn btn-default btn-flat" type="reset">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
    </section>