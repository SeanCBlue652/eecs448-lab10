<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "seancunningha", "fohNuph4",
"seancunningha");
/* check connection */
if ($mysqli->connect_errno) {
 printf("Connect failed: %s\n", $mysqli->connect_error);
 exit();
}
$query = "SELECT Name, CountryCode FROM City ORDER by ID DESC LIMIT 50,5";
if ($result = $mysqli->query($query)) {
 /* fetch associative array */
 while ($row = $result->fetch_assoc()) {
 printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
 }
 /* free result set */
 $result->free();
}
/* close connection */
$mysqli->close();
?>
