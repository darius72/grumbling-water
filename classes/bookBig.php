<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.11
 * Time: 00:14
 */

class bookBig {
    private $id;
    private $name;
    private $author;
    private $year;
    private $genre;
    private $about;
    private $original_name;
    private $series;
    private $isbn;

    function __construct($id, $name, $author, $year, $genre, $about, $original_name, $series, $isbn) {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
        $this->about = $about;
        $this->original_name = $original_name;
        $this->series = $series;
        $this->isbn = $isbn;
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}