<div class="col-8">
<h2><?= esc($books['book']) ?></h2>
</div>
<div class="col-4">
<a href="<?php echo base_url('books/edit/'.esc($books['slug'])); ?>" class="btn btn-sm btn-primary">Update Book</a> &nbsp;<a href="<?php echo base_url('books/delete/'.esc($books['slug'])); ?>" class="btn btn-sm btn-danger">Delete Book</a>
</div>
<p><?= esc($books['author']) ?></p>
<p><?= esc($books['summary']) ?></p>
<div class="col-8">
<img src="<?php echo base_url('uploads/'.esc($books['book_cover'])) ?>"height="200px" width="200px" alt="">
</div>