<?php

namespace App\Menu;

use App\Type\NavigationType;
use Core\Component\MenuComponent\AbstractMenu;

class ProfileMenu extends AbstractMenu
{

    public function __construct($user = false)
    {
        parent::__construct($user);
    }

    public function createMenu( array $collection = []): AbstractMenu
    {
        if($this->HideUnlessHasPermission('show_profile'))
        {
            $this->add('data_import',NavigationType::class,[
                'label' => 'overview',
                'route' => 'user_profile_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ;
        }

        $this->add('dashboard',NavigationType::class,[
            'label' => 'user_settings',
            'route' => 'admin_index',
            'attrib' => [
                'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
            ],
        ]);

        $this->add('dashboard',NavigationType::class,[
            'label' => 'exams',
            'route' => 'admin_index',
            'attrib' => [
                'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
            ],
        ]);

        return $this;
    }

}
