<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Student Book',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'Student Book',

    'logo_mini' => 'Student Book',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => NULL,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        // 'MAIN NAVIGATION',
        // [
        //     'text' => 'Blog',
        //     'url'  => 'admin/blog',
        //     'can'  => 'manage-blog',
        // ],
        // [
        //     'text'        => 'Pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        'ACCOUNT SETTINGS',
        [
            'text' => 'Profile',
            'url'  => 'user/show',
            'icon' => 'user',
            'icon_color' => 'green',
        ],


        'DISPLAY',
        [
            'text'       => 'All directors',
            'url'  => 'user/list/Director',
            'icon_color' => 'yellow',
            'can' => 'users-CRUD',
        ],
        [
            'text'       => 'All teachers',
            'url'  => 'user/list/Teacher',
            'icon_color' => 'yellow',
              'can' => 'users-CRUD',
        ],
        [
            'text'       => 'All students',
            'url'  => 'user/list/Student',
            'icon_color' => 'yellow',
            'can' => 'users-CRUD'

        ],

        [
            'text'       => 'All grades',
            'url'  => 'grades',
            'icon_color' => 'yellow',
            'can' => 'see-all-grades',
        ],
        [
            'text'       => 'All classes',
            'url'  => 'classrooms',
            'icon_color' => 'yellow',
            'can' => 'classes-CRUD',
        ],
        [
            'text'       => 'All subjects',
            'url'  => 'subjects',
            'icon_color' => 'yellow',
            'can' => 'subjects-CRUD',
        ],
        [
            'text'       => 'Your subjects',
            'url'  => 'subject/teacher/list',
            'icon_color' => 'yellow',
            'can' => 'see-subjects-for-teacher',
        ],
        [
            'text'       => 'Your grades',
            'url'  => 'grade/teacher/list',
            'icon_color' => 'yellow',
            'can' => 'see-grades-for-teacher',
        ],
        [
            'text'       => 'History of grades changes',
            'url'  => 'gradesHistory/teacher',
            'icon_color' => 'yellow',
            'can' => 'see-history-of-changes-for-teacher',
        ],
        [
            'text'       => 'Generate file with list of Your students with grades',
            'url'  => 'admin/settings',
            'icon_color' => 'yellow',
            'can' => 'generate-CSV-file-with-grade',

        ],
        [
            'text'       => 'Your grades',
            'url'  => 'grade/student/list',
            'icon_color' => 'yellow',
            'can' => 'see-grades-for-student',
        ],
        [
            'text'       => 'E-mail notifications',
            'url'  => 'admin/settings',
            'icon_color' => 'yellow',
            'can' => 'send-notification-email-to-student',

        ],



    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        // JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\MyClasses\MyMenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
    ],
];
