<?php

echo "<html><head><style>table, th, td {border: 1px solid black; border-collapse: collapse;}</style><title>View Users</title></head><body>";

$mysqli = new mysqli("mysql.eecs.ku.edu", "***REMOVED***", "***REMOVED***", "***REMOVED***");
if ($mysqli->connect_errno) {
    echo "<h1>Could not connect to DB</h1></body></html>";
    exit();
}
echo "<table style=><thead><th>Users</th></thead><tbody>";
$query = "SELECT user_id FROM Users";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        printf("<tr><td>%s</td></tr>", $row["user_id"]);
    }
    $result->free();
}
echo "</tbody></table>";
echo "</body></html>";
$mysqli->close();
?>