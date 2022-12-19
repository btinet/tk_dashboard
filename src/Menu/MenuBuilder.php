<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Menu;

use App\Type\NavigationType;
use Core\Component\MenuComponent\AbstractMenu;

class MenuBuilder extends AbstractMenu
{

    public function __construct($user = false)
    {
        parent::__construct($user);
    }

    public function createMenu( array $collection = []): MenuBuilder
    {

        $this
            ->add('home',NavigationType::class,[
                'label' => 'overview',
                'route' => 'exam_index',
                'attrib' => [
                    'class' => ['nav-link'],
                ],
            ]);

        if($this->HideUnlessHasPermission('show_profile'))
        {
            $this->add('profile',NavigationType::class,[
                'label' => 'profile',
                'route' => 'user_profile_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ]);
        }

        if($this->HideUnlessHasPermission('show_dashboard'))
        {
            $this->add('dashboard',NavigationType::class,[
                'label' => 'dashboard',
                'route' => 'admin_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action'],
                ],
            ]);
        }

        if($this->HideUnlessHasPermission('show_school_subject'))
        {
            $this->add('subjects',NavigationType::class,[
                'label' => 'subjects',
                'route' => 'admin_school_subject_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            );
        }

        if($this->HideUnlessHasPermission('show_school_subject_type'))
        {
            $this->add('SchoolSubjectTypes',NavigationType::class,[
                'label' => 'SchoolSubjectTypes',
                'route' => 'admin_school_subject_type_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            );
        }

        if($this->HideUnlessHasPermission('show_topic'))
        {
            $this->add('topics',NavigationType::class,[
                'label' => 'topics',
                'route' => 'admin_topic_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            );
        }

        if($this->HideUnlessHasPermission('show_exam'))
        {
            $this->add('exams',NavigationType::class,[
                'label' => 'exams',
                'route' => 'admin_exam_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            );
        }

        if($this->HideUnlessHasPermission('show_exam_status'))
        {
            $this->add('exam_status',NavigationType::class,[
                'label' => 'exam_status',
                'route' => 'admin_exam_status_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ],[0]
            );
        }

        if($this->HideUnlessHasPermission('show_user'))
        {
            $this->add('users',NavigationType::class,[
                'label' => 'users',
                'route' => 'admin_user_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ]);
        }

        if($this->HideUnlessHasPermission('show_role'))
        {
            $this->add('roles',NavigationType::class,[
                'label' => 'roles',
                'route' => 'admin_role_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ]);
        }

        if($this->HideUnlessHasPermission('show_group'))
        {
            $this->add('group',NavigationType::class,[
                'label' => 'groups',
                'route' => 'admin_group_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ]);
        }

        if($this->HideUnlessHasPermission('show_permission'))
        {
            $this->add('permission',NavigationType::class,[
                'label' => 'permissions',
                'route' => 'admin_permission_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ;
        }

        if($this->HideUnlessHasPermission('upload_data'))
        {
            $this->add('data_import',NavigationType::class,[
                'label' => 'data_import',
                'route' => 'admin_data_upload_index',
                'attrib' => [
                    'class' => ['list-group-item list-group-item-action py-3 lh-sm'],
                ],
            ])
            ;
        }

        return $this;
    }

}
