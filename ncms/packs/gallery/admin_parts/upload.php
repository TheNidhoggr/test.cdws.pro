<?
if (!SITE_ROOT) die();
require_once("../../../../config.php");
require_once(SITE_ROOT . "/ncms/init.php");
session_start();

if (Auth::IsAuthorized()) {
    include_once("thumbnail_func.php");

    $arGallerySettings = CdwsGallery::FetchSettings();

    $stUploadDir = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"];
    foreach ($_FILES["userfile"]["tmp_name"] as $file) {
        $stNewName = date("YmdHis") . rand(100000, 999999) . ".jpg";
        if (move_uploaded_file($file, $stUploadDir . "/" . $stNewName)) {
            image_resize($stUploadDir . "/" . $stNewName, $stUploadDir . "/thumbnails/" . $stNewName, $arGallerySettings["thumb_width"], $arGallerySettings["thumb_height"]);
            $stQuery = "INSERT INTO `ncms_pack_cdws_gallery_images` (`id`, `upload_src`, `tags`, `name`, `description`,`timestamp` , `priced`, `pool`, `pool_order`) VALUES ('0', '".$connect->real_escape_string($stNewName)."', '', '', '','".date("YmdHis")."' , '0', '', '0')";
            $connect->query($stQuery);
        }
    }
    header("Location: ../../../?page=cdws.gallery&cat=images&action=edit");
} else {
    die("Permission denied");
}