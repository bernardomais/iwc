<div class="text-center">
    <nav>
        <ul class="pagination pagination-sm">
            <?php if ($prevPage): ?>
                <?php print $this->Paginator->prev('<<', array('tag' => 'li')); ?>
            <?php endif; ?>
            <?php print $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'separator' => null)); ?>
            <?php if ($nextPage): ?>
                <?php print $this->Paginator->next('>>', array('tag' => 'li')); ?>
            <?php endif; ?>
        </ul>
    </nav>
</div>
