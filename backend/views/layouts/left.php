<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/logo.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Ковкаснаб', 'options' => ['class' => 'header']],
                    ['label' => 'Статьи', 'icon' => 'fa-fw fa-align-justify', 'url' => ['/post']],
                    ['label' => 'Категории товаров', 'icon' => 'fa-fw fa-cubes', 'url' => ['/product-category']],
                    ['label' => 'Товары', 'icon' => 'fa-fw fa-cube', 'url' => ['/product']],
                    ['label' => 'Характеристики', 'icon' => 'fa-fw fa-info', 'url' => ['/feature']],
                    ['label' => 'Пользователи', 'icon' => 'fa-fw fa-user', 'url' => ['/user']],
                ],
            ]
        ) ?>

    </section>

</aside>