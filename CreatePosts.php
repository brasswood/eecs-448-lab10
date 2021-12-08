<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set('display_startup_errors', 1);
    echo "<html><head><title>Create Post</title></head><body>";

    function success() {
        echo "<h1>Post saved.</h1>";
    }

    $mysqli = new mysqli("mysql.eecs.ku.edu", "***REMOVED***", "***REMOVED***", "***REMOVED***");

    if ($mysqli->connect_errno) {
        echo "<h1>Could not connect to DB</h1></body></html>";
        exit();
    }
    // Ensure nonempty string
    if ($_POST["username"] == "") {
        echo "<h1>Username cannot be empty</h1></body></html>";
        exit();
    }

    if ($_POST["content"] == "") {
        echo "<h1>Post cannot be empty</h1></body></html>";
        exit();
    }
    // Prevent SQL injection by preparing and executing a statement
    $stmt = $mysqli->prepare("INSERT INTO Posts (content, author_id) VALUES (?, ?);");
    $stmt->bind_param("ss", $_POST["content"], $_POST["username"]);
    $result = $stmt->execute();

    if ($result == false) {
        echo "<h1>Insertion into DB failed.</h1><p>Maybe you haven't registered your username yet?</p>";
    }
    else {
        success();
    }

    echo "</body></html>";
    $mysqli->close();

?>