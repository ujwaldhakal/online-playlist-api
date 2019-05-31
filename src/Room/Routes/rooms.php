<?php

$router->get('/', \App\Http\Controllers\Room\Fetch::class);
$router->post('/', \App\Http\Controllers\Room\Create::class);
$router->delete('/{id}', \App\Http\Controllers\Room\Delete::class);
$router->post('/{id}', \App\Http\Controllers\Room\Update::class);
$router->get('/{roomId}/playlists/{playlistId}/play', \App\Http\Controllers\Room\PlayPlaylist::class);
$router->get('/{roomId}/current-playlist', \App\Http\Controllers\Room\CurrentPlaying::class);
$router->post('/{roomId}/default/playlist/addsong', \App\Http\Controllers\Room\AddSongToCurrentlyPlayingPlaylist::class);


