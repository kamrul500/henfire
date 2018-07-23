<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                 <img src="<?= Yii::$app->user->identity->profile_picture;?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
                'items' => [
          ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/']],


          ['label' => 'Accounts', 'options' => ['class' => 'header']],
          [
                        'label' => 'User management',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
                          ['label' => 'All Users', 'icon' => 'user', 'url' => ['/user/admin']],
                          ['label' => 'Members', 'icon' => 'user', 'url' => ['/members']],
                          ['label' => 'Freelancers', 'icon' => 'user', 'url' => ['/freelancers']],
                          ['label' => 'Create new user', 'icon' => 'address-card', 'url' => ['/user/admin/create']],

                        ],
                    ],


					['label' => 'Management', 'options' => ['class' => 'header']],
					[
                        'label' => 'Hourlies',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'list', 'url' => ['/hourlies'],],
                            ['label' => 'Reviews', 'icon' => 'comments-o', 'url' => ['/hourliesreviews'],],
							['label' => 'Sales', 'icon' => 'money', 'url' => ['/hourliessales'],],
							['label' => 'WorkStream', 'icon' => 'briefcase', 'url' => ['/hourlieworkstream'],],

                        ],
                    ],
					[
                        'label' => 'Jobs',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List', 'icon' => 'list', 'url' => ['/job'],],
                            ['label' => 'WorkStream', 'icon' => 'briefcase', 'url' => ['/jobworkstream'],],
                            ['label' => 'Proposals', 'icon' => 'handshake-o', 'url' => ['/job-proposals'],],
							//['label' => 'Proposals', 'icon' => 'dashboard', 'url' => ['/job-proposals'],],
							//['label' => 'Job Question', 'icon' => 'dashboard', 'url' => ['/job-questions'],],

                        ],
                    ],

            ['label' => 'Finances', 'options' => ['class' => 'header']],
            //['label' => 'Payments', 'icon' => 'money', 'url' => ['/payments']],
            ['label' => 'Pay Freelancers', 'icon' => 'paper-plane', 'url' => ['/payment-requests']],
            //['label' => 'Revenue', 'icon' => 'line-chart', 'url' => ['/payments/revenue']],
            //['label' => 'Processor', 'icon' => 'cogs', 'url' => ['/payments/processor']],

            ['label' => 'Site Settings', 'options' => ['class' => 'header']],
  					['label' => 'Settings', 'icon' => 'cog', 'url' => ['/settings']],
  					['label' => 'Categories', 'icon' => 'bookmark-o', 'url' => ['/job-category']],
            ['label' => 'Analytics', 'icon' => 'bar-chart', 'url' => ['/settings/analytics']],

            //['label' => 'Front End Settings', 'options' => ['class' => 'header']],
            //['label' => 'Home Page', 'icon' => 'file', 'url' => ['/settings/homepage']],
            //['label' => 'About Page', 'icon' => 'file', 'url' => ['/settings/aboutpage']],
            //['label' => 'Custom Page', 'icon' => 'file', 'url' => ['/settings/customepage']],
  					//['label' => 'Footer', 'icon' => 'window-minimize', 'url' => ['/settings/footer']],
                ],
            ]
        ) ?>

    </section>

</aside>
