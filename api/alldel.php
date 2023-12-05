<?php
require "../libs/accesssql.php";
Header("Location:/api/showlog.php");
if(!isset($_POST["oo"])) die();
if(!isset($_POST["ot"])) die();
if(!isset($_POST["ao"])) die();
if(!isset($_POST["at"])) die();
$oo = $_POST["oo"];
$ot = $_POST["ot"];
$ao = $_POST["ao"];
$at = $_POST["at"];

if($oo != $ao) die();
if(($ot * $ot) != $at) die();

accesssql("DELETE FROM log");