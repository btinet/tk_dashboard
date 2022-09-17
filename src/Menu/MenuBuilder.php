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
            ],
            [
                '1999'
            ])
        ;

        return $this;
    }

}
