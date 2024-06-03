<?php

namespace Modules\User;

use Modules\BaseModuleProvider;
use Modules\User\Models\PlanPayment;

class ModuleProvider extends BaseModuleProvider
{

    public static function getAdminMenu()
    {

        $options = [
            "position"   => 10,
            'url'        => route('user.admin.index'),
            'title'      => __('Users :count', ['count' => $noti ? sprintf('<span class="badge badge-warning">%d</span>', $noti) : '']),
            'icon'       => 'icon ion-ios-contacts',
            'permission' => 'user_view',
            'group'      => 'system',
            'children'   => [
                'user' => [
                    'url'   => route('user.admin.index'),
                    'title' => __('All Users'),
                    'icon'  => 'fa fa-user',
                ],
                'role' => [
                    'url'        => route('user.admin.role.index'),
                    'title'      => __('Role Manager'),
                    'permission' => 'role_view',
                    'icon'       => 'fa fa-lock',
                ],
            ]
        ];

        $count = PlanPayment::query()->where('object_model', 'plan')->where('status', 'processing')->count();

        return [
            'users' => $options,
            'plan'  => [
                "position"   => 50,
                'url'        => route('user.admin.plan.index'),
                'title'      => __('User Plans :count', ['count' => $count ? sprintf('<span class="badge badge-warning">%d</span>', $count) : '']),
                'icon'       => 'fa fa-list-alt',
                'permission' => 'role_view',
                'group'      => 'system',
                'children'   => [
                    'user-plan'    => [
                        'url'        => route('user.admin.plan.index'),
                        'title'      => __('User Plans'),
                        'permission' => 'role_view',
                    ],
                    'plan-report'  => [
                        'url'        => route('user.admin.plan_report.index'),
                        'title'      => __('Plan Report'),
                        'permission' => 'role_view',
                    ],
                    'plan-request' => [
                        'url'        => route('user.admin.plan_request.index'),
                        'title'      => __('Plan Request :count', ['count' => $count ? sprintf('<span class="badge badge-warning">%d</span>', $count) : '']),
                        'permission' => 'role_view',
                    ],
                ]
            ]
        ];
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

    }


}
