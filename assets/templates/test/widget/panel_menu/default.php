<?//=dump($data);die;?>
<?foreach($list as $row):?>
		
	<li>
      <div id="m<?=$row->id_menu;?>" class="pasive">
			<a href="javascript:void(0)" 
				onclick="loadFragment('#main_panel_container','<?=site_url($row->menu_path);?>'); getActiveNav(<?=$row->id_menu;?>); loadsidebar(<?=$row->id_menu;?>); return false;">
					<span><img src="<?=CSS_PATH."admin/img/common/".$row->icon_menu;?>" /></span><br />
        <?=$row->menu_name;?></a></div>
    </li>
<? endforeach;?>