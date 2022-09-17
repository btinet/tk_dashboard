<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Menu;

use App\Type\NavigationType;
use Core\Component\MenuComponent\AbstractMenu;

class AdminMenu extends AbstractMenu
{

    public function createMenu( array $collection = []): AbstractMenu
    {

        $this
            ->add('dashboard',NavigationType::class,[
                'label' => 'dashboard',
                'route' => 'admin_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action'],
                ],
            ])
            ->add('user',NavigationType::class,[
                'label' => 'user',
                'route' => 'authentication_login',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action'],
                ],
            ])
        ;

        return $this;
    }

}
