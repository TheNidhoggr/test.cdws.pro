<?
if (!SITE_ROOT) die("This script must be called");
    mb_internal_encoding("UTF-8");
    $arKernel = array(
        SITE_ROOT . "/ncms/cores"
    );

    foreach ($arKernel as $stDirCore) {
        $arDirCore = scandir($stDirCore);
        foreach ($arDirCore as $stCore) {
            if (is_dir($stCore) != true) {
                include_once($stDirCore . "/" . $stCore);
            }
        }
    }

    $arSite = array(
        "lang" => "ru",
    );
    global $arSite;