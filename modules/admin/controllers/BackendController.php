<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use app\assets\AdminAsset;

/**
 * Default controller for the `admin` module
 */
class BackendController extends Controller
{

    public $actionNavigation;

    public function init()
    {
        parent::init();

        $this->actionNavigation = [
            'main' => [
                'title' => 'Панель управления',
                'link' => '/admin/',
                'status' => 1,
            ],
            'pages' => [
                'title' => 'Управление страницами',
                'link' => '/admin/pages/index',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/admin/pages/create',
                        'title' => 'Добавить страница',
                    ],
                ],

            ],
            'category' => [
                'title' => 'Управление категориями',
                'link' => '/admin/catalog/',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/admin/catalog/create',
                        'title' => 'Добавить категория',
                    ],
                ],
            ],
            'goods' => [
                'title' => 'Управление товаров',
                'link' => '/admin/goods/',
                'status' => 1,
                'items' => [
                    [
                        'link' => '/admin/goods/create',
                        'title' => 'Добавить товар',
                    ],
                ],
            ],
            'user' => [
                'title' => 'Пользователь',
                'link' => '/rbac/user',
                'status' => 1,
            ],

        ];

    }
}
