<?
if (!SITE_ROOT) die("This script must be called");
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
function safeGet($getKey) {
    global $connect;
    return $connect->real_escape_string(onGet($getKey));
}
function safePost($postKey) {
    global $connect;
    return $connect->real_escape_string(onGet($postKey));
}