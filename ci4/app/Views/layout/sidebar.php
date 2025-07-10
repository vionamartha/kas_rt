<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"> 

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kas RT</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="font-weight-bold text-white">Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Data Warga -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('warga') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Warga</span>
        </a>
    </li>

    <!-- Nav Item - Iuran Kas -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('iuran') ?>">
            <i class="fas fa-fw fa-coins"></i>
            <span>Iuran Kas</span>
        </a>
    </li>

    <!-- Nav Item - Permohonan Kas -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('permohonan_kas') ?>">
            <i class="fas fa-fw fa-hand-holding-usd"></i>
            <span>Permohonan Kas</span>
        </a>
    </li>

     <hr class="sidebar-divider my-0" />
     
    <!-- Nav Item - Laporan -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('laporan') ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>

     <hr class="sidebar-divider my-0" />

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline" style="margin-top: 20px;"> 
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
