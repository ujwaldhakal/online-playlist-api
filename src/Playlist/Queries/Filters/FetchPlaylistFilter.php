<?php

namespace OP\Playlist\Queries\Filters;

use OP\Services\Read\Queries\Filters\AbstractFilter;

class FetchPlaylistFilter extends AbstractFilter
{
    protected $allowedParams = [
        'fields',
        'id',
        'created_by'
    ];
    protected $allowedFields = [
        'id',
        'name',
        'created_at',
        'created_by',
        'total_songs',
        'creator_id',
    ];

    public function shouldFetchUserDetails(): bool
    {
        return $this->hasField('created_by');
    }

    public function shouldFilterByUserId()
    {
        return !empty($this->getUserId());
    }

    public function getUserId()
    {
        return $this->getParams('created_by');
    }

    public function shouldCountTotalSongs()
    {
        return $this->hasField('total_songs');
    }

}
