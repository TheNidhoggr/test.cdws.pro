<?
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/init.php");

    {
        define("CURRENT_TEMPLATE", "main");
        $arFrame = array(
            "title" => "Create & Develop Workshop",
            "html_title" => "Create &amp; Develop Workshop",
        );
        global $arFrame;
        define("FRAME_NAME", "MainPage");
    }

    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/templates/" . CURRENT_TEMPLATE . "/header.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/frames/" . FRAME_NAME . "/templates/" . CURRENT_TEMPLATE . "/template.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");