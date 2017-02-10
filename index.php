<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:30
 */

require_once('classes/database.php');
require_once('classes/book.php');

$db = new database();

if ($db->Connected()) {
    $books = $db->GetBooks();
    foreach($books as $book) {
        echo $book->ToString()."<br>";
    }
} else {
    echo "No connection with DataBase";
}
