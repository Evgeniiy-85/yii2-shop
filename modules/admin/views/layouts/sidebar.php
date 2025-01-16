<?php $user = Yii::$app->user->identity;?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$user->user_photo ? "/load/avatars/{$user->user_photo}" : '/images/avatars/no-avatar.png'?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?="{$user->user_name} {$user->user_surname}";?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?=\hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Заказы', 'iconStyle' => 'far', 'url' => ['/admin/orders'], 'active' => $this->context->route == 'admin/orders/index'],
                    [
                        'label' => 'Продукты',
                        'icon' => 'tachometer-alt',
                        'url' => '#',
                        'active' => strpos($this->context->route, 'admin/products') === 0,
                        'items' => [
                            ['label' => 'Список продуктов', 'iconStyle' => 'far', 'url' => ['/admin/products'], 'active' => $this->context->route == 'admin/products/index',],
                            ['label' => 'Акции', 'iconStyle' => 'far', 'url' => ['/admin/products/actions'], 'active' => $this->context->route == '/admin/products/actions',],
                        ],
                    ],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'tachometer-alt',
                        'url' => '#',
                        'active' => strpos($this->context->route, 'admin/users') === 0,
                        'items' => [
                            ['label' => 'Список пользователей', 'iconStyle' => 'far', 'url' => ['/admin/users'], 'active' => $this->context->route == 'admin/users/index',],
                            ['label' => 'Группы', 'iconStyle' => 'far', 'url' => ['/admin/users/groups'], 'active' => $this->context->route == 'admin/users/groups',],
                            ['label' => 'Подписки', 'iconStyle' => 'far', 'url' => ['/admin/users/members'], 'active' => $this->context->route == 'admin/users/members',],
                            [
                                'label' => 'Действия',
                                'icon' => 'share',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Импорт', 'iconStyle' => 'far', 'url' => '/admin/users/import', 'active' => $this->context->route == '/admin/users/import',],
                                    ['label' => 'Экспорт', 'iconStyle' => 'far', 'url' => '/admin/users/export', 'active' => $this->context->route == '/admin/users/export',],
                                ],
                            ],
                        ],
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'tachometer-alt',
                        'url' => '#',
                        'active' => strpos($this->context->route, 'admin/settings') === 0,
                        'items' => [
                            ['label' => 'Основные', 'iconStyle' => 'far', 'url' => ['/admin/settings/main'], 'active' => $this->context->route == 'admin/settings/main',],
                            ['label' => 'Внешний вид', 'iconStyle' => 'far', 'url' => ['/admin/users/appearance'], 'active' => $this->context->route == 'admin/settings/appearance',],
                        ],
                    ],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'active' => $this->context->route == '/gii'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'active' => $this->context->route == '/debug'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>