<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="{{url('/books')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Buku
                </a>
                @if (auth()->user()->hasRole('admin'))
                <a class="nav-link" href="{{url('/students')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Siswa
                </a>
                <a class="nav-link" href="{{url('/operators')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                    Operator
                </a>
                @endif

                <div class="sb-sidenav-menu-heading">Profile</div>
                <a class="nav-link" href="{{url('/profile')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                    Pengaturan
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{Auth::user()->name}}
        </div>
    </nav>
</div>