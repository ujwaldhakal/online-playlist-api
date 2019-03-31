<?php

namespace OP\Playlist\Queries\Alias;

use OP\Services\Read\Queries\Alias\AbstractAlias;

class FetchPlaylistAlias extends AbstractAlias
{
    protected $alias = [
        'id' => PLAYLISTS_TABLE . '.id',
        'name' => PLAYLISTS_TABLE . '.name',
        'created_at' => PLAYLISTS_TABLE . '.created_at',
        'updated_at' => PLAYLISTS_TABLE . '.updated_at',
        'creator_id' => PLAYLISTS_TABLE . '.created_by',
        'total_songs' => 'count('.PLAYLIST_SONGS_TABLE.'.playlist_id)',
        'created_by' => 'CONCAT('.USERS_TABLE.".first_name,' ',".USERS_TABLE.'.last_name)'
    ];

}
