<?
function onGet($getKey) {
    $result = false;
    if (isset($_GET[$getKey]) == true) {
        $result = $_GET[$getKey];
    }
    return $result;
}
function onPost($postKey) {
    $result = false;
    if (isset($_POST[$postKey]) == true) {
        $result = $_POST[$postKey];
    }
    return $result;
}