<?
if (!SITE_ROOT) die();

global $connect;

$arResult = array();
$stQuery = "SELECT * FROM `ncms_pack_cdws_gallery_images` ORDER BY `id` DESC LIMIT 0,12";
$rsImg = $connect->query($stQuery) or die($connect->error);
$arResult["ITEMS"] = array();
while ($arImg = $rsImg->fetch_assoc()) {
    $arResult["ITEMS"][] = $arImg;
}
$arResult["TAGS"] = array();
$stQuery = "SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC";
$rsTags = $connect->query($stQuery);
while($arTag = $rsTags->fetch_assoc()) {
    if (is_array($arResult["TAGS"][$arTag["tagtype"]]) == false) {
        $arResult["TAGS"][$arTag["tagtype"]] = array();
    }
    array_push($arResult["TAGS"][$arTag["tagtype"]], array(
        "name" => $arTag["tagname"],
        "code" => $arTag["code"]
    ));
}

include_once("templates/" . $stTemplate . "/template.php");