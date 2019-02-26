<?php


$router->get('login', \Authentication\Login::class);
$router->post('register', \Authentication\Register::class);
