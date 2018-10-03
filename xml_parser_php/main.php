<?php
function xmlParser($file){
    $test = file($file);                                                        // Открываем файл

    $string_text = "";                                                          //
    foreach($test as $w) { $string_text .= $w; }                                // Преобразуем в массив
    $arr = str_split($string_text);                                             //
    
    $openTeg = false; $inText = false;
    $teg = ""; $text = ""; $nArr = array();
    
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == "\n" or $arr[$i] == "/") { continue; }
        
        if ($arr[$i] == "<") { $inText = false; }                              // Текст кончился?
    
        if ($arr[$i] == '>'){                                                   // Тег кончился?
            $openTeg = false; $inText = true;
            if ($teg != "") { $nArr[$teg] = $text; }
            $teg = ""; $text = "";
            continue;
        }
    
        if ($arr[$i] == '<') {                                                  // Мы в открывающем теге?
            $openTeg = true; 
            continue;                            
        } 
    
        if ($openTeg) { $teg  .= $arr[$i]; }                                   // Если в теге ведём запись
        if ($inText)  { $text .= $arr[$i]; }                                   // Если в тексте то пишем     
    }

    return $nArr; 
}


//---------------------------------------------------------
//------------------TESTING------ZONE----------------------
$file  = 'test.xml'; 
$nArr = xmlParser($file);
$keys  = array_keys($nArr);                                                    // Получаем массив ключей

foreach ($keys as $key){ echo "$key = $nArr[$key] \n"; } 
//---------------------------------------------------------


/*
Запасной вариант. Мысль левой пятки правой ноги. 
Однако зараза практически работает!
Если маленько подрихтовать основной код то 
будет работать

if ($arr[$i] == '<' and $arr[$i+1] == '/') {                                // Мы в закрывающем теге?
    echo "Test $teg | $text | $openTeg \n";
    if ($teg != "") { $nArr[$teg] = $text; }
    $teg = ""; $text = "";
    $inText = false; $openTeg = false;
    continue;
}
*/
?>
