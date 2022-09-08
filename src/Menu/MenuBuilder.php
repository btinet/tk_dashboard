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
                'label' => 'Home',
                'route' => 'app_index_id',
                'attrib' => [
                    'class' => ['nav-link'],
                ],
            ],
            [
                '1999'
            ])
            ->add('lucky',NavigationType::class,[
                'label' => 'Lucky Number',
                'route' => 'app_index',
                'attrib' => [
                    'class' => ['nav-link'],
                ],
            ])
        ;

        return $this;
    }

}
