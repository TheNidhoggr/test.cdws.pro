<?
if (!SITE_ROOT) die("This script must be called");
if (onGet("page") == "cdws.gallery") {
    ?>
        <h2><a href="?page=cdws.gallery">Галерея</a></h2>
        <hr />
        <a href="?page=cdws.gallery&cat=settings">
            <div class="menuitem<?=NMenu::Active("cat=settings")?>" style="background-image:url('packs/gallery/admin_parts/icons/settings.png')">
                Настройки
            </div>
        </a>
        <a href="?page=cdws.gallery&cat=tags">
            <div class="menuitem<?=NMenu::Active("cat=tags")?>" style="background-image:url('packs/gallery/admin_parts/icons/settings.png')">
                Настройка тегов
            </div>
        </a>
        <a href="?page=cdws.gallery&cat=images">
            <div class="menuitem<?=NMenu::Active("cat=images")?>" style="background-image:url('packs/gallery/admin_parts/icons/gallery.png')">
                Изображения
            </div>
        </a>
        <hr />
    <?
    $rsPackData = $connect->query("SELECT * FROM `ncms_pack_cdws_gallery_settings`");
    $arPackData = array();
    while ($arPackDataItem = $rsPackData->fetch_assoc()) {
        $arPackData[$arPackDataItem["key"]] = $arPackDataItem["value"];
    }
    switch(onGet("cat")) {
        case "settings": {
            include("admin_parts/settings.php");
            break;
        }
        case "tags": {
            include("admin_parts/tags.php");
            break;
        }
        case "images": {
            include("admin_parts/images.php");
            break;
        }
    }
} elseif(onGet("page") == false) {
    ?>
    <a href="?page=cdws.gallery"><div class="menuitem" style="background-image:url('packs/gallery/pack-icon.png')">
            Галерея
        </div></a>
    <?
}