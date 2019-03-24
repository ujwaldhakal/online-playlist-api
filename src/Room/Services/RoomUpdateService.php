<?php

namespace OP\Room\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Room\Entities\RoomInterface;
use OP\Room\Exceptions\RoomDoesNotBelongToYou;
use OP\Room\Exceptions\RoomDoesNotExist;
use OP\Room\Fields\Fillables;
use OP\Services\Write\UpdateInterface;

class RoomUpdateService implements UpdateInterface
{
    private $formData;
    private $roomId;
    private $room;
    private $user;

    public function __construct($roomId, $formData, LoggedInUser $user, RoomInterface $room)
    {
        $this->roomId = $roomId;
        $this->formData = new Collection($formData);
        $this->user = $user;
        $this->room = $room;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->room = $this->room->findbyId($this->roomId);
        $this->checkIfRoomExists();
        $this->checkIfRoomBelongsToUser();

    }

    public function getId()
    {
        return $this->room->getId();
    }

    private function checkIfRoomExists()
    {
        if (!$this->room) {
            throw new RoomDoesNotExist();
        }
    }

    private function checkIfRoomBelongsToUser()
    {
        if ($this->room->getCreatorId() !== $this->user->getId()) {
            throw new RoomDoesNotBelongToYou();
        }
    }

    public function extract()
    {
        return $this->formData->only(Fillables::getAllowedFields())->toArray();
    }
}
