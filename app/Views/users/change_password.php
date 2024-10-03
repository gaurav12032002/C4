<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<h2 class="text-center"><?= esc($title) ?></h2>
<hr>


<?php echo form_open_multipart (base_url('users/change_password')); ?>
    <?= csrf_field() ?>
    <div class="col-6">
    <label for="title">Old Password</label>
    <input type="password" name="old_password" id="old_password" class="form-control">
    </div>
    <br>
    <div class="col-6">
    <label for="title">New Password</label>
    <input type="password" name="password" id="password" class="form-control">
    </div>
    <br>
    <div class="col-6">
    <label for="body">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
    </div>
    <br>
    <div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" name="submit">Change Password</button>
    <a href="<?php echo base_url('./users'); ?>" class="btn btn-sm btn-success">Cancel</a>
    </div>
</form>