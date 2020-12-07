<?php

$username = $_POST["username"];
$userpost = $_POST["input"];

$userExists = false;

$resultset = "";

$mysqli = new mysqli("mysql.eecs.ku.edu", "seancunningha", "fohNuph4",
"seancunningha");
/* check connection */
if ($mysqli->connect_errno) {
 printf("Connect failed: %s\n", $mysqli->connect_error);
 exit();
}

function checkForUser($mysqli, $userExists, $resultset) {
    $userExists = false;
    $query = "SELECT * FROM Users";
if ($result = $mysqli->query($query)) {
 /* fetch associative array */

 while ($row = $result->fetch_assoc()) {
     $resultset = $resultset.$row["user_id"]."\n";
 if (strcmp(trim($row["user_id"]), trim($username)) == 0) {
        $userExists = true;
 }
}
 
 /* free result set */
 $result->free();
}
}

checkForUser($mysqli, $userExists, $resultset);

if ($userpost == "" || $userpost == null) {
    echo "Post cannot be blank.\n";
} else {
    if ($userExists) {
        $insertString = "INSERT INTO Posts (author_id, content) VALUES ('{$username}', '{$userpost}')";
            if ($mysqli->query($insertString)) {
                echo "Post {$userpost} has been successfully added for the user: {$username}.\n";
            } else {
                echo "Error creating post: ", $mysqli->error, "\n";
            }
        
     }
    else {
        echo "Post cannot be created for the user {$username} because that user does not exist. Existing users: {$resultset}";  
    }
}







/* close connection */
$mysqli->close();
?>
