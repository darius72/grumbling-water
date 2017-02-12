<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 23:19
 */

require_once('classes/database.php');
require_once('classes/book.php');

if ((isset($_GET['id'])) && (ctype_digit($id = $_GET['id']))) {
    $db = new database();
    if ($db->Connected()) {
        if ((1 <= $id) && ($id <= $db->GetTableRowCount())) {
            $book = $db->GetBook($id);
            echo "<a href='index.php'> Back to Book List </a>";
            echo "<table border='1'>
                    <tr><td> $book->name </td><td> original title </td></tr>
                    <tr><td> by $book->author </td><td> First published $book->year </td></tr>
                    <tr><td> Genre: $book->genre </td><td> ISBN </td></tr>
                    <tr><td colspan='2'> $book->about </td></tr>
                    </table>";
            //---------------
        } else {
            header("Location: index.php");
        }
    } else {
        echo "No connection with DataBase";
    }
} else {
    header("Location: index.php");
}




