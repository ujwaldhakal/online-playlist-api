<?php

$router->get('/', \App\Http\Controllers\Room\Fetch::class);
$router->post('/', \App\Http\Controllers\Room\Create::class);
$router->delete('/{id}', \App\Http\Controllers\Room\Delete::class);
$router->post('/{id}', \App\Http\Controllers\Room\Update::class);
