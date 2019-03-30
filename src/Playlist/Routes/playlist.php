<?php

$router->post('/', \App\Http\Controllers\Playlist\CreatePlaylist::class);
$router->delete('/{id}', \App\Http\Controllers\Playlist\DeletePlaylist::class);
$router->post('/{id}/songs/', \App\Http\Controllers\Playlist\AddSong::class);
$router->delete('/{playlistId}/song/{songId}', \App\Http\Controllers\Playlist\RemoveSong::class);
