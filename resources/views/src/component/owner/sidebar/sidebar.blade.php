<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        @if (isset($dataProfile->foto) != null)
            <a class="navbar-brand m-0" href=" {{ url('/owner/home') }}">
                <img src="{{ asset('storage/' . $dataProfile->foto) }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">{{ $dataProfile->fullname }}</span>
            </a>
        @else
            <a class="navbar-brand m-0" href=" {{ url('/owner/home') }}">
                <img src="{{ asset('argon') }}/assets/img/foto.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">{{ Auth::user()->name }}</span>
            </a>
        @endif
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/home') ? 'active' : '' }}" href="{{ url('/owner/home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-tachometer text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/order') ? 'active' : '' }}" href="{{ url('/owner/order') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-text-o text-primary text-sm opacity-10" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/tracking') ? 'active' : '' }}"
                    href="{{ url('/owner/tracking') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-spinner text-primary text-sm opacity-10" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Status Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/account') ? 'active' : '' }}"
                    href="{{ url('/owner/account') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-sm opacity-10" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Karyawan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/profile') ? 'active' : '' }}"
                    href="{{ url('/owner/profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user text-primary text-sm opacity-10" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('owner/changepassword') ? 'active' : '' }}"
                    href="{{ url('/owner/changepassword') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-key text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ubah Password</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 mt-3">
        <a class="btn btn-danger btn-sm mb-0 w-100" href="{{ route('logout') }}" type="button">Logout</a>
    </div>
</aside>
