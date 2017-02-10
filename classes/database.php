<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:31
 */
require_once('book.php');
require_once('bookBig.php');

class database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "myDB";
    private $conn;

    private $connected;

    function __construct() {
        $this->conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbname
            );
        if ($this->conn->connect_error) {
            $this->connected = false;
            //die("Connection failed: " . $conn->connect_error . "<br>");
        } else {
            $this->connected = true;
        }
    }

    function Connected() {
        return $this->connected;
    }

    function GetBooks() {
        $list = array();
        $sql = "SELECT id, name, year, author, genre FROM MyBooks";
        $result = $this->conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $list[] = new book(
                    $row["id"],
                    $row["name"],
                    $row["author"],
                    $row["year"],
                    $row["genre"]
                );
        }
        return $list;
    }

    function GetBook($bookId) {
        $sql = "SELECT id, name, year, author, genre, about FROM MyBooks WHERE id = ".$bookId;
        $result = $this->conn->query($sql);
        while($row = $result->fetch_assoc()) {
            return new bookBig(
                $row["id"],
                $row["name"],
                $row["author"],
                $row["year"],
                $row["genre"],
                $row["about"]
            );
        }
        return null;
    }
}