<?php

namespace tests\src\Playlist\Services;

use OP\Authentication\Entities\User;
use OP\playlist\Entities\playlist;
use OP\Playlist\Exceptions\PlaylistNameAlreadyExists;
use OP\playlist\Exceptions\playlistWithGivenNameAlreadyExists;
use OP\playlist\Services\playlistCreationService;

class PlaylistCreationServiceTest extends \TestCase
{
    protected $playlist;
    protected $user;

    public function basicSetup()
    {
        $this->playlist = \Mockery::mock(Playlist::class);
        $this->user = \Mockery::mock(User::class);
    }


    public function testExceptionWhenNameIsDuplicate()
    {
        $this->basicSetup();
        $this->user->shouldReceive('getId')->andReturn('12323');
        $this->playlist->shouldReceive('findByUserAndSlug')->andReturn(collect(['somedata' => 'somedata']));
        $this->expectException(PlaylistNameAlreadyExists::class);
        $playlistCreationService = new PlaylistCreationService(['name' => 'a'], $this->user, $this->playlist);
    }


    public function testExceptionWhenDataAreValid()
    {
        $this->basicSetup();
        $this->playlist->shouldReceive('findByUserAndSlug')->andReturn(false);
        $this->user->shouldReceive('getId')->andReturn(1);
        $playlistCreationService = new playlistCreationService(['name' => 'a'], $this->user, $this->playlist);
        $this->assertArrayHasKey('id',$playlistCreationService->extract());
        $this->assertArrayHasKey('name',$playlistCreationService->extract());
        $this->assertArrayHasKey('created_by',$playlistCreationService->extract());
        $this->assertArrayHasKey('slug',$playlistCreationService->extract());
    }

}
