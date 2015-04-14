<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('JS_PATH' , 'assets/js/');
define('CSS_PATH' , 'assets/css/');
define('GF_LIBPATH' ,'lib/');
define('GF_COMPATH' , 'com/');
define('GF_COM_PREFIX' , 'com');
define('GF_COM_VIEWPATH' , 'com/com');

define('DOC_PATH_BASE', $_SERVER['DOCUMENT_ROOT'].'/');

$this_dir = dirname(__FILE__) . '/../..';

define('DOC_PATH_ROOT', realpath($this_dir) . '/');

define('DOC_PATH_APP' , DOC_PATH_ROOT.'application/');
define('DOC_PATH_GRID' , DOC_PATH_APP.'libraries/grid/');
define('CLASSES_PATH' , DOC_PATH_ROOT.'classes/');
define('TEMPLATES_PATH' , DOC_PATH_ROOT.'assets/templates/');
//var_dump(DOC_PATH_ROOT);
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
