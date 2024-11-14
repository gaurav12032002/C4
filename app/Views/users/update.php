<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<h2 class="text-center"><?= esc($title) ?></h2>
<hr>

<?php echo form_open_multipart (base_url('users/update')); ?>
    <?= csrf_field() ?>
    <div class="col-6">
    <label for="title">Full Name</label>
    <input type="input" name="full_name" id="full_name" class="form-control" value="<?= $edit['full_name']  ?>">
    </div>
    <br>
    <div class="col-6">
    <label for="body">Profile Picture</label>
    <input type="file" name="profile_picture" class="form-control" value="<?= $edit['profile_picture']  ?>">
    </div>
    <br>
    <div class="col-6">
    <label for="body"> Bio</label>
    <textarea name="bio" class="form-control" id="bio" <?= $edit['bio']  ?>></textarea>
    </div>
    <br>
    <div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" name="submit">Update Profile</button>
    <a href="<?php echo base_url('./users'); ?>" class="btn btn-sm btn-success">Cancel</a>
    </div>
</form>