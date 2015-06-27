<?php

namespace tgbot\Api\Types;

use tgbot\Api\InvalidArgumentException;
use tgbot\Api\TypeInterface;

/**
 * Class Video
 * This object represents a video file.
 *
 * @package tgbot\Api\Types
 */
class Video implements TypeInterface
{
    /**
     * Unique identifier for this file
     *
     * @var string
     */
    protected $fileId;

    /**
     * Video width as defined by sender
     *
     * @var int
     */
    protected $width;

    /**
     * Video height as defined by sender
     *
     * @var int
     */
    protected $height;

    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var int
     */
    protected $duration;

    /**
     * Video thumbnail
     *
     * @var \tgbot\Api\Types\PhotoSize
     */
    protected $thumb;


    /**
     * Optional. Mime type of a file as defined by sender
     *
     * @var string
     */
    protected $mimeType;

    /**
     * Optional. File size
     *
     * @var int
     */
    protected $fileSize;

    /**
     * Optional. Text description of the video (usually empty)
     *
     * @var string
     */
    protected $caption;

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        if (is_numeric($duration)) {
            $this->duration = $duration;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param string $fileId
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     */
    public function setFileSize($fileSize)
    {
        if(is_numeric($fileSize)) {
            $this->fileSize = $fileSize;
        }
        else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        if (is_numeric($height)) {
            $this->height = $height;
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return PhotoSize
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param PhotoSize $thumb
     */
    public function setThumb(PhotoSize $thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        if (is_numeric($width)) {
            $this->width = $width;
        } else {
            throw new InvalidArgumentException();
        }
    }

    public static function fromResponse($data)
    {
        $instance = new self();

        if (!isset($data['file_id'], $data['width'], $data['height'], $data['duration'], $data['thumb'])) {
            throw new InvalidArgumentException();
        }
        $instance->setFileId($data['file_id']);
        $instance->setWidth($data['width']);
        $instance->setHeight($data['height']);
        $instance->setDuration($data['duration']);
        $instance->setThumb(PhotoSize::fromResponse($data['thumb']));

        if (isset($data['mime_type'])) {
            $instance->setMimeType($data['mime_type']);
        }
        if (isset($data['file_size'])) {
            $instance->setFileSize($data['file_size']);
        }
        if (isset($data['caption'])) {
            $instance->setCaption($data['caption']);
        }

        return $instance;
    }
}