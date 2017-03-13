<?php

include('./map.class.php');
$moveDirection = $_GET['move'];

//print_r($moveDirection);

$map = new Map();
$map->move($moveDirection);
$html = $map->generateHtml();
$map->collision();

echo $html;

