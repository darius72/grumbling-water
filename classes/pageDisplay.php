<?php

/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.12
 * Time: 02:58
 */
class pageDisplay
{
    static function pageLink ($page, $orderby, $asc, $show_sides_count, $per_page, $rowCount ) {
        $eilute = "Page: " . "<br>";
        $eilute .= ($page>1 ? "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page-1) . "'> Previous </a>" : " ");
        for ($i = ($show_sides_count); $i>=1; $i--) {
            $eilute .= ($page>$i ? "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page-$i) . "'> " . ($page-$i) . " </a>" : " ");
        }
        $eilute .= " " . $page . " ";
        for ($i = 1; $i<= ($show_sides_count); $i++) {
            $eilute .= ( (abs(($page-1+$i)*$per_page)+$i) > $rowCount ? " " : "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page+$i) . "'> " . ($page+$i) . " </a>" );
        }
        $eilute .= ( (abs(($page)*$per_page)+1) > $rowCount ? " " : "<a href='index.php?orderby=" . $orderby . "&asc=" . $asc . "&page=" . ($page+1) . "'> Next </a>" );
        return $eilute;
    }
}