<?= $this->include('admin/layout/header') ?>

<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-dark">
        <i class="bi bi-speedometer2 me-2 text-primary"></i> Dashboard Overview
    </h2>

    <div class="row g-4">
        <!-- Users Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle bg-primary text-white me-3">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Users</p>
                        <h4 class="fw-bold mb-0"><?= $totalUsers ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle bg-success text-white me-3">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Products</p>
                        <h4 class="fw-bold mb-0"><?= $totalProducts ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-circle bg-warning text-white me-3">
                        <i class="bi bi-receipt fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Total Orders</p>
                        <h4 class="fw-bold mb-0"><?= $totalOrders ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<?= $this->include('admin/layout/footer') ?>