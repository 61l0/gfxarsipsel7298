<style>
.ui-datepicker{z-index:99999}
</style>

<div id="responceArea" />
<form method="post" action="" id="formcatatan">
<?=form_hidden('oper',@$oper);?>
	<table border=0 class="table-flat" width='100%'>
		<tr>
			<td>SKPD</td>
			<td>:</td>
			<td>
			<input type='text' name='skpd' size=40>
				</td>
		</tr>
		
		<tr>
		<td colspan=3>
		<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>
	</table>
</form>