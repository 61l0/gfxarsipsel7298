<div class="button-box-skyblue">
	<table>
		<tr>
			<td>Kanal</td>
			<td><?=form_dropdown('id_kanal',@$arrkanal['options'],@$idkanal['default'],' id="id_kanal" onchange="'.$class_name.'grid.extra.optkanal()"');?></td>
		</tr>
	</table>
</div>
<div class="page-break" />
<script type='text/javascript'>
jQuery(document).ready(function() {
	<?=$class_name?>grid.extra.optkanal();
});
</script>
