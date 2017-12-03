<?
    if (!SITE_ROOT) die("This script must be called");
if (onGet("page") == "menu") {
    ?>
        <h2><a href="?page=menu">Menu</a></h2>
        <a href="?page=menu&action=newitem<?if(onGet("show")):?>&show=<?=onGet("show")?><?endif?>">New item</a>
        <hr />
    <?
    show_msg();
    if (onGet("action") == "newitem") {
        ?>
            New menu item <br />
            <form>
                <input type="hidden" name="action" value="additem" />
                <input type="hidden" name="page" value="menu" />
                Menu ID: <br />
                <input type="text" name="menuid"<?if(onGet("show")):?> value="<?=onGet("show")?>"<?endif?> /><br />
                Name: <br />
                <input type="text" name="name" /><br />
                Link: <br />
                <input type="text" name="link" /><br />
                Parent ID: <br />
                <input type="number" name="parentid" value="0" /><br />
                <input type="submit" value="Save item" />
            </form>
            <hr />
        <?
    }
    if (onGet("show") == false && onGet("menuid") == false) {
        $rsMenuTypes = $connect->query("SELECT * FROM `menu`");
        $arMenuTypes = array();
        while ($dtMenuType = $rsMenuTypes->fetch_assoc()) {
            if (is_in_array($arMenuTypes, $dtMenuType["menuid"]) == false) {
                array_push($arMenuTypes, $dtMenuType["menuid"]);
            }
        }
        foreach ($arMenuTypes as $stMenuType) {
            ?>
                <a href="?page=menu&show=<?=$stMenuType?>"><?=$stMenuType?></a><br />
            <?    
        }
    }
    if (onGet("menuid")) {
        $stShow = onGet("menuid");
    } elseif (onGet("show")) {
        $stShow = onGet("show");
    }
        
    if (isset($stShow) == true){
        echo $stShow . "<hr />";
        if (onGet("action")) {
            switch (onGet("action")) {
                case "edit": {
                    $rsItem = $connect->query("SELECT * FROM `menu` WHERE `id` = '".onGet("id")."'");
                    $item = $rsItem->fetch_assoc();
                    echo "<pre>", print_r($item), "</pre>";
                    ?>
                        <form>
                            <input type="hidden" name="page" value="menu" />
                            <input type="hidden" name="show" value="<?=$stShow?>" />
                            <input type="hidden" name="id" value="<?=onGet("id")?>" />
                            <input type="hidden" name="action" value="savechanges" />
                            Name: <br />
                            <input type="text" name="name" value="<?=$item["name"]?>" /><br />
                            Link: <br />
                            <input type="text" name="link" value="<?=$item["link"]?>" /><br />
                            Parent ID: <br />
                            <input type="number" name="parentid" value="<?=$item["parentid"]?>" /><br />
                            <input type="submit" value="Save changes" />
                        </form>
                        <hr />
                    <?
                    break;
                }
                case "savechanges": {
                    $query = "UPDATE `menu`
                        SET
                            `name` = '".onGet("name")."',
                            `link` = '".onGet("link")."',
                            `parentid` = '".onGet("parentid")."'
                        WHERE `id` = '".onGet("id")."'";
                    $res = $connect->query($query);
                    if ($res == 1) {
                        IMsg::Success("Changes saved");
                    } else {
                        IMsg::Error($connect->error);
                    }
                    break;
                }
                case "additem": {
                    $query = "INSERT INTO `menu`
                        (
                            `id`,
                            `menuid`,
                            `name`,
                            `link`,
                            `parentid`
                        )
                        VALUES (
                            '0',
                            '".onGet("menuid")."',
                            '".onGet("name")."',
                            '".onGet("link")."',
                            '".onGet("parentid")."'
                        )";
                    $res = $connect->query($query);
                    if ($res == true) {
                        IMsg::Success("Menu item added");
                    } else {
                        IMsg::Error($connect->error);
                    }
                    break;
                }
                case "delete": {
                    $query = "DELETE FROM `menu`
                        WHERE
                            `id` = '".onGet("id")."'
                            OR `parentid` = '".onGet("id")."'
                    ";
                    $res = $connect->query($query);
                    if ($res == true) {
                        IMsg::Success("Menu item deleted");
                    } else {
                        IMsg::Error($connect->error);
                    }
                    break;
                }
            }
        }
        $rsMenu = $connect->query("SELECT * FROM `menu` WHERE `menuid` = '".$stShow."'");
        ?>
            <table width="100%">
                <tr style="font-weight:700">
                    <td>ID</td>
                    <td>Name</td>
                    <td>Link</td>
                    <td>Parent ID</td>
                    <td>Actions</td>
                </tr>
        <?
        while ($arItem = $rsMenu->fetch_assoc()) {
            ?>
                <tr>
                    <td><?=$arItem["id"]?></td>
                    <td><?=$arItem["name"]?></td>
                    <td><?=$arItem["link"]?></td>
                    <td><?=$arItem["parentid"]?></td>
                    <td>
                        <a href="?page=menu&show=<?=$stShow?>&action=edit&id=<?=$arItem["id"]?>">Edit</a>
                        <br />
                        <a href="#" onclick="if(confirm('This will delete the menu item and its child items. Are you sure?')) location.replace('?page=menu&show=<?=$stShow?>&action=delete&id=<?=$arItem["id"]?>')">Delete</a>
                    </td>
                </tr>
            <?
        }
    }
} elseif(onGet("page") == false) {
    ?>
        <a href="?page=menu"><div class="menuitem" style="background-image: url('packs/menu/pack-icon.png');">
            Управление меню
        </div></a>
    <?
}