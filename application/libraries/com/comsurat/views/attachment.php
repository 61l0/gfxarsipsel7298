<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/fileupload/fileuploader.css"/>
<script type="text/javascript" src="<?php echo base_url()?>assets/fileupload/fileuploader.js"></script>
<style type="text/css">
.tb-attachment{
	border-collapse: collapse;
}

.tb-data-empty,
.tb-data-template{
	display: none;
}
.qq-upload-button,#ctkBtn {
    background: linear-gradient(to bottom, #FFB76B 0%, #FFA73D 50%, #FF7C00 54%, #E86704 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border-radius: 5px;
    box-shadow: 0 1px 2px #B2B2B2;
    color: #FFFFFF;
    display: block;
    font-weight: bold;
    padding: 7px 19px;
    text-align: center;
    text-shadow: 0 1px 1px #000000;
    width: 105px;
    margin: 4px auto;
}
.tb-attachment thead th{
	background: linear-gradient(to bottom, #FFB76B 0%, #FFA73D 50%, #FF7C00 54%, #E86704 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #FFFFFF !important;
}
.bordered{
	border-top:solid 1px orange;
}
.img-thumb-cnt{
	width: 240px;
	border:solid 1px orange;
	padding: 2px;
	padding-bottom: 0px;
	background: #dedede;
}
a.img-ln{
	font-weight: bold;
	text-decoration: underline;
	color: orange;
}
</style>
<div id="file-uploader-demo1" style="margin:0 auto">		
	<noscript>			
		<p>Please enable JavaScript to use file uploader.</p>
		<!-- or put a simple form for upload here -->
	</noscript>         
</div>
<input type="button" value="CETAK" id="ctkBtn" onclick="doCetak()"/>

<div style="border:solid 1px orange;">
	
<table border="0" class="tb-attachment" width="100%" cellpadding="6" colspacing="6">
	<thead>
		<tr>
			<th width="12px" ><input type="checkbox" name="ckAll"/></th>
			<th>Nama File</th>
			<th width="30px">Aksi</th>
		</tr>
	</thead>
	<tbody class="tb-data">
		<tr class="tb-data-template">
			<td>#{no}</td>
			<td>#{nama_file}</td>
			<td>#{aksi}</td>
		</tr>
		<tr class="tb-data-empty">
			<td colspan="3">Belum ada gambar ataupun file yang disisipkan untuk item ini.</td>
		</tr>
	</tbody>
</table>
</div>
<?php if($_SESSION['id_skpd'] != '40'){ ?>
<style type="text/css">
	div[title=Hapus].ui-pg-div.ui-inline-edit,
	.qq-upload-button{display: none !important;}
</style>
<?php } ?>
<script type="text/javascript">
	 function createUploader(){            
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader-demo1'),
            action: '<?php echo base_url()?>admin/com/surat/attachment/upload',
        	params:{
        		parent_id:<?php echo $parent_id?>,
        		attachment_for:'<?php echo $attachment_for?>'
        	},
        	allowedExtensions:['jpg', 'jpeg', 'png'],
        	onSubmit: function(id, fileName){},
		    onProgress: function(id, fileName, loaded, total){},
		    onComplete: function(id, fileName, data){
		    	grd_append_data(data,true);
		    	setTimeout(function(){
		    		$($('ul.qq-upload-list li').get(id)).fadeOut('slow');
		    		//console.log($($('ul.qq-upload-list li').get(id)));
		    	},1000);
		    },
		    onCancel: function(id, fileName){},
		    onError: function(id, fileName, xhr){
		    	setTimeout(function(){
		    		$($('ul.qq-upload-list li').get(id)).fadeOut('slow');
		    		//console.log($($('ul.qq-upload-list li').get(id)));
		    	},1000);
		    }
        });           
    }
    function doCetak()
    {
    	var pictIdList = $('input.ckAll:checked');
    	var attachmentIds = [];

    	for(var i=0;i<pictIdList.length;i++)
    	{
    		var id = $(pictIdList[i]).attr('rowid');
    		attachmentIds.push(id); 
    	}
    	console.log(attachmentIds);

    	if(attachmentIds.length)
    	{
    		window.open('<?php echo base_url()?>admin/com/surat/attachment/pdf/'+attachmentIds.join('_'));
    	}
    	else
    	{
    		alert('Silahkan pilih gambar yang akan dicetak terlebih dahulu.');
    	}
    }
    function delButton(row)
    {
    	console.log(row)
    	return '<div class="ui-pg-div ui-inline-edit" style="float: left; cursor: pointer;" title="Hapus"><span class="ui-icon ui-icon-trash" onclick="delete_attachment({id_attachment:'+row.id_attachment+',attachment_for:\''+row.attachment_for+'\'});"></span></div>';
    }
    function grd_append_data(row,first){
    	//console.log(row);
    	row.thumb = row.path;
    	if(first == true)
    	{
    		row.path = 'assets/media/file/attachments/' + row.path;
    		//row.thumb;
    	}
    	$('.tb-data-empty').hide();
    	var no = $('.tb-attachment').attr('next_number');
    	var rowHtml = '<tr class="tb-data-'+row.id_attachment+'">'+
								'<td align="center" class="bordered"><input type="checkbox" class="ckAll" rowid="'+row.id_attachment+'"/></td>'+
								'<td class="bordered">'+imgThumb(row.thumb)+'<a class="img-ln" target="_blank" href="admin/com/proxyurl/load/attachments/'+row.path64+'">'+row.filename+'</a></td>'+
								'<td class="bordered">'+delButton(row)+'</td>'+
							'</tr>';
		$('table.tb-attachment tbody').append(rowHtml).show();
		$('.tb-attachment').attr('next_number',parseInt(no)+1);
    }
    function imgThumb(path){
    	//path = path.split('/').join('__SEP__');
    	//console.log(path);
    	return '<div class="img-thumb-cnt"><img src="<?php echo base_url()?>admin/com/surat/attachment/thumb/'+path+'"/></div>';
    }
	function grd_load_data(data) {
		if(!data.length)
		{
			$('.tb-data-empty').show();
			$('.tb-attachment').attr('next_number','1');
		}
		else
		{
			var no = 1;
			for(var i=0;i<data.length;i++)
			{
				var row = data[i];
				var rowHtml = '<tr class="tb-data-'+row.id_attachment+'">'+
								'<td align="center" class="bordered"><input type="checkbox" class="ckAll" rowid="'+row.id_attachment+'"/></td>'+
								'<td class="bordered">'+imgThumb(row.path)+'<a class="img-ln" target="_blank" href="admin/com/proxyurl/load/attachments/'+row.path64+'">'+row.filename+'</a></td>'+
								'<td class="bordered">'+delButton(row)+'</td>'+
							'</tr>';
				$('table.tb-attachment tbody').append(rowHtml).show();
				no+=1;
				$('.tb-attachment').attr('next_number',no);
				//console.log(rowHtml);
			}

		}
	}
	function delete_attachment(data){
		//console.log(data)

		if(confirm('Hapus Gambar ? '))
		{
			$.getJSON('<?php echo base_url()?>admin/com/surat/attachment/delete',data,function(r){
				//console.log(r)
				if(r.success)
				{
					//console.log(data);
					$('.tb-attachment tbody tr.tb-data-'+r.id_attachment).fadeOut('slow');//.remove();

					setTimeout(function(){
						$('.tb-attachment tbody tr.tb-data-'+r.id_attachment).remove();
						//console.log($('.tb-attachment tbody tr').is(':visible'))
						if(!$('.tb-attachment tbody tr').is(':visible'))
						{
							//console.log('SET STATUS EMPTY')
							$('.tb-attachment tbody .tb-data-empty').fadeIn('slow');
						}
					},1300);
					
				}
			})
		}
	}

$(document).ready(function(){
	grd_load_data(<?php echo json_encode($attachment_list)?>);
	createUploader(); 

	$('input[name=ckAll]').click(function(){
		var checked = $(this).attr('checked');
		$('input.ckAll').attr('checked',checked?checked:false);
		//console.log(checked)
	});
});
	
</script>