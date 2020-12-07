<?php

$username = $_POST["username"];
$userpost = $_POST["input"];

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
        $insertString = "INSERT INTO Posts (author_id, content) VALUES ('{$username}', '{$userpost}')";
        if ($mysqli->query($insertString)) {
            echo "Post {$userpost} has been successfully added for the user: {$username}.\n";
            $result->free();
        } else {
            echo "Error creating post: ", $mysqli->error, "\n";
            $result->free();
        }
 break;
 }
 if ($userExists == false) {
    echo "Post cannot be created for the user {$username} because that user does not exist.\n";  
 }
 }
 /* free result set */
 $result->free();
}

if ($userpost == "" || $userpost == null) {
    echo "Post cannot be blank.\n";
} else {
    
}



/* close connection */
$mysqli->close();
?>
