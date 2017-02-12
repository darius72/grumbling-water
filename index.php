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

$show_sides_count = 2;

$db = new database();

if ($db->Connected()) {
    $orderby = "id";
    $asc = 1;
    $per_page = 10;
    $page = 1;
    $start= 0;

    echo "<form action='bookSearch.php' method='get'>
        <input type='submit' name='submit' value='Search' />
        <input type='text' name='search' />
        <select name=\"key\">
            <option value=\"name\">Name</option>
            <option value=\"author\">Author</option>
            <option value=\"year\">Year</option>
            <option value=\"genre\">Genre</option>
        </select>
        </form>";

    if (isset($_GET['orderby'])) {
        switch($_GET['orderby']) {
            case 'id':
            case 'name':
            case 'author':
            case 'year':
            case 'genre':
                $orderby = $_GET['orderby'];
                break;
        }
    }
    if (isset($_GET['asc'])) {
        if ($_GET['asc'] == 1) $asc = 1;
        if ($_GET['asc'] == 0) $asc = 0;
    }
    if ((isset($_GET['page'])) && (ctype_digit($_GET['page']))) $page = $_GET['page'];
    $start = abs(($page-1)*$per_page);

    echo pageDisplay::pageLink($page, $orderby, $asc, $show_sides_count, $per_page, $db->GetTableRowCount());

    $books = $db->GetBooks($orderby, $asc, $per_page, $start);
    echo "<table border='1'><tr>";
    echo "<th><a href='index.php?orderby=name&asc=" . ($orderby == 'name' ? !$asc : '1') . "&page=" . $page . "'> Name </a></th>";
    echo "<th><a href='index.php?orderby=author&asc=" . ($orderby == 'author' ? !$asc : '1') . "&page=" . $page. "'> Author </a></th>
        <th><a href='index.php?orderby=year&asc=" . ($orderby == 'year' ? !$asc : '1') . "&page=" . $page . "'> Year </a></th>
        <th><a href='index.php?orderby=genre&asc=" . ($orderby == 'genre' ? !$asc : '1') . "&page=" . $page . "'> Genre </a></th></tr>";
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
