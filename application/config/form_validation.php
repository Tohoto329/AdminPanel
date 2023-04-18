<?php

$config=[

    'login_rules'=>[
        [
            'field' => 'uname',
            'label' => 'UserName',
            'rules' => 'required|alpha_numeric_spaces'
        ],
        [
            'field' => 'pass',
            'label' => 'Password',
            'rules' => 'required|max_length[12]'
        ]
    ],
    'register_rules' =>[
        [
            'field' => 'username',
            'label' => 'UserName',
            'rules' => 'required|alpha_numeric_spaces'
        ],
        [
            'field' => 'firstname',
            'label' => 'FirstName',
            'rules' => 'required|alpha_numeric_spaces'
        ],
        [
            'field' => 'lastname',
            'label' => 'LastName',
            'rules' => 'required|alpha_numeric_spaces'
        ],
        [
            'field' => 'pno',
            'label' => 'Phone number',
            'rules' => 'required|regex_match[/^[6-9][0-9]{9}$/]'

        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[user.email]'
        ],
        [
            'field' => 'pass',
            'label' => 'Password',
            'rules' => 'max_length[12]'
        ],
        [
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required'
        ]
    ],

    'add_article_rules'=>[
        [
            'field' => 'article_title',
            'label' => 'Article Title',
            'rules' => 'required|alpha_numeric_spaces'
        ],
        [
            'field' => 'article_body',
            'label' => 'Article Body',
            'rules' => 'required'
        ]
    ],

    
]

?>