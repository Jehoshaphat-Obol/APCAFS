<?php
/** User: ProgDesn */
use yii\bootstrap5\Nav;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use app\models\StaffProfile;

$navItems = []; // Initialize as an empty array to avoid undefined errors

if (!Yii::$app->user->isGuest) {

    // Super Admin Role
    if (Yii::$app->user->can('super-admin')) {
        $navItems = [
            [
                'label' => '<i class="bi bi-speedometer2 sidebar-icons fs-5"></i> Dashboard',
                'encode' => false,
                'url' => ['/dashboard/dashboard']
            ], 
            [
                'label' => '<i class="bi bi-buildings sidebar-icons fs-5"></i> Companies',
                'encode' => false,
                'url' => ['/company/index'],
            ],
            [
                'label' => '<i class="bi bi-people sidebar-icons fs-5"></i> Users',
                'encode' => false,
                'url' => ['/user/index'],
            ],
            [
                'label' => '<i class="bi bi-trash sidebar-icons fs-5"></i> Bin',
                'encode' => false,
                'items' => [
                    ['label' => '<i class="bi bi-people sidebar-icons-inside fs-5"></i> Users', 'encode' => false, 'url' => ['/user/deleted-users']],
                    ['label' => '<i class="bi bi-buildings sidebar-icons-inside fs-5"></i> Companies', 'encode' => false, 'url' => ['/company/deleted-companies']],
                ],
            ],
            [
                'label' => '<i class="bi bi-key sidebar-icons fs-5"></i> Change Password',
                'encode' => false,
                'url' => ['/user/change-password'],
            ],
            [
                'label' => '<i class="bi bi-gear sidebar-icons fs-5"></i> Settings',
                'encode' => false,
                'url' => ['/settings/settings'],
            ],
        ];
    }
    
    // if(StaffProfile::findOne(['staff_user_id' => Yii::$app->user->id]))
    // {
        // Company Admin Role
        if (Yii::$app->user->can('company-admin')) {
            $navItems = [
                [
                    'label' => '<i class="bi bi-speedometer2 sidebar-icons fs-5"></i> Dashboard',
                    'encode' => false,
                    'url' => ['/dashboard/dashboard']
                ], 
                [
                    'label' => '<i class="bi bi-people sidebar-icons fs-5"></i> Users',
                    'encode' => false,
                    'url' => ['/user/index'],
                ],
                [
                    'label' => '<i class="bi bi-briefcase sidebar-icons fs-5"></i> Job Posts',
                    'encode' => false,
                    'url' => ['/job-post/index'],
                ],
                [
                    'label' => '<i class="bi bi-clipboard-check sidebar-icons fs-5"></i> Tests',
                    'encode' => false,
                    'url' => ['/job-test/index'],
                ],
                [
                    'label' => '<i class="bi bi-trash sidebar-icons fs-5"></i> Bin',
                    'encode' => false,
                    'items' => [
                        ['label' => '<i class="bi bi-people sidebar-icons-inside fs-5"></i> Users', 'encode' => false, 'url' => ['/user/deleted-users']],
                    ],
                ],
                [
                    'label' => '<i class="bi bi-key sidebar-icons fs-5"></i> Change Password',
                    'encode' => false,
                    'url' => ['/user/change-password'],
                ],
                [
                    'label' => '<i class="bi bi-gear sidebar-icons fs-5"></i> Settings',
                    'encode' => false,
                    'url' => ['/settings/settings'],
                ],
            ];
        }

        // Manager Role
        if (Yii::$app->user->can('hr')) {
            $navItems = [
                [
                    'label' => '<i class="bi bi-speedometer2 sidebar-icons fs-5"></i> Dashboard',
                    'encode' => false,
                    'url' => ['/dashboard/dashboard']
                ],
                [
                    'label' => '<i class="bi bi-people sidebar-icons fs-5"></i> Users',
                    'encode' => false,
                    'url' => ['/users/index'],
                ],
                [
                    'label' => '<i class="bi bi-briefcase sidebar-icons fs-5"></i> Job Posts',
                    'encode' => false,
                    'url' => ['/job-post/index'],
                ],
                [
                    'label' => '<i class="bi bi-clipboard-check sidebar-icons fs-5"></i> Tests',
                    'encode' => false,
                    'url' => ['/job-test/index'],
                ],
                [
                    'label' => '<i class="bi bi-trash sidebar-icons fs-5"></i> Bin',
                    'encode' => false,
                    'items' => [
                        ['label' => '<i class="bi bi-people sidebar-icons-inside fs-5"></i> Users', 'encode' => false, 'url' => ['/users/deleted-users']],
                        ['label' => '<i class="bi bi-people sidebar-icons-inside fs-5"></i> Categories', 'encode' => false, 'url' => ['/categories/deleted-categories']],
                        ['label' => '<i class="bi bi-tags sidebar-icons-inside fs-5"></i> Brands', 'encode' => false, 'url' => ['/brands/deleted-brands']],
                        ['label' => '<i class="bi bi-cart sidebar-icons-inside fs-5"></i> Packages', 'encode' => false, 'url' => ['/packages/deleted-packages']],
                        ['label' => '<i class="bi bi-people sidebar-icons-inside fs-5"></i> Suppliers', 'encode' => false, 'url' => ['/suppliers/deleted-suppliers']],
                        ['label' => '<i class="bi bi-tags sidebar-icons-inside fs-5"></i> Measurements', 'encode' => false, 'url' => ['/unit-of-measurements/deleted-measurements']],
                        ['label' => '<i class="bi bi-tags sidebar-icons-inside fs-5"></i> Taxes', 'encode' => false, 'url' => ['/taxes/deleted-taxes']],
                        ['label' => '<i class="bi bi-tags sidebar-icons-inside fs-5"></i> Inventory Types', 'encode' => false, 'url' => ['/inventory-types/deleted-inventory-types']],
                    ],
                ],
                [
                    'label' => '<i class="bi bi-key sidebar-icons fs-5"></i> Change Password',
                    'encode' => false,
                    'url' => ['/user/change-password'],
                ],
                [
                    'label' => '<i class="bi bi-gear sidebar-icons fs-5"></i> Settings',
                    'encode' => false,
                    'url' => ['/settings/settings'],
                ],
            ];
        }
    // } 
        // Seller Role
        if (Yii::$app->user->can('applicant')) {
            $navItems = [
                [
                    'label' => '<i class="bi bi-speedometer2 sidebar-icons fs-5"></i> Dashboard',
                    'encode' => false,
                    'url' => ['/dashboard/dashboard']
                ],
                [
                    'label' => '<i class="bi bi-briefcase sidebar-icons fs-5"></i> Job Posts',
                    'encode' => false,
                    'url' => ['/job-post/index'],
                ],
                [
                    'label' => '<i class="bi bi-person sidebar-icons fs-5"></i> My Profile',
                    'encode' => false,
                    'url' => '#',
                    'items' => [
                        [
                            'label' => 'View Profile',
                            'url' => ['/profile/view', 'id' => Yii::$app->user->identity->profiles2->id ?? null],
                        ],
                        [
                            'label' => 'Edit Profile',
                            'url' => ['/profile/update', 'id' => Yii::$app->user->identity->profiles2->id ?? null],
                        ],
                        [
                            'label' => 'Complete Profile',
                            'visible' => Yii::$app->user->identity->getProfiles2()->one() === null,
                            'url' => ['/profile/create'],
                        ],
                    ],
                ],                                                                       
                [
                    'label' => '<i class="bi bi-key sidebar-icons fs-5"></i> Change Password',
                    'encode' => false,
                    'url' => ['/user/change-password'],
                ],
                [
                    'label' => '<i class="bi bi-gear sidebar-icons fs-5"></i> Settings',
                    'encode' => false,
                    'url' => ['/settings/settings'],
                ],
            ];
        }
    
} else {
    // Guest User (Login/Logout)
    $navItems[] = [
        'label' => 'Login',
        'url' => ['/site/login']
    ];
}

?>

<aside class="shadow">
    <?= 
        Nav::widget([
            'options' => ['class' => 'd-flex flex-column bg-light nav-pills'],
            'items' => $navItems
        ]);
    ?>
</aside>