<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:56
 */
class book {
    private $name;
    private $author;
    private $year;
    private $genre;

    function __construct($name, $author, $year, $genre) {
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function ToString() {
        return $this->name;
    }

}