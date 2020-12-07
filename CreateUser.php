<?php

$username = $_POST["input"];

$mysqli = new mysqli("mysql.eecs.ku.edu", "seancunningha", "fohNuph4",
"seancunningha");
/* check connection */
if ($mysqli->connect_errno) {
 printf("Connect failed: %s\n", $mysqli->connect_error);
 exit();
}

$userExists = false;

$query = "SELECT {$username} FROM Users";
if ($result = $mysqli->query($query)) {
 /* fetch associative array */
 while ($row = $result->fetch_assoc()) {
 if ($row["user_id"] == $username) {
     global $userExists;
     $userExists = true;
 break;
 }
 }
 /* free result set */
 $result->free();
}

if ($userExists) {
    echo "User {$username} cannot be created because they already exist.\n";
} else {
    $insertString = "INSERT INTO Users (user_id) VALUES ('{$username}')";
    if ($mysqli->query($insertString)) {
        echo "User {$username} has been successfully created.\n";
        $result->free();
    } else {
        echo "Error creating user {$username}: ", $mysqli->error, "\n";
        $result->free();
    }
    
}

/* close connection */
$mysqli->close();
?>
