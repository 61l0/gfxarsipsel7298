<?=$comjs;?>

<div class="head-content">
  <h3><a href="#"><?=$header_caption;?></a></h3>

<!--begin:content-->
</div>

    <div class="contextMenu" id="jqContextMenu" style="display:none;">
        <ul>
            <li id="edit">
                Edit</li>
            <li id="cut">
                Cut</li>
            <li id="copy">
                Copy</li>
            <li id="paste">
                Paste</li>
            <li id="delete">
                Hapus</li>
        </ul>
    </div>

<table id="<?=$grid->id;?>"></table>
<div id="<?=$grid->pager;?>"></div>
<script type='text/javascript'>  
jQuery(document).ready(function() {  
	<?=$class_name;?>.main.init();
});
</script>
