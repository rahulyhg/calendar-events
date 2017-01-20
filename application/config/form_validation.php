<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config = array(
    'users/login' => array(
        array(
            'field' => 'loginby',
            'label' => 'Loginby',
            'rules' => 'trim|required|alpha_dash|min_length[6]|max_length[128]',
            'errors' => array(
                'required' => 'Wrong Username or Password',
                'alpha_dash' => 'Wrong Username or Password',
                'min_length' => 'Wrong Username or Password',
                'max_length' => 'Wrong Username or Password'
            )
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Wrong Username or Password'
            )
        )
    ),
    'users/signup' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|alpha_dash|min_length[6]|max_length[128]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[6]|max_length[128]'
        ),
        array(
            'field' => 'passwordconf',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]',
            'errors' => array(
                'matches' => 'The passwords do not match.'
            )
        )
    )
);