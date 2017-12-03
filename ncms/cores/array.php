<?
if (!SITE_ROOT) die("This script must be called");
function is_in_array($arSource, $valSearch) {
    $result = false;
    foreach ($arSource as $itemSource) {
        if ($itemSource === $valSearch) {
            $result = true;
        }
    }
    return $result;
}