<style>
    div.gallery-background {
        top:                    0;
        left:                   0;
        height:                 100%;
        width:                  100%;
        position:               fixed;
        background:             rgba(0, 0, 0, 0.7);
        z-index:                149;
    }
    div.gallery-main * {
        /*border:                 1px dotted white;*/
    }
    div.gallery-main {
        height:                 90%;
        width:                  90%;
        top:                    5%;
        left:                   5%;
        position:               fixed;
        background:             rgb(40, 47, 40);
        z-index:                150;
    }
    div.gallery-main div.gallery-header {
        height:                 50px;
        line-height:            50px;
        width:                  100%;
        position:               absolute;
    }
    div.gallery-main div.gallery-header h1 {
        height:                 100%;
        margin:                 0 20px;
        line-height:            inherit;
    }
    div.gallery-main div.gallery-inner {
        height:                 100%;
        width:                  100%;
        position:               absolute;
        margin:                 0;
    }
    div.gallery-main div.gallery-inner * {
        transition:             width 0.2s;
    }
    div.gallery-main div.gallery-inner div.gallery-menu {
        float:                  left;
        width:                  20%;
    }
    div.gallery-main div.gallery-inner div.gallery-menu ul {
        padding-left:           15px;
    }
    div.gallery-main div.gallery-inner div.gallery-menu ul li {
        list-style:             none;
        height:                 40px;
        line-height:            40px;
        padding-left:           10px;
        transition:             0.35s;
        cursor:                 pointer;
    }
    div.gallery-main div.gallery-inner div.gallery-menu ul li:hover {
        background:             rgba(100, 150, 100, 0.4);
        transition:             0.1s;
    }
    div.gallery-main div.gallery-inner div.gallery-container {
        float:                  left;
        width:                  80%;
    }
    div.gallery-main div.gallery-inner div.gallery-container div.gallery-container-thumbnail {
        width:                  19.5%;
        height:                 200px;
        float:                  left;
        margin:                 0.25%;
        background-size:        cover;
        background-position:    50% 50%;
        background-repeat:      no-repeat;
        cursor:                 pointer;
    }
    div.gallery-main div.gallery-inner div.gallery-menu-additional {
        float:                  right;
        width:                  0;
        overflow-x:             hidden;
        height:                 100%;
        overflow-y:             auto;
    }
</style>

<script>
    if (!CDWS) var CDWS = {};
    CDWS.Gallery = {};

    CDWS.Gallery.MenuAdditional = {};

    CDWS.Gallery.MenuAdditional.toggle = function() {
        var container = document.getElementById('cdws_gallery_container');
        if (container.style.width == '60%') {
            container.style.width = '80%';
            addmenu.style.width = '0';
        } else {
            container.style.width = '60%';
            addmenu.style.width = '20%';
        }
    }

    function waitNV(type) {
        var msg = '';
        switch (type) {
            case 'pack': {
                msg = ' пакета';
                break;
            }
            case 'core': {
                msg = ' ядра';
                break;
            }
            case 'atom': {
                msg = ' атома';
                break;
            }
        }
        alert('В следующей версии' + msg);
    }
</script>

<div class="gallery-background"></div>
<div class="gallery-main">
    <div class="gallery-header">
        <h1>Gallery</h1>
    </div>
    <div class="gallery-inner">
        <div style="height:50px"></div>
        <div class="gallery-menu">
            <ul>
                <li onclick="CDWS.Gallery.MenuAdditional.toggle()">Теги</li>
                <li onclick="waitNV('pack')">Альбомы</li>
                <hr />
                <li onclick="waitNV('atom')">Сначала старые</li>
            </ul>
        </div>
        <div class="gallery-container" id="cdws_gallery_container">
            <?foreach ($arResult["ITEMS"] as $arItem):?>
                <div
                    class="gallery-container-thumbnail"
                    style="background-image: url('/ncms/upload/gallery/thumbnails/<?=$arItem["upload_src"]?>')"
                    onclick="waitNV('atom')"
                ></div>
            <?endforeach;?>
        </div>
        <div class="gallery-menu-additional" id="cdws_gallery_menu_additional">
            <?foreach ($arResult["TAGS"] as $stTagtypeKey => $arTags):?>
                <h2><?=$stTagtypeKey?></h2>
                <?foreach ($arTags as $arTag):?>
                    <button><?=$arTag["name"]?></button>
                <?endforeach;?>
            <?endforeach;?>
            <script>
                var addmenu = document.getElementById('cdws_gallery_menu_additional');
                addmenu.style.height = addmenu.parentNode.offsetHeight - 50 + 'px';
            </script>
        </div>
    </div>
</div>