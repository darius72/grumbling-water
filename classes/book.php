<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:56
 */

class book {
    protected $id;
    protected $name;
    protected $author;
    protected $year;
    protected $genre;

    public function __construct($id, $name, $author, $year, $genre) {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->genre = $genre;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

}