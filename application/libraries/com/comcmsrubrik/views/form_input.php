 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="add">
	<input type="hidden" id="id_group" name="id_group" value="<?=@$id_group?>">
	<table  class="table-flat" width="100%">
	<?
	foreach($data as $row){?>
		<tr>
			<td><input type="checkbox" name="id_menu[<?=@$row->id_menu?>]" id="id_menu[<?=@$row->id_menu?>]" value="<?=@$row->id_menu?>" /></td>
			<td><?=@$row->menu_name?></td>
		</tr>
		<tr>
	<? } ?>
			<td colspan="2">
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan_perhatian_lap">
				<input type="button" class="bt-blue-common" onclick="$('#dialogArea1').dialog('close');" value="Batal">
			</td>
		</tr>
	</table>
</form>
<script language="javascript">	   
	jQuery(document).ready(function() {
		<?=$class_name;?>grid.extra.btn_simpan();
	});
</script>