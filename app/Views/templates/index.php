<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Desa</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/node_modules/selectric/public/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <?= $this->include('templates/topbar'); ?>
            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">Administration</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="">SIAK</a>
                    </div>
                    <?= $this->include('templates/sidebar'); ?>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('pageContent'); ?>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>
    <script src="<?= base_url(); ?>/assets/css/custom.css"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>/node_modules/jquery-ui-dist/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url(); ?>/node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?= base_url(); ?>/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>


    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/assets/js/custom.js"></script>
</body>

</html>