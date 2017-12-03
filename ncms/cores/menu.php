<?
if (!SITE_ROOT) die("This script must be called");
class NMenu
{
    function Active($pattern) {
        $fullUri = $_SERVER["REQUEST_URI"] . $_SERVER["QUERY_STRING"];
        $pattern = trim($pattern, "?&=");
        $result = strripos($fullUri, $pattern);
        if ($result != false) {
            return " active";
        }
    }
}