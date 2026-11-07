<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

    'title' => 'InventarioDB',

    'title_prefix' => '',
    'title_postfix' => '',


    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,


    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    */

    'google_fonts' => [
        'allowed' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    */

    'logo' => '<b>Inventario</b>DB',

    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

    'logo_img_class' => 'brand-image img-circle elevation-3',

    'logo_img_xl' => null,

    'logo_img_xl_class' => 'brand-image-xs',

    'logo_img_alt' => 'InventarioDB',


    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    */

    'auth_logo' => [

        'enabled' => false,

        'img' => [

            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

            'alt' => 'InventarioDB',

            'class' => '',

            'width' => 50,

            'height' => 50,

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    */

    'preloader' => [

        'enabled' => true,

        'mode' => 'fullscreen',

        'img' => [

            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',

            'alt' => 'InventarioDB',

            'effect' => 'animation__shake',

            'width' => 60,

            'height' => 60,

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,

    'usermenu_header' => false,

    'usermenu_header_class' => 'bg-primary',

    'usermenu_image' => false,

    'usermenu_desc' => false,

    'usermenu_profile_url' => false,


    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => null,

    'layout_boxed' => null,

    'layout_fixed_sidebar' => null,

    'layout_fixed_navbar' => null,

    'layout_fixed_footer' => null,

    'layout_dark_mode' => null,


    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    */

    'classes_auth_card' => 'card-outline card-primary',

    'classes_auth_header' => '',

    'classes_auth_body' => '',

    'classes_auth_footer' => '',

    'classes_auth_icon' => '',

    'classes_auth_btn' => 'btn-flat btn-primary',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    */

    'classes_body' => '',

    'classes_brand' => '',

    'classes_brand_text' => '',

    'classes_content_wrapper' => '',

    'classes_content_header' => '',

    'classes_content' => '',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    'classes_sidebar' => 'sidebar-dark-primary elevation-4',

    'classes_sidebar_nav' => '',


    /*
    |--------------------------------------------------------------------------
    | Top Navigation
    |--------------------------------------------------------------------------
    */

    'classes_topnav' => 'navbar-white navbar-light',

    'classes_topnav_nav' => 'navbar-expand',

    'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar Configuration
    |--------------------------------------------------------------------------
    */

    'sidebar_mini' => 'lg',

    'sidebar_collapse' => false,

    'sidebar_collapse_auto_size' => false,

    'sidebar_collapse_remember' => false,

    'sidebar_collapse_remember_no_transition' => true,

    'sidebar_scrollbar_theme' => 'os-theme-light',

    'sidebar_scrollbar_auto_hide' => 'l',

    'sidebar_nav_accordion' => true,

    'sidebar_nav_animation_speed' => 300,


    /*
    |--------------------------------------------------------------------------
    | Control Sidebar
    |--------------------------------------------------------------------------
    */

    'right_sidebar' => false,

    'right_sidebar_icon' => 'fas fa-cogs',

    'right_sidebar_theme' => 'dark',

    'right_sidebar_slide' => true,

    'right_sidebar_push' => true,

    'right_sidebar_scrollbar_theme' => 'os-theme-light',

    'right_sidebar_scrollbar_auto_hide' => 'l',


    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    'use_route_url' => false,

    'dashboard_url' => 'dashboard',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    'disable_darkmode_routes' => false,


    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Menú principal de InventarioDB.
    |
    */

    'menu' => [

        /*
        |--------------------------------------------------------------------------
        | BARRA SUPERIOR
        |--------------------------------------------------------------------------
        */

        [
            'type' => 'navbar-search',
            'text' => 'Buscar',
            'topnav_right' => true,
        ],

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],


        /*
        |--------------------------------------------------------------------------
        | BUSCADOR DEL SIDEBAR
        |--------------------------------------------------------------------------
        */

        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar...',
        ],


        /*
        |--------------------------------------------------------------------------
        | INICIO
        |--------------------------------------------------------------------------
        */

        [
        'header' => 'ACCESO Y SEGURIDAD',
    ],

   [
    'text' => 'Usuarios',
    'route' => 'users.index',
    'icon' => 'fas fa-fw fa-users',
],
[
    'text' => 'Roles',
    'route' => 'roles.index',
    'icon' => 'fas fa-fw fa-user-shield',
],
[
    'text' => 'Asignar Rol a Usuario',
    'route' => 'asignar.index',
    'icon' => 'fas fa-fw fa-user-tag',
],


        /*
        |--------------------------------------------------------------------------
        | PARAMETRIZACIÓN
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'PARAMETRIZACIÓN',
        ],

        [
            'text' => 'Categorías',
            'route' => 'categorias.index',
            'icon' => 'fas fa-tags',
        ],

        [
            'text' => 'Productos',
            'route' => 'productos.index',
            'icon' => 'fas fa-box',
        ],

        // NUEVO: acceso al módulo de variantes
        [
            'text' => 'Variantes de Productos',
            'route' => 'producto-variantes.index',
            'icon' => 'fas fa-layer-group',
        ],

        [
            'text' => 'Clientes',
            'route' => 'clientes.index',
            'icon' => 'fas fa-users',
        ],

          [
            'text' => 'Inventario',
            'route' => 'inventarios.index',
            'icon' => 'fas fa-warehouse',
        ],


        /*
        |--------------------------------------------------------------------------
        | INVENTARIO
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'INVENTARIO',
        ],

      
       


        /*
        |--------------------------------------------------------------------------
        | TRANSACCIONES
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'TRANSACCIONES',
        ],

        [
            'text' => 'Ventas',
            'route' => 'ventas.index',
            'icon' => 'fas fa-cash-register',
        ],

        [
            'text' => 'Pedidos',
            'route' => 'pedidos.index',
            'icon' => 'fas fa-shopping-cart',
        ],

        [
            'text' => 'Reservas',
            'route' => 'reservas.index',
            'icon' => 'fas fa-calendar-alt',
        ],

        [
            'text' => 'Devoluciones',
            'route' => 'devoluciones.index',
            'icon' => 'fas fa-undo',
        ],


        /*
        |--------------------------------------------------------------------------
        | REPORTES
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'REPORTES',
        ],

        [
            'text' => 'Reportes',
            'icon' => 'fas fa-chart-bar',
            'url' => '#',
        ],

         

         [
            'header' => 'KPIS',
        ],
        [
            'text' => 'Estadísticas y KPIs',
            'icon' => 'fas fa-chart-line',
            'submenu' => [
                ['text' => 'Resumen general', 'route' => 'kpis.resumen', 'icon' => 'fas fa-tachometer-alt'],
                ['text' => 'Estadísticas de ventas', 'route' => 'kpis.ventas', 'icon' => 'fas fa-chart-bar'],
                ['text' => 'Estadísticas de productos', 'route' => 'kpis.productos', 'icon' => 'fas fa-box'],
                ['text' => 'Estadísticas de inventario', 'route' => 'kpis.inventario', 'icon' => 'fas fa-warehouse'],
                ['text' => 'Operaciones comerciales', 'route' => 'kpis.operaciones', 'icon' => 'fas fa-clipboard-list'],
            ],
        ],
        [
            'text' => 'Vista de Estantes',
            'route' => 'inventarios.dinamico',
            'icon' => 'fas fa-th-large',
        ],

    ], // ← AQUÍ TERMINA CORRECTAMENTE EL MENÚ


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [

        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,

        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,

    ],


    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    */

    'plugins' => [

        /*
        |--------------------------------------------------------------------------
        | DataTables
        |--------------------------------------------------------------------------
        */

        'Datatables' => [

            'active' => false,

            'files' => [

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],

                [
                    'type' => 'css',

                    'asset' => false,

                    'location' =>
                        '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],

            ],

        ],


        /*
        |--------------------------------------------------------------------------
        | Select2
        |--------------------------------------------------------------------------
        */

        'Select2' => [

            'active' => false,

            'files' => [

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],

                [
                    'type' => 'css',

                    'asset' => false,

                    'location' =>
                        '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],

            ],

        ],


        /*
        |--------------------------------------------------------------------------
        | Chart.js
        |--------------------------------------------------------------------------
        */

        'Chartjs' => [

            'active' => false,

            'files' => [

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],

            ],

        ],


        /*
        |--------------------------------------------------------------------------
        | SweetAlert2
        |--------------------------------------------------------------------------
        */

        'Sweetalert2' => [

            'active' => false,

            'files' => [

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],

            ],

        ],


        /*
        |--------------------------------------------------------------------------
        | Pace
        |--------------------------------------------------------------------------
        */

        'Pace' => [

            'active' => false,

            'files' => [

                [
                    'type' => 'css',

                    'asset' => false,

                    'location' =>
                        '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],

                [
                    'type' => 'js',

                    'asset' => false,

                    'location' =>
                        '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],

            ],

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    */

    'iframe' => [

        'default_tab' => [

            'url' => null,

            'title' => null,

        ],

        'buttons' => [

            'close' => true,

            'close_all' => true,

            'close_all_other' => true,

            'scroll_left' => true,

            'scroll_right' => true,

            'fullscreen' => true,

        ],

        'options' => [

            'loading_screen' => 1000,

            'auto_show_new_tab' => true,

            'use_navbar_items' => true,

        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'livewire' => false,

];