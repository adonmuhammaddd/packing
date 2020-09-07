<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        User
        <small>Create User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>User</li>
        <li class="active">Create</li>
      </ol>
    </section>
    
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Create User</h3>
                <div class="pull-right">
                    <a href="<?= base_url('user') ?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form action="" method="post">
                            <div class="form-group <?= form_error('name') ? 'has-error' : null ?>">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="<?= $this->input->post('name') ?? $row->name ?>" class="form-control">
                                <?= form_error('name')?>
                            </div>
                            <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="<?= $this->input->post('username') ?? $row->username ?>" class="form-control">
                                <?= form_error('username')?>
                            </div>
                            <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                                <label for="password">Password</label><small>(Let this empty if don't want to change it)</small>
                                <input type="password" name="password" value="<?= $this->input->post('password') ?>" class="form-control">
                                <?= form_error('password')?>
                            </div>
                            <div class="form-group <?= form_error('password_confirmation') ? 'has-error' : null ?>">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" value="<?= $this->input->post('password_confirmation')?>" class="form-control">
                                <?= form_error('password_confirmation')?>
                            </div>
                            <div class="form-group <?= form_error('address') ? 'has-error' : null ?>">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control"><?= $this->input->post('address') ?? $row->address ?></textarea>
                                <?= form_error('address')?>
                            </div>
                            <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control">
                                    <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?> 
                                    <option value="1">Admin</option>
                                    <option value="2" <?= $level == 2 ? 'selected' : null?>>Kasir</option>
                                </select>
                                <?= form_error('level')?>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success btn-flat" type="submit">
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