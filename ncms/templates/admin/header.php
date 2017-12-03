<?
if (!SITE_ROOT) die("This script must be called");
function show_msg() {
    if (onGet("errmsg")) {
        echo "<div onclick=\"this.parentNode.removeChild(this);\" class=\"msg error\">".onGet("errmsg")."</div>";
    }
    if (onGet("successmsg")) {
        echo "<div onclick=\"this.parentNode.removeChild(this);\" class=\"msg success\">".onGet("successmsg")."</div>";
    }
}
?>
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
            position:           fixed;
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
        a:hover, a.active {
            color:              rgb(250, 250, 250);
            text-decoration:    underline;
        }
        input {
            margin:             3px 0;
        }
        .menuitem {
            /*border: 1px dotted white;*/
            border:             2px solid rgb(45, 45, 45);
            display:            table-cell;
            width:              140px;
            height:             30px;
            text-align:         left;
            padding:            10px 10px 10px 60px;
            vertical-align:     middle;
            background-color:   rgba(0, 0, 0, 0);
            background-position: 0 50%;
            background-repeat:  no-repeat;
            background-size:    contain;
            transition:         0.4s;
        }
        .menuitem:hover, .menuitem.active {
            background-color:   rgba(200, 200, 200, 0.3);
            transition:         0.15s;
        }
        button, input[type="submit"] {
            padding:            5px;
            background:         none;
            border:             2px solid rgb(45, 45, 45);
            color:              white;
            transition:         0.25s;
        }
        button.selected, input[type="submit"] {
            border:             2px solid rgb(64, 255, 0);
            color:              rgb(64, 255, 0);
        }
        button.warning {
            border:             2px solid rgb(255, 255, 0);
            color:              rgb(255, 255, 0);
        }
        tr td {
            border-bottom:      2px solid rgb(45, 45, 45);
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
        <li><a href="?">ВСЕ</a></li>
        <hr />
        <?// Menu ends here?>
        <?
            Atom(
                "menu",
                "admin_favs",
                array(
                    "TYPE" => "admin_favs"
                )
            );
        ?>
    </ul>
</div>
<div class="template-content">