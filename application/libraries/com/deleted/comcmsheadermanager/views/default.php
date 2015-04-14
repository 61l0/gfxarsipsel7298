<div id="table_config" style="display:none">
<div class="page-break" />
	<form id="myForm2" action="">
		<input type="hidden" name="oper" id="oper" value="config">
		<input type="hidden" name="id_config" id="id_config" value="<?=@$id_config;?>">
		<table class="table-flat" >
			<tr><th colspan="2"><b>Header Config Manager</b></th></tr>
			<tr>
				<td width="93">Banner Effect</td>
				<td width="382"><select name="banner_effect" id="banner_effect">
									<?=$banner_effect_opt;?>
								</select>
				</td>
			</tr>
			<tr >
				<td valign="top">Banner Width</td>
				<td><input type="text" name="banner_width" id="banner_width" size="5" maxlength="3" value="<?=@$banner_width;?>" />
				</td>
			</tr>
			<tr >
				<td valign="top">Banner Height</td>
				<td><input type="text" name="banner_height" id="banner_height" size="5" maxlength="3" value="<?=@$banner_height;?>" />
				</td>
			</tr>
			<tr >
				<td valign="top">Banner Strips</td>
				<td><input type="text" name="banner_strips" id="banner_strips" size="5" maxlength="3" value="<?=@$banner_strips;?>" />
				</td>
			</tr>
			<tr >
				<td valign="top">Banner Delay</td>
				<td><input type="text" name="banner_delay" id="banner_delay" size="5" maxlength="3" value="<?=@$banner_delay;?>" />
				</td>
			</tr>
			<tr>
				<td width="93">Banner Position</td>
				<td width="382"><select name="banner_position" id="banner_position">
				<?=@$banner_position_opt;?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="93">Banner Direction</td>
				<td width="382"><select name="banner_direction" id="banner_direction">
				<?=@$banner_direction_opt;?>
				</select>
				</td>
			</tr>
			<tr >
				<td colspan="2">
					<input type="button" class="bt-blue-common" value="Simpan" id="simpan" onclick="<?=$class_name;?>grid.extra.btn_simpan_config();">
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="page-break" />
<script type='text/javascript'>
jQuery(document).ready(function() {
	$("#main_panel_container").append(jQuery("#table_config").html());
	$("#header_caption_content").html("<h3>Pengaturan Tampilan &raquo; Header</h3>");
	
});
</script>
