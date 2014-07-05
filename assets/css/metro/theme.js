(function($){
  $.fn.extend({ 
    onShow: function(callback, unbind){
      return this.each(function(){
        var obj = this;
        var bindopt = (unbind==undefined)?true:unbind; 
        if($.isFunction(callback)){
          if($(this).is(':hidden')){
            var checkVis = function(){
              if($(obj).is(':visible')){
                callback.call();
                if(bindopt){
                  $('body').unbind('click keyup keydown', checkVis);
                }
              }                         
            }
            $('body').bind('click keyup keydown', checkVis);
          }
          else{
            callback.call();
          }
        }
      });
    }
  });
})(jQuery);
function NavigationHistory (argument) {
		
		var loc = location.hash.replace(/\W*/,'').replace(/\.php$/,'').replace(/\-/,'_');

		if( NavigationHistory.last_loc != loc )
		{
			NavigationHistory.last_loc = loc;
			NavigationHistory.EntryPoint.Start();
		}
		//console.log(loc);
		setTimeout(function (argument) {
			NavigationHistory();
		},500);
	}
	NavigationHistory.last_loc = '';
	NavigationHistory.EntryPoint = {
		Start:function(){

			$('#main_panel_container .table-flat').addClass(NavigationHistory.last_loc);
			if(typeof NavigationHistory.Callback[NavigationHistory.last_loc] == 'object')
			{
				if(typeof NavigationHistory.Callback[NavigationHistory.last_loc].start== 'function')
				{
					NavigationHistory.Callback[NavigationHistory.last_loc].start();
				}
				else
				{
					//console.log('NavigationHistory.Callback.' + NavigationHistory.last_loc + '.start() is not a function.')
				}	
			}
			else
			{
				//console.log('NavigationHistory.Callback.' + NavigationHistory.last_loc + ' is not an object.')
			}
			
		}
	}
	NavigationHistory.Callback = {
		'data_master' : {
			start : function(){
				//console.log(NavigationHistory.last_loc);
			}
		},
		'pengolahan'  : {
			title : 'Data Pengolahan',	
			icon : 'icon-envelope',
			start :function(){
				NavigationHistory.SetAppTitle(this.title,this.icon)
			}	
		},
		'peminjaman_pelayanan':{
			title : 'Peminjaman / Pelayanan',
			'icon': 'icon-hand-right',
			start : function(){
				//NotifikasiPinjam.Update();
			}
		}
	}
	NavigationHistory.Init = function (node) {
		//location.hash = '/' + $(node).last().text().replace(/\s/g,'-').toLowerCase().replace(/\//,'-').replace(/\-*/,'')+'.php';
	}

	NavigationHistory.SetAppTitle = function(title,icon){
		var el = $('<i></i>').addClass('fa ' + icon);
		document.title = 'ARSIP :: ' + title;
		// setTimeout(function () {
		// 	$('#header_caption_content h3').empty().append(el).append('&nbsp;' + title);// body...
		// },1000)
		
	}
