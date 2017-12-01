<?
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/init.php");

    {
        define("CURRENT_TEMPLATE", "admin");
        $arFrame = array(
            "title" => "NCMS - Admin",
            "html_title" => "NCMS - Admin",
        );
        global $arFrame;
        define("FRAME_NAME", "Admin");
    }

    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/templates/" . CURRENT_TEMPLATE . "/header.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/frames/" . FRAME_NAME . "/templates/" . CURRENT_TEMPLATE . "/template.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");