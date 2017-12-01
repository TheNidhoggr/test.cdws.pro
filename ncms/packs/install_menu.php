<?
    require_once("../../config.php");
    require_once("../init.php");

    $stQuery = "CREATE TABLE
      `menu`
      (
        `id` INT(10) NOT NULL AUTO_INCREMENT ,
        `menuid` VARCHAR(64) NOT NULL ,
        `parentid` INT(10) NOT NULL ,
        `name` VARCHAR(512) NOT NULL ,
        `link` VARCHAR(512) NOT NULL DEFAULT '#' ,
        PRIMARY KEY (`id`)
      )
      ENGINE = InnoDB";

    $connect->query($stQuery) or die($connect->error);
    die("Pack installed");