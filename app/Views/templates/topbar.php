<form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
        <li><a href="" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>

<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url('/assets/images/users/' . user()->user_img); ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= user()->username; ?></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title text-center"></div>
            <a href="<?= base_url('profile'); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </li>
</ul>