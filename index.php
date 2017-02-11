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
    $order = "id";
    if (isset($_GET['order'])) {
        switch($_GET['order']) {
            case 'id':
            case 'name':
            case 'author':
            case 'year':
            case 'genre':
                $order = $_GET['order'];
                break;
        }
    }

    $books = $db->GetBooks($order);
    echo "<table border='1'><tr>
        <th><a href='index.php?order=name'> Name </a></th>
        <th><a href='index.php?order=author'> Author </a></th>
        <th><a href='index.php?order=year'> Year </a></th>
        <th><a href='index.php?order=genre'> Genre </a></th></tr>";
    foreach($books as $book) {
        echo "<tr><td><a href='bookinfo.php?id=".$book->id."'>" . $book->name . "</a></td><td>" . $book->author . "</td><td>" . $book->year . "</td><td>" . $book->genre . "</td></tr>";
    }
    echo '</table>';
} else {
    echo "No connection with DataBase";
}
