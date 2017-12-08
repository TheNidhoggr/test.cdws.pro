<style>
    div#cdws_gallery_mini {
        height:             autox;
    }
    div#cdws_gallery_mini div.cdws_gallery_mini_img {
        width:              16%;
        height:             200px;
        float:              left;
        margin:             0.3%;
        background-position: 50% 50%;
        background-repeat:  no-repeat;
        background-size:    cover;
    }
</style>
<div id="cdws_gallery_mini">
    <h3>Последние / <a href="/gallery">Все</a></h3>
    <?foreach ($arResult["ITEMS"] as $arItem):?>
        <a href="/gallery/detail/?view=<?=$arItem["id"]?>">
            <div class="cdws_gallery_mini_img" style="background-image: url('/ncms/upload/gallery/thumbnails/<?=$arItem["upload_src"]?>')"></div>
        </a>
    <?endforeach;?>
</div>
<script>
    var cdwsGalleryMiniImages = document.getElementById('cdws_gallery_mini').getElementsByClassName('cdws_gallery_mini_img');
    var width = cdwsGalleryMiniImages[0].offsetWidth;
    for (var i=0; i<cdwsGalleryMiniImages.length; i++) {
        cdwsGalleryMiniImages[i].style.height = width + 'px';
    }
</script>