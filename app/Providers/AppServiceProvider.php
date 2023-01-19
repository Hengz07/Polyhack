<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events, UrlGenerator $url)
    {
        //\App\Observers\Kernel::make()->observes();

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Modules\Site\Console\GeneratePtjCommand::class,
            ]);
        }

        if (config('app.https')) {
            $url->forceScheme('https');
        }

        Paginator::useBootstrap();
        
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            // MAIN MENU
            $event->menu->add([
                'text' => __('User Dashboard'),
                'icon' => 'fas fa-fw fa-home',
                'route' => 'ewp.dashboards.index',
            ]);

            $event->menu->add([
                'text' => __('EWP'),
                'icon' => 'fas fa-fw fa-cogs',
                'url' => '#',
                'submenu' => [
                    [
                        'text' => __('Admin Dashboard'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'ewp.dashboards.admin_dash',
                        'active' => [],
                    ],
                    [
                        'text' => __('Questions'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'ewp.setup.questions',
                        'active' => [],
                    ],
                    [
                        'text' => __('Scales'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'setup.scale',
                        'active' => [],
                    ],
                    [
                        'text' => __('Schedules'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'ewp.setup.schedules',
                        'active' => [],
                    ],
                    [
                        'text' => __('Assign Record'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'ewp.assign.index',
                        'active' => [],
                    ]
                ]
            ]);

            $event->menu->add([
                'text' => __('System Configuration'),
                'icon' => 'fas fa-fw fa-cogs',
                'url' => '#',
                'submenu' => [
                    [
                        'text' => __('Module'),
                        'icon' => 'fas fa-fw fa-file',
                        'route' => 'site.modules.index',
                        'active' => ['site/modules', 'site/modules*'],
                    ],
                    [
                        'text' => __('Organizations'),
                        'route' => 'site.org-structure.index',
                        'icon' => 'fa-fw fas fa-route',
                        'active' => ['site.org-structure', 'site.org-structure*'],
                    ],
                    [
                        'text' => __('Access Controls'),
                        'route' => 'site.permissions.index',
                        'icon' => 'fas fa-fw fa-route',
                    ],
                    [
                        'text' => __('Roles'),
                        'route' => 'site.roles.index',
                        'icon' => 'fa-fw fas fa-project-diagram',
                    ],
                    [
                        'text' => __('Users'),
                        'route' => 'site.users.index',
                        'icon' => 'fa-fw fas fa-users',
                        'active' => ['site.users', 'site.users*'],
                    ],
                    // [
                    //     'text' => __('System Config'),
                    //     'route' => 'site.system-configs.index',
                    //     'icon' => 'fa-fw fas fa-cogs',
                    // ],
                    [
                        'text' => __('Logs'),
                        'route' => 'logs',
                        'icon' => 'fa-fw fas fa-clipboard-list',
                        'can' => 'log-view',
                    ]
                ]
            ]);

            

            $event->menu->add([
                'text' => __('Help'),
                'icon' => 'fas fa-fw fa-question', 
                'url' => '#', 
                
                'topnav_right' => true,
                'submenu' => [
                    [
                        'text' => __('What\'s new'), 
                        'url' => '#',
                        // 'icon' => 'fas fa-fw fa-newpaper', 
                    ],
                    [
                        'text' => __('Helpdesk'), 
                        'url' => '#',
                        // 'icon' => 'fas fa-fw fa-question',
                    ],
                    [
                        'text' => __('Contact Us'), 
                        'url' => '#',
                        // 'icon' => 'fas fa-fw fa-th-list',
                    ],
                    [
                        'text' => __('Feedback'), 
                        'url' => '#',
                        // 'icon' => 'fas fa-fw fa-comments',
                    ],
                ],
            ]);
        });
    }
}
