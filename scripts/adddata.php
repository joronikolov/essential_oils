<?php
include_once('connection.php');
$stmt=$conn->prepare("select 1 from essential_oils.ingredients_catalog e where e.name=(?)");
$stmt->bind_param('n',$_POST['ICaddDataName']);
$stmt->execute();
$stmt->bind_result($results);
$stmt->fetch();
printf("Number of results %d",count($results));
$stmt->close();
?>
