<?php

namespace OP\Playlist\Services;

use Illuminate\Support\Collection;
use OP\Authentication\Entities\LoggedInUser;
use OP\Playlist\Entities\PlaylistInterface;
use OP\Playlist\Exceptions\PlaylistDoesNotExist;
use OP\Services\Write\CreateInterface;

class AddSongService implements CreateInterface
{
    private $formData;
    private $user;
    private $playlist;
    private $id;

    public function __construct($formData, LoggedInUser $user, PlaylistInterface $playlist)
    {
        $this->formData = new Collection($formData);
        $this->id = getUuid();
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
        $this->playlist = $this->playlist->findById($this->formData->get('playlist_id'));
        $this->checkIfPlaylistExists();
    }


    private function checkIfPlaylistExists()
    {
        if (!$this->playlist) {
            throw new PlaylistDoesNotExist();
        }
    }


    public function isYoutubePlaylistLink(): int
    {
        return false;
    }

    public function isYoutubeList(): int
    {
        return true;
    }

    public function extract(): array
    {
        return [
            'id' => $this->getId(),
            'link' => $this->formData->get('link'),
            'creator_id' => $this->user->getId(),
            'playlist_id' => $this->playlist->getId(),
            'is_youtube_playlist_link' => $this->isYoutubePlaylistLink(),
            'is_youtube_list' => $this->isYoutubeList(),
            'is_played' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }


}
