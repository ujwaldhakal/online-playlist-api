<?php

$router->post('login', \Authentication\Login::class);
$router->post('register', \Authentication\Register::class);
