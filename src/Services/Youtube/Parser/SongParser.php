<?php

namespace OP\Services\Youtube\Parser;

class SongParser
{
    private $title;
    private $snippet;
    private $channelName;
    private $description;
    private $thumbnails;
    private $availableAttr = ['title','thumbnails'];

    public function __construct(array $data)
    {
        foreach($data['items']['0']['snippet'] as $key => $value) {
            if (in_array($key,$this->availableAttr)) {
                $method = camel_case('set_'.$key);
                $this->{$method}($value);
            }
        }

    }

    public function getCoverPic()
    {
        return $this->getThumbnail()['medium']['url'];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * @param mixed $snippet
     */
    public function setSnippet($snippet): void
    {
        $this->snippet = $snippet;
    }

    /**
     * @return mixed
     */
    public function getChannelName()
    {
        return $this->channelName;
    }

    /**
     * @param mixed $channelName
     */
    public function setChannelName($channelName): void
    {
        $this->channelName = $channelName;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnails($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }



}
