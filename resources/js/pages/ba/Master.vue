<template>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Bisnis Analitik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <router-link to="/register" class="nav-link">Daftar</router-link>
                </li>
                
                <li class="nav-item">
                    <router-link to="/login" class="nav-link">Masuk</router-link>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>-->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <!-- <img
                        src="../../dist/img/AdminLTELogo.png"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8"
                    /> -->
                    <span class="brand-text font-weight-light"><b>cabai.id</b></span>
                </a>

                <button
                    class="navbar-toggler order-1"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarCollapse"
                    aria-controls="navbarCollapse"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">
                                Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <router-link to="/register" class="nav-link">Daftar</router-link>
                        </li>
                        
                        <li class="nav-item">
                            <router-link to="/login" class="nav-link">Masuk</router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/detail" class="nav-link">Detail</router-link>
                        </li>

                        <!-- <li class="nav-item dropdown">
                            <a
                                id="dropdownSubMenu1"
                                href="#"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                class="nav-link dropdown-toggle"
                            >Dropdown</a>
                            <ul
                                aria-labelledby="dropdownSubMenu1"
                                class="dropdown-menu border-0 shadow"
                            >
                                <li>
                                    <a href="#" class="dropdown-item">Some action</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">Some other action</a>
                                </li>

                                <li class="dropdown-divider"></li>

                                <li class="dropdown-submenu dropdown-hover">
                                    <a
                                        id="dropdownSubMenu2"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        class="dropdown-item dropdown-toggle"
                                    >Hover for action</a>
                                    <ul
                                        aria-labelledby="dropdownSubMenu2"
                                        class="dropdown-menu border-0 shadow"
                                    >
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                        </li>

                                        <li class="dropdown-submenu">
                                            <a
                                                id="dropdownSubMenu3"
                                                href="#"
                                                role="button"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                class="dropdown-item dropdown-toggle"
                                            >level 2</a>
                                            <ul
                                                aria-labelledby="dropdownSubMenu3"
                                                class="dropdown-menu border-0 shadow"
                                            >
                                                <li>
                                                    <a href="#" class="dropdown-item">3rd level</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item">3rd level</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item">level 2</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item">level 2</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                    </ul>

                    <!-- SEARCH FORM -->
                    <!-- <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input
                                class="form-control form-control-navbar"
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <!-- <img
                                        src="../../dist/img/user1-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle"
                                    /> -->
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span
                                                class="float-right text-sm text-danger"
                                            >
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted">
                                            <i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <!-- <img
                                        src="../../dist/img/user8-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 img-circle mr-3"
                                    /> -->
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted">
                                            <i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <!-- <img
                                        src="../../dist/img/user3-128x128.jpg"
                                        alt="User Avatar"
                                        class="img-size-50 img-circle mr-3"
                                    /> -->
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span
                                                class="float-right text-sm text-warning"
                                            >
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted">
                                            <i class="far fa-clock mr-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span
                                    class="float-right text-muted text-sm"
                                >12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="control-sidebar"
                            data-slide="true"
                            href="#"
                        >
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                Harga Rataan Cabai 
                                <small>Provinsi Jawa Barat</small>
                            </h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Layout</a>
                                </li>
                                <li class="breadcrumb-item active">Top Navigation</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                            <div class="inner">
                                <h4><b>Cabai Merah</b></h4>
                                <h4>Rp20000/kg</h4>

                                <p align="right">Harga stabil</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag fas fa-equals"></i>
                            </div>
                            <router-link to="/detail" class="nav-link small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h4><b>Cabai Rawit</b></h4>
                                <h4>Rp20000/kg</h4>

                                <p align="right">Harga Turun Rp1000</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag fas fa-angle-double-down"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h4><b>Cabai Besar</b></h4>
                                <h4>Rp-/kg</h4>

                                <p align="right">Harga Tidak Diketahui</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag fas fa-times"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                            <div class="inner">
                                <h4><b>Cabai Keriting</b></h4>
                                <h4>Rp30000/kg</h4>

                                <p align="right">Harga Naik Rp3000</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag fas fa-angle-double-up"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Recap Report</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                    </p>

                                    <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                    <strong>Goal Completion</strong>
                                    </p>

                                    <div class="progress-group">
                                    Add Products to Cart
                                    <span class="float-right"><b>160</b>/200</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                    </div>
                                    <!-- /.progress-group -->

                                    <div class="progress-group">
                                    Complete Purchase
                                    <span class="float-right"><b>310</b>/400</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                                    </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="float-right"><b>480</b>/800</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: 60%"></div>
                                    </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                    Send Inquiries
                                    <span class="float-right"><b>250</b>/500</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                    </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                    <h5 class="description-header">$35,210.43</h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                    <h5 class="description-header">$10,390.90</h5>
                                    <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                    <h5 class="description-header">$24,813.53</h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                    <h5 class="description-header">1200</h5>
                                    <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the card's
                                        content.
                                    </p>

                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p
                                        class="card-text"
                                    >With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p
                                        class="card-text"
                                    >With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        
    </div>
</template>