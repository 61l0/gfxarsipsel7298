<script type='text/javascript'>  
jQuery(document).ready(function() { 
<?=$class_name;?>.main.init();
jQuery("#"+<?=$class_name;?>grid.id).jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, groupOp:'AND'});
});
</script>
