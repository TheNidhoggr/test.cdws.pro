<?
if (!SITE_ROOT) die("This script must be called");
$arGallerySettings = CdwsGallery::FetchSettings();
?>
<a href="?page=cdws.gallery&cat=images&action=add">
    <div class="menuitem<?=NMenu::Active("action=add")?>" style="background-image:url('packs/gallery/admin_parts/icons/add.png')">
        Добавить
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
        <td>Стоимость сессии</td>
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
            <td><?=$arImage["priced"]?></td>
            <td>
                <button onclick="location.href='?page=cdws.gallery&cat=images&action=editinpool&id=<?=$arImage["id"]?>'">[<?=$arImage["pool"]?>]</button>
            </td>
            <td><?=$arImage["pool_order"]?></td>
            <td></td>
        </tr>
    <?endwhile;?>
</table>
