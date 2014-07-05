<script type='text/javascript'>   
<?=$formjs;?>
<?=$className;?>form =  <?=convert_js_serialize($form)?>;
jQuery("#FirstForm").gfForm(<?=$className;?>form);
// jQuery("#FirstForm").gfForm('formId','xxx');
</script>


<div class="head-content">
  <h3><a href="#"><?=$header_caption;?></a></h3>
</div>
<div class="content">
<!--begin:content-->
<div id ="responceArea" />
<div class="page-break" />
<div id="FirstForm" ></div>
<button onclick="jQuery('#FirstForm').gfForm('submit');">huya</button>
</div>
