<?
    function Atom($stAtom, $stTemplate = CURRENT_TEMPLATE, $arParams = array()) {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/ncms/atoms/" . $stAtom)) {
            include($_SERVER["DOCUMENT_ROOT"] . "/ncms/atoms/" . $stAtom . "/atom.php");
        }
    }