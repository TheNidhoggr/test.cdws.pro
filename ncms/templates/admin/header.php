<!DOCTYPE html>
<html lang="<?=$arSite["lang"]?>">
<head>
    <meta charset="UTF-8">
    <title><?=$arFrame["title"]?></title>
    <style>
        * {
            /*border:             1px dotted white;*/
        }
        body {
            background:         rgb(25, 25, 25);
            color:              white;
        }
        .topbar {
            position:           fixed;
            top:                0;
            left:               0;
            width:              100%;
            height:             50px;
            background:         rgb(45, 45, 45);
            z-index:            100;
        }
        .topbar span.delimeter {
            font-size:          35px;
            color:              rgb(100, 100, 100);
        }
        .topbar a {
            line-height:        50px;
            margin-left:        10px;
        }
        .leftbar {
            position:           absolute;
            height:             100%;
            width:              200px;
            padding-right:      10px;
            top:                0;
            left:               0;
            background:         rgb(45, 45, 45);
            z-index:            2;
        }
        .leftbar ul {
            padding-left:       10px;
            list-style:         none;
        }
        .leftbar ul li {
            margin-top:         0px;
        }
        .leftbar ul li a {
            display:            inline-block;
            height:             100%;
            width:              100%;
            padding:            5px;
            transition:         0.4s;
        }
        .leftbar ul li a:hover {
            background:         rgba(200, 200, 200, 0.3);
            transition:         0.15s;
        }
        .template-content {
            margin:             60px 0px 0px 210px;
            z-index:            1;
        }

        a {
            color:              rgb(171, 171, 171);
            text-decoration:    none;
        }
        a:hover {
            color:              rgb(250, 250, 250);
            text-decoration:    underline;
        }
    </style>
</head>
<body>
<div class="topbar">
    <a href="#">Перейти на сайт</a>
    <span class="delimeter">|</span>
    <a href="#">Статистика</a>
</div>
<div class="leftbar">
    <div style="height:50px"></div>
    <ul>
        <?// Menu starts here?>
        <li><a href="#">ВСЕ</a></li>
        <hr />
        <li><a href="#">Редактировать меню</a></li>
        <li><a href="#">Галерея</a></li>
        <li><a href="#">Подключенные модули</a></li>
        <li><a href="#">Проверка обновлений из жопы полярного сервера на морде динозавра</a></li>
        <?// Menu ends here?>
        <?
//            Atom(
//                "menu",
//                "admin-left",
//                array(
//                    "TYPE" => "admin-left"
//                )
//            );
        ?>
    </ul>
</div>
<div class="template-content">