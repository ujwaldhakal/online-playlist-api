<?php

namespace OP\Room\Services;


use OP\Authentication\Entities\LoggedInUser;
use OP\Room\Entities\RoomInterface;
use OP\Room\Exceptions\CannotDeleteOthersRoom;
use OP\Room\Exceptions\RoomDoesNotExist;
use OP\Services\Write\DeleteInterface;

class RoomDeletionService implements DeleteInterface
{
    private $id;
    private $room;
    private $user;

    public function __construct($id, LoggedInUser $user, RoomInterface $room)
    {
        $this->room = $room;
        $this->id = $id;
        $this->user = $user;
        $this->runDataValidation();
    }

    public function getId(): String
    {
        return $this->id;
    }

    private function runDataValidation()
    {
        $this->room = $this->room->findById($this->id);
        $this->checkIfRoomExists();
        $this->checkIfUserIsOnlyDeletingOwnRoom();
    }

    private function checkIfRoomExists()
    {
        if (!$this->room) {
            throw new RoomDoesNotExist();
        }
    }

    private function checkIfUserIsOnlyDeletingOwnRoom()
    {
        if ($this->room->getCreatorId() !== $this->user->getId()) {
            throw new CannotDeleteOthersRoom();
        }
    }
}
