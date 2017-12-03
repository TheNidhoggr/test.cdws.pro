<?
if (!SITE_ROOT) die("This script must be called");
class CdwsGallery
{
    function FetchSettings() {
        global $connect;
        $rsGallerySettingsData = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_settings`");
        $arGallerySettings = array();
        while($arGallerySettingsItem = $rsGallerySettingsData->fetch_assoc()) {
            $arGallerySettings[$arGallerySettingsItem["key"]] = $arGallerySettingsItem["value"];
        }
        return $arGallerySettings;
    }
}