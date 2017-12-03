<?
if (!SITE_ROOT) die("This script must be called");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
    require_once(SITE_ROOT . "/ncms/init.php");

    $stQuery = "CREATE TABLE
      `ncms_menu`
      (
        `id` INT(10) NOT NULL AUTO_INCREMENT ,
        `menuid` VARCHAR(64) NOT NULL ,
        `parentid` INT(10) NOT NULL ,
        `name` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
        `order` INT(10) NOT NULL ,
        `link` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '#' ,
        PRIMARY KEY (`id`)
      )
      ENGINE = InnoDB";

    $connect->query($stQuery) or die($connect->error);
    die("Pack installed");