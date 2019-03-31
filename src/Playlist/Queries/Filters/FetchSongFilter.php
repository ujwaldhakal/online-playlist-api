<?php

namespace OP\Playlist\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchSongFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields',
        'id',
        'creator_id',
        'next',
        'playlist_id'
    ];

    protected $allowedFields = [
        'id',
        'link',
        'created_at',
        'created_by',
        'playlist_id',
        'is_youtube_list',
        'is_youtube_playlist_link',
        'is_played'
    ];

    public function shouldFetchUserDetails(): bool
    {
        return $this->hasField('created_by');
    }

    public function shouldFilterByUserId()
    {
        return !empty($this->getUserId());
    }

    public function shouldFilterByPlaylistId()
    {
        return !empty($this->getPlaylistId());
    }

    public function getUserId()
    {
        return $this->getParams('created_by');
    }

    public function getPlaylistId()
    {
        return $this->getParams('playlist_id');
    }

}
