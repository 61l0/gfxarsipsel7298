gf = {
	content:{
		load:function(){},
		fragment:function(elmContainer,url,postData){
			console.log(url);
			jQuery(elmContainer).slideUp(1000,function(){
				jQuery(elmContainer).html('');
				jQuery(elmContainer).load(url,postData,function(){
					jQuery(elmContainer).slideDown(1000,function(){
					});
				});
			});
		}
	},
	dialog:{
		layer: function(url,postData,settings){
			var countLayer = jQuery(".dialogLayer:visible").length;
			var id = countLayer + 1;
			// var zin = 1000 + id + 50;
			jQuery("#dialogArea"+id).length || jQuery('<div id="dialogArea'+id+'" class="dialogLayer" />').appendTo('body').css('display','none');
			var dialog = jQuery("#dialogArea"+id);
			dialog.dialog('destroy').html('Sedang memuat..............');
			var options = {
					modal:true
					,title: 'title'
					,width: 500
					,height: 300
					,closeOnEscape:false
					,stack:true
				};
			jQuery.extend(options, settings);
			dialog
				.load(url,postData);
				dialog.dialog(options);
			dialog.dialog('open');
			dialog.dialog( "moveToTop" );
			return false;
		},
		notif:{
			buka: function(message, settings){
				jQuery("#dialogNotifArea").length || jQuery('<div id="dialogNotifArea" class="dialogNotifArea" />').appendTo('body').css('display','none');
				var dialog = jQuery("#dialogNotifArea");
				//alert(dialog.dialog);
				dialog.dialog('destroy').html('');
				var options = {
						modal:true
						,title: 'Notifikasi'
						,width: 300
						,height: 200
						,closeOnEscape:false
						,stack:true
					};
				jQuery.extend(options, settings);
				dialog
					.load("assets/templates/adminica/notification.html",function(){
						jQuery("#dialogNotifArea #responceNotifArea").html(message);
					});
					dialog.dialog(options);
				dialog.dialog('open');
				dialog.dialog( "moveToTop" );
				return false;
			}
		}
	}
}