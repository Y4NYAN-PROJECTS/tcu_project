<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taguig City University</title>

    <link rel="icon" href="/assets/tcu/logo-square.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/assets/compiled/css/iconly.css">
</head>

<body>
    <script src="/assets/static/js/initTheme.js"></script>
    <div id="main" class="layout-horizontal">

        <!-- [ Body ] -->
        <?= $this->renderSection('content'); ?>

        <!-- [ toast ] -->
        <?= $this->include('VerificationPage/Components/toast.php'); ?>

        <script src="/assets/static/js/components/dark.js"></script>
        <script src="/assets/static/js/pages/horizontal-layout.js"></script>
        <script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="/assets/compiled/js/app.js"></script>
        <script src="/assets/extensions/apexcharts/apexcharts.min.js"></script>
        <script src="/assets/static/js/pages/dashboard.js"></script>
</body>

</html>