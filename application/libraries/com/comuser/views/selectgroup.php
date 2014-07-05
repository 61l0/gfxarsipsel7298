<select>
<option value="">pilih group</option>
<?php 
	foreach($data as $row){
	 echo '<option value='.$row->id_group.'>'.$row->group_name.'</option>';
	}
?>
</select>