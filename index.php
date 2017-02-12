<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:30
 */

require_once ('classes/database.php');
require_once ('classes/book.php');
require_once ('classes/pageDisplay.php');

$show_sides_count = 3;

$db = new database();

if ($db->Connected()) {
    $order = "id";
    $per_page = 10;
    $page = 1;
    $start= 0;

    echo "<form action='bookSearch.php' method='post'>
        <input type='submit' name='submit' value='Search' />
        <input type='text' name='search' />
        <select name=\"Key\">
            <option value=\"name\">Name</option>
            <option value=\"author\">Author</option>
            <option value=\"year\">Year</option>
            <option value=\"genre\">Genre</option>
        </select>
        </form>";

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
    if ((isset($_GET['page'])) && (ctype_digit($_GET['page']))) $page = $_GET['page'];
    $start = abs(($page-1)*$per_page);

    echo pageDisplay::pageLink($page, $order, $show_sides_count, $per_page, $db->GetTableRowCount());

    $books = $db->GetBooks($order, $per_page, $start);
    echo "<table border='1'><tr>
        <th><a href='index.php?order=name&page=" . $page . "'> Name </a></th>
        <th><a href='index.php?order=author&page=" . $page. "'> Author </a></th>
        <th><a href='index.php?order=year&page=" . $page . "'> Year </a></th>
        <th><a href='index.php?order=genre&page=" . $page . "'> Genre </a></th></tr>";
    foreach($books as $book) {
        echo "<tr><td><a href='bookinfo.php?id=".$book->id."'>" . $book->name . "</a></td>
            <td>" . $book->author . "</td>
            <td>" . $book->year . "</td>
            <td>" . $book->genre . "</td></tr>";
    }
    echo '</table>';
} else {
    echo "No connection with DataBase";
}
