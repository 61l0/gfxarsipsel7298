<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_file extends CI_Model {
	public function index_js()
    {
		$js_files = array(
			"assets/apps/autoload/lib/d3.min.js",
			"assets/apps/autoload/lib/jquery-ui.min.js", 
			"assets/apps/autoload/lib/bootstrap.min.js",
			"assets/apps/autoload/lib/angular-route.min.js",
			"assets/apps/autoload/lib/angular-ui.min.js", 
			"assets/apps/autoload/lib/ui-bootstrap-tpls.min.js", 
			"assets/apps/autoload/lib/ng-table.min.js", 
			"assets/apps/autoload/lib/bootstrap-select.min.js",
			"assets/apps/autoload/lib/spin.min.js", 
			"assets/apps/autoload/lib/ladda.min.js", 
			"assets/apps/autoload/lib/ngProgress.min.js", 
			// "assets/lang/id-ID.js", "assets/apps/autoload/application.js", "assets/apps/autoload/services.js", "assets/apps/autoload/controllers.js", "assets/apps/autoload/filters.js", "assets/apps/autoload/directives.js"
		);

		return combine_assets($js_files);
    }

    public function app_js()
    {
		$js_files  = array(
			"assets/apps/app.js", 
		);

		$this->load->helper('directory');
		$this->load->helper('file');

		$base_dir 		 = realpath(FCPATH   . "assets/apps");
		$base_config_dir = $base_dir . "/config";

		$data 		     = (object)array(
			'controller_buffer'=> '',
			'route_buffer' => '',
			'permission_buffer'=> '',
			'lang_buffer'=> '',
			'service_buffer'=> ''
			
		);

		

		// LOAD SPEARATED JS FILE IN THIS SECTION
		// read config json file
		$config_maps = directory_map($base_config_dir, FALSE, TRUE);
		foreach ($config_maps as $json_filename) 
		{
			$json_content = file_get_contents($base_config_dir . "/{$json_filename}");
			$config_json  = json_decode($json_content);
			$module_dir   = FCPATH   . $config_json->base ;
			
			$base_templates = '$base_templates_'.$config_json->name;
			$controller_path = $module_dir . '/' . $config_json->js_files->controller;
			if(file_exists($controller_path))
			{
				$data->controller_buffer .= "\n".$base_templates.'="'.$config_json->base.'/templates/'.'";'."\n";
				$data->controller_buffer .= "\n".str_replace('$base',$base_templates,file_get_contents($controller_path));  

			}

			$permission_path = $module_dir . '/' . $config_json->js_files->permission;

			if(file_exists($permission_path))
			{
				$data->permission_buffer .= "\n".file_get_contents($permission_path);  
			}

			$route_path = $module_dir . '/' . $config_json->js_files->route;
			
			if(file_exists($route_path))
			{
				
				$data->route_buffer .= "\n".$base_templates.'="'.$config_json->base.'/templates/'.'";'."\n";
				$data->route_buffer .= "\n".str_replace('$base',$base_templates,file_get_contents($route_path));  
			}
			
			$lang_path = $module_dir . '/' . $config_json->js_files->lang;
			if(file_exists($lang_path))
			{
				$lang_name = '$lang_' . $config_json->name;
				$data->lang_buffer .= "\n".str_replace('$lang',$lang_name,file_get_contents($lang_path));  
				$data->lang_buffer .= "\n".'try{ if(typeof '.$lang_name.' != "undefined")$.extend(i18n.languages,'.$lang_name.');}catch(e){console.log(e);}' . "\n";
			}
			$service_path = $module_dir . '/' . $config_json->js_files->service;

			if(file_exists($service_path))
			{
				$data->service_buffer .= file_get_contents($service_path);  
			}
		}

		
		
		$buffer = $this->load->view('www_static/app_js',$data,true);

		return combine_assets($js_files) . $buffer;
    }

}