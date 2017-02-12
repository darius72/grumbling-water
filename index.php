<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:30
 */

/**
 * Cia yra pirmasis uzduoties puslapis su knygu sarasu.
 *
 * Antrame puslapyje rodoma detali informacija apie viena knyga.
 *
 * Paieskos rezultatai rodomi treciame puslapyje ir jie yra nepuslapiuojami. Visi rezultatai rodomi vienoje vietoje.
 *
 * Sioje uzduotyje naudojamos duomenu bazes prisijungimo duomenys saugomi klaseje 'credentials'.
 * Duomenu bazes struktura saugomi objekto 'database' klaseje.
 */

require_once ('classes/database.php');
require_once ('classes/book.php');
require_once ('classes/pageDisplay.php');

/**
 * Kintamieji puslapiuojamo knygu saraso duomenims saugoti ir perduoti
 */
$orderby = "id";    // Pavadinimas stulpelio pagal kuri rikiuojas knygu sarasas
$asc = 1;           // Saraso rikiavimo tvarka (1 = Ascending, 0 = Descending)
$per_page = 10;     // Kiek eiluciu vaizduojama viename puslapyje
$page = 1;          // Esamo puslapio numeris
$start= 0;          // Esamo puslapio pirmos eilutes (pirmos knygos) eiliskumo numeris (reikalingas kaip sql limit 'offset')

/**
 * Prisijungiame prie duomenu bazes su 'default' prisijungimo duomenimis.
 */
$db = new database();
if ($db->Connected()) {         // Jeigu pavyko prisijungi prie duomenu bazes
    // Sukuriame Paieskos laukeli.
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

    // Apdorojame knygu saraso puslapiu informacija.
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

    echo pageDisplay::pageLink($page, $orderby, $asc, $per_page, $db->GetTableRowCount());

    // Is duomenu bazes atsisiunciame knygu sarasa.
    $books = $db->GetBooks($orderby, $asc, $per_page, $start);

    // Sukuriame lentele knygu saraso vaizdavimui.
    echo "<table border='1'><tr>";
    echo "<th><a href='index.php?orderby=name&asc=" . ($orderby == 'name' ? !$asc : '1') . "&page=" . $page . "'> Name </a></th>";
    echo "<th><a href='index.php?orderby=author&asc=" . ($orderby == 'author' ? !$asc : '1') . "&page=" . $page. "'> Author </a></th>
        <th><a href='index.php?orderby=year&asc=" . ($orderby == 'year' ? !$asc : '1') . "&page=" . $page . "'> Year </a></th>
        <th><a href='index.php?orderby=genre&asc=" . ($orderby == 'genre' ? !$asc : '1') . "&page=" . $page . "'> Genre </a></th></tr>";
    foreach($books as $book) {
        echo "<tr><td><a href='bookInfo.php?id=".$book->id."'>" . $book->name . "</a></td>
            <td>" . $book->author . "</td>
            <td>" . $book->year . "</td>
            <td>" . $book->genre . "</td></tr>";
    }
    echo '</table>';
} else {                        // Jeigu prisijungti prie duomenu bazes nepavyko.
    echo "No connection with DataBase";
}

echo pageDisplay::copyrights();
