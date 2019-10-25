<?php require __DIR__.'/../layouts/partials/_filter.php'; ?>

<!-- Task list' -->
<ul class="todo-list mb-3">

    <?php foreach ($tasks as $task): ?>

        <li class="card <?= ($task['status'] === 'completed') ? 'completed' : ''; ?>">

            <p class="js-task-description" id="js-task-description-<?php echo $task['id']; ?>">
                <?php if ($task['status'] === 'completed'): ?>

                    <i class="far fa-check-square text-success cursor-pointer js-set-created"
                       title="Change status"
                       id="<?php echo $task['id']; ?>"
                    ></i>

                <?php else: ?>

                    <i class="far fa-square text-primary cursor-pointer js-set-completed"
                       title="Change status"
                       id="<?php echo $task['id']; ?>"
                    ></i>

                <?php endif; ?>

                <span><?php echo htmlspecialchars($task['content']); ?></span>

                <i class="fas fa-edit text-warning cursor-pointer js-edit-task"
                   title="Edit task"
                   id="edit-<?php echo $task['id']; ?>"
                ></i>

            </p>

            <div class="js-edit-task-description mb-3"
               id="js-edit-task-description-<?php echo $task['id']; ?>"
               style="display: none"
            >
                <form method="post">

                    <?php \app\lib\CSRF::createTokenField(); ?>

                    <input type='hidden' name='id' value='<?php echo $task['id']; ?>'>

                    <label for="task-<?php echo $task['id']; ?>" class="sr-only"></label>
                    <textarea name="task"
                              required
                              class="form-control mb-2"
                              id="task-<?php echo $task['id']; ?>"
                              rows="2"><?php echo htmlspecialchars($task['content']); ?></textarea>

                    <button class="btn btn-primary jb-save-button" type="submit">
                        Save
                    </button>
                    <button class="btn btn-light jb-btn-cancel" type="button">
                        Cancel
                    </button>
                </form>

            </div>

            <p class="small">

                Posted by <?php echo htmlspecialchars($task['author_name']); ?>

                <span class="text-muted"><?php echo htmlspecialchars($task['author_email']); ?></span>
            </p>

            <?php if ((int) $task['edited'] === 1): ?>

                <p class="small text-muted">Edited by Admin</p>

            <?php endif; ?>

        </li>

    <?php endforeach; ?>
</ul>

<!-- Pagination -->
<?php echo $pagination; ?>


<script defer src="/public/js/admin.js"></script>

<?php require __DIR__.'/../layouts/partials/_modal.php'; ?>
