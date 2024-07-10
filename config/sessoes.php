<?php 

session_start();
foreach ($_SESSION as $key => $value) {
    echo "<strong>$key: </strong>";

    echo $value;
    echo "<br>";
}
?>