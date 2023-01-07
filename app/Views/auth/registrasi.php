<?= $this->extend('auth/template/index'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4"><?= lang('Auth.register') ?></h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form action="<?= route_to('register') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="col-12 my-2">
                                        <label for="email"><?= lang('Auth.email') ?></label>
                                        <input type="email" name="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="yourEmail" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                        <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                                    </div>

                                    <div class="col-12 my-2">
                                        <label for="username"><?= lang('Auth.username') ?></label>
                                        <input type="text" name="username" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="yourUsername" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                                    </div>

                                    <div class="col-12 my-2">
                                        <label for="password"><?= lang('Auth.password') ?></label>
                                        <input type="password" name="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="yourPassword" placeholder="<?= lang('Auth.password') ?>" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12 my-2">
                                        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                        <input type="password" name="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="yourPassword" placeholder="<?= lang('Auth.repeatPassword') ?>" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12 my-2">
                                        <button class="btn btn-primary w-100" type="submit"><?= lang('Auth.register') ?></button>
                                    </div>
                                    <div class="col-12 my-2">
                                        <p class="small mb-0"><?= lang('Auth.alreadyRegistered') ?><a href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<?= $this->endSection(); ?>