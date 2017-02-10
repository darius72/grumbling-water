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
    echo "<table border='1'><tr>
        <th><button type='button'>Name</button></th>
        <th><button type='button'>Author</button></th>
        <th><button type='button'>Year</button></th>
        <th><button type='button'>Genre</button></th></tr>";
    foreach($books as $book) {
        echo "<tr><td><a href='bookinfo.php?id=".$book->id."'>" . $book->name . "</a></td><td>" . $book->author . "</td><td>" . $book->year . "</td><td>" . $book->genre . "</td></tr>";
    }
    echo '</table>';
} else {
    echo "No connection with DataBase";
}
