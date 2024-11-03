<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row text-center">
            <div class="col-lg-12">
                <div class="card shadow-sm mb-0">
                    <div class="card-header">
                        <h2 class="mb-0 mt-2">Dashboard</h2>
                    </div>
                    <div class="card-footer">
                        <small>Welcome back to Digital Equipment and Appliances Logging System! Your journey continues here. <span>&#128640;</span></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body my-4" style="height:120px; background-image: url('/assets/tcu/tcu-background.jpg'); background-size: cover; background-position: center;"></div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <p>Date Today</p>
                        <h3 id="date-today"></h3>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <p>Time Today</p>
                        <h3 id="time-today"></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function updateDateTime() {
        const now = new Date();

        const date_options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            timeZone: 'Asia/Manila',
        };

        const time_options = {
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            timeZone: 'Asia/Manila',
            hour12: true
        };

        document.getElementById('date-today').innerText = new Intl.DateTimeFormat('en-US', date_options).format(now);
        document.getElementById('time-today').innerText = new Intl.DateTimeFormat('en-US', time_options).format(now);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>


<?= $this->endSection(); ?>