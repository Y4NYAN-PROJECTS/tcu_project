<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taguig City University</title>

    <link rel="icon" href="/assets/tcu/logo-square.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/compiled/css/auth.css">
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.css">
</head>

<body>
    <script src="/assets/static/js/initTheme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div id="app">
        <!-- [ Side Navigation ] -->
        <?= $this->include('StudentPages/Components/nav-side.php'); ?>

        <div id="main" class='layout-navbar navbar-fixed'>
            <!-- [ Top Navigation ] -->
            <?= $this->include('StudentPages/Components/nav-top.php'); ?>

            <!-- [ Content ] -->
            <?= $this->renderSection('content'); ?>

            <!-- [ Footer ] -->
            <?= $this->include('StudentPages/Components/footer.php'); ?>

            <!-- [ Toast ] -->
            <?= $this->include('StudentPages/Components/toast.php'); ?>
        </div>

        <script>
            <?= $this->include('StudentPages/charts.js'); ?>
        </script>
    </div>

    <script src="/assets/static/js/components/dark.js"></script>
    <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/compiled/js/app.js"></script>
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
    <script src="/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="/assets/extensions/filepond/filepond.js"></script>
    <script src="/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="/assets/static/js/pages/filepond.js"></script>
</body>

</html>