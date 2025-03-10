 <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-info border-bottom">
     <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- Navbar links -->
             <ul class="navbar-nav align-items-center ml-md-auto">
                 <li class="nav-item d-xl-none">
                     <!-- Sidenav toggler -->
                     <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                         data-target="#sidenav-main">
                         <div class="sidenav-toggler-inner">
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                         </div>
                     </div>
                 </li>

             </ul>
             <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                 <li class="nav-item dropdown">
                     <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">
                         <div class="media align-items-center">
                             <span class="avatar avatar-sm " style="background: #F3F6F9;">
                                 <img alt="" src="{{ asset('/assets/img/images/defaultPerfil.png') }}">
                             </span>
                             <div class="media-body ml-2 d-none d-lg-block">
                                 <div class="media-body ml-2 d-none d-lg-block">
                                     <div class="d-flex flex-column"> <span class="mb-0 text-sm font-weight-bold">
                                             {{ Auth::user()->personal->nombres }}</span>
                                         <span class="mb-0 text-xs font-weight-bold"> {{ Auth::user()->email }}</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right">
                         <div class="dropdown-header noti-title">
                             <h6 class="text-overflow m-0">Bienvenido!</h6>
                         </div>
                         {{-- <a href="{{route('profile.index')}}" class="dropdown-item">
                            <i class="fas fa-user-cog"></i>
                            <span>Mi Perfil</span>
                          </a> --}}
                         <div class="dropdown-divider"></div>
                         <form action="{{ route('logout') }}" method="post">
                             @csrf
                             <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                 <span>Cerrar sesión</span>
                             </button>
                         </form>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
