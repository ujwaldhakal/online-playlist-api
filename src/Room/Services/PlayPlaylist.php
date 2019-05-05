<?php

namespace OP\Room\Services;

use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Entities\PlaylistQueueInterface;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Room\Entities\RoomInterface;
use OP\Room\Exceptions\RoomDoesNotExist;
use OP\Services\Exceptions\NotAuthorized;

class PlayPlaylist
{
    private $roomId;
    private $playlistId;
    private $user;
    private $room;
    private $playlist;
    private $id;

    public function __construct($roomId, $playlistId, LoggedInUser $user,
                                RoomInterface $room, PlaylistInterface $playlist)
    {

        $this->id = getUuid();
        $this->roomId = $roomId;
        $this->playlistId = $playlistId;
        $this->user = $user;
        $this->room = $room;
        $this->playlist = $playlist;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->room = $this->room->findById($this->roomId);
        $this->playlist = $this->playlist->findById($this->playlistId);
        $this->checkIfPlaylistExists();
        $this->checkIfRoomExists();
        $this->checkIfDjHasPermissionToChangePlaylist();
    }

    private function checkIfPlaylistExists()
    {
        if (!$this->room) {
            throw new RoomDoesNotExist();
        }
    }

    private function checkIfRoomExists()
    {
        if (!$this->playlist) {
            throw new PlaylistDoesNotExist();
        }
    }

    private function checkIfDjHasPermissionToChangePlaylist()
    {
        if ($this->room->getDjId() !== $this->user->getId()) {
            throw new NotAuthorized();
        }
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function getPlaylistId(): string
    {
        return $this->playlistId;
    }

    public function extract()
    {
        return [
            'id' => $this->id,
            'room_id' => $this->roomId,
            'playlist_id' => $this->playlistId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'is_playing' => 1
        ];
    }

}
