<?
if (!SITE_ROOT) die("This script must be called");
switch(onGet("action")) {
    case "savesettings": {
        $stQuery = "INSERT INTO `ncms_pack_cdws_gallery_settings`
                        (
                            `id`,
                            `key`,
                            `value`
                        )
                        VALUES
                            ('0', 'uploaddir', '".safeGet("uploaddir")."'),
                            ('0', 'readrights', '".safeGet("readrights")."'),
                            ('0', 'writerights', '".safeGet("writerights")."'),
                            ('0', 'thumb_height', '".safeGet("thumb_height")."'),
                            ('0', 'thumb_width', '".safeGet("thumb_width")."')
                        ON DUPLICATE KEY UPDATE
                            `id` = VALUES(`id`),
                            `key` = VALUES(`key`),
                            `value` = VALUES(`value`)
                    ";
        $res = $connect->query($stQuery);
        if ($res == 1) {
            IMsg::Success("Настройки сохранены");
            $rsPackData = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_settings`");
            $arPackData = array();
            while ($arPackDataItem = $rsPackData->fetch_assoc()) {
                $arPackData[$arPackDataItem["key"]] = $arPackDataItem["value"];
            }
        } else {
            IMsg::Error($connect->error);
        }
        break;
    }
}
?>
    <form>
        <input type="hidden" name="page" value="cdws.gallery" />
        <input type="hidden" name="cat" value="settings" />
        <input type="hidden" name="action" value="savesettings" />
        Папка для загруженных изображений: <br />
        /ncms/upload/<input type="text" name="uploaddir" value="<?=$arPackData["uploaddir"]?>" /><br />
        <br />
        Права доступа<br />
        На чтение <input type="number" name="readrights" value="<?=$arPackData["readrights"]?>" /><br />
        На запись <input type="number" name="writerights" value="<?=$arPackData["writerights"]?>" /><br />
        <br />
        Размер уменьшенного изображения<br />
        Ширина <input type="number" name="thumb_width" value="<?=$arPackData["thumb_width"]?>"><br />
        Высота <input type="number" name="thumb_height" value="<?=$arPackData["thumb_height"]?>"><br />
        <input type="submit" value="Сохранить настройки" />
    </form>