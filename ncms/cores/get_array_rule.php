<?
function onGet($getKey) {
    $result = false;
    if (isset($_GET[$getKey]) == true) {
        $result = $_GET[$getKey];
    }
    return $result;
}