<?
if (!SITE_ROOT) die();
$arGallerySettings = CdwsGallery::FetchSettings();
?>
<a href="?page=cdws.gallery&cat=images&action=add">
    <div class="menuitem<?=NMenu::Active("action=add")?>" style="background-image:url('packs/gallery/admin_parts/icons/add.png')">
        Добавить
    </div>
</a>
<a href="?page=cdws.gallery&cat=images&action=replaceallthumbs">
    <div class="menuitem" style="background-image:url('packs/gallery/admin_parts/icons/add.png')">
        Изменить эскизы
    </div>
</a>
<hr />
<?
switch(onGet("action")) {
    case "add": {
        ?>
            <form action="packs/gallery/admin_parts/upload.php" method="post" enctype="multipart/form-data">
                Файлы:<br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input name="userfile[]" type="file" /><br />
                <input type="submit" value="Отправить" />
            </form>
        <?
        break;
    }
    case "edittags": {
        ?>
            <button style="border:2px solid white;" onclick="saveChanges()">Сохранить</button>
        <?
        $rsImage = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_images` WHERE `id` = '".safeGet("id")."'");
        $arImage = $rsImage->fetch_assoc();
        $arImageTagCodes = explode(" ", $arImage["tags"]);
        $rsAllTags = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC");
        $arTags = array();
        while($arTag = $rsAllTags->fetch_assoc()) {
            if (is_array($arTags[$arTag["tagtype"]]) == false) {
                $arTags[$arTag["tagtype"]] = array();
            }
            array_push($arTags[$arTag["tagtype"]], array(
                "name" => $arTag["tagname"],
                "code" => $arTag["code"]
            ));
        }
        ?>
            <script>
                function toggleSelection(elem, e) {
                    e.preventDefault();
                    if (elem.className == "selected") {
                        elem.className = "";
                    } else {
                        elem.className = "selected";
                    }
                    return false;
                }
                function saveChanges() {
                    var allSelected = document.getElementById("tagsofimg").getElementsByClassName("selected");
                    var msg = "";
                    for (var i=0; i<allSelected.length; i++) {
                        msg += allSelected[i].getAttribute("code");
                        if (i != allSelected.length-1) msg += " ";
                    }
                    var link = "?page=cdws.gallery&cat=images&action=savetags&id=<?=onGet("id")?>&tags=" + msg;
                    location.href = link;
                }
            </script>
            <table width="100%" cellspacing="10px">
                <tr>
                    <td width="50%" style="vertical-align: top">
                        <img src="upload/<?=$arGallerySettings["uploaddir"]?>/<?=$arImage["upload_src"]?>" width="100%">
                    </td>
                    <td style="vertical-align: top">
                        <div id="tagsofimg">
                            <?foreach($arTags as $stTagtypeKey => $arTagtype):?>
                                <h3><?=$stTagtypeKey?></h3>
                                <?foreach($arTagtype as $arTag):?>
                                    <button code="<?=$arTag["code"]?>" onclick="toggleSelection(this, event)"<?if(is_in_array($arImageTagCodes, $arTag["code"])):?> class="selected"<?endif;?>><?=$arTag["name"]?></button>
                                <?endforeach;?>
                            <?endforeach;?>
                        </div>
                    </td>
                </tr>
            </table>
        <?
        break;
    }
    case "savetags": {
        $stQuery = "UPDATE `ncms_pack_cdws_gallery_images`
            SET `tags` = '" . safeGet("tags") . "'
            WHERE `id` = '" . safeGet("id") . "'";
        $res = $connect->query($stQuery);
        if ($res == 1) {
            IMsg::Success("Теги сохранены");
            print_r("<script>location.replace('?page=cdws.gallery&cat=images&action=edit')</script>");
        } else {
            IMsg::Error($connect->error);
        }
        break;
    }
    case "delete": {
        $stQuery = "SELECT * FROM `ncms_pack_cdws_gallery_images`
            WHERE `id` = '" . safeGet("id") . "'";
        $res = $connect->query($stQuery);
        if ($res->num_rows < 1) {
            IMsg::Error("Изображение с ID <b>" . safeGet("id") . "</b> не найдено");
        } else {
            $row = $res->fetch_assoc();
            $filename = $row["upload_src"];
            $filePath = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/" . $filename;
            $fileThumbPath = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/thumbnails/" . $filename;
            if (unlink($filePath) == true) IMsg::Success("Изображение удалено");
            else IMsg::Error("Ошибка удаления изображения");
            if (unlink($fileThumbPath) == true) IMsg::Success("Уменьшенное изображение удалено");
            else IMsg::Error("Ошибка удаления уменьшенного изображения");
            $stQuery = "DELETE FROM `ncms_pack_cdws_gallery_images`
                WHERE `id` = '" . safeGet("id") . "'";
            $res = $connect->query($stQuery);
            if ($res == 1) {
                IMsg::Success("Запись удалена из базы данных");
            } else {
                IMsg::Error("Ошибка удаления записи из базы данных");
            }
        }
        break;
    }
    case "replacethumb": {
        include_once("thumbnail_func.php");
        $stQuery = "SELECT * FROM `ncms_pack_cdws_gallery_images`
            WHERE `id` = '" . safeGet("id") . "'";
        $res = $connect->query($stQuery);
        $row = $res->fetch_assoc();
        $res = image_resize(SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/" . $row["upload_src"],
            SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/thumbnails/" . $row["upload_src"],
            intval($arGallerySettings["thumb_width"]),
            intval($arGallerySettings["thumb_height"])
        );
        if ($res != false) {
            IMsg::Success("Новая миниатюра создана");
        } else {
            IMsg::Warning("Скрипт отработал, но не вернул ответ. Очистите кеш браузера, обновите страницу галереи и проверьте результат визуально");
        }
        break;
    }
    case "replaceallthumbs": {
        include_once("thumbnail_func.php");
        $stQuery = "SELECT * FROM `ncms_pack_cdws_gallery_images`";
        $rsImages = $connect->query($stQuery) or die($connect->error);
        $resizeSuccessCount = 0;
        $resizeWarningCount = 0;
        while ($arImage = $rsImages->fetch_assoc()) {
            $filePath = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/" . $arImage["upload_src"];
            $fileThumbPath = SITE_ROOT . "/ncms/upload/" . $arGallerySettings["uploaddir"] . "/thumbnails/" . $arImage["upload_src"];
            $res = image_resize($filePath, $fileThumbPath, intval($arGallerySettings["thumb_width"]), intval($arGallerySettings["thumb_height"]));
            if ($res != false) {
                $resizeSuccessCount++;
            } else {
                $resizeWarningCount++;
            }
        }
        if ($resizeSuccessCount > 0) {
            IMsg::Success("Новые миниатюры созданы в количестве " . $resizeSuccessCount);
        } else {
            IMsg::Warning("Скрипт отработал, но не вернул ответ. Очистите кеш браузера, обновите страницу галереи и проверьте результат визуально");
        }
        break;
    }
}
$rsAllImages = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_images` ORDER BY `id` DESC");
?>
<hr />
<table width="100%">
    <tr style="font-weight: 700;">
        <td style="width:64px;"></td>
        <td>ID</td>
        <td>Имя файла</td>
        <td>Теги</td>
        <td>Название</td>
        <td>Описание</td>
        <td>Дата загрузки</td>
        <td>Пул</td>
        <td>Место в пуле</td>
        <td>Действия</td>
    </tr>
    <?while($arImage = $rsAllImages->fetch_assoc()):?>
        <tr>
            <td>
                <img src="upload/<?=$arGallerySettings["uploaddir"]?>/thumbnails/<?=$arImage["upload_src"]?>" width="64" height="64" />
            </td>
            <td><?=$arImage["id"]?></td>
            <td><?=$arImage["upload_src"]?></td>
            <td>
                <button<?if($arImage["tags"]==""):?> class="warning"<?endif?> onclick="location.href='?page=cdws.gallery&cat=images&action=edittags&id=<?=$arImage["id"]?>'">Изменить</button>
            </td>
            <td><?=$arImage["name"]?></td>
            <td><?=$arImage["description"]?></td>
            <?
            $arImageTimestamp = substr_replace($arImage["timestamp"],"." , 4, 0);
            $arImageTimestamp = substr_replace($arImageTimestamp,"." , 7, 0);
            $arImageTimestamp = substr_replace($arImageTimestamp,"<br />" , 10, 0);
            $arImageTimestamp = substr_replace($arImageTimestamp,":" , -2, 0);
            $arImageTimestamp = substr_replace($arImageTimestamp,":" , -5, 0);
            ?>
            <td><?=$arImageTimestamp?></td>
            <td>
                <button onclick="location.href='?page=cdws.gallery&cat=images&action=editinpool&id=<?=$arImage["id"]?>'">[<?=$arImage["pool"]?>]</button>
            </td>
            <td><?=$arImage["pool_order"]?></td>
            <td>
                <button onclick="if (confirm('Это действие бедут невозможно отменить. Продолжить?'))location.href='?page=cdws.gallery&cat=images&action=delete&id=<?=$arImage["id"]?>'">Удалить</button>
                <button onclick="location.href='?page=cdws.gallery&cat=images&action=replacethumb&id=<?=$arImage["id"]?>'">Пересоздать миниатюру</button>
            </td>
        </tr>
    <?endwhile;?>
</table>
