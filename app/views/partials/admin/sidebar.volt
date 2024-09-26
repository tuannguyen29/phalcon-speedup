<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ static_url('vendor/core/images/avatar.jpg') }}" class="img-circle" alt="<?php echo fullname() ?>">
            </div>
            <div class="pull-left info">
                <p><?php echo fullname() ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href=""><i class="glyphicon glyphicon-th-large"></i><span>dashboard</span></a>
            </li>

            <li class="treeview active">
                <a href="#"><i class="fa fa-user"></i> <span>user</span>
                    <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="">
                            <i class="bullet-dot"><span></span></i> user
                        </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="">
                    <i class="fa fa-image"></i>
                    <span>slider</span>
                </a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
