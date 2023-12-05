<?php
function accesssql($query){
    $sqli = new mysqli('localhost','sqler','','jehmehcpb');
    if($sqli->connect_errno){
        return null;
    }
    $sqli->set_charset('utf8');
    $stmt = $sqli->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
    
}