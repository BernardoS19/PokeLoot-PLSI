<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Backoffice PokéLoot</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block" id="current-username"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            switch (\common\models\User::findOne(Yii::$app->user->identity->getId())->getUserRole()){
                case 'admin':
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Dashboard', 'url' => ['site/index'], 'icon' => 'tachometer-alt'],
                            ['label' => 'ADMINISTRAÇÃO', 'header' => true],
                            ['label' => 'Utilizadores', 'url' => ['user/index'], 'icon' => 'user'],
                            ['label' => 'Eventos', 'url' => ['evento/index'], 'icon' => 'calendar'],
                            ['label' => 'AVALIAÇÕES', 'header' => true],
                            ['label' => 'Pedidos de Avaliação', 'url' => ['pedido_avaliacao/index_admin'], 'icon' => 'table'],
                            ['label' => 'CATÁLOGO', 'header' => true],
                            ['label' => 'Tipos de Cartas', 'url' => ['tipo/index'], 'icon' => 'table'],
                            ['label' => 'Elementos de Cartas', 'url' => ['elemento/index'], 'icon' => 'table'],
                            ['label' => 'Coleções', 'url' => ['colecao/index'], 'icon' => 'table'],
                            ['label' => 'Gestão de Cartas', 'url' => ['carta/index'], 'icon' => 'table'],
//                    [
//                        'label' => 'Starter Pages',
//                        'icon' => 'tachometer-alt',
//                        'badge' => '<span class="right badge badge-info">2</span>',
//                        'items' => [
//                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
//                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
//                        ]
//                    ],
//                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                            ['label' => 'Yii2 PROVIDED', 'header' => true],
//                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
//                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
//                    ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
//                    ['label' => 'Level1'],
//                    [
//                        'label' => 'Level1',
//                        'items' => [
//                            ['label' => 'Level2', 'iconStyle' => 'far'],
//                            [
//                                'label' => 'Level2',
//                                'iconStyle' => 'far',
//                                'items' => [
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
//                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
//                                ]
//                            ],
//                            ['label' => 'Level2', 'iconStyle' => 'far']
//                        ]
//                    ],
//                    ['label' => 'Level1'],
//                    ['label' => 'LABELS', 'header' => true],
//                    ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
//                    ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
//                    ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                        ],
                    ]);
                    break;

                case 'avaliador':
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Dashboard', 'url' => ['site/index'], 'icon' => 'tachometer-alt'],
                            ['label' => 'AVALIAÇÕES', 'header' => true],
                            ['label' => 'Pedidos de Avaliação', 'url' => ['pedido_avaliacao/index_avaliador'], 'icon' => 'table'],


//                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                            ['label' => 'Yii2 PROVIDED', 'header' => true],
//                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],

                        ],
                    ]);
                    break;

                default: echo '';
                break;
            }

            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>