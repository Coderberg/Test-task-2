<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/app.css">

    <title><?php echo $title; ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <a class="navbar-brand" href="/">
        Task list
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">

            <?php if (empty($_SESSION['admin'])): ?>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/login">Administrator</a>
                </li>

            <?php else: ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Administrator
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/admin/tasks">Dashboard</a>
                        <a class="dropdown-item" href="/admin/logout">Logout</a>
                    </div>
                </li>

            <?php endif; ?>

        </ul>

    </div>
</nav>

<div class="container" style="max-width: 600px">

    <div class="mt-4">
        <?php echo \app\lib\FlashMessages::get(); ?>
    </div>

    <div class="mt-4">
        <?php echo $content; ?>
    </div>

</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="/public/js/app.js"></script>
    <script src="https://kit.fontawesome.com/e70316b35e.js" crossorigin="anonymous"></script>
</body>
</html>
