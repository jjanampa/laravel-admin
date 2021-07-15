<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
{{--            @if (Auth::guard('admin')->user()->hasRole('administrador'))--}}
{{--            @if (auth('admin')->user()->hasRole('administrador'))--}}
{{--            @if (auth('admin')->user()->can('pagina'))--}}
                <li class="nav-item {{ Request::routeIs('admin.pages.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.pages.index') }}">
                        <i class="material-icons">web</i>
                        <p> {{ __('Pages') }} </p>
                    </a>
                </li>
{{--            @endif--}}

            <li class="nav-item {{ Request::routeIs('admin.activitylogs.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.activitylogs.index') }}">
                    <i class="material-icons">toc</i>
                    <p> {{ __('Activity Logs') }} </p>
                </a>
            </li>

            <li class="nav-item active-pro">
                <a class="nav-link" data-toggle="collapse" href="#configManagement" aria-expanded="true">
                    <i class="material-icons">settings</i>
                    <p>{{ __('Settings') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="configManagement">
                    <ul class="nav">
                        <li class="nav-item {{ Request::routeIs('admin.settings.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.settings.index') }}">
                                <i class="material-icons">settings</i>
                                <p> {{ __('Settings') }} </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <span class="sidebar-mini"> UM </span>
                                <span class="sidebar-normal"> {{ __('Users') }} </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('admin.roles.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                <span class="sidebar-mini"> RM </span>
                                <span class="sidebar-normal"> {{ __('Roles') }} </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::routeIs('admin.permissions.*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> {{ __('Permissions') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
    <div class="sidebar-background" style="background-image: url({{ asset('material') }}/img/sidebar-1.jpg) "></div>
</div>
