<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 21:31
 */

/**
 *   Objekto 'databaze' klase
 * skirta darbui su duomenu bazeje esancia lentele.
 * kintamieji 'username' ir 'password' yra paveldeti is klases 'credentials'.
 *
 *   Sioje uzduotyje naudojama konkreti duomenu baze, kuri turi vienintele lentele, saugancia knygu sarasa.
 *
 *     Lenteles stulpeliai yra:
 *   Knygu sarase rodoma informacija:
 * id - Unikalus knygos identifikacinis numeris
 * name - knygos pavadinimas
 * author - knygos autorius
 * year - Metai kuriais knyga buvo isleista pirma karta
 * genre - Zanras, kuriam knyga priskiria dauguma skaitytoju
 *   Papildoma informacija, rodoma tik atskirame knygos puslapyje:
 * about - Trumpas tekstas apie knyga, knygos veikejus ir jos autoriu (NULL or text)
 * original_name - Pirmasis knygos pavadinimas (NULL or string)
 * series - Serija, kuriai priklauso knyga (jeigu knyga priklauso serijai) (NULL or string)
 * isbn - Desimties skaitmenu knygos ISBN numeris. (NULL or string)
 */

require_once('book.php');
require_once('bookBig.php');
include ('credentials.php');

class database extends credentials {
    /**
     * Kintamieji saugantys duomenu bazes prisijungimo duomenis
     */
    private $servername = "localhost";
    private $dbname = "id783838_mydb";
    private $dbtable = "mybooks";

    private $conn;          // rysio su duomenu baze kintamasis
    private $connected;     // kintamasis saugantis rysio statusa

    /**
     * Duomenu bazes konstruktorius
     * Iskvietimo metu prisijungia prie duomenu bazes
     * ir issaugo informacija apie prisijungimo statusa kintamajame 'connected'.
     */
    function __construct() {
        parent::__construct();
        $this->conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbname
            );
        if ($this->conn->connect_error) {
            $this->connected = false;
        } else {
            $this->connected = true;
        }
    }

    /**
     * Funkcija skirta perduoti informacija apie prisijungimo prie duomenu bazes statusa
     */
    function Connected() {
        return $this->connected;
    }

    /**
     * Funkcija grazina visa knygu sarasa is duomenu bazes
     * skirta suformuoti knygu sarasui pirmajame puslapyje
     */
    function GetBooks($order, $asc, $limit, $offset) {
        $list = array();
        $sql = "SELECT id, name, year, author, genre FROM $this->dbtable 
            ORDER BY $order " . ($asc ? "ASC" : "DESC") . " LIMIT $offset, $limit";
        $result = $this->conn->query($sql);
        if ($result) {
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
        } else {
            return null;
        }
    }

    /**
     * Funkcija grazina knygu sarasa pagal nurodytus duomenis
     * search - ieskoma fraze
     * key - stulpelis, kuriame atliekama paieska (book name, book author, year...)
     */
    function GetBooksSearch($key, $search) {
        $list = array();
        $sql = "SELECT id, name, year, author, genre FROM $this->dbtable WHERE $key LIKE '$search'";
        $result = $this->conn->query($sql);
        if ($result) {
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
        } else {
            return null;
        }
    }

    /**
     * Funkcija grazina visa informacija apie viena knyga pagal knygos Id.
     */
    function GetBook($bookId) {
        $sql = "SELECT id, name, year, author, genre, about, original_name, series, isbn FROM " . $this->dbtable
            . " WHERE id = " . $bookId;
        $result = $this->conn->query($sql);
        if ($result) {
            while($row = $result->fetch_assoc()) {
                return new bookBig(
                    $row["id"],
                    $row["name"],
                    $row["author"],
                    $row["year"],
                    $row["genre"],
                    $row["about"],
                    $row["original_name"],
                    $row["series"],
                    $row["isbn"]
                );
            }
            return null;
        } else {
            return null;
        }
    }

    /**
     * Funkcija skirta gauti knygu, esanciu knygu sarase, skaiciui.
     */
    function GetTableRowCount() {
        $sql = "SHOW TABLE STATUS FROM $this->dbname LIKE '$this->dbtable'";
        $result = $this->conn->query($sql);
        if ($result) {
            while($row = $result->fetch_assoc()) {
                return $row['Rows'];
            }
        } else {
            return null;
        }
    }

}