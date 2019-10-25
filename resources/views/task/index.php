<?php require __DIR__.'/../layouts/partials/_filter.php'; ?>

<!-- Task list' -->
<ul class="todo-list mb-3">

    <?php foreach ($tasks as $task): ?>

        <li class="card <?= ($task['status'] === 'completed') ? 'completed' : ''; ?>">

            <p>
                <?php if ($task['status'] === 'completed'): ?>

                    <i class="far fa-check-square text-success" title="Completed"></i>

                <?php else: ?>

                    <i class="far fa-square text-primary" title="New"></i>

                <?php endif; ?>

                <?php echo htmlspecialchars($task['content']); ?>
            </p>
            <p class="small">

                Posted by <?php echo htmlspecialchars($task['author_name']); ?>

                <span class="text-muted">
                        <?php echo htmlspecialchars($task['author_email']); ?>
                    </span>
            </p>

            <?php if ((int) $task['edited'] === 1): ?>

                <p class="small text-muted">Edited by Admin</p>

            <?php endif; ?>

        </li>

    <?php endforeach; ?>
</ul>

<!-- Pagination -->
<?php echo $pagination; ?>

<?php require __DIR__.'/../layouts/partials/_modal.php'; ?>
