<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.12
 * Time: 02:58
 */
class pageDisplay
{
    static function pageLink ($page, $orderby, $asc, $per_page, $rowCount ) {
        $show_sides_count = 2;
        $eilute = "Page: " . "<br>";
        $eilute .= ($page>1 ? "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page-1) . "'> Previous </a>" : " ");
        if ($page > ($show_sides_count + 1)) {
            $eilute .= "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=1'> 1 </a>";
            switch ($page) {
                case ($page > ($show_sides_count + 3)) :
                    $eilute .= " ... ";
                    break;
                case ($page > ($show_sides_count + 2)) :
                    $eilute .= "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=2'> 2 </a>";
                    break;
            }
        }
        for ($i = ($show_sides_count); $i>=1; $i--) {
            $eilute .= ($page>$i ? "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page-$i) . "'> " . ($page-$i) . " </a>" : " ");
        }
        $eilute .= " " . $page . " ";
        for ($i = 1; $i<= ($show_sides_count); $i++) {
            $eilute .= ( (abs(($page-1+$i)*$per_page)+$i) > $rowCount ? " " : "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page+$i) . "'> " . ($page+$i) . " </a>" );
        }
        if ($page  < ceil($rowCount / $per_page) - $show_sides_count) {
            switch ($page) {
                case ($page < (ceil($rowCount / $per_page) - $show_sides_count - 2)) :
                    $eilute .= " ... ";
                    break;
                case ($page < (ceil($rowCount / $per_page) - $show_sides_count - 1)) :
                    $eilute .= "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . (ceil($rowCount / $per_page)-1) . "'> ". (ceil($rowCount / $per_page)-1)." </a>";
                    break;
            }
            $eilute .= "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ceil($rowCount / $per_page) . "'> ".ceil($rowCount / $per_page)." </a>";
        }
        $eilute .= ( (abs(($page)*$per_page)+1) > $rowCount ? " " : "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page+1) . "'> Next </a>" );
        return $eilute;
    }

    static function checkFormInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}