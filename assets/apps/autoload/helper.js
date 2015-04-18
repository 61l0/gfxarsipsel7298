Helper = {
	// Hide_Activity_Indicator:function(timeout){
		
	// },
	Get_Root_Scope : function(){
		var appElement = document.querySelector('#rootScope');
    	return angular.element(appElement).scope() || {showAcIndicator:function(){}};
	},
	/*CONVERT REGULAR NUM TO CURRENCY */
	IDR_Currency : function (amount, decimalSeparator, thousandsSeparator, nDecimalDigits){
	    var num = parseFloat( amount ); //convert to float
	    //default values
	    decimalSeparator 	= decimalSeparator || '.';
	    thousandsSeparator 	= thousandsSeparator || ',';
	    nDecimalDigits 		= nDecimalDigits == null? 2 : nDecimalDigits;

	    var fixed 			= num.toFixed(nDecimalDigits); //limit or add decimal digits
	    //separate begin [$1], middle [$2] and decimal digits [$4]
	    var parts 			= new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed); 
	    if(parts){ //num >= 1000 || num < = -1000
	        var parts = parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');
	        return parts;
	    }else{
	        return fixed.replace('.', decimalSeparator);
	    }
	},
	/* CONVERT CURRENCY TO NUMBER */
	IDR_Currency_Number : function(amount) {
		return parseInt(amount.replace(/\D/g,''));
	},
	/* CURRENCY KEY STROKE CHECKER */
	Currency_Key_Stroke_Only: function(keycode){

		/* VALID KEYSTROKE ARE 012345678. \b\del\left-arrow\right-arrow*/
    	var validKeyCodes =  [
	    	8,					//backspace
	    	37,					// LEFT
	    	39,					// RIGHT
	    	46,					// DEL
	    	48,					// 0
	    	49,					// 1
	    	50,					// 2
	    	51,					// 3
	    	52,					// 4
	    	53,					// 5
	    	54,					// 6
	    	55,					// 7
	    	56,					// 8
	    	57,					// 9	
	    	96, 				// NUM PAD 0
	    	97, 				// NUM PAD 1 
	    	98, 				// NUM PAD 2 
	    	99, 				// NUM PAD 3 
	    	100, 				// NUM PAD 4 
	    	101, 				// NUM PAD 5 
	    	102, 				// NUM PAD 6 
	    	103, 				// NUM PAD 7 
	    	104, 				// NUM PAD 8 	
	    	105, 				// NUM PAD 9
	    	101					// .
    	];
    	return $.inArray(keycode,validKeyCodes) >= 0;
	},
	/* PIN KEY STROKE CHECKER */
	PIN_Key_Stroke_Only: function(keycode){

		/* VALID KEYSTROKE ARE 012345678 \b\del\left-arrow\right-arrow*/
    	var validKeyCodes =  [
	    	8,					//backspace
	    	37,					// LEFT
	    	39,					// RIGHT
	    	46,					// DEL
	    	48,					// 0
	    	49,					// 1
	    	50,					// 2
	    	51,					// 3
	    	52,					// 4
	    	53,					// 5
	    	54,					// 6
	    	55,					// 7
	    	56,					// 8
	    	57,					// 9	
	    	96, 				// NUM PAD 0
	    	97, 				// NUM PAD 1 
	    	98, 				// NUM PAD 2 
	    	99, 				// NUM PAD 3 
	    	100, 				// NUM PAD 4 
	    	101, 				// NUM PAD 5 
	    	102, 				// NUM PAD 6 
	    	103, 				// NUM PAD 7 
	    	104, 				// NUM PAD 8 	
	    	105 				// NUM PAD 9
    	];
    	return $.inArray(keycode,validKeyCodes) >=0 ;
	},
	Waktu_Hari : function()
	{
		 var waktu = '';
		 var h=(new Date()).getHours(); 
		 var m=(new Date()).getMinutes(); 
		 var s=(new Date()).getSeconds(); 
		 if (h > 3 && h < 12) 
		 	waktu = 'pagi'; 
		 if (h > 11 && h < 15) 
		 	waktu = 'siang' ;
		 if (h > 14 && h < 18) 
		 	waktu='sore'; 
		 if (h > 17 || h < 4) 
		 	waktu = 'malam';

		 return waktu;
	}
};