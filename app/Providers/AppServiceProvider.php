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
                'can' => ['user-dashboard'],
            ]);

            $event->menu->add([
                'text' => __('EWP'),
                'icon' => 'fas fa-fw fa-cogs',
                'url' => '#',
                'can' => ['home'],
                'submenu' => [
                    [
                        'text' => __('Admin Dashboard'),
                        'icon' => 'fas fa-tachometer-alt',
                        'route' => 'ewp.dashboards.admin_dash',
                        'active' => [],
                        'can' => ['admin-dashboard'],
                    ],
                    [
                            'text' => __('Settings'),
                            'icon' => 'fas fa-wrench',
                            'url' => '#',
                            'can' => ['home'],
                            'submenu' => [
                                [
                                    'text' => __('Questions'),
                                    'icon' => 'fas fa-question-circle',
                                    'route' => 'ewp.setup.questions',
                                    'active' => [],
                                    'can' => ['ewp-question'],
                                ],
                                [
                                    'text' => __('Scales'),
                                    'icon' => 'fas fa-balance-scale',
                                    'route' => 'setup.scale',
                                    'active' => [],
                                    'can' => ['ewp-scale'],
                                ],
                                [
                                    'text' => __('Schedules'),
                                    'icon' => 'fas fa-calendar',
                                    'route' => 'ewp.setup.schedules',
                                    'active' => [],
                                    'can' => ['ewp-schedule'],
                                ]
                            ]
                    ],
                    // [
                    //     'text' => __('Questions'),
                    //     'icon' => 'fas fa-question-circle',
                    //     'route' => 'ewp.setup.questions',
                    //     'active' => [],
                    //     'can' => ['ewp-question'],
                    // ],
                    // [
                    //     'text' => __('Scales'),
                    //     'icon' => 'fas fa-balance-scale',
                    //     'route' => 'setup.scale',
                    //     'active' => [],
                    //     'can' => ['ewp-scale'],
                    // ],
                    // [
                    //     'text' => __('Schedules'),
                    //     'icon' => 'fas fa-calendar',
                    //     'route' => 'ewp.setup.schedules',
                    //     'active' => [],
                    //     'can' => ['ewp-schedule'],
                    // ],
                    [
                        'text' => __('Screening Record'),
                        'icon' => 'fas fa-file-archive',
                        'route' => 'ewp.assign.index',
                        'active' => [],
                        'can' => ['ewp-screening'],
                    ],
                    [
                        'text' => __('Specific Record'),
                        'icon' => 'fas fa-file-alt',
                        'route' => 'ewp.assign.specificrecordindex',
                        'active' => [],
                        'can' => ['ewp-specific'],
                    ]
                ]
            ]);            
        });
    }
}