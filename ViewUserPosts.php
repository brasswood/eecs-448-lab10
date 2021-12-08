<?php
    $mysqli = new mysqli("mysql.eecs.ku.edu", "***REMOVED***", "***REMOVED***", "***REMOVED***");
    echo "<html><head><title>{$_GET['user']}'s posts</title><style>table, th, td { border: 1px solid black; border-collapse: collapse }</style></head><body>";
    if ($mysqli->connect_errno) {
        echo "<h1>Could not connect to DB</h1></body></html>";
        exit();
    }

    // Prevent SQL injection by preparing and executing a statement
    $stmt = $mysqli->prepare("SELECT content FROM Posts WHERE author_id=?;");
    $stmt->bind_param("s", $_GET["user"]);
    if (!($stmt->execute())) {
        echo "<h1>Could not retrieve {$_GET['user']}'s posts</h1></body></html>";
    }
    else {
        $result = $stmt->get_result();
        echo "<table><thead><tr><th>Posts from {$_GET['user']}</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['content']}</td></tr>";
        }
        echo "</tbody></table>";
        $result->free();
    }
    $mysqli->close();
    echo "</body></html>";
?>