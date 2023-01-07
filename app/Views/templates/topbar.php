<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/admin" class="logo d-flex align-items-center">
            <img src="<?= base_url(); ?>/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">SIMPUS</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <?php if (logged_in()) : ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= user()->username ?></span>
                    <?php else : ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= user() ?></span>
                    <?php endif; ?>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <?php if (logged_in()) : ?>
                            <h6><?= user()->username ?></h6>
                        <?php else : ?>
                            <h6><?= user() ?></h6>
                        <?php endif; ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <?php if (logged_in()) : ?>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/login">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign In</span>
                            </a>
                        </li>
                    <?php endif; ?>



                </ul><!-- End Profile Dropdown Items -->


        </ul>
    </nav><!-- End Icons Navigation -->

</header>