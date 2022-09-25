<nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                           class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ route('projects.index') }}"
                           class="nav-link {{ (request()->is('home/projects*')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-project-diagram"></i>
                            <p>
                                Projects
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                                {{--                                <span class="badge badge-info right">6</span>--}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('users-view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}?type=0"
                                       class="nav-link {{ (request()->is('home/users*')) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin-view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}?type=1"
                                       class="nav-link {{ (request()->is('home/admin')) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Admin
                                        </p>
                                    </a>

                                </li>
                            @endcan
                            @can('company-view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}?type=3"
                                       class="nav-link {{ (request()->is('home/company')) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Company
                                        </p>
                                    </a>

                                </li>
                            @endcan
                            @can('teachers-view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}?type=2"
                                       class="nav-link {{ (request()->is('home/teacher')) ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Teacher
                                        </p>
                                    </a>

                                </li>
                            @endcan
                            @can('roles-view')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}"
                                       class="nav-link {{(request()->is('home/roles*')) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}"
                                   class="nav-link {{(request()->is('home/permissions*')) ? 'active' : ''}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @can('orders-view')
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}"
                               class="nav-link {{ (request()->is('home/orders*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Orders
                                </p>
                            </a>

                        </li>
                    @endcan
                    @can('payments-view')
                        <li class="nav-item">
                            <a href="{{ route('payments.index') }}"
                               class="nav-link {{ (request()->is('home/payments*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Payments
                                </p>
                            </a>

                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-plus-square"></i>
                            <p>
                                General
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('attributes-view')
                                <li class="nav-item">
                                    <a href="{{ route('attributes.index') }}"
                                       class="nav-link {{(request()->is('home/attributes*')) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attributes</p>
                                    </a>
                                </li>
                            @endcan

                                @can('blogs-view')
                                    <li class="nav-item">
                                        <a href="{{ route('blogs.index') }}"
                                           class="nav-link {{(request()->is('home/notifications*')) ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Blogs</p>
                                        </a>
                                    </li>
                                @endcan

                            @can('categories-view')
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}"
                                       class="nav-link {{(request()->is('home/categories*')) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                            @endcan
                            @can('partners-view')
                                <li class="nav-item">
                                    <a href="{{ route('partners.index') }}"
                                       class="nav-link {{(request()->is('home/permissions*')) ? 'active' : ''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Partners</p>
                                    </a>
                                </li>
                            @endcan
                                @can('standart-pages-view')
                                    <li class="nav-item">
                                        <a href="{{ route('standart-pages.index') }}"
                                           class="nav-link {{(request()->is('home/standart-pages*')) ? 'active' : ''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Standart Pages</p>
                                        </a>
                                    </li>
                                @endcan
                        </ul>
                    </li>
                   @can('settings-view')
                        <li class="nav-item">
                            <a href="{{ route('settings.index') }}"
                               class="nav-link {{ (request()->is('home/settings*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Settings
                                </p>
                            </a>

                        </li>
                    @endcan
                    @can('comments-view')
                        <li class="nav-item">
                            <a href="{{ route('comments.index') }}"
                               class="nav-link {{ (request()->is('home/comments*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Comments
                                </p>
                            </a>

                        </li>
                    @endcan

                    @can('contacts-view')
                        <li class="nav-item">
                            <a href="{{ route('contacts.index') }}"
                               class="nav-link {{ (request()->is('home/contacts*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comment-dollar"></i>
                                <p>
                                    Contact Us
                                </p>
                            </a>

                        </li>
                    @endcan
                    @can('notifications-view')
                        <li class="nav-item">
                            <a href="{{ route('notifications.index') }}"
                               class="nav-link {{ (request()->is('home/notifications*')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>
                                     Notifications
                                </p>
                            </a>

                        </li>
                    @endcan
                </ul>
            </nav>
