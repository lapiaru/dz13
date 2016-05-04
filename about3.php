<html><body>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" > 

<?php
mb_internal_encoding("utf-8");
$OkrugGor=array();
$OkrugGor= [
    "Урал"=>array(
        "Нижний Тагил",
        "Екатеринбург",
        "Каменск-Уральский",
        "Верхняя Пышма",
        "Верхняя Тура"),
    "Поволжье"=>array(
        "Великий Устюг",
        "Вятские Поляны",
        "Йошкар-Ола",
        "Соль-Илецк",
        "Углич",
        "Вышний Волочек"),
    "Сибирь"=>array(
       "Камень-на-Оби",
        "Горно-Алтайск",
        "Петровск-Забайкальский",
        "Иркутск"),
    "Дальний восток"=>array(
        "Петропавловск-Камчатский",
        "Комсомольск-на-Амуре",
        "Усолье-Сибирское",
        "Омск",
        "Усть-Илимск",
        "Улан-Удэ",
        "Норильск"),
    ];

//|mb_strpos($gorod, "-")

$novOkrugGor = array();
$novNach = array();
$novKon = array();
$itog=array();

//echo "<h3> было </h3>";

foreach ($OkrugGor as $Okrug =>$strGor )
{
    foreach ($strGor as $k => $gorod)
    {
        if (mb_strpos($gorod, " ")|mb_strpos($gorod, "-") !== false) {
            $novOkrugGor[]= $gorod;
            $p=mb_strpos($gorod, " ")|mb_strpos($gorod, "-"); 
            $nach=mb_substr($gorod,0,$p);
         //   echo $nach."<br/>";
            $kon=mb_substr($gorod,$p+1,NULL);
         //   echo $kon."<br/>";
            $novNach[]=$nach;
            $novKon[]=$kon;
            
          // echo current($novOkrugGor) ."<br/>";
        //    next($novOkrugGor);
        }
    }
}
shuffle($novNach);
//var_dump($novNach);
shuffle($novKon);
// echo "<h3> стало </h3>";
foreach($novNach as $i=>$zn)
 { 
    // unset($novNach[$i]);
     //echo "del".$novNach[$i];
     $novNach[$i]=$zn." ".$novKon[$i];
     echo $novNach[$i]."<br/>";
            
 }



?>
</body>
</html>