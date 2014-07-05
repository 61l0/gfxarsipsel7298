<script type='text/javascript'>   
(function($){
    $.fn.gfForm = function(method){
		if ( methods[method] ) {
		  return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
		  return methods.init.apply( this, arguments );
		} else {
		  $.error( 'Method ' +  method + ' does not exist on jQuery.gfForm' );
		}    
	  
	};
	var check_rules = function(){
	    return true;
	};
	var methods = {
	    formId: "",
		init : function(options){
			var settings = {
        	    form_data : {},
				inputModel : {},
				formopt : {},
				td_caption_css:{color:"black"},
				data:{}
			};
			return this.each(function(){
				if ( options ) { 
					$.extend( settings, options );
				}
				var $this = $(this);
				var data = $this.data('gfForm');
				var gfForm = $('<div />', { text : $this.attr('title')});
                
				if ( ! data ) {
					/*	
					Do more setup stuff here
					*/
					$(this).data('gfForm', {
						target : $this,
						gfForm : gfForm
					});
				}
				tbl = $("<table id='gfForm' class='EditTable' cellspacing='0' cellpadding='0' border='0'><tbody></tbody></table>");
                var div = $("<div class='button-box-skyblue' />");
				$.each(settings.inputModel,function(name,inpOpt){
				    var inpTy = methods.cekType(inpOpt.edittype,inpOpt);
				    if(inpOpt.event){
			            inpTy.bind(inpOpt.event);
				    }
				    
					var tr = jQuery("<tr class='ui-jqdialog-content FormData' id='tr_"+name+"' ></tr>");
					var tdCaption = $("<td class='ui-jqdialog-content CaptionTD'></td>");
				    tdCaption.append("<strong>"+inpOpt.label+"</strong>");
					tdCaption.css(settings.td_caption_css);
					$(tr).append(tdCaption);

					var tdMe = $("<td class='ui-jqdialog-content DataTD'></td>").append(inpTy);
					$(tr).append(tdMe);
					$(tbl).append(tr);
				});
				var divbreak = $("<div class='page-break' />");
				tbl.css({'margin-left':'17px'});
				$(div).append(tbl);
				$this.append(div).append(divbreak);
			});
		},
		cekType: function(el,obj){
		    switch (el){
            case "select" :
                var selAttr ={
                    id:obj.name,
                    name:obj.name
                };
                var sel = jQuery("<select />").attr(selAttr);
                if(obj.editoptions){
                    $.each(obj.editoptions.value,function(i,val){
                        $(sel).append("<option value='"+i+"'>"+val+"</option>");
                    });
                }else{
                     $(sel).append("<option value=''>Empty</option>");
                }
                return sel;
                break;
            case "textarea" :
                var txtareAttr = {
                    id:obj.name,
                    name:obj.name,
                };
                if(obj.editoptions){
                    if(obj.editoptions.rows){
                        inpAttr.rows = obj.editoptions.rows;
                    }
                    if(obj.editoptions.maxlength){
                        inpAttr.cols = obj.editoptions.cols;
                    }
                }
                var txtarea = jQuery("<textarea />").attr(txtareAttr);
                return txtarea; 
                break;
            case "checkbox":
                var checkAttr = {
                    type:"checkbox",
                    id:obj.name,
                    name:obj.name,
                };
                if(obj.editoptions){
                    if(obj.editoptions.value){
                        checkAttr.value = obj.editoptions.value;
                    }
                    if(obj.editoptions.checked){
                        checkAttr.checked = obj.editoptions.checked;
                    }
                }
                var checkbox = jQuery("<input />").attr(checkAttr);
                return checkbox; 
                break;
            case "password":
                passAttr = {
                    type: "password",
                    id: obj.name,
                    name: obj.name,
                };
                
                if(obj.editoptions){
                    if(obj.editoptions.size){
                        passAttr.size = obj.editoptions.size;
                    }
                    if(obj.editoptions.maxlength){
                        passAttr.maxlength = obj.editoptions.maxlength;
                    }
                }
                var pass = jQuery("<input />").attr(passAttr);
                return pass;
                break;
            case "label":
                lblAttr = {
                    id: obj.name,
                    name: obj.name,
                };
                var lbl = jQuery("<label />").attr(lblAttr);
                return lbl;
                break;
            default : 
                inpAttr = {
                    id: obj.name,
                    name: obj.name,
                };
                if(obj.editable == false){
                    inpAttr.disabled = true;
                }
                if(obj.editoptions){
                    if(obj.editoptions.size){
                        inpAttr.size = obj.editoptions.size;
                    }
                    if(obj.editoptions.maxlength){
                        inpAttr.maxlength = obj.editoptions.maxlength;
                    }
                }
                if(obj.editrules){
                    if(obj.editrules){
                        ty={};
                        val={};
                        if(obj.editrules.number == true){
                            ty.num = true;
                        }
                        if(obj.editrules.integer == true){
                            ty.int = true;
                        }
                        if(obj.editrules.email == true){
                            ty.email = true;
                        }
                        if(obj.editrules.minValue){
                            var nilai = Number(obj.editrules.minValue);
                            ty.min = true;
                            val.min = nilai;
                        }
                        if(obj.editrules.maxValue){
                            var nilai = Number(obj.editrules.maxValue);
                            ty.max = true;
                            val.max = nilai;
                        }
                        if(obj.editrules.required==true){
                            inpAttr.required = true;
                        }
                        var ind = 0;
                        var ind1 = 0;
                        var typ = Array();

                        var value = Array();
                        $.each(ty,function(i,val){
                            typ[ind]=i+":"+val;
                            ind++;
                        });
                        $.each(val,function(i,val){
                            value[ind1]=i+":"+val;
                            ind1++;
                        });
                        inpAttr.onblur = "checkInp(this,{"+typ+"},{"+value+"});";
                    }
                
                }
                var inp = jQuery("<input />").attr(inpAttr);
                return inp;
                break;
            } 
		},
		getData : function(url){
		    var datax = {};
		    $.ajax({
		        url: url,
		        // global: false,
		        type: 'POST',
		        success:function(data, textStatus, jqXHR){
		            datax = data;
		        },
		        dataType: 'json'
		    });
		},
		submit:function(){
            var inp = jQuery('form,input,select,textarea');
            var jsoninp = new Object();
		    $.each(inp, function(i,val){
		        jsoninp[val.id]=val.value;
		    });
			$.ajax({
			    async: false,
			    url: methods.editUrl,
			    type:'POST',
			    dataType: 'json',
			    data: jsoninp,
			    beforeSend: function(){
			        jQuery("#responceArea").html('');
			        var inp_req = new Array();
			        var inp_count = 0;
			        $.each(inp, function(i,val){
		                if(val.required){
		                    if(val.value==""){
		                        jQuery("#responceArea").append("<b>"+val.name+"</b> can not empty, This is required! </br>");
		                        inp_count++;
		                    }
		                }
		            });
                    if(inp_count > 0){
                        return false;                    
                    };
			    },
			    success: function(data){
			        jQuery("#responceArea").html('Sukses!!')
			    }
			});
		},
	};
})(jQuery);
</script>

