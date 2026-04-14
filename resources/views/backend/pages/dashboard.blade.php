@extends('backend.common.master')

@section('content')

<style>
/* Page */
.dashboard-wrap {
    background: #f5f7fb;
    min-height: 100vh;
    padding: 20px;
}

/* Glass Card */
.stat-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 22px;
    position: relative;
    overflow: hidden;
    border: 1px solid #eef0f4;
    transition: 0.25s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.06);
}

/* Top Icon */
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 14px;
}

/* Color Variants */
.icon-blue { background: #eef4ff; color: #3b82f6; }
.icon-green { background: #ecfdf5; color: #10b981; }
.icon-purple { background: #f5f3ff; color: #8b5cf6; }
.icon-orange { background: #fff7ed; color: #f97316; }
.icon-dark { background: #f3f4f6; color: #111827; }

/* Numbers */
.stat-value {
    font-size: 26px;
    font-weight: 700;
    color: #111;
}

.stat-label {
    font-size: 13px;
    color: #6b7280;
}

/* Trend Badge */
.stat-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 12px;
    background: #ecfdf5;
    color: #10b981;
    padding: 4px 10px;
    border-radius: 20px;
}

/* Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.dashboard-title {
    font-size: 22px;
    font-weight: 700;
}

</style>

<div class="main-content app-content dashboard-wrap">
    <div class="container-fluid">

        <!-- Header -->
        <div class="dashboard-header">
            <div class="dashboard-title">Dashboard</div>
            <div class="text-muted small">Welcome back, Admin</div>
        </div>

        <!-- Cards -->
        <div class="row g-4">

            <!-- Categories -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <i class="bi bi-folder2"></i>
                    </div>
                    <div class="stat-value">{{ $categories }}</div>
                    <div class="stat-label">Total Categories</div>
                    <div class="stat-badge">+12%</div>
                </div>
            </div>

            <!-- Subcategories -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <div class="stat-value">{{ $subcategories }}</div>
                    <div class="stat-label">Sub Categories</div>
                    <div class="stat-badge">+8%</div>
                </div>
            </div>

            <!-- Services -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div class="stat-value">{{ $services }}</div>
                    <div class="stat-label">Services</div>
                    <div class="stat-badge">+20%</div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon icon-orange">
                        <i class="bi bi-box"></i>
                    </div>
                    <div class="stat-value">{{ $products }}</div>
                    <div class="stat-label">Products</div>
                    <div class="stat-badge">+5%</div>
                </div>
            </div>

            <!-- Leads -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon icon-dark">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-value">{{ $leads }}</div>
                    <div class="stat-label">Leads</div>
                    <div class="stat-badge">+15%</div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection