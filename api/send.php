<?php
require "../libs/accesssql.php";
if(!isset($_POST["url"])) die();
if(!isset($_POST["usr"])) die();
accesssql("INSERT INTO log VALUES(\"" . $_POST["usr"] . "\",\"" . $_POST["url"] . "\",\"" . date("Y/m/d/H/i/s") . "\");");