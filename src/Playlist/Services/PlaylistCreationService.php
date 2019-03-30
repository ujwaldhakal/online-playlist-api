<?php

namespace OP\Playlist\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Exceptions\PlaylistNameAlreadyExists;

class PlaylistCreationService
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

    private function runDataValidation()
    {
        $this->checkIfItsDuplicateName();
    }


    private function checkIfItsDuplicateName()
    {
        if ($this->playlist->findBySlug($this->getSlug())) {
            throw new PlaylistNameAlreadyExists();
        }
    }


    private function getSlug()
    {
        return strtolower($this->formData->get('name'));
    }

    public function extract()
    {
        return [
            'id' => $this->id,
            'name' => $this->formData->get('name'),
            'slug' => $this->getSlug(),
            'created_by' => $this->user->getId()
        ];
    }
}
