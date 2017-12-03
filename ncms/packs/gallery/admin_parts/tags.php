<?
if (!SITE_ROOT) die("This script must be called");
?>
<a href="?page=cdws.gallery&cat=tags&action=newtag">
    <div class="menuitem<?=NMenu::Active("action=newtag")?>" style="background-image:url('packs/gallery/admin_parts/icons/add.png')">
        Добавить
    </div>
</a>
<hr />
<?
$rsTags = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC");
switch(onGet("action")) {
    case "newtag": {
        ?>
            <script>
                transliterate = (
                    function() {
                        var
                            rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
                            eng = "shh sh ch cz yu ya yo zh `` y' e` a b v g d e z i j k l m n o p r s t u f x `".split(/ +/g)
                        ;
                        return function(text, engToRus) {
                            var x;
                            for(x = 0; x < rus.length; x++) {
                                text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
                                text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
                            }
                            text = text.replace(RegExp(' ', 'g'), '_');
                            return text;
                        }
                    }
                )();
                function translit(elem) {
                    var res = transliterate(elem.value);
                    document.getElementById('code').value = res.toLowerCase();
                }
            </script>
            <form>
                <input type="hidden" name="page" value="cdws.gallery" />
                <input type="hidden" name="cat" value="tags" />
                <input type="hidden" name="action" value="addnewtag" />
                Название: <br />
                <input type="text" name="tagname" onchange="translit(this)" /><br />
                Тип: <br />
                <select name="tagtype">
                    <option value="author">Авторство</option>
                    <option value="models">Модели</option>
                    <option value="places">Места</option>
                    <option value="colors">Цвета</option>
                    <option value="general" selected>Общие</option>
                </select>
                <br />
                Код (лат.) <br />
                <input type="text" name="code" id="code" /><br />
                <input type="submit" value="Добавить">
            </form>
            <hr />
        <?
        break;
    }
    case "addnewtag": {
        $stQuery = "INSERT INTO `ncms_pack_cdws_gallery_tags`
            (
                `id`,
                `tagname`,
                `tagtype`,
                `code`
            )
            VALUES (
                '0',
                '".safeGet("tagname")."',
                '".safeGet("tagtype")."',
                '".safeGet("code")."'
            )
        ";
        $res = $connect->query($stQuery);
        if ($res == 1) {
            IMsg::Success("Тег добавлен");
            $rsTags = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC");
        } else {
            IMsg::Error($connect->error);
        }
        break;
    }
    case "edit": {
        $rsTag = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` WHERE `id` = '".safeGet("id")."'");
        $arTag = $rsTag->fetch_assoc();
        ?>
            <form>
                <input type="hidden" name="page" value="cdws.gallery" />
                <input type="hidden" name="id" value="<?=onGet("id")?>">
                <input type="hidden" name="cat" value="tags" />
                <input type="hidden" name="action" value="edittag" />
                Название: <br />
                <input type="text" name="tagname" value="<?=$arTag["tagname"]?>" /><br />
                Тип: <br />
                <select name="tagtype">
                    <?$stTagtype = $arTag["tagtype"];?>
                    <option value="author"<?if($stTagtype == "author"):?> selected<?endif?>>Авторство</option>
                    <option value="models"<?if($stTagtype == "models"):?> selected<?endif?>>Модели</option>
                    <option value="places"<?if($stTagtype == "places"):?> selected<?endif?>>Места</option>
                    <option value="colors"<?if($stTagtype == "colors"):?> selected<?endif?>>Цвета</option>
                    <option value="general"<?if($stTagtype == "general"):?> selected<?endif?>>Общие</option>
                </select>
                <br />
                Код (лат.) <br />
                <input type="text" name="code" value="<?=$arTag["code"]?>" /><br />
                <input type="submit" value="Изменить">
            </form>
            <hr />
        <?
        break;
    }
    case "edittag": {
        $stQuery = "UPDATE `ncms_pack_cdws_gallery_tags`
            SET
                `tagname` = '".safeGet("tagname")."',
                `tagtype` = '".safeGet("tagtype")."',
                `code` = '".safeGet("code")."'
            WHERE `id` = '".safeGet("id")."'
        ";
        $res = $connect->query($stQuery);
        if ($res == 1) {
            IMsg::Success("Тег изменен");
            $rsTags = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC");
        } else {
            IMsg::Error($connect->error);
        }
        break;
    }
    case "delete": {
        $stQuery = "DELETE FROM `ncms_pack_cdws_gallery_tags`
            WHERE `id` = '".safeGet("id")."'
        ";
        $res = $connect->query($stQuery);
        if ($res == 1) {
            IMsg::Success("Тег удален");
            $rsTags = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_tags` ORDER BY `tagname` ASC");
        } else {
            IMsg::Error($connect->error);
        }
    }
}
?>
<table width="100%">
    <tr style="font-weight: 700;">
        <td>Название</td>
        <td>Тип</td>
        <td>Код (лат.)</td>
        <td>Действия</td>
    </tr>
    <?while($arTag = $rsTags->fetch_assoc()):?>
        <tr>
            <td><?=$arTag["tagname"]?></td>
            <td><?=$arTag["tagtype"]?></td>
            <td><?=$arTag["code"]?></td>
            <td>
                <a href="?page=cdws.gallery&cat=tags&action=edit&id=<?=$arTag["id"]?>">Изменить</a>
                <br />
                <a href="#" onclick="if(confirm('Тег будет удален. Это действие будет невозможно отменить. Вы уверены?')) location.href='?page=cdws.gallery&cat=tags&action=delete&id=<?=$arTag["id"]?>'">Удалить</a>
            </td>
        </tr>
    <?endwhile?>
</table>
