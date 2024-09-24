<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<!-- <form action="<?php echo base_url('books/update'); ?>" method="post"> -->
<?php echo form_open_multipart (base_url('books/update')); ?>
    <?= csrf_field() ?>
    <input type="hidden" name="slug"  value="<?= $edit['slug']; ?>">
    <div class="col-6">
    <label for="title">Book</label>
    <input type="input" name="book" id="book" class="form-control" value="<?= $edit['book']  ?>">
    </div>
    <br>
    <div class="col-6">
    <label for="title">Author</label>
    <input type="input" name="author" id="author" class="form-control" value="<?= $edit['author']  ?>">
    </div>
    <br>
    <div class="col-6">
    <label for="body">Summary</label>
    <textarea name="summary" id="summary" class="form-control" cols="45" rows="4"><?= $edit['summary']  ?></textarea>
    </div>
    <br>
    <div class="col-6">
    <label for="body">Book cover</label>
    <input type="file" name="book_cover" class="form-control">
    </div>
    <br>
    <div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary" name="submit">Update Book</button>
    <a href="<?php echo base_url('./books'); ?>" class="btn btn-sm btn-success">Cancel</a>
    </div>
</form>