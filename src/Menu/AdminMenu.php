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
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ->add('exams',NavigationType::class,[
                'label' => 'exams',
                'route' => 'admin_exam_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            )
            ->add('roles',NavigationType::class,[
                'label' => 'roles',
                'route' => 'admin_role_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ->add('group',NavigationType::class,[
                'label' => 'groups',
                'route' => 'admin_group_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ->add('permission',NavigationType::class,[
                'label' => 'permissions',
                'route' => 'admin_permission_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
        ;

        return $this;
    }

}
