

App.injectControllers = function(controllers){
	<?php echo $controller_buffer;?>

};

App.injectPermissions = function(promises,user,$scope){
	<?php echo $permission_buffer;?>

};

App.injectRoutes = function($routeProvider){
	<?php echo $route_buffer;?>

};
App.injectLanguages=function(i18n){
	<?php echo $lang_buffer;?>

};
App.injectServices=function(factory){
	<?php echo $service_buffer;?>

};