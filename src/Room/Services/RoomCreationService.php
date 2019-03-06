<?php

namespace OP\Room\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Room\Entities\RoomInterface;
use OP\Room\Exceptions\RoomWithGivenNameAlreadyExists;
use OP\Services\Write\CreateInterface;

class RoomCreationService implements CreateInterface
{
    private $formData;
    private $id;
    private $room;
    private $user;

    public function __construct($formData, LoggedInUser $user, RoomInterface $room)
    {
        $this->id = getUuid();
        $this->formData = new Collection($formData);
        $this->user = $user;
        $this->room = $room;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->checkIfGivenNameAlreadyExists();
    }

    private function checkIfGivenNameAlreadyExists()
    {
        $name = strtolower($this->formData->get('name'));
        if ($this->room->findbySlug($name)) {
            throw new RoomWithGivenNameAlreadyExists();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->formData->has('description') ? $this->formData->get('description') : '';

    }

    public function extract(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->formData->get('name'),
            'creator_id' => $this->user->getId(),
            'slug' => strtolower($this->formData->get('name')),
            'description' => $this->getDescription(),
            'dj_id' => $this->user->getId(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }


}
