<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'history'            => 'History',
            'status_helper'      => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'attachment'         => 'Attachment',
            'attachment_helper'  => ' ',
            'due_date'           => 'Due date',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],

    'project' => [
        'title'          => 'Projects',
        'title_singular' => 'Project',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'       => 'Project Name',
            'name_helper'        => ' ',
            'description'        => 'Project Description',
            'description_helper' => ' ',
            'estamtion_cost'     => 'Project Estamtion Cost',
            'estamtion_cost_helper'  => ' ',
            'actual_cost'        => 'Project Actual Cost',
            'actual_cost_helper' => ' ',
            'project_owner'           => 'Project Owner',
            'vote_number'        => 'Project Vote Number',
            'vote_number_helper' => ' ',
            'status'             => 'Project Status',
            'status_helper'      => ' ',
            'engineer_owner'           => 'Project Engineer',
            'enginner_helper'    => ' ',
            'owner'              => 'Project Owner',
            'owner_helper'       => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'tags'                => 'Project Tags',
            'tags_helper'         => ' ',
            'PDF_attachement'         => ' PDF Attachment',
            'PDF_attachement_helper'  => ' ',
            'Excel_attachement'         => ' Excel Attachment',
            'Excel_attachement_helper'  => ' ',
            'due_date'           => 'Project Due date',
            'due_date_helper'    => ' ',
            'created_at'         => 'Project Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Project Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Project Deleted At',
            'deleted_at_helper'  => ' ',
        ],
        'activeProject' => 'Active Projects',
        'completedProject' => 'Completed Projects',
        'allProject' => 'All Projects',

    ],

    'projectOwner' => [
        'title'          => 'Project Owners',
        'title_singular' => 'Project Owner',
        'title_list' => 'Project Owners List',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'       => 'Project Owner Name',
            'name_helper'        => ' ',
            'description'        => 'Project Owner Description',
            'description_helper' => ' ',
            'created_at'         => 'Project Owner Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Project Owner Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Project Owner Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
