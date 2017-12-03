<?
if (!SITE_ROOT) die("This script must be called");
    function Atom($stAtom, $stTemplate = CURRENT_TEMPLATE, $arParams = array()) {
        if (file_exists(SITE_ROOT . "/ncms/atoms/" . $stAtom)) {
            include(SITE_ROOT . "/ncms/atoms/" . $stAtom . "/atom.php");
        }
    }