<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.11
 * Time: 00:14
 */
class bookBig
{
    private $id;
    private $name;
    private $author;
    private $year;
    private $genre;
    private $about;

    function __construct($id, $name, $author, $year, $genre, $about) {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
        $this->about = $about;
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}