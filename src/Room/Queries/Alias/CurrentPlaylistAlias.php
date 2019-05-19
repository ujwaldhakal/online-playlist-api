<?php

namespace OP\Room\Queries\Alias;

use OP\Services\Read\Queries\Alias\AbstractAlias;

class CurrentPlaylistAlias extends AbstractAlias
{
    protected $alias = [
        'id' => PLAYLIST_SONGS_TABLE . '.id',
        'link' => PLAYLIST_SONGS_TABLE . '.link',
        'created_at' => PLAYLIST_SONGS_TABLE . '.created_at',
        'updated_at' => PLAYLIST_SONGS_TABLE . '.updated_at',
        'creator_id' => PLAYLIST_SONGS_TABLE . '.created_by',
        'playlist_id' => PLAYLIST_SONGS_TABLE . '.playlist_id',
        'is_youtube_list' => PLAYLIST_SONGS_TABLE . '.is_youtube_list',
        'is_playing' => PLAYLIST_SONGS_TABLE . '.is_playing',
        'created_by' => 'CONCAT(' . USERS_TABLE . ".first_name,' '," . USERS_TABLE . '.last_name)'
    ];
}
