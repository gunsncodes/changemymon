<div class="sidebar-menu toggle-others fixed">

    <div class="sidebar-menu-inner">

        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <div class="logo">
                    <a href="dashboard-1.html" class="logo-expanded">
                        <img src="{{asset('images/logo@2x.png')}}" width="80" alt=""/>
                    </a>

                    <a href="dashboard-1.html" class="logo-collapsed">
                        <img src="{{asset('images/logo-collapsed@2x.png')}}" width="40" alt=""/>
                    </a>
                </div>

                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                <div class="mobile-menu-toggle visible-xs">
                    <a href="#" data-toggle="user-info-menu">
                        <i class="fa-bell-o"></i>
                        <span class="badge badge-success">7</span>
                    </a>

                    <a href="#" data-toggle="mobile-menu">
                        <i class="fa-bars"></i>
                    </a>
                </div>

                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
                <div class="settings-icon">
                    <a href="#" data-toggle="settings-pane" data-animate="true">
                        <i class="linecons-cog"></i>
                    </a>
                </div>


        </header>


        <!-- Sidebar User Info Bar - Added in 1.3 -->
        <section class="sidebar-user-info">
            <div class="sidebar-user-info-inner">
                <a href="extra-profile.html" class="user-profile">
                    <img src="{{asset('images/user-4.png')}}" width="60" height="60" class="img-circle img-corona" alt="user-pic"/>

							<span>
								<strong>{{$nameUser}}</strong>
							</span>
                </a>

                <ul class="user-links list-unstyled">
                    <li>
                        <a href="myprofile" title="Mi Perfil">
                            <i class="linecons-user"></i>
                            Mi Perfil
                        </a>
                    </li>
                    <li>
                        <a href="mailbox-main.html" title="Correo">
                            <i class="linecons-mail"></i>
                            Correo
                        </a>
                    </li>
                    <li class="logout-link">
                        <a href="extra-login.html" title="Salir">
                            <i class="fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </section>


        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            @foreach($menu1User as $menu1)
                <li>
                    <a href="{{$menu1->menu1_pagina}}">
                        <i class="{{$menu1->menu1_icono}}"></i>
                        <span class="title">{{$menu1->menu1_descripcion}}</span>
                    </a>
                    @if(sizeof($menu1->menu2User))
                        <ul>
                            @foreach($menu1->menu2User as $menu2)
                                <li>
                                    <a href="{{$menu2->menu2_pagina}}">
                                        <i class="{{$menu2->menu2_icono}}" ></i>
                                        <span class="title">{{$menu2->menu2_descripcion}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

    </div>

</div>