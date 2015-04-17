Callback = {
	Global_Ajax_Start : function(config){
		// console.log(config);
  //       console.log(config.requestTimestamp, 'ajax call started');
  		Helper.Get_Root_Scope().showAcIndicator('<i class="fa fa-spin fa-spinner"></i>') ;
	},
	Global_Ajax_Stop : function(config){
		//console.log(config.responseTimestamp ,'ajax call stopped');
	},
	Global_Ajax_Success : function(config){
		//console.log(config.responseTimestamp ,'ajax stopped with success');
  		Helper.Get_Root_Scope().showAcIndicator('<i class="fa fa-check"></i>');

	},
	Global_Ajax_Error : function(config){
		//console.log(config.responseTimestamp ,'ajax stopped with errors');
  		Helper.Get_Root_Scope().showAcIndicator('<i class="fa fa-exclamation"></i>');

	}
};