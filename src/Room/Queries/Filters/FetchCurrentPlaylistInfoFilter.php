<?php

namespace OP\Room\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchCurrentPlaylistInfoFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields'
    ];
    protected $allowedFields = [
        'id',
        'link',
        'created_at',
        'created_by',
        'playlist_id',
        'is_youtube_list',
        'is_youtube_playlist_link',
        'is_playing'
    ];

}

