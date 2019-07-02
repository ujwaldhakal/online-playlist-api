<?php

namespace OP\Room\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchCurrentPlaylistInfoFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields',
        'not_played'
    ];
    protected $allowedFields = [
        'id',
        'link',
        'title',
        'cover_image',
        'created_at',
        'created_by',
        'playlist_id',
        'is_youtube_list',
        'is_youtube_playlist_link',
        'is_playing'
    ];

    public function shouldFilterNotPlayed() : bool
    {
        return !empty($this->getParams('not_played'));
    }

}

