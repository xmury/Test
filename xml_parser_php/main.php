<?php
//<note>
//<to>Tove</to>
//<from>Jani</from>
//<heading>Reminder</heading>
//<body>Don't forget me this weekend!</body>
//</note>

$file = 'test.xml'; $test = file($file);

$string_text = "";
foreach($test as $w) { $string_text .= $w; }
$arr = str_split($string_text);

$open_teg = false; $in_text = false;
$teg = ""; $text = "";
$n_arr = array();
for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] == "\n" or $arr[$i] == "/") { continue; }
    
    if ($arr[$i] == "<") {                          // Текст кончился
        $in_text = false;
    }

    if ($arr[$i] == '<') {                          // Мы в открывающем теге?
        $open_teg = true; 
        continue;                            
    } 

    if ($arr[$i] == '<' and $arr[$i+1] == '/') {    // Мы в закрывающемся теге?
        $n_arr[$teg] = $text;
        $teg = ""; $text = "";
        $in_text = false; $open_teg = false;
        continue;
    }

    if ($arr[$i] == '>'){                           // Тег кончился?
        $open_teg = false; $in_text = true;
        if ($teg != "") { $n_arr[$teg] = $text; echo "$i | $text \n"; }
        $teg = ""; $text = "";
        continue;
    }


    if ($open_teg) { $teg  .= $arr[$i]; }           // Если в теге ведём запись
    if ($in_text)  { $text .= $arr[$i]; }           // Если в тексте то пишем

     
}
echo "\n";
$keys = array_keys($n_arr);                         // Получаем массив ключей
foreach ($keys as $key){ echo "$key = $n_arr[$key] \n"; } 

?>