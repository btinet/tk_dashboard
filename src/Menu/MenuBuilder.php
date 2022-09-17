<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Menu;

use App\Type\NavigationType;
use Core\Component\MenuComponent\AbstractMenu;

class MenuBuilder extends AbstractMenu
{

    public function createMenu( array $collection = []): MenuBuilder
    {

        $this
            ->add('home',NavigationType::class,[
                'label' => 'Übersicht',
                'route' => 'app_index',
                'attrib' => [
                    'class' => ['nav-link'],
                ],
            ])
            ->add('dashboard',NavigationType::class,[
                'label' => 'dashboard',
                'route' => 'admin_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action'],
                ],
            ])
        ;

        return $this;
    }

}
