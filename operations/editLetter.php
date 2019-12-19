<?php

$priority=$_POST['priority'];
$salary=$_POST['salary'];
$date=date('Y/m/d h:i:s');
$type_name=$_POST['type_name'];
//  AND salary = " . $salary . " AND date = " . $date . "  AND   type_name = " . $type_name .  "
$sql="UPDATE requests SET priority = " . $priority . " WHERE Request_id = " . $requestId;
$DB->query($sql);
$DB->execute();


?>