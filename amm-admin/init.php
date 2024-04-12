<?php
include "connect.php";
//routes :
$tpl = 'includes/templates/';
$img='../media/images/';
$func ='includes/functions/';
$css='layout/css/';
$js ='layout/js/';
$fonts='layout/webfonts/';
$lang ='includes/languages/';

// includes:
include $lang."eng.php";
include $func."functions.php";
include $tpl."header.php";

if(!isset($nonavbar)){
    include $tpl.'navbar.php';
}