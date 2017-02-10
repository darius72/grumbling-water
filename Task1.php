<html>
<head>
    <title>Book List</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 20:46
 */

$per_page = 10;
$order = isset($_GET['order']) ? $_GET['order'] : "id";
$CUR_PAGE = (isset($_GET['page']) AND intval($_GET['page'])>1) ? intval($_GET['page']) : 1;
$start = abs(($CUR_PAGE-1)*$per_page);

echo date("h:i:s") . "<br>";
echo 'This is my book list:</p>';



?>

    <a href="Task1.php?page=<?php echo $CUR_PAGE-1 ?>&order=<?php echo $order ?>"> <?php echo "<<" ?> </a>
    Page <?php echo $CUR_PAGE ?>
    <a href="Task1.php?page=<?php echo $CUR_PAGE+1 ?>&order=<?php echo $order ?>"> >> </a> <br>

<?php
if ($result->num_rows == 0)
    die("No results");

echo "<table border='1'><tr><th>Id</th><th>";
?>
    <a href="Task1.php?page=<?php echo $CUR_PAGE ?>&order=name"> Name </a>
<?php
echo "</th><th>";
?>
    <a href="Task1.php?page=<?php echo $CUR_PAGE ?>&order=year"> Year </a>
<?php
echo "</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr><th>". $row["id"] . "</th><th>";
    ?>

    <a href="Task2.php?name=<?php echo $row["name"]?>"> <?php echo $row["name"] ?> </a>

    <?php echo "</th><th>" . $row["year"] . "</th>";
}
echo "</table>";

$conn->close();
?>

