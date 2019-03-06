<?php

$router->post('/', \App\Http\Controllers\Room\Create::class);
$router->delete('/{id}/', \App\Http\Controllers\Room\Delete::class);
