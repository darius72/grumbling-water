<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.12
 * Time: 01:57
 */

require_once('classes/database.php');
require_once('classes/book.php');

$key;
$search;
if (isset($_POST['search'])){
    $search = $_POST['search'];
}
if (isset($_POST['Key'])) {
    $key = $_POST['Key'];
}

echo "<a href='index.php'> Back to Book List </a>";
$db = new database();
if ($db->Connected()) {
    $books = $db->GetBooksSearch($key, $search);
    echo "<table border='1'><tr>
        <th><a href='index.php'> Name </a></th>
        <th><a href='index.php'> Author </a></th>
        <th><a href='index.php'> Year </a></th>
        <th><a href='index.php'> Genre </a></th></tr>";
    foreach($books as $book) {
        echo "<tr><td><a href='bookinfo.php?id=".$book->id."'>" . $book->name . "</a></td>
           <td>" . $book->author . "</td>
           <td>" . $book->year . "</td>
           <td>" . $book->genre . "</td></tr>";
        }
    echo '</table>';
}