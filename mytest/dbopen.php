<?php

$Mydb = new MyDB();
$Mydb->Connect(DefaultDBServer, MyDBUser, MyDBPasswd, DefaultDBName);

$Mydb2 = new MyDB();
$Mydb2->Connect(DefaultDBServer, MyDBUser, MyDBPasswd, DefaultDBName);
?>