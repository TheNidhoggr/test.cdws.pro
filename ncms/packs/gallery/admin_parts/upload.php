<?
if (!SITE_ROOT) die("This script must be called");
require_once("../../../../config.php");
require_once(SITE_ROOT . "/ncms/init.php");
session_start();

if (Auth::IsAuthorized()) {
    function image_resize(
        $source_path,
        $destination_path,
        $newwidth,
        $newheight = FALSE
    ) {

        ini_set("gd.jpeg_ignore_warning", 1); // иначе на некотоых jpeg-файлах не работает

        list($oldwidth, $oldheight, $type) = getimagesize($source_path);

        switch ($type) {
            case IMAGETYPE_JPEG: $typestr = 'jpeg'; break;
            case IMAGETYPE_GIF: $typestr = 'gif' ;break;
            case IMAGETYPE_PNG: $typestr = 'png'; break;
        }
        $function = "imagecreatefrom$typestr";
        $src_resource = $function($source_path);

        if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
        elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
        $destination_resource = imagecreatetruecolor($newwidth,$newheight);

        imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

        if ($type = 2) { # jpeg
            imageinterlace($destination_resource, 1); // чересстрочное формирование изображение
            imagejpeg($destination_resource, $destination_path, "100");
        }
        else { # gif, png
            $function = "image$typestr";
            $function($destination_resource, $destination_path);
        }

        imagedestroy($destination_resource);
        imagedestroy($src_resource);
    }

    $arGallerySettings = CdwsGallery::FetchSettings();

    $stUploadDir = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"];
    foreach ($_FILES["userfile"]["tmp_name"] as $file) {
        $stNewName = date("YmdHis") . rand(100000, 999999) . ".jpg";
        if (move_uploaded_file($file, $stUploadDir . "/" . $stNewName)) {
            image_resize($stUploadDir . "/" . $stNewName, $stUploadDir . "/thumbnails/" . $stNewName, 256);
            $stQuery = "INSERT INTO `ncms_pack_cdws_gallery_images` (`id`, `upload_src`, `tags`, `name`, `description`, `priced`, `pool`, `pool_order`) VALUES ('0', '".$connect->real_escape_string($stNewName)."', '', '', '', '0', '0', '0')";
            $connect->query($stQuery);
        }
    }
    header("Location: ../../../?page=cdws.gallery&cat=images&action=edit");
} else {
    die("Permission denied");
}