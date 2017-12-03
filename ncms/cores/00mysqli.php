<?
if (!SITE_ROOT) die("This script must be called");
    $connect = mysqli_connect($DB["SERVER"], $DB["USER"], $DB["PASSWORD"], $DB["DATABASE"]);
    $connect->set_charset("UTF-8");