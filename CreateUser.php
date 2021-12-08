<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('display_startup_errors', 1);
    echo "<html><head><title>Create User</title></head><body>";

    function success() {
        echo "<h1>Success</h1>";
    }

    $mysqli = new mysqli("mysql.eecs.ku.edu", "***REMOVED***", "***REMOVED***", "***REMOVED***");

    echo "<html><body>";
    if ($mysqli->connect_errno) {
        echo "<h1>Could not connect to DB</h1></body></html>";
        exit();
    }
    // Ensure nonempty string
    if ($_POST["username"] == "") {
        echo "<h1>Username cannot be empty</h1></body></html>";
        exit();
    }
    // Prevent SQL injection by preparing and executing a statement
    $stmt = $mysqli->prepare("INSERT INTO Users (user_id) VALUES (?);");
    $stmt->bind_param("s", $_POST["username"]);
    $result = $stmt->execute();

    // SQL injection prone (multi_query is especially vulnerable)
    // $query = "INSERT INTO Users (user_id) VALUES ('{$_POST['username']}')";
    // e.g. $_POST["username"] = "ha'); TRUNCATE TABLE Users; INSERT INTO Users (user_id) VALUES ('pwned"
    // $result = $mysqli->multi_query($query);
    if ($result == false) {
        echo "<h1>Insertion failed</h1>";
    }
    else {
        success();
    }

    echo "</body></html>";
    $mysqli->close();

?>