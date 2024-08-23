<?php
$mysqli = new mysqli("localhost", "root", "", "to_do_app", 3308);

    if ($mysqli->connect_errno) {
        echo "Failed Connection: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

