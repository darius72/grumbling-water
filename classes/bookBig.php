<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.11
 * Time: 00:14
 */

require_once ('classes/book.php');

class bookBig extends book  {
    private $about;
    private $original_name;
    private $series;
    private $isbn;

    function __construct($id, $name, $author, $year, $genre, $about, $original_name, $series, $isbn) {
        parent::__construct($id, $name, $author, $year, $genre);
        $this->about = $about;
        $this->original_name = $original_name;
        $this->series = $series;
        $this->isbn = $isbn;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}