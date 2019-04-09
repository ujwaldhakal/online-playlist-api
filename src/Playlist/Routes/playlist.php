<?php

$router->get('/', \App\Http\Controllers\Playlist\FetchPlaylist::class);
$router->get('/songs', \App\Http\Controllers\Playlist\FetchSong::class);
$router->post('/', \App\Http\Controllers\Playlist\CreatePlaylist::class);
$router->delete('/{id}', \App\Http\Controllers\Playlist\DeletePlaylist::class);
$router->post('/{id}/songs/', \App\Http\Controllers\Playlist\AddSong::class);
$router->get('songs/{songId}/playing', \App\Http\Controllers\Playlist\PlaySong::class);
$router->delete('/songs/{songId}', \App\Http\Controllers\Playlist\RemoveSong::class);
