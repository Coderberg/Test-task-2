<div class="card mx-auto mt-5">
    <div class="card-header">Log in</div>
    <div class="card-body">
        <form action="/admin/login" method="post">
            <?php \app\lib\CSRF::createTokenField(); ?>
            <div class="form-group">
                <label for="login">Login</label>
                <input class="form-control" type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </form>
    </div>
</div>
