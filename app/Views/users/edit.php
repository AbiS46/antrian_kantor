<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="d-flex align-items-center">
                <div class="sidebar-brand-icon mx-3">
                    <img src="../img/logo_ssm.png" width="35px" alt="">
                </div>
                <div class="sidebar-brand-text text-light fs-5 fw-semibold">Sinar Surya Mustika</div>
            </div>
        </nav>
    </div>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Contoh gambar">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h2 class="mb-4">Ganti Password</h2>

                    <!-- Notifikasi berhasil -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Notifikasi error -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('users/change_password'); ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="username" class="form-control form-control-lg"
                                placeholder="Masukkan username" value="<?= old('username', $old['username'] ?? '') ?>" required />
                            <label class="form-label" for="username">Username</label>
                            <?php if (isset($validation) && $validation->getError('username')): ?>
                                <div class="text-danger"><?= $validation->getError('username') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="new_password" id="new_password"
                                class="form-control form-control-lg" placeholder="Masukkan password baru" required />
                            <label class="form-label" for="new_password">Password Baru</label>
                            <?php if (isset($validation) && $validation->getError('new_password')): ?>
                                <div class="text-danger"><?= $validation->getError('new_password') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Ganti Password</button>
                        </div>
                    </form>

                    <div class="text-center text-lg-start mt-3">
                        <a href="<?= base_url('users'); ?>" class="btn btn-secondary">Kembali ke Login</a>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CV. Sinar Surya Mustika</span>
                    </div>
                </div>
            </footer>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>