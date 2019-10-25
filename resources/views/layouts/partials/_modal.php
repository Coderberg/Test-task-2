<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form class="js-add-task" method="post" action="/">

                    <?php \app\lib\CSRF::createTokenField(); ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                        <div class="invalid-feedback">
                            Please enter a valid name.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        <div class="invalid-feedback">
                            Please enter a email.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="task">Task Description</label>
                        <textarea class="form-control" id="task" name="task" rows="3"></textarea>
                        <div class="invalid-feedback">
                            Please enter a valid task description.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

        </div>
    </div>
</div>
