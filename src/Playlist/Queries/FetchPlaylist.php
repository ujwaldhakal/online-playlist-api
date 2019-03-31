<?php

namespace OP\Playlist\Queries;

use Illuminate\Database\ConnectionInterface;
use OP\Playlist\Queries\Alias\FetchPlaylistAlias;
use OP\Playlist\Queries\Filters\FetchPlaylistFilter;
use OP\Services\Read\ReadInterface;

class FetchPlaylist implements ReadInterface
{
    private $records;
    private $connection;
    private $filter;

    public function __construct(ConnectionInterface $connection, FetchPlaylistFilter $filter)
    {
        $alias = new FetchPlaylistAlias();
        $this->connection = $connection;

        $this->filter = $filter;

        $this->records = $this->queryRooms()
            ->selectRaw($alias->generate($this->filter->getFields()))
            ->get();
    }

    private function queryRooms()
    {
        $query = $this->connection->table(PLAYLISTS_TABLE);

        if ($this->filter->shouldFilterById()) {
            $query = $query->where(PLAYLISTS_TABLE . '.id', $this->filter->getId());
        }

        if ($this->filter->shouldFetchUserDetails()) {
            $query = $query->join(USERS_TABLE, PLAYLISTS_TABLE . '.created_by', '=', USERS_TABLE . '.id');
        }

        if ($this->filter->shouldFilterByUserId()) {
            $query = $query->where(PLAYLISTS_TABLE . '.created_by', $this->filter->getUserId());
        }

        if ($this->filter->shouldCountTotalSongs()) {
            $query = $query->leftJoin(PLAYLIST_SONGS_TABLE, PLAYLISTS_TABLE . '.id', '=', PLAYLIST_SONGS_TABLE . '.playlist_id');
            $query = $query->groupBy(PLAYLISTS_TABLE . '.id');
        }


        return $query;
    }

    public function get()
    {
        return $this->records;
    }
}
