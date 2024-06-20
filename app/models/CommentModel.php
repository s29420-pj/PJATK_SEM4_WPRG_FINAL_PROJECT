<?php

namespace models;

class CommentModel {
    private $id;
    private $content;
    private $date;
    private $authorId;

    /**
     * @param $id
     * @param $content
     * @param $date
     * @param $authorId
     */
    public function __construct($id, $content, $date, $authorId)
    {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }
}