<?php
/*** set the content type header ***/
/*** Without this header, it wont work ***/
header("Content-type: text/css");


$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '1em';
$border = '1px solid';
?>

table {
margin: 3%;
border-collapse: collapse;
text-align: center;
width: 40%;
}

tr {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
background: yellow;
color: black;

border: <?=$border?> black;
}

td {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
border: <?=$border?> black;
width: 7%;
}