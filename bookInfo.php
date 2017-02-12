<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 23:19
 */

/**
 * Knygos informacinis puslapis
 */

require_once ('classes/database.php');
require_once ('classes/bookBig.php');

// Gauname knygos ID
if ((isset($_GET['id'])) && (ctype_digit($id = $_GET['id']))) {
    // Prisijungiame prie duomenu bazes.
    $db = new database();
    if ($db->Connected()) {
        // Jeigu knygu sarase yra nurodytas Id numeris
        if ((1 <= $id) && ($id <= $db->GetTableRowCount())) {
            // Atsisiunciame visa informacija apie knyga
            $oneBook = $db->GetBook($id);
            echo "<a href='index.php'> Back to Book List </a><br>";
            // Jeigu i si puslapi patekome is paieskos rezultatu puslapio, sukuriame nuoroda grizimui.
            if (isset($_GET['key']) and isset($_GET['search'])) {
                $key = $_GET['key'];
                $search = $_GET['search'];
                echo "<a href='bookSearch.php?key=$key&search=$search'> Back to Search results </a><br>";
            }
            // Sukuriame lentele su knygos informacija
            echo "<table border='1'>
                    <tr><td> $oneBook->name";
            if (!is_null($oneBook->series)) echo " (".$oneBook->series.")";
            echo "</td><td> $oneBook->original_name </td></tr>
                    <tr><td> by $oneBook->author </td><td> First published $oneBook->year </td></tr>
                    <tr><td> Genre: $oneBook->genre </td><td> ISBN: $oneBook->isbn </td></tr>
                    <tr><td colspan='2'> $oneBook->about </td></tr>
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




