<?php

namespace OP\Services\Youtube;

use GuzzleHttp\Exception\RequestException;
use OP\Services\Environment;
use OP\Services\Youtube\Exception\InvalidYoutubeLink;
use OP\Services\Youtube\Parser\SongParser;
use Pv\RequestOut;

class ExtractSongDetail
{
    private $environment;
    private $songId;
    private $requestOut;
    private $data;
    const YOUTUBE_API_URL = "https://www.googleapis.com/youtube/v3/videos?id=%s&key=%s&part=snippet";


    public function __construct(Environment $environment, RequestOut $requestOut, string $songId)
    {
        $this->requestOut = $requestOut;
        $this->environment = $environment;
        $this->songId = $songId;
        $this->prepareForApiCall();
    }


    public function prepareForApiCall()
    {
        try {
            $url = sprintf(self::YOUTUBE_API_URL, $this->songId, $this->environment->getYoutubeApiKey());
            $this->requestOut->setTargetUrl($url);
            $response = $this->requestOut->get();
            $response = json_decode($response, 1);
            if (count($response['items']) == 0) {
                throw new InvalidYoutubeLink();
            }
            $this->data = new SongParser($response);

        } catch (RequestException $exception) {
            dd($exception);
        }
    }

    public function getData()
    {
        return $this->data;
    }


}
