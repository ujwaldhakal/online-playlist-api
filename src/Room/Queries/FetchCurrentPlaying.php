<?php

namespace OP\Room\Queries;

use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use OP\Room\Queries\Alias\FetchRoomsAlias;
use OP\Room\Queries\Filters\FetchRoomsFilter;
use OP\Services\Read\ReadInterface;

class FetchCurrentPlaying implements ReadInterface
{
    private $records;
    private $connection;
    private $roomId;

    public function __construct(ConnectionInterface $connection, $roomId)
    {
        $this->connection = $connection;
        $this->roomId = $roomId;

        $this->records = $this->queryCurrentPlaylist()
            ->selectRaw('*')
            ->get();
    }

    private function queryCurrentPlaylist()
    {
        $query = $this->connection->table(PLAYLIST_QUEUES);

        $query = $query->where(['room_id' => $this->roomId, PLAYLIST_QUEUES.'.is_playing' => 1]);

        $query = $query->join(PLAYLIST_SONGS_TABLE, PLAYLIST_QUEUES . '.playlist_id', '=', PLAYLIST_SONGS_TABLE . '.playlist_id');

        return $query;
    }

    public function get()
    {
        return $this->records;
    }
}
