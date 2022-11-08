<?php
    $reg = '/((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,12}/i';

    $host = 'localhost';
    $dbname = 'adventour';
    $username = 'root';
    $password = 'root';
    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db = $connection->query('SELECT * FROM reviews');
    $peoples = $db->fetchAll(PDO::FETCH_ASSOC);

    $main_template = file_get_contents("reviews.html");
    $template = file_get_contents("reviews_pattern.html");
    $block = '';
    $temp = '';
    $newstr = '';
    
    foreach($peoples as $people){
        $temp = str_replace("{text_name}",$people['Name'], $template);
        $temp = str_replace("{text}",$people['Text'], $temp);
        $temp = str_replace("{image}",$people['Photo'], $temp);
        if(preg_match($reg,$temp)){
            preg_match_all($reg,$temp,$found);
            for($j = 0; $j < count($found);$j++){
                $newstr = '<span class="textcolor">'.$found[0][$j].'</span>';
                $temp= str_replace($found[0][$j],$newstr, $temp);
            }
        }
        $block .= $temp;
    } 
    $main_template= str_replace("{reviews}",$block, $main_template);
    $main_template= str_replace("{footer}",file_get_contents("footer_pattern.html"), $main_template);
    print($main_template); 
?>