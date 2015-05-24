
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


	// RESETTING CONTENT HEIGHT
	$('div.content').css('height','auto !important');

	$('#navigation').append(w.clone().addClass('cl'));
	var tabindex=2;
	$('#navigation > ul > li > div > a').click(function () {
	
		var parent = $(this).parent().parent();
		if(!parent.hasClass('parent-menu'))
		{
			$('.accordionMenu').remove();
		}
	});


	var icon_nav_list={
		'beranda' : 'icon-home',
		'datamaster' : 'icon-hdd' ,
		'pengolahan': 'icon-retweet',
		'penyerahanakuisisi': 'icon-exchange',
		'pemusnahanretensi': 'icon-trash',
		'peminjamanpelayanan': 'icon-hand-right',
		'catatanskpd': 'icon-list-alt',
		'suratmasukkeluar': 'icon-envelope',
		'laporan': 'icon-bar-chart',
		'pengaturanpengguna':'icon-group',
		'pengaturanmenu':'icon-th-list',
		'pengguna':'icon-user',
		'logaktifitaspengguna':'icon-flag',
	}
	$('#navigation ul li a span img').each(function () {
		tabindex+=1;
		$(this).parent().parent().attr('tabindex',tabindex)
		var icon = $(this).parent().parent().text().replace(/(\s|\W)*/g,'').replace(/\//,'-').toLowerCase();
		$(this).replaceWith('<i class="fa '+ icon_nav_list[icon]+'"></i>');

	})

	$('.profileNav').click(function() {
		$('.header-status').toggle();
	});
	
	var nav_width = 0;
	$('#navigation > ul > li').each(function(){
		if( $(this).find('>ul').length > 0){
			$(this).addClass('parent-menu');
		}

		nav_width += $(this).width();
	});

	// console.log(nav_width)
	$('#navigation > ul.paging').width(nav_width);
	// ADD CLEAR BOTH
	$('#navigation').after('<div class="cb"></div>'); 
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

			var subNavNode = $(this).parent().parent().find('> ul');//.addClass('subnav-item');

			// CREATE ACCORDION
			var accordion 			= $('<div></div>').addClass('accordionMenu');
			
			// ADD DATA
			// caption
			// [link]

			var uList = subNavNode.find('> li > a ');

			// VALUES
			// PARENT
			var data = {};
			
			$.each(uList,function(i,a) {
				var caption2= $(a).text().replace(/\s+/g,' ');
				var link = $(a).attr('href');

				// PERIKSA APAKAH LI MEMILIKI SUBMENU
				if( $(a).parent().hasClass('parent-menu-a') )
				{
					// LI PUNYA SUBMENU
					// PERIKSA APAKAH KONTAINER SUDAH DIBUAT
					if( typeof data[caption2] == 'undefined')
					{
						data[caption2] = [];
					}

					var uList2 = $(a).parent().find('>ul > li > a');
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
						'onclick'  :$(a).attr('onclick')	
					})
					// LI TIDAK PUNYA SUBMENU
				}
					
			})


			$.each(data,function(key,val){
				tabindex += 1;
				var accordionSection2	= $('<h3></h3>').addClass('accordionSection').text( key ).attr('tabindex',tabindex);
				var accordionContent2	= $('<div></div>').addClass('accordionContent');
				var list = $('<ul></ul>');
				$.each(val,function(index,obj){
					tabindex += 1;
					var li = $('<li></li>');
					var div = $('<div></div>').addClass('accordion-item');
					var anchor = $('<a></a>').attr('tabindex',tabindex).attr('onclick',obj.onclick ).html('<i class="fa icon-chevron-right"></i> '+obj.caption)
					accordionContent2.append(li.append(div.append(anchor)));
 				})

 				accordion.append(accordionSection2).append(accordionContent2);
			})
						
			
			var realAccordion 		= accordion;

			$('.accordionMenu').remove();
			$('.main-content').append(realAccordion);
			realAccordion.accordion({});
			$('.accordionMenu a[tabindex]').keydown(function(e){
				if( (e.keyCode == 18 || e.keyCode == 32) ){
						$(this).click();
				}
			})

			setTimeout(function(){
				$('.accordionMenu a:first').click();
				
			},300);
		}
	});

	
	

	var subMenuList = $('ul.subnav-item > li > a');
	var ajaxChecker = $('<div>HELP</div>').addClass('ajaxChecker');

	GridChecker();

	$('a[tabindex]').keydown(function(e){

		if( (e.keyCode == 18 || e.keyCode == 32) ){
			
				$(this).click();
			
		}
	})


})


function GridChecker(){

	var grid = $('#main_panel_container > center > .ui-jqgrid table.ui-jqgrid-btable');
	if( $('.accordionMenu').length && grid.length && grid.attr('id') != GridChecker.LastGridId && !grid.attr('replaced'))
	{
		GridChecker.LastGridId = grid.attr('id');
		GridChecker.GridObject = grid;

		
		
		grid.attr('replaced',true)
		
		$('#gbox_'+GridChecker.LastGridId).css('float','right');
		

		

		
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

			var mTop = 193;
			if($('.accordionMenu').css('top')!= mTop+'px' ){
				$('.accordionMenu').animate({
					top:mTop
				},2000)
			}
	}
	if(  $('.accordionMenu').length && grid.length && GridChecker.FlexibleWidth != $('#gbox_'+GridChecker.LastGridId).width() )
	{
		GridChecker.GridObject.jqGrid('setGridWidth',GridChecker.FlexibleWidth);
		

		setTimeout(function(){	
			$('#gbox_'+GridChecker.LastGridId).css({
				opacity: '1',
				position : 'relative',
				float:'right',
				display:'block'
			});
			$('#main_panel_container').removeClass('lap-mode');
		},500);
		
	}


	// PERIKSA NON GRID
	if(!grid.length)
	{
		$('#main_panel_container').addClass('lap-mode');
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
					
				}
			}
			
		});
	}
	var EL = $('#edithdgridcommstlokasisimpan');
	if(EL.length)
	{
		var isOpen = EL.is(':visible');
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
		if(!isOpen )
		{
			EU.data('dont_change',false);
			EU.find('.navButton a#pData').unbind('click');
			EU.find('.navButton a#nData').unbind('click');
		}

		if(!EU.data('dont_change') && isOpen )
		{
			EU.data('dont_change',true);

			

			// Do change your form here
			var id_skpd_sotk = EU.find('input#id_skpd_sotk').val();
			var id_unit_pengolah = EU.find('input#id_unit_pengolah').val();
			var txt_skpd = EU.find('input#txt_skpd');
			var txt_pengolah = EU.find('input#txt_pengolah');

 			
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
 			
 			console.log(id_unit_pengolah)

 			try{

	 			if( typeof window.aux.skpd_list[id_unit_pengolah] != 'undefined' )
	 				txt_pengolah.val(window.aux.skpd_list[id_unit_pengolah])
	 			else
	 				txt_pengolah.val('');
			}
			catch(e){
				txt_skpd.val('');
				txt_pengolah.val('');
			} 
			var onPageClick = function(){
				
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