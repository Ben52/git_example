<?php 

//$handle = fopen('users.csv', 'r');
//$users = fgetcsv($handle);
$row=1;
if(($handle = fopen('users.csv', 'r'))!==FALSE){
	while(($record = fgetcsv($handle, 0, ','))!==FALSE){
		if($row==1){
			$keys=$record;
			$row++;
		}else{
			$records[] = array_combine($keys, $record);
		}
	}
	function makePrimaryKey($key_name='Username', $records){
		foreach($records as $record){
			$index_name = $record[$key_name];
			unset($record[$key_name]);
			$new_records[$index_name] = $record;
		}
		return($new_records);
	}
}

$sorted_records = makePrimaryKey('Username', $records);
print_r($sorted_records);


/*if(in_array('BGreenes', $records[0])){
	echo 'Found Binny!';
	$username = $records[0]['Username'];
	$password = $records[0]['Password'];
	if($password !== )
}else {
	echo 'Can\'t find Binyomin';
}*/






print_r($records);






?>