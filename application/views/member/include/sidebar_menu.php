<div id="sidebar" class="sidebar                  responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            
            <!--
            <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
            </button>

            
            <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
            </button>
            -->    

        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <!--
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
            -->
        </div>
    </div>
    <?php 
    $cur1 = $this->uri->segment(2);
    ?>
    <ul class="nav nav-list">
        <li class="<?php echo ($cur1=="dashboard") ? "active" : ""; ?>" style="height: 100%;">
            <a href="<?php echo base_url('admin/dashboard') ?>">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> Beranda </span>
            </a>
            <b class="arrow"></b>
        </li>
		<li class="<?php echo ($cur1=="petugas") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-shield"></i>
                <span class="menu-text">
                    Petugas
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/pengguna/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Pengguna
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/pengguna/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Pengguna
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="petugas") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text">
                    Flight Attendant
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/flight_attendant/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah FA
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/flight_attendant/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data FA
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="schedule") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                   Schedule
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/schedule/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Schedule
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/schedule/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Schedule
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="pilot") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-plane"></i>
                <span class="menu-text">
                    Pilot
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/pilot/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Pilot
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/pilot/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Pilot
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="licence") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-gavel"></i>
                <span class="menu-text">
                    Licence
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/licence/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Licence
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/licence/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Licence
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="driver") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">
                    Driver
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/driver/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Driver
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/driver/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Driver
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<!--
		<li class="<?php echo ($cur1=="driver_schedule") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                    Driver Schedule
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/driver_schedule/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Driver Schedule
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/driver_schedule/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Driver Schedule
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		-->
		<li class="<?php echo ($cur1=="vehicle") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-car"></i>
                <span class="menu-text">
                    Vehicle
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/vehicle/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Vehicle
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/vehicle/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Vehicle
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		<li class="<?php echo ($cur1=="aerotrans") ? "active" : ""; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">
                    Aerotrans
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo base_url('admin/aerotrans/add') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Tambah Aerotrans
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo base_url('admin/aerotrans/daftar') ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Data Aerotrans
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
		
	</ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>
