<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="" alt="">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="" alt="">
        </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a class="btn btn-success btn-site-preview" href="/" target="_blank">
                        <i class="fa fa-eye"></i> View site
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe"></i> Language
                        <span class="fa fa-caret-down"></span>
                    </a>
                    <ul class="dropdown-menu list-language">
                        <li>
                            <form action="" method="post">
                                <button type="submit" class="control-panel-lang-btn">English</button>
                            </form>
                        </li>
                        <li>
                            <form action="" method="post">
                                <button type="submit" class="control-panel-lang-btn">Vietnamese</button>
                            </form>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-envelope-o"></i></a>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ static_url('vendor/core/images/avatar.jpg') }}" class="user-image" alt="fullname">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">ffullname</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ static_url('vendor/core/images/avatar.jpg') }}" class="img-circle" alt="ffullname">
                            <p><?php echo fullname() ?></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href=""
                                    class="btn btn-default btn-flat">profile</a>
                            </div>
                            <div class="pull-right">
                                <a href=""
                                    class="btn btn-default btn-flat">logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
