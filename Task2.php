<html>
<head>
    <title>Book Info</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Darius
 * Date: 2017.02.10
 * Time: 20:52
 */

echo date("h:i:s") . "<br>";
?>

<a href="Task1.php"> Back to Book List </a><br>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}

$name= $_GET["name"];

$sql = "SELECT id, name, year, genre FROM MyBooks WHERE myBooks.name='$name'";
$result = $conn->query($sql);

echo "<table border='1'><tr><th>Id</th><th>Name</th><th>Year</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr><th>" . $row["id"] . "</th><th>" . $row["name"] . "</th><th> " . $row["year"]. "</th></tr>";
}
echo "</table>";

$conn->close();
?>

</body>
</html>