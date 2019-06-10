<?php

namespace OP\Playlist\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Exceptions\PlaylistNameAlreadyExists;
use OP\Services\Write\CreateInterface;

class PlaylistCreationService implements CreateInterface
{
    private $formData;
    private $user;
    private $playlist;
    private $id;

    public function __construct($formData, LoggedInUser $user, PlaylistInterface $playlist)
    {
        $this->id = getUuid();
        $this->formData = new Collection($formData);
        $this->user = $user;
        $this->playlist = $playlist;
        $this->runDataValidation();
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function runDataValidation()
    {
        $this->checkIfItsDuplicateName();
    }


    private function checkIfItsDuplicateName()
    {
        if ($this->playlist->findByUserAndSlug($this->user->getId(), $this->getSlug())) {
            throw new PlaylistNameAlreadyExists();
        }
    }


    private function getSlug()
    {
        return strtolower($this->formData->get('name'));
    }

    public function extract() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->formData->get('name'),
            'slug' => $this->getSlug(),
            'created_by' => $this->user->getId(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
}
