<?php

namespace OP\Playlist\Queries;

use Illuminate\Database\ConnectionInterface;
use OP\Playlist\Queries\Alias\FetchPlaylistAlias;
use OP\Playlist\Queries\Alias\FetchSongAlias;
use OP\Playlist\Queries\Filters\FetchPlaylistFilter;
use OP\Playlist\Queries\Filters\FetchSongFilter;
use OP\Services\Read\ReadInterface;

class FetchSong implements ReadInterface
{
    private $records;
    private $connection;
    private $filter;

    public function __construct(ConnectionInterface $connection, FetchSongFilter $filter)
    {
        $alias = new FetchSongAlias();
        $this->connection = $connection;

        $this->filter = $filter;

        $this->records = $this->querySongs()
            ->selectRaw($alias->generate($this->filter->getFields()))
            ->get();
    }

    private function querySongs()
    {
        $query = $this->connection->table(PLAYLIST_SONGS_TABLE);

        if ($this->filter->shouldFilterById()) {
            $query = $query->where(PLAYLIST_SONGS_TABLE . '.id', $this->filter->getId());
        }

        if ($this->filter->shouldFetchUserDetails()) {
            $query = $query->join(USERS_TABLE, PLAYLIST_SONGS_TABLE . '.created_by', '=', USERS_TABLE . '.id');
        }

        if ($this->filter->shouldFilterByUserId()) {
            $query = $query->where(PLAYLIST_SONGS_TABLE . '.created_by', $this->filter->getUserId());
        }

        if ($this->filter->shouldFilterByPlaylistId()) {
            $query = $query->where(PLAYLIST_SONGS_TABLE . '.playlist_id', $this->filter->getPlaylistId());
        }


        return $query;
    }

    public function get()
    {
        return $this->records;
    }
}
