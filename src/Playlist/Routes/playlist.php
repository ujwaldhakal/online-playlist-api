<?php

$router->get('/', \App\Http\Controllers\Playlist\Fetch::class);
$router->post('/', \App\Http\Controllers\Playlist\CreatePlaylist::class);
$router->delete('/{id}', \App\Http\Controllers\Playlist\DeletePlaylist::class);
$router->post('/{id}/songs/', \App\Http\Controllers\Playlist\AddSong::class);
$router->delete('/songs/{songId}', \App\Http\Controllers\Playlist\RemoveSong::class);
