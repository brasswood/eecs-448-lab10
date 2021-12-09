<html>
    <head>
        <title>Posts Deleted</title>
        <style>table, th, td { border: 1px solid black; border-collapse: collapse }</style>
    </head>
    <body>
        <?php
            $mysqli = new mysqli("mysql.eecs.ku.edu", "***REMOVED***", "***REMOVED***", "***REMOVED***");

            if ($mysqli->connect_errno) {
                echo "<h1>Could not connect to DB</h1>";
                exit();
            }
            else if (!empty($_POST['toDelete'])){
                $query = "DELETE FROM Posts WHERE post_id IN (?";
                foreach (array_slice($_POST['toDelete'], 1) as $_) {
                    $query .= ", ?";
                }
                $query .= ")";
                $stmt = $mysqli->prepare($query);
                $type_str = "";
                foreach ($_POST['toDelete'] as $_) {
                    $type_str .= "i";
                }
                $array_copy = array_map("intval", $_POST['toDelete']);
                $stmt->bind_param($type_str, ...$array_copy);
                $result = $stmt->execute();
                if (!$result) {
                    echo "<h1>Could not delete posts</h1>";
                    echo "<p>";
                    var_dump($stmt);
                    echo "</p>";
                }
                else {
                    echo "<table><thead><tr><th>Post IDs deleted</th></tr></thead><tbody>";
                    foreach ($_POST['toDelete'] as $toDelete) {
                        echo "<tr><td>{$toDelete}</td></tr>";
                    }
                    echo "</tbody></table>";
                }
            }
            else {
                echo "<h1>Nothing to delete</h1>";
            }
        ?>
    </body>
</html>

