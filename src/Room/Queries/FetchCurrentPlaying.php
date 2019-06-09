<?php

namespace OP\Room\Queries;

use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use OP\Room\Queries\Alias\CurrentPlaylistAlias;
use OP\Room\Queries\Alias\FetchRoomsAlias;
use OP\Room\Queries\Filters\FetchCurrentPlaylistInfoFilter;
use OP\Room\Queries\Filters\FetchRoomsFilter;
use OP\Services\Read\ReadInterface;

class FetchCurrentPlaying implements ReadInterface
{
    private $records;
    private $connection;
    private $roomId;
    private $playlistInfoFilter;

    public function __construct(ConnectionInterface $connection, FetchCurrentPlaylistInfoFilter $filter, $roomId)
    {
        $this->connection = $connection;
        $this->roomId = $roomId;
        $alis = new CurrentPlaylistAlias();

        $this->records = $this->queryCurrentPlaylist()
            ->selectRaw($alis->generate($filter->getFields()))
            ->get();
    }

    private function queryCurrentPlaylist()
    {
        $query = $this->connection->table(PLAYLIST_QUEUES);

        $query = $query->where(['room_id' => $this->roomId, PLAYLIST_QUEUES.'.is_playing' => 1]);

        $query = $query->join(PLAYLIST_SONGS_TABLE, PLAYLIST_QUEUES . '.playlist_id', '=', PLAYLIST_SONGS_TABLE . '.playlist_id');

        $query = $query->join(USERS_TABLE, PLAYLIST_SONGS_TABLE . '.created_by', '=', USERS_TABLE . '.id');

        $query = $query->where([PLAYLIST_SONGS_TABLE.'.already_played' => 0]);

        return $query;
    }

    public function get()
    {
        return $this->records;
    }
}
