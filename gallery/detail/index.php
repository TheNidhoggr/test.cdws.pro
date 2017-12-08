<?
session_start();
require_once("../../config.php");
require_once(SITE_ROOT . "/ncms/init.php");

{
    define("CURRENT_TEMPLATE", "gallery");
    $arFrame = array(
        "title" => "Gallery",
        "html_title" => "Gallery",
    );
    global $arFrame;
    define("FRAME_NAME", "Gallery");
}

include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/header.php");
?>
<?
Atom("cdws.gallery.mini");
?>
<?
include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");