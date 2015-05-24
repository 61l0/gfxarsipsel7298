<?php if(count($data)>0):?>
<div class="arsip-image-list view-gambar">
<?php foreach($data as $rowx): ?>
<?php
$path = DOC_PATH_ROOT . 'assets/media/file/arsip_galery/'.@$rowx->id_data.'/'.@$rowx->foto;
$image_thumb = '';
if(is_file($path)){
	$path = BASE_URL.'assets/media/file/arsip_galery/'.@$rowx->id_data.'/'.@$rowx->foto;
	$proxy_path = 'admin/com/proxyurl/load/arsip_galery/'.base64_encode($rowx->id_data.'/'.@$rowx->foto);
    $path = $proxy_path;
}
?>	
	<div class="pick-img">					
		<a href="<?php echo $path; ?>" onclick="return false;">
			<img src="<?php echo $path; ?>" width="400px"/>				
		</a>
	</div>
<?php endforeach; ?>
<div class="cb"></div>
</div>
<?php else: ?>
	<div>
		<span>Arsip tidak memiliki gambar.</span>
	</div>
<?php endif ?>	

<script type="text/javascript">
$('.arsip-image-list.view-gambar a').lightBox({fixedNavigation:true});
</script>