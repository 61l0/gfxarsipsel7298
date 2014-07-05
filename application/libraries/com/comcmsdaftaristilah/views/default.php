<div class="button-box-skyblue">
	<table>
		<tr>
			<td>ABJAD</td>
			<td><select name="abjad" id="abjad" onchange="<?=$class_name?>grid.extra.optabjad();">
			<?
			$res = array('A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F','G'=>'G','H'=>'H','I'=>'I','J'=>'J','K'=>'K','L'=>'L','M'=>'M','N'=>'N','O'=>'O','P'=>'P','Q'=>'Q','R'=>'R','S'=>'S','T'=>'T','U'=>'U','V'=>'V','W'=>'W','X'=>'X','Y'=>'Y','Z'=>'Z');
			foreach($res as $key=>$row):
				echo "<option value='".$key."'>".$row."</option>";
			endforeach;

			?>
			</select>
			</td>
		</tr>
	</table>
</div>
<div class="page-break" />
<script type='text/javascript'>
jQuery(document).ready(function() {
	$("#header_caption_content").html("<h3>Pengaturan Konten &raquo; Konten Khusus &raquo; Daftar Istilah</h3>");
});
</script>
