<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="<?= asset_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= asset_url('css/style.css') ?>">
    <script src="<?= asset_url('js/jquery.min.js') ?>"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card mt-3 card-border">
                        <div class="card-body">
                            <div class="defaultAlert"></div>
                            <h5 class="card-title">Login</h5>
                            <form action="<?= base_url('login-check') ?>" autocomplete="off" id="loginForm" method="POST">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="emailInput" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" name="passwordInput" placeholder="Password" required>
                                </div>
                                <p class="link text-right">Not yet register ? <a href="<?= base_url('register') ?>">register now</a></p>
                                <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="baseUrl" value="<?= base_url() ?>">

    <script src="<?= asset_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset_url('js/login.js') ?>"></script>
</body>

</html>