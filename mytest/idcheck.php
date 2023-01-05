<?php include "db.php"; ?> 
<?php include "dbopen.php"; ?>  
<?php
     $id = $_GET['idcheck'];
     $sql = "select count(*) as cnt from ta_member where id='".$id."'";
     $result = $Mydb->Query($sql);
     while ($row=$Mydb->NextRow()) {
         $cnt= $row['cnt'];
     }
    echo $cnt;
?>