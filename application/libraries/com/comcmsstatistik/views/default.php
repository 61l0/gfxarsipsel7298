<table width="60%" border="0" cellpadding="0" cellspacing="0" class="table-flat" bgcolor="#FFFFFF">
 <tr class="blink">
    <td width="20%"><font size="2">Visitors</font></td>
    <td width="5%"><font size="2">:</font></td>
    <td width="75%"><font size="2"><?=$theCount;?> users</font></td>
    <td rowspan="5" align="center">
    	<a href="javascript:void(0)" onClick="javascript:loadModule('contentleft', 'statistik/detail')">
        <img src="<?=BASE_URL;?>assets/media/file/statistik_img/stat_detail.png" width="120" />
        </a>
    </td>
  </tr>
  <tr>
    <td width="20%"><font size="2">Hits</font></td>
    <td width="5%"><font size="2">:</font></td>
    <td width="75%"><font size="2"><?=$hits;?> hits</font></td>
  </tr>
  <tr class="blink">
    <td width="20%"><font size="2">Month</font></td>
    <td width="5%"><font size="2">:</font></td>
    <td width="75%"><font size="2"><?=$month_online;?> users</font></td>
  </tr>
  <tr>
    <td width="20%"><font size="2">Today</font></td>
    <td width="5%"><font size="2">:</font></td>
    <td width="75%"><font size="2"><?=$today_online;?> users</font></td>
  </tr>
  <tr class="blink">
    <td width="20%"><font size="2">Online</font></td>
    <td width="5%"><font size="2">:</font></td>
    <td width="75%"><font size="2"><?=$now_online;?> users</font></td>
  </tr>
</table>
<script language="javascript">	
	$(document).ready(function(){
		$("#header_caption_content").html("<h3>Pengaturan Konten &raquo; Konten Umum &raquo; Statistik Pengunjung</h3>");
	});
</script>
