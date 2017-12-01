<?
    require_once("../config.php");
    require_once(SITE_ROOT . "/ncms/init.php");

    {
        define("CURRENT_TEMPLATE", "admin");
        $arFrame = array(
            "title" => "NCMS - Admin",
            "html_title" => "NCMS - Admin",
        );
        global $arFrame;
        define("FRAME_NAME", "Admin");
    }

    include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/header.php");
    include_once(SITE_ROOT . "/ncms/frames/" . FRAME_NAME . "/templates/admin/template.php");
    include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");