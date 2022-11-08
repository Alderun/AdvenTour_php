<?php
    $host = 'localhost';
    $dbname = 'adventour';
    $username = 'root';
    $password = 'root';
    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db = $connection->query('SELECT * FROM start');
    $places = $db->fetchAll(PDO::FETCH_ASSOC);
    
    $main_template = file_get_contents("index.html");
    $block = '';
    $template = file_get_contents("top_pattern.html");
    $temp = '';
    foreach($places as $place){
        $temp = str_replace("{name_top}",$place['Name'], $template);
        $temp = str_replace("{text_top}",$place['Text'], $temp);
        $temp = str_replace("{image_top}",$place['Photo'], $temp);
        $block .= $temp;
    } 
    $main_template= str_replace("{top}",$block, $main_template);
    $main_template= str_replace("{footer}",file_get_contents("footer_pattern.html"), $main_template);
    print($main_template); 
?>