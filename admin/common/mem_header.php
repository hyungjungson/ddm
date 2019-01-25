<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left"> </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #1c3d5e; font-size: 30px; font-weight: 900;">
                    T
                </a>

                <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="/admin/profile"><i class="fa fa- user"></i>My Profile</a>
                        <?php if( $sess_lev == 10 ) {?>
                            <a class="nav-link" href="/admin/admManager"><i class="fa fa -cog"></i>Admin List</a>
                        <?php }?>
                        <a class="nav-link" href="/admin/logout"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>

</header>
