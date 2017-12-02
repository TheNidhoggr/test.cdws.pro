<?
    session_start();
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
    if (Auth::isAuthorized() && $_SESSION["auth_groupid"] == 0) {
        include_once(SITE_ROOT . "/ncms/frames/" . FRAME_NAME . "/templates/admin/template.php");
    } else {
        Auth::AuthForm("admin");
    }
    include_once(SITE_ROOT . "/ncms/templates/" . CURRENT_TEMPLATE . "/footer.php");