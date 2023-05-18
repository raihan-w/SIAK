<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li><a class="nav-link" href="<?= base_url('home'); ?>"> <i class="fas fa-fire"></i> <span>Dashboard</span> </a></li>

    <li class="menu-header">Kependudukan</li>
    <li><a class="nav-link" href="<?= base_url('penduduk'); ?>"> <i class="fas fa-users"></i> <span>Daftar Penduduk</span> </a></li>
    <li><a class="nav-link" href="<?= base_url('kartu-keluarga'); ?>"> <i class="fas fa-id-card"></i> <span>Kartu Keluarga</span> </a></li>

    <li class="menu-header">Persuratan</li>
    <li><a class="nav-link" href="<?= base_url('outgoing'); ?>"> <i class="fas fa-envelope"></i> <span>Surat Keluar</span> </a></li>
    <?php if (in_groups('administrator') || in_groups('operator')) : ?>
        <li class="dropdown">
            <a href="" class="nav-link has-dropdown" data-toggle="dropdown"> <i class="fas fa-file-alt"></i> <span>Surat Pengantar</span> </a>
            <ul class="dropdown-menu">
                <li><a href="<?= base_url('form-bedanama'); ?>" class="nav-link">Keterangan Beda Nama</a></li>
                <li><a href="<?= base_url('form-bidikmisi'); ?>" class="nav-link">Keterangan Bidik Misi</a></li>
                <li><a href="<?= base_url('form-domisili'); ?>" class="nav-link">Keterangan Domisili</a></li>
                <li><a href="<?= base_url('form-keterangan'); ?>" class="nav-link">Keterangan</a></li>
                <li><a href="<?= base_url('form-kematian'); ?>" class="nav-link">Keterangan Kematian</a></li>
                <li><a href="<?= base_url('form-tidak-mampu'); ?>" class="nav-link">Keterangan Tidak Mampu</a></li>
                <li><a href="<?= base_url('form-pengantar'); ?>" class="nav-link">Surat Pengantar</a></li>
            </ul>
        </li>
    <?php endif ?>
    <?php if (in_groups('administrator')) : ?>
        <li class="menu-header">Konfigurasi</li>
        <li><a class="nav-link" href="<?= base_url('perangkat'); ?>"> <i class="fas fa-id-badge"></i> <span>Perangkat Desa</span> </a></li>
        <li><a class="nav-link" href="<?= base_url('users'); ?>"> <i class="fas fa-users"></i> <span>Users</span> </a></li>
    <?php endif ?>
</ul>