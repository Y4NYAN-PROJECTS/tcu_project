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
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <!-- [ Content ] -->
            <?= $this->renderSection('content'); ?>

            <!-- [ Right Content ] -->
            <div class="col-md-7 d-none d-lg-block">
                <div id="auth-right" style="background-image: url('/assets/tcu/tcu-background.jpg'); background-size: cover; background-position: center; filter: brightness(50%)">
                </div>
            </div>
        </div>
    </div>

    <!-- [ toast ] -->
    <?= $this->include('LoginPages/Components/toast.php'); ?>
</body>

<script src="/assets/static/js/components/dark.js"></script>
<script src="/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/compiled/js/app.js"></script>
<script src="/assets/extensions/jquery/jquery.min.js"></script>
<script src="assets/static/js/pages/component-toasts.js"></script>

</html>