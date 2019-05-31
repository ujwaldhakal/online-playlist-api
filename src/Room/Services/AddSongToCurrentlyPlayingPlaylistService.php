<?php

namespace OP\Room\Services;

use OP\Authentication\Entities\UserInterface;
use OP\Room\Entities\RoomInterface;
use OP\Room\Exceptions\RoomDoesNotExist;

class AddSongToCurrentlyPlayingPlaylistService
{
    private $roomId;
    private $songLink;
    private $id;
    private $room;
    private $user;

    public function __construct($songLink, $roomId, RoomInterface $room, UserInterface $user)
    {
        $this->id = getUuid();
        $this->songLink = $songLink;
        $this->roomId = $roomId;
        $this->room = $room;
        $this->user = $user;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->room = $this->room->findById($this->roomId);
        $this->checkIfRoomExists();
    }

    private function checkIfRoomExists()
    {
        if (!$this->room) {
            throw new RoomDoesNotExist();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSongLink()
    {
        return $this->songLink;
    }


    public function getRoom(): RoomInterface
    {
        return $this->room;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

}
