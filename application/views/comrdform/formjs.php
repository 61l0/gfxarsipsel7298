<script type='text/javascript'>   
(function($){
    $.fn.gfForm = function(method){
		if ( methods[method] ) {
		  return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
          methods.url = arguments[0].url;
          methods.editUrl = arguments[0].editUrl;
		  return methods.init.apply( this, arguments );
		} else {
		  $.error( 'Method ' +  method + ' does not exist on jQuery.gfForm' );
		}    
	  
	};
	var check_rules = function(){
	    return true;
	};
	var methods = {
	    url : "",
	    editUrl : "",
	    formId: "",
		init : function(options){
			var settings = {
        	    form_data : {},
				inputModel : {},
				formopt : {},
				td_caption_css:{color:"black"},
				url: this.url,
				editUrl: this.editUrl,
				// top : 0,
				// left: 0,
				// width: 300,
				// height: 'auto',
				// url: null,
				// mtype : "POST",
				// onInitializeForm: null,
				// beforeInitData: null,
				// beforeShowForm: null,
				// afterShowForm: null,
				// beforeSubmit: null,
				// afterSubmit: null,
				// onclickSubmit: null,
				// afterComplete: null,
				// editData : {},
				// topinfo : '', ==> topinfo untuk memberi informasi di atas tabel or form
				// bottominfo: '', ==> untuk memberi informasi di bawah tabel or form
				// saveicon : [],
				// closeicon : [],
				// savekey: [false,13],
				// navkeys: [false,38,40],
				// checkOnSubmit : false,
				// processing : false,
				// onClose : null,
				// ajaxEditOptions : {},
				// serializeEditData : null
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
				var frmtb = "frmHuya";
				frm = $("<form onSubmit='return false;' style='width:100%;overflow:auto;position:relative;'></form>").data("disabled",false),
				tbl = $("<table id='"+frmtb+"' class='EditTable' cellspacing='0' cellpadding='0' border='0'><tbody></tbody></table>");
				$(frm).attr(settings.formopt);
				$(frm).append(tbl);
		        $.ajax({
		            url: settings.url,
		            type: 'POST',
		            dataType: 'json',
		            success:function(data, textStatus){
		                $.extend(settings.form_data,data.data);
		            },
		        });
		        
		        // console.log(settings.form_data.email);
				// var responseText = methods.getData(methods.url);
				$.each(settings.inputModel,function(name,inpOpt){
				    var inpTy = methods.cekType(inpOpt.edittype,inpOpt);
				    
				    // console.log(settings.form_data);
				    
					var tr = jQuery("<tr class='ui-jqdialog-content FormData' id='tr_"+name+"' ></tr>");
					var tdCaption = $("<td class='ui-jqdialog-content CaptionTD'></td>");
				    tdCaption.append("<strong>"+inpOpt.label+"</strong>");
					tdCaption.css(settings.td_caption_css);
					$(tr).append(tdCaption);
					// $(inpTy).attr('value',settings.form_data[name]);
					var tdMe = $("<td class='ui-jqdialog-content DataTD'></td>").append(inpTy);
					$(tr).append(tdMe);
					$(tbl).append(tr);
				});
				$this.append(frm);
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
                    // $(sel).append("<option value=''>Pilih</option>");
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
            
            // eval("var result = {"+responseText['responseText']+"}");
            // console.log(responseText);
            console.log(datax);
		    // return result;
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
function checkInp(field,objty,objval) {
    $.each(objty,function(ty,val){
        // /*
        if(ty=='num'){
            var regExpr = new RegExp("([0-9]+\.[0-9]*)|([0-9]*\.[0-9]+)|([0-9]+)");
            if (!regExpr.test(field.value)) {
              // alert('Not a valid Number');
              field.value = "";
            }
        }
        if(ty=='int'){
            var regExpr = new RegExp("^[0-9]+$");
            if (!regExpr.test(field.value)) {
              // Case of error
              // alert('Not a valid Integer');
              field.value = "";
            }
        }
        if(ty=='email'){
            var Mail=field.value.toLowerCase();
            var cek = (Mail.search(/^([a-z]+)([a-z0-9\-\_\.]{1,100})([a-z0-9]+)\@([a-z0-9]+)([a-z0-9\-\.]*)([a-z0-9]+)\.([a-z]{2,6})$/) != -1);
            if(cek==false){
                if(field.value !== ""){
                    alert('Not a valid email');            
                }
                field.value = "";
            }
        }
        if(ty=='min'){
            if(field.value){
                if(field.value < objval.min){
                    alert('can not fill less than '+objval.min);
                    field.value = "";
                }
            }
        }
        if(ty=='max'){
            if(field.value){
                if(field.value > objval.max){
                    alert('can not fill greather than '+objval.max);
                    field.value = "";
                }
            }
        }
        // */
    });
}
</script>

