<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <img src="../img/logo_ssm.png" width="35px" alt="Logo SSM">
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
                    <h2 class="mb-4">Register</h2>

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

                    <form action="<?= base_url('users/store'); ?>" method="post">

                        <div class="form-outline mb-4">
                            <input type="text" name="username" id="form3Example1" class="form-control form-control-lg"
                                placeholder="Masukkan username" value="<?= old('username') ?>" required />
                            <label class="form-label" for="form3Example1">Username</label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example2"
                                class="form-control form-control-lg" placeholder="Masukkan password" required />
                            <label class="form-label" for="form3Example2">Password</label>
                        </div>

                        <div class="mb-4">
                            <select name="role" id="role" class="form-select form-select-lg" required>
                                <option value="" disabled <?= old('role') ? '' : 'selected' ?>>Pilih role</option>
                                <option value="Admin" <?= old('role') == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="User" <?= old('role') == 'User' ? 'selected' : '' ?>>User</option>
                            </select>
                            <label for="role" class="form-label">Role</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        </div>
                    </form>

                    <!-- Tombol kembali ke login -->
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