<?
    {
        global $connect;
        $stQuery = "SELECT * 
          FROM `menu` 
          WHERE `menuid` = '".$arParams["TYPE"]."'";
        $obRes = $connect->query($stQuery);
        $arAllRows = array();
        while ($arRows = $obRes->fetch_array()) {
            if ($arRows["parentid"] == "0") {
                array_push($arAllRows, $arRows);
            } else {
                $arAllRows["id"]["child"] = $arRows;
            }
        }
        $arResult = $arAllRows;
    }
    include_once("templates/".$stTemplate."/template.php");