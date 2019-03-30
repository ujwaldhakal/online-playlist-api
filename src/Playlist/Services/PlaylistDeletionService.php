<?php

namespace OP\Playlist\Services;

use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Exceptions\PlaylistDoesNotBelongsToUser;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Services\Write\DeleteInterface;

class PlaylistDeletionService implements DeleteInterface
{
    private $formData;
    private $user;
    private $playlist;
    private $id;

    public function __construct($id, LoggedInUser $user, PlaylistInterface $playlist)
    {
        $this->id = $id;
        $this->user = $user;
        $this->playlist = $playlist;
        $this->runDataValidation();
    }

    private function runDataValidation()
    {
        $this->playlist = $this->playlist->findById($this->getId());
        $this->checkIfPlaylistExists();
        $this->checkIfPlaylistBelongsToUser();
    }


    public function getId(): string
    {
        return $this->id;
    }

    private function checkIfPlaylistBelongsToUser()
    {
        if ($this->user->getId() !== $this->playlist->getCreatorId()) {
            throw new PlaylistDoesNotBelongsToUser();
        }
    }


    private function checkIfPlaylistExists()
    {
        if (!$this->playlist) {
            throw new PlaylistDoesNotExist();
        }
    }

    private function getSlug()
    {
        return strtolower($this->formData->get('name'));
    }

}
