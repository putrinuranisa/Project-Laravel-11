<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <a class="navbar-brad logo_h" href="index.html"><ing src="{{ asset('assets/templates/user/img/logo.png') }}" alt=""></a>
                    <button class="navbar-togggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSuppportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="av-link" href="index.html">Home</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-items"><a class="nav-link" href="{{ route('user.logout') }}">Logout</a></li>
                        </ul>
                    </div>
            </div>
        </nav>
    </div>
</header>