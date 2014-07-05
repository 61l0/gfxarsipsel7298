<div class="button-box-skyblue">
	<table>
		<tr>
			<td>Rubrik</td>
			<td>
				<?//=form_dropdown('id_rubrik',@$arrrubrik['options'],@$idrubrik['default'],' id="id_rubrik" onchange="'.$class_name.'grid.extra.optrubrik()"');?>
				<?//=form_dropdown('id_rubrik',@$arrrubrik,@$idrubrik,' id="id_rubrik" onchange="'.$class_name.'grid.extra.optrubrik()"');?>
				<?//=form_dropdown('id_rubrik',@$arrrubrik,@$idrubrik,' id="id_rubrik" onchange="'.$class_name.'grid.extra.optrubrik()"');?>
				<?=form_dropdown('id_rubrik',@$arrrubrik,@$idrubrik,' id="id_rubrik" onchange="'.$class_name.'grid.extra.optrubrik()"');?>
			</td>
		</tr>
	</table>
</div>
<div class="page-break" />
<script type='text/javascript'>
jQuery(document).ready(function() {
	<?=$class_name;?>grid.extra.optrubrik();
	
});
</script>

