<?
session_start();
require_once("../config.php");
require_once(SITE_ROOT . "/ncms/init.php");

{
    define("CURRENT_TEMPLATE", "admin");
    $arFrame = array(
        "title" => "Gallery",
        "html_title" => "Gallery",
    );
    global $arFrame;
    define("FRAME_NAME", "Gallery");
}

include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/header.php");
include_once(SITE_ROOT . "/ncms/frames/" . FRAME_NAME . "/templates/" . CURRENT_TEMPLATE . "/template.php");
include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");