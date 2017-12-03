<?
if (!SITE_ROOT) die("This script must be called");
require_once($_SERVER["DOCUMENT_ROOT"] . "/config.php");
require_once(SITE_ROOT . "/ncms/init.php");

$stQuery = "CREATE TABLE 
    `u0429599_cdws`.`ncms_pack_cdws_gallery_settings` 
    ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `key` VARCHAR(50) NOT NULL , 
        `value` VARCHAR(150) NOT NULL , 
        PRIMARY KEY (`id`)
    ) 
    ENGINE = InnoDB";
$connect->query($stQuery) or die($connect->error);

$stQuery = "CREATE TABLE 
    `u0429599_cdws`.`ncms_pack_cdws_gallery_tags` 
    ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `tagname` VARCHAR(50) NOT NULL , 
        `tagtype` VARCHAR(50) NOT NULL , 
        PRIMARY KEY (`id`), 
        UNIQUE (`tagname`)
    ) 
    ENGINE = InnoDB";
$connect->query($stQuery) or die($connect->error);

$stQuery = "CREATE TABLE `u0429599_cdws`.`ncms_pack_cdws_gallery_images` 
    ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `upload_src` VARCHAR(500) NOT NULL , 
        `tags` VARCHAR(1500) NOT NULL , 
        `name` VARCHAR(50) NOT NULL , 
        `description` VARCHAR(1500) NOT NULL , 
        `priced` INT(7) NOT NULL , 
        `pool` INT(10) NOT NULL , 
        `pool_order` INT(10) NOT NULL , 
        PRIMARY KEY (`id`), 
        UNIQUE (`upload_src`)
    ) 
    ENGINE = InnoDB";
$connect->query($stQuery) or die($connect->error);

$stQuery = "CREATE TABLE 
    `u0429599_cdws`.`ncms_pack_cdws_gallery_pools` 
    ( 
        `id` INT(10) NOT NULL AUTO_INCREMENT , 
        `name` VARCHAR(50) NOT NULL , 
        `description` VARCHAR(1500) NOT NULL , 
        `tags` VARCHAR(1500) NOT NULL , PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB";
$connect->query($stQuery) or die($connect->error);

die("Pack installed");