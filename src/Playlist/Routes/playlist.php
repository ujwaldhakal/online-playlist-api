<?php

$router->post('login', \App\Http\Controllers\Authentication\Login::class);
$router->post('register', \App\Http\Controllers\Authentication\Register::class);
