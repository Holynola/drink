<?php

if (isset($_GET['tri']) && ($_GET['condi'])) {
    
    if ($tri == "total") {
        $divCon = "";
    } else {
        $tri = $_GET['tri'];
        $divCon = $_GET['condi'];
    }
} else {
    $divCon = "";
}