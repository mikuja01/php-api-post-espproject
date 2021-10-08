<?php
/*** set the content type header ***/
header("Content-type: text/css");


$font_family = 'Arial, Helvetica, sans-serif';
$font_size = '2em';
$border = '2px solid';
?>
body {
  background-color: #121212;
}


table {
margin: 8px;
border-collapse: collapse;

}

th {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
background: #666;
}

td {
font-family: <?=$font_family?>;
font-size: <?=$font_size?>;
color: #FFFFFF;
text-align: center;
padding: 5px 40px;

}
tr:nth-child(even) {background-color: #424242;}