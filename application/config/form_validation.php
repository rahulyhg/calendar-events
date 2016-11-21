<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array (
    'login/index' => array (
        array (
                'field' => 'loginby',
                'label' => 'Loginby',
                'rules' => 'trim|required|alpha_dash|min_length[6]|max_length[128]|xss_clean',
                'errors' => array (
                    'required' => 'Wrong Username or Password',
                    'alpha_dash' => 'Wrong Username or Password',
                    'xss_clean' => 'Wrong Username or Password',
                    'min_length' => 'Wrong Username or Password',
                    'max_length' => 'Wrong Username or Password'
                )
        ),
        array (
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'trim|required',
                'errors' => array ('required' => 'Wrong Username or Password')
        )
    ),
    'signup/index' => array (
        array (
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|alpha_dash|min_length[6]|max_length[128]|xss_clean'
        ),
        array (
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[128]',
        ),
        array (
                'field' => 'passwordconf',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => array (
                        'matches' => 'The passwords do not match.'
                )
        )
    )
);