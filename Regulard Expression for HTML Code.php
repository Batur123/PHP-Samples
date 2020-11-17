<?php
/*
* Saving HTML Code to the database (Regulard Expression)
* $conn -> SQL Connection
*/

$SecuredHTMLCodeforQuerty = stripcslashes(preg_replace("(\r\n|\n|\r)", "<br />", mysqli_real_escape_string($conn,$_POST["HTMLCodePost"])));

?>