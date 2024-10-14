<div class="col-10">
<h2><?= esc($title) ?></h2>
</div>
<div class="col-2">
<a href="<?php echo base_url('books/new'); ?>" class="btn btn-sm btn-primary"> Create Book</a>
</div>
<?php if ($books !== []) { ?>
    <?php foreach ($books as $books_item): ?>
        <div>
        <img src="<?php echo base_url('./icon/open-book.png'); ?>" height="40px" width="35px"alt="">
        <h3><?= esc($books_item['book']) ?></h3>
           <?= esc($books_item['author']) ?> 
        <p><a href="<?= base_url('./books/'. esc($books_item['slug'], 'url')) ?>" class="btn btn-sm btn-link">View article</a></p>
        </div>
    <?php endforeach ?>
    
<?php }else{ ?>

<h3>No News</h3>

<p>Unable to find any book for you.</p>

<?php } ?>