<?
    $dirPacksDir = SITE_ROOT . "/ncms/packs";
    $arPacks = scandir($dirPacksDir);
    foreach ($arPacks as $dirPack) {
        $stAdminFile = $dirPacksDir . "/" . $dirPack . "/admin.php";
        if (file_exists($stAdminFile)) {
            include_once($stAdminFile);
        }
    }