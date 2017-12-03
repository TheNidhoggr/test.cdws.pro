<?foreach ($arResult as $arItem):?>
    <li>
        <a href="<?=$arItem["link"]?>" class="<?=NMenu::Active($arItem["link"])?>"><?=$arItem["name"]?></a>
    </li>
<?endforeach?>