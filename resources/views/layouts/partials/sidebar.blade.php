<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="@yield('user_image', '/img/user-placeholder.png')" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p> @if(Auth::user()->tipo_utente == '1')
                  {{ Auth::user()->consulente->nome }} {{ Auth::user()->consulente->cognome }}
                        @else
                            {{ Auth::user()->contatto->descrizione }}
                        @endif</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!--li class="header">CONSULENTE</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/consulenti/dashboard_direzionale"><i class='fa fa-dashboard'></i> <span>Dashboard direzionale</span></a></li>
            <li><a href="/consulenti/{{ Auth::user()->consulente->id }}"><i class='fa fa-dashboard'></i> <span>Dashboard consulente</span></a></li>
            <li><a href="/clienti/dashboard"><i class='fa fa-dashboard'></i> <span>Dashboard cliente</span></a></li>
            <li><a href="/interventi"><i class='fa fa-calendar '></i> <span>Interventi</span></a></li>
            <li><a href="/progetti"><i class='fa fa-bitcoin'></i> <span>Filiera</span></a></li>
            <li><a href="/consulenti"><i class='fa fa-user'></i> <span>Consulenti</span></a></li>
            <li><a href="/clienti"><i class='fa fa-briefcase'></i> <span>Clienti</span></a></li>
            <!--li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
