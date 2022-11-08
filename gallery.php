<?php
     $host = 'localhost';
     $dbname = 'adventour';
     $username = 'root';
     $password = 'root';
     $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
     $db = $connection->query('SELECT * FROM gallery');
     $places = $db->fetchAll(PDO::FETCH_ASSOC);

    $main_template = file_get_contents("gallery.html");
    $block = '';
    $template = file_get_contents("gallery_pattern.html");
    $temp = '';
    foreach($places as $place){
        $temp = str_replace("{name}",$place['Name'], $template);
        $temp = str_replace("{text}",$place['Text'], $temp);
        $temp = str_replace("{image}",$place['Photo'], $temp);
        $temp = str_replace("{country}",$place['Country'], $temp);
        $block .= $temp;
    } 
    $main_template= str_replace("{info}",$block, $main_template);
    $main_template= str_replace("{footer}",file_get_contents("footer_pattern.html"), $main_template);
    print($main_template); 
?>