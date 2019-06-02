<?php

namespace OP\Services;

class Environment
{
    public function getYoutubeApiKey()
    {
        return env('YOUTUBE_API_KEY');
    }
}
