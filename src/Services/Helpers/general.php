<?php

if (!function_exists('getUuid')) {
    function getUuid()
    {

        return \Ramsey\Uuid\Uuid::uuid1()->toString();
    }
}
