<?php
/**
 * Created by PhpStorm.
 * User: anons
 * Date: 3/7/19
 * Time: 12:09 AM
 */

namespace OP\Room\Events;


use OP\Room\Services\RoomDeletionService;

class RoomDeleted
{

    private $service;

    public function __construct(RoomDeletionService $service)
    {
        $this->service = $service;
    }

    public function getService(): RoomDeletionService
    {
        return $this->service;
    }
}
