<?php
if(!$_GET['menuitem']){
die ("Menu item not specified");
}
switch ($_GET['menuitem']){
 case 'IC':
			$q="select * from essential_oils.ingredients_catalog c, essential_oils.ingredients_prices p, essential_oils.ingredients_availability a where c.id=p.ingredient_id and c.id=a.ingredient_id and p.date_added= (select max(j.date_added) from essential_oils.ingredients_prices j where j.ingredient_id=c.id) ";
				$results=mysqli_query($conn,$q);
				$columns=array(/* 'id', */'name','price','quantity','units');
				$cnt=count($columns);?>
				<table id="ingrCatTable" border="1">
				<tr>
				<?php for ($i=0;$i<$cnt;$i++){
				 echo ('<th>'.$columns[$i].'</th>');}
				 ?>
				 </tr>
				 
				 <?php foreach($results as $item){
				 echo('<tr>');
				 for ($i=0;$i<$cnt;$i++){
				 echo ('<td>'.$item[$columns[$i]].'</td>');}
				 echo('<tr>');
				 }
				 ;?>
				 <tr id="ICaddData" onclick="hidVisStatus('#ICaddDataDiv')"><th colspan="5"><img src="img/plus.png" alt="plus image">add data</th></tr>
				 </table>
				 <div id="ICaddDataDiv" class="hidden">
				 <form method="POST" id="ICaddForm">
				 <input type="text" name="ICaddDataName" id="ICaddDataName" required placeholder="Essential Oil Name">
				 <input type="text" name="ICaddDataPrice" id="ICaddDataPrice" required placeholder="Essential Oil Price">
				 <input type="text" name="ICaddDataQuantity" id="ICaddDataQuantity" required placeholder="Essential Oil Quantity">
				 <input type="text" name="ICaddDataUnits" id="ICaddDataUnits" required placeholder="Essential Oil Units">
				 <input type="submit" name="addDataSubmit">
				 </form>
				 </div>
				 <?php
				 //print $_POST['ICaddDataName'];
				 	if($_POST['ICaddDataName']!=""){
					$stmt=$conn->prepare("select 1 from essential_oils.ingredients_catalog e where e.name=(?)");
					$stmt->bind_param('s',$_POST['ICaddDataName']);
					$stmt->execute();
					#$results=$stmt->get_results();
					
					$stmt->bind_result($results);
					$stmt->fetch();
					//printf("Number of results %d".PHP_EOL,count($results));
					$stmt->close();
					//var_dump($results);
					//echo($results);
					if($results){echo 'This item is already in the list. If you want to change it use update button';}
					 else{
						$stmt=$conn->prepare('insert into essential_oils.ingredients_catalog(name,units) values ((?),(?))');
						$stmt->bind_param('ss',$_POST['ICaddDataName'],$_POST['ICaddDataUnits']);
						$stmt->execute();
						echo (($stmt->error? $stmt->error: ($stmt->affected_rows." record".($stmt->affected_rows>1?'s':'')." added")));
						$stmt->close();
						$stmt=$conn->prepare('insert into essential_oils.ingredients_prices(ingredient_id,price,date_added) select id, (?), sysdate() from essential_oils.ingredients_catalog where name=(?)');
						$stmt->bind_param('ds',$_POST['ICaddDataPrice'],$_POST['ICaddDataName']);
						$stmt->execute();
						echo (($stmt->error? $stmt->error: ($stmt->affected_rows." record".($stmt->affected_rows>1?'s':'')." added")));
						$stmt->close();
						$stmt=$conn->prepare('insert into essential_oils.ingredients_availability(ingredient_id,quantity) select id, (?) from essential_oils.ingredients_catalog where name=(?)');
						$stmt->bind_param('ds',$_POST['ICaddDataQuantity'],$_POST['ICaddDataName']);
						$stmt->execute();
						echo (($stmt->error? $stmt->error: ($stmt->affected_rows." record".($stmt->affected_rows>1?'s':'')." added")));
						$stmt->close();
						?><meta http-equiv="refresh" content="0"><?php
						} 
						
 				 }
			break;
			
}
?>
