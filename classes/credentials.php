<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.12
 * Time: 22:28
 */
class credentials
{
    protected $username;
    protected $password;

    function __construct()
    {
        $this->username = "";      // Your database Username
        $this->password = "";      // Your database Password
    }
}