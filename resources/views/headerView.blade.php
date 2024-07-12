<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="/"><img src="/dist/assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="/"><img src="/dist/assets/images/logo-mini.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
        @if(session("final-submission") == true)
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-logout d-none d-lg-block">       
              <button class="btn btn-gradient-light btn-rounded btn-fw btnLogout">Logout</button>
            </li>
          </ul>
        @endif
        </div>
      </nav>