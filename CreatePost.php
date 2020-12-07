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

function checkForUser() {
    $query = "SELECT {$username} FROM Users";
if ($result = $mysqli->query($query)) {
 /* fetch associative array */

 while ($row = $result->fetch_assoc()) {
 if ($row["user_id"] == $username) {
        $result->free();
        return(true);
 }
 
 /* free result set */
 $result->free();
 return(false);
}
}
}



if ($userpost == "" || $userpost == null) {
    echo "Post cannot be blank.\n";
}


if (checkForUser() == false) {
    echo "Post cannot be created for the user {$username} because that user does not exist.";  
 }
else {
    $insertString = "INSERT INTO Posts (author_id, content) VALUES ('{$username}', '{$userpost}')";
        if ($mysqli->query($insertString)) {
            echo "Post {$userpost} has been successfully added for the user: {$username}.\n";
        } else {
            echo "Error creating post: ", $mysqli->error, "\n";
        }
}




/* close connection */
$mysqli->close();
?>