var tabindex = 2;
jQuery(document).ready(function  () {
	var html = '<a href="javascript:;" tabindex="1"><i class="fa icon-home"></i>'+'&nbsp;Sistem Informasi Arsip Daerah'+'</a>'
	$('.header-title').html(html);

	var username = $('.header-status a:first').text().replace(/Login\ssebagai\s\:/,'').replace(/\[.*\]/,'');

	html = '<a href="javascript:;" tabindex="2"><i class="fa icon-user"></i>&nbsp;'+ username +'</a>';
	var w = $('<div></div>').addClass('w');

	var profileNav =w.clone().addClass('profileNav').append(html);

	$('.header-status').before(profileNav);

	$('.header-status').fadeOut();

	// $('.header-status a:first').html($('.header-status a:first').html().replace(/\|/,''));

	// RESETTING CONTENT HEIGHT
	$('div.content').css('height','auto !important');

	$('#navigation').append(w.clone().addClass('cl'));
	var tabindex=2;
	$('#navigation > ul > li > div > a').click(function () {
		// NavigationHistory.Init(this);

		// setTimeout(function() {
		// 	$('.page .content').css('height','auto');
		// 	//window.
		// 	// var idGrid =$('.ui-jqgrid:first').attr('id').replace(/gbox_/,'');
		// 	// var grid   = $('table#'+idGrid);

		// 	 // RESIZE GRID
		// 	// $('.content').hide();
		// 	// grid.jqGrid('setGridWidth',$('.content').width()-10);
		// 	// document.title = 'ARSIP :: ' + $('#header_caption_content h3').text();
		// 	// $('#header_caption_content h3').html('<i class="fa icon-envelope"></i>&nbsp;'+$('#header_caption_content h3').text().replace(/»/,'/'));
		// 	// $('.content').show();
		// 	// console.log(grid);

		// }, 500);
		var parent = $(this).parent().parent();
		if(!parent.hasClass('parent-menu'))
		{
			$('.accordionMenu').remove();
		}
		//$('.header-title').click();
		// $('#navigation').slideUp(500,function(){
		// 	//console.log('OK');
		// 	$('#header_caption_content').css('margin','-25px 0 0');
		// });
	});

	$('#navigation').css('left','0').css('overflow','hidden');
	/*
datamaster
theme.js (line 55)
pengolahan
theme.js (line 55)
penyerahan-akuisisi
theme.js (line 55)
pemusnahan-retensi
theme.js (line 55)
peminjaman-pelayanan
theme.js (line 55)
suratelektronik
theme.js (line 55)

theme.js (line 55)
laporan
	*/
	var icon_nav_list={
		'beranda' : 'icon-home',
		'datamaster' : 'icon-hdd' ,
		'pengolahan': 'icon-retweet',
		'penyerahan-akuisisi': 'icon-exchange',
		'pemusnahan-retensi': 'icon-trash',
		'peminjaman-pelayanan': 'icon-hand-right',
		'catatanskpd': 'icon-list-alt',
		'suratmasuk&keluar': 'icon-envelope',
		'laporan': 'icon-bar-chart',
		'pengaturanpengguna':'icon-group',
		'pengaturanmenu':'icon-th-list',
		'pengguna':'icon-user'
	}
	$('#navigation ul li a span img').each(function () {
		//var src = $(this).attr('src').replace(/\.png$/,'').split('/');
		tabindex+=1;
		$(this).parent().parent().attr('tabindex',tabindex)
		var icon = $(this).parent().parent().text().replace(/\s*/g,'').replace(/\//,'-').toLowerCase();
		console.log(icon);
		$(this).replaceWith('<i class="fa '+ icon_nav_list[icon]+'"></i>');

	})

	$('.profileNav').click(function() {
		$('.header-status').toggle();
	})
	// $('.header-title').click(function () {
	// 	if($('#navigation').is(':hidden')){
	// 		$('#navigation').slideDown();
	// 		//$('#header_caption_content').css('margin','-53px 0 0');
	// 		$('#header_caption_content h3').hide();
	// 		$('.sub-navigation').show();
	// 	}
	// 	else{
			
	// 		$('#navigation').slideUp(500,function(){
	// 			//console.log('OK');
	// 			//$('#header_caption_content').css('margin','-25px 0 0');
	// 		});
	// 		$('#header_caption_content h3').hide();


	// 	}
	// })

	// $('#navigation').resizable().mouseout(function () {
	// 	//$(this).fadeOut();
	// });


	function check_interval(){
		var dlg = $('.dialogLayer.ui-dialog-content.ui-widget-content:last');
		if(dlg.length && !dlg.hasClass('scrolleds'))
		{
			//console.log('dumb');
			//dlg.addClass('scrolleds');//.jScrollPane();
			//dlg.find('.jspContainer').width(dlg.parent().width());
			//if(!dlg.is(':hidden'))
			$('#ui-datepicker-div').css('border','none');
			//$('rdpilih')
		}
		else
		{
			setTimeout(function(){
				check_interval();
			},1000);
		}
	}
	check_interval();


	//var last_loc = '';
	
	NavigationHistory();
	$('#navigation > ul > li').each(function(){
		if( $(this).find('>ul').length > 0){
			$(this).addClass('parent-menu');
		}
	});
	$('li.parent-menu > ul > li').each(function(){
		if( $(this).find('>ul').length > 0){
			$(this).addClass('parent-menu-a');

		}
	});

	$('li.parent-menu-a > ul > li').each(function(){
		if( $(this).find('>ul').length > 0){
			$(this).addClass('parent-menu-b');
		}
	});

	$('li.parent-menu').mouseover(function(){
	    var subMenu = $(this).find('>ul');
	    // subMenu.css({
	    // 	position:'absolute',
	    // 	'z-index':1000,
	    // 	display:'block !important'
	    // })
	  });

	$('.parent-menu > div > a').unbind('click');
	$('.parent-menu  > div > a').click(function(){
		var haveAccordion = $(this).data('haveAccordion');
		var subNav = $('<div></div>').addClass('sub-navigation');
		var caption= $(this).text().replace(/\s+/g,' ');
		//console.log(caption)
		if( true )
		{
			$(this).data('haveAccordion',true);

			// ADD CLASS
			var subNavNode = $(this).parent().parent().find('> ul');//.addClass('subnav-item');

			// CREATE ACCORDION
			var accordion 			= $('<div></div>').addClass('accordionMenu');
			
			// ADD DATA
			// caption
			// [link]
			//var accordionSection	= $('<h3></h3>').addClass('accordionSection').text( caption );
			
			
			//var accordionContent	= $('<div></div>').addClass('accordionContent').append(subNavNode);

			var uList = subNavNode.find('> li > a ');

			// VALUES
			// PARENT
			//console.log(uList)
			var data = {};
			//data[caption] = [];
			
			$.each(uList,function(i,a) {
				var caption2= $(a).text().replace(/\s+/g,' ');
				var link = $(a).attr('href');

				// PERIKSA APAKAH LI MEMILIKI SUBMENU
				//console.log($(a).parent())
				if( $(a).parent().hasClass('parent-menu-a') )
				{
					// LI PUNYA SUBMENU
					// PERIKSA APAKAH KONTAINER SUDAH DIBUAT
					if( typeof data[caption2] == 'undefined')
					{
						data[caption2] = [];
					}

					var uList2 = $(a).parent().find('>ul > li > a');
					//console.log(uList2)
					$.each(uList2,function(x,y){
						var caption3= $(y).text().replace(/\s+/g,' ');
						data[caption2].push({
							'caption' : caption3,
							//'link'	  :	link,
							'onclick'  :$(y).attr('onclick')	
						})
					})

					
				}
				else
				{
					if( typeof data[caption] == 'undefined')
					{
						data[caption] = [];
					}
					
					data[caption].push({
						'caption' : caption2,
						//'link'	  :	link,
						'onclick'  :$(a).attr('onclick')	
					})
					// LI TIDAK PUNYA SUBMENU
				}
					
				//console.log(a);
			})

			//console.log(data)

			$.each(data,function(key,val){
				tabindex += 1;
				var accordionSection2	= $('<h3></h3>').addClass('accordionSection').text( key ).attr('tabindex',tabindex);
				var accordionContent2	= $('<div></div>').addClass('accordionContent');
				var list = $('<ul></ul>');
				$.each(val,function(index,obj){
					tabindex += 1;
					var li = $('<li></li>');
					var div = $('<div></div>').addClass('accordion-item');
					var anchor = $('<a></a>').attr('tabindex',tabindex).attr('onclick',obj.onclick ).html('<i class="fa icon-hand-right"></i>'+obj.caption)
					accordionContent2.append(li.append(div.append(anchor)));
				//	console.log(obj)
 				})

 				accordion.append(accordionSection2).append(accordionContent2);
			})
						
			
			var realAccordion 		= accordion;

			$('.accordionMenu').remove();
			$('.main-content').append(realAccordion);
			realAccordion.accordion({});
			$('.accordionMenu a[tabindex]').keydown(function(e){
				//if( !$(this).data('clicked') )
				//{
			//		$(this).data('clicked',false)
		//		}
				if( (e.keyCode == 18 || e.keyCode == 32) ){
					//if( !$(this).data('clicked') )
					//{
					//	$(this).data('clicked',true);
						$(this).click();
					//}
					//console.log(e.keyCode)
					//$(this).data('lastKeyCode',e.keyCode);
				}
			})

			setTimeout(function(){
				$('.accordionMenu a:first').click();
				//$('.accordionMenu a:first').click();
				// $('#navigation').slideUp(500,function(){
				// 	//console.log('OK');
				// 	$('#header_caption_content').css('margin','-25px 0 0');
				// });
			},300);
		}

	// 	$('.sub-navigation').html('');
	// 	var sub = $(this).parent().parent().find('> ul').addClass('subnav-item');
	// 	sub.append('<div class="cb"></div>');
	// 	sub.find('> div > a').each(function () {
	// 		//console.log(this);
	// 		//if( !$(this).find('i').length ){
	// 			console.log('icon')
	// 			var text = $(this).text();
	// 			var html = '<i class="fa icon-hdd"></i>&nbsp;' + text;
				
	// 		//}else{
	// //			$(this).html(html);
	// //		}
	// 	})
	// 	var subNav = $('<div></div>').addClass('sub-navigation');
	// 	$('#navigation').after(subNav.append(sub.clone()));
	// 	$('ul.subnav-item > li > a').click(function(){
	// 		//alert('click')
	// 		var parent_menu_a = $(this).parent();
	// 		console.log(parent_menu_a);
	// 		var subMenu = parent_menu_a.find('> ul');
	// 		if( subMenu.length > 0 )
	// 		{
	// 			subMenu.show();
	// 			console.log('HAVE SUBMENU')
	// 			// HAVE ANOTHER SUB MENU
	// 			return false;
	// 		}
	// 		else
	// 		{
	// 			// DOESNT HAVE SUB MENU
	// 			console.log('DOESNT HAVE SUBMENU')
	// 			$('.header-title > a').click();
	// 		}
	// 	});
	// 	//$('#navigation .subnav-item').slideDown()

	});

	
	

	var subMenuList = $('ul.subnav-item > li > a');
	//console.log(subMenuList);
	var ajaxChecker = $('<div>HELP</div>').addClass('ajaxChecker');
	//$('body').prepend(ajaxChecker);

	GridChecker();

	$('a[tabindex]').keydown(function(e){
		//if( !$(this).data('clicked') )
		//{
	//		$(this).data('clicked',false)
//		}
		if( (e.keyCode == 18 || e.keyCode == 32) ){
			//if( !$(this).data('clicked') )
			//{
			//	$(this).data('clicked',true);
				$(this).click();
			//}
			//console.log(e.keyCode)
			//$(this).data('lastKeyCode',e.keyCode);
		}
	})



	///////////////
	// $('#navigation').masonry({
	// 	columnWidth		: 320,
	// 	itemSelector	: '>ul>li'
	// }).imagesLoaded(function() {
	// 	$('#navigation').masonry('reload');
	// });

	//$('#navigation').css('height')

	///////////


})


function GridChecker(){

	var grid = $('#main_panel_container > center > .ui-jqgrid table.ui-jqgrid-btable');
	if( $('.accordionMenu').length && grid.length && grid.attr('id') != GridChecker.LastGridId && !grid.attr('replaced'))
	{
		GridChecker.LastGridId = grid.attr('id');
		GridChecker.GridObject = grid;

		//console.log('grid added');
		
		
		grid.attr('replaced',true)
		//GridChecker.GridObject.hide();

		// GridChecker.GridObject.jqGrid('setGridParam', { gridComplete: function(id){ 
		// 	//if(!$('.accordionMenu').is(':hidden') && !GridChecker.GridObject.attr('resized'))
		// 	//{
		// 		setTimeout(function(){	
		// 			GridChecker.GridObject.jqGrid('setGridWidth',GridChecker.FlexibleWidth);
		// 			console.log(GridChecker.FlexibleWidth)

		 			$('#gbox_'+GridChecker.LastGridId).css('float','right');
		// 			//GridChecker.GridObject.slideDown();

		// 		//	GridChecker.GridObject.attr('resized','true')
		// 		},300);
		// 	//}
		// } } );


		

		
	}
	GridChecker.FlexibleWidth = $('.main-content').width() - $('.accordionMenu').width() - 50;

	if( !$('.accordionMenu').width() )
	{
		if( $('.ui-jqgrid').is(':hidden') )
		{
			$('.ui-jqgrid').slideDown()
		}


	}
	else
	{
		// calculate top 
		var banner_height = $('.banner').height();
		var header_height = $('.header').height();
		var navigation_height = $('#navigation').height();
		var grid_title_height = $('.grid-title').height();
		var toolbar_filter_height = 0;//$('.toolbar-filter').height();
		var toolbar_grid_height = $('.toolbar-grid').height();
		var margin = 40;
		var top = banner_height + header_height + navigation_height + grid_title_height + toolbar_grid_height + toolbar_filter_height +margin;

		var css = top + 'px';

		// if( $('#navigation').is(':hidden') )
		// {
			var mTop = 194;
			if($('.accordionMenu').css('top')!= mTop+'px' ){
				$('.accordionMenu').animate({
					top:mTop
				},2000)
				//console.log('top  is ' + $('.accordionMenu').css('top'))
			}
		// }
		// else
		// {
			
		// 	if($('.accordionMenu').css('top')!= css ){
		// 		$('.accordionMenu').animate({
		// 			top:top
		// 		},150)
		// 	}
		// }
	}
	if(  $('.accordionMenu').length && grid.length && GridChecker.FlexibleWidth != $('#gbox_'+GridChecker.LastGridId).width() )
	{
		$('#gbox_'+GridChecker.LastGridId).css({
			//position:'absolute',
			//margin : '-10000px'
			//opacity:'0'
			//display:'none'
		});
		GridChecker.GridObject.jqGrid('setGridWidth',GridChecker.FlexibleWidth);
		
		//console.log('doing resizing');
		//console.log(GridChecker.GridObject);

		setTimeout(function(){	
			$('#gbox_'+GridChecker.LastGridId).css({
				opacity: '1',
				position : 'relative',
				float:'right',
				display:'block'
			});
			$('#main_panel_container').removeClass('lap-mode');
			// 	width:'100%',
			// 	'float':'none',
			// 	'margin-top':'auto'
			// })
		},500);
		
	}


	// PERIKSA NON GRID
	if(!grid.length)
	{
		$('#main_panel_container').addClass('lap-mode');
		// 	width:'80%',
		// 	'float':'right',
		// 	'margin-top':'2em'
		// })
	}
	setTimeout(function () {
		GridChecker();
	},100)

	
}	
GridChecker.FlatTable = 0;
GridChecker.FlexibleWidth = 0;
GridChecker.LastGridId = false;	
GridChecker.GridObject = false;



// NOTIFIKASI PINJAM
var NotifikasiPinjam = {
	// INTERVAL WAKTU CEK DATA
	Interval: 80000,
	Style: 'notifikasi-pinjam',
	El : 'ul.paging > li > div > a:contains(Peminjaman/Pelayanan)',
	Url: base_url() + 'admin/com/peminjaman/loadsub',				
	Start:function(){
		NotifikasiPinjam.EntryPoint();
		setTimeout(function() {
			NotifikasiPinjam.Start();		
		},NotifikasiPinjam.Interval)
	},
	EntryPoint:function () {
		$.post(NotifikasiPinjam.Url+'?get',{name:'notifikasi',aksi:'get'},function(r){
			try
			{
				var data = $.parseJSON(r);
				if( parseInt(data.status) > 0 )
				{
					//console.log(data);
					var penminjaman_baru = data.log_value.split(',')[1];
					var title = 'Ada ' + penminjaman_baru + ' Peminjaman baru';

					$(NotifikasiPinjam.El).parent().addClass(NotifikasiPinjam.Style);	
					$(NotifikasiPinjam.El).attr('title',title);
					//$(NotifikasiPinjam.El).tooltip({})

				}	
			}

			//
			catch(e){}
		});
	},
	Update:function () {
		$.post(NotifikasiPinjam.Url+'?update',{name:'notifikasi',aksi:'update'},function(r){
			 var data = $.parseJSON(r);
			 if(parseInt(data.status) > 0)
			 {
			 	//console.log(data);
			 	$(NotifikasiPinjam.El).parent().removeClass(NotifikasiPinjam.Style);
			 	$(NotifikasiPinjam.El).attr('title','');
			 	//$(NotifikasiPinjam.El).parent().unbind('mouseover');
			 }
			
		});
	}
}

function DialogLoop(){

	// ADD DIALOG LOOP HERE
	// QUEUE
	var DP = $('input.hasDatepicker');
	if(DP.length)
	{
		DP.each(function(){
			//console.log(this)
			if(! $(this).data('changeMe'))
				 $(this).data('changeMe',1);

			if( $(this).data('changeMe') <= 10 && !$('select.ui-datepicker-year').is(':hidden'))
			{
				if( $(this).val() == '01-01-1970' || !$(this).val().length){
					$(this).val('')
					// $(this).datepicker('setDate',new Date('1980-01-01'));
					// $(this).val('')
					// $(this).data('changeMe',$(this).data('changeMe')+1);
					// var firstY = 1980;
					// var endY   = 2025;
					// var option = '';

					// while(firstY <= endY)
					// {
					// 	option += '<option value="'+firstY.toString()+'">'+firstY.toString()+'</option>';
					// 	firstY+=1;
					// }
					// $('select.ui-datepicker-year').empty().append(option);
				}
			}
			// else
			// {
				
			// }
			// if($('select.ui-datepicker-year').is(':hidden'))
			// {
			// 	$(this).data('changeMe',0);
			// }
			// if(!$(this).data('updatedMinMaxChangeProp')){
			// 	DP.datepicker("option","defaultDate",-1);
			// 	var currentTime = new Date();
			// 	// First Date Of the month 
			// 	var startDateFrom = new Date(1979,1,1);
			// 	// Last Date Of the Month 
			// 	var startDateTo = new Date(1999,12,1);
			// 	DP.datepicker("option", "minDate", startDateFrom);
	  //           DP.datepicker("option", "maxDate", startDateTo);
	  //           $(this).data('updatedMinMaxChangeProp',true);
   //      	}
		});
	}
	var EL = $('#edithdgridcommstlokasisimpan');
	if(EL.length)
	{
		var isOpen = EL.is(':visible');
		//console.log(isOpen);
		//var mode = EU.find('.ui-jqdialog-title').text();
		if(!isOpen )
		{
			EL.data('dont_change',false);

		}

		if(!EL.data('dont_change') && isOpen )
		{
			console.log('DO THIS CHANGE AT ' + (new Date()));
			EL.data('dont_change',true);
			setTimeout(function(){
				$('select#type > option[value=folder]').text('Sampul');
			},300)
			
		}
	}	
	var EU = $('#editmodgridcomuser');
	if(EU.length)
	{
		if( !EU.data('aux') )
		{

		}
		var isOpen = EU.is(':visible');
		//console.log(isOpen);
		//var mode = EU.find('.ui-jqdialog-title').text();
		if(!isOpen )
		{
			EU.data('dont_change',false);
			EU.find('.navButton a#pData').unbind('click');
			EU.find('.navButton a#nData').unbind('click');
		}

		if(!EU.data('dont_change') && isOpen )
		{
			//console.log('DO THIS CHANGE AT ' + (new Date()));
			EU.data('dont_change',true);

			

			// Do change your form here
			var id_skpd_sotk = EU.find('input#id_skpd_sotk').val();
			var id_unit_pengolah = EU.find('input#id_unit_pengolah').val();
			var txt_skpd = EU.find('input#txt_skpd');
			var txt_pengolah = EU.find('input#txt_pengolah');

 			
 			// if( id_skpd_sotk.val() == '' || id_skpd_sotk.val() == 0)
 			// 	txt_skpd.val('');
 			// if( id_unit_pengolah.val() == '' || id_unit_pengolah.val() == 0)
 			// 	txt_pengolah.val('');
 			function hidePop(){
 				EU.find('#tr_id_skpd_sotk').hide();
 				EU.find('#tr_id_unit_pengolah').hide();

 				EU.find('#id_skpd_sotk').val('0');
 				EU.find('#id_unit_pengolah').val('0');
 			}
 			setTimeout(function(){
	 				// DO SOME CSS ALTER
					EU.find('#instansi').width('350px');
					EU.find('#nama_pengguna').width('350px');
					EU.find('select#group_id').change(function(event) {
					
					var gid = $(this).val();
					// <option value="1" role="option">superadmin</option>
					// <option value="2" role="option">admin</option>
					// <option value="3" role="option">skpd</option>
					// <option value="6" role="option">operator</option>

					if(gid=="1" || gid == "2")
					{	
						hidePop();
					}
					else if(gid == "3")
					{
						hidePop();
						EU.find('#id_skpd_sotk').val('');
						EU.find('#tr_id_skpd_sotk').fadeIn();
					}
					else if(gid == "6")
					{
						hidePop();
						EU.find('#id_unit_pengolah').val('');
						EU.find('#tr_id_unit_pengolah').fadeIn();
					}else{
						hidePop();
					}

				}).change();
 			},100)
 			

 			try{
	 			if( typeof window.aux.skpd_sotk_list[id_skpd_sotk] != 'undefined' )
	 				txt_skpd.val(window.aux.skpd_sotk_list[id_skpd_sotk])
	 			else
	 				txt_skpd.val('');

	 			if( typeof window.aux.unit_pengolah_list[id_unit_pengolah] != 'undefined' )
	 				txt_pengolah.val(window.aux.unit_pengolah_list[id_unit_pengolah])
	 			else
	 				txt_pengolah.val('');
			}
			catch(e){
				txt_skpd.val('');
				txt_pengolah.val('');
			}///////////////////////////////////
			var onPageClick = function(){
				//console.log(EU.find('input#id_skpd_sotk').val())
				//console.log(EU.find('input#id_unit_pengolah').val())
				
			}
			EU.find('.navButton a#pData').click(onPageClick).hide();
			EU.find('.navButton a#nData').click(onPageClick).hide();

		}
		
	}
	

	setTimeout(function(){
		DialogLoop();
	},250)
}
// RUN
$(document).ready(function(){
	var node = $(NotifikasiPinjam.El);
	var need_checker = node.length > 0;


	if(need_checker)
	{
		NotifikasiPinjam.Start();
	}
	$(NotifikasiPinjam.El).click(function(){
		NotifikasiPinjam.Update();
	});

	DialogLoop();

});	


if( typeof jQuery.dispatch == 'undefined')
{
	jQuery.dispatch = function(){};
}