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
                <div class="col-md-6 offset-md-3">
                    <div class="card mt-3 card-border">
                        <div class="card-body">
                            <div class="defaultAlert"></div>
                            <h5 class="card-title">Register</h5>
                            <form method="POST" action="<?= base_url('reister-user') ?>" autocomplete="off" enctype="multipart/form-data" id="registerForm">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Full Name</label>
                                    <input type="text" class="form-control" name="fullNameInput" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="emailInput" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" name="passwordInput" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-form-label">Profile</label>
                                    <input type="file" class="form-control-file" name="profile" required>
                                </div>
                                <p class="link text-right">I have Account ? <a href="<?= base_url('login') ?>">login now</a></p>
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