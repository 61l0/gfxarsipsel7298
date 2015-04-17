<?php
function add_cached_header($age)
{
	error_reporting(0);
    $headers 		= apache_request_headers();
    $timestamp 		= time();
    $tsstring 		= gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
    $etag 			= md5($timestamp);

    header("Last-Modified: $tsstring");
    header("ETag: \"{$etag}\"");
    header('Expires: Thu, 01-Jan-70 00:00:01 GMT');

    if(isset($headers['If-Modified-Since'])) {
        if(intval(time()) - intval(strtotime($headers['If-Modified-Since'])) < 600) 
        {
          header('HTTP/1.1 304 Not Modified');
          exit();
        }
    }
    flush();
}
function combine_assets($files)
{
	$buffer = '';
	$no =1;
	foreach ($files as $file) 
	{
		$filename = $file;
		$file = FCPATH  . $file;
		if(file_exists($file))
		{
			$buffer .= "\n\n";
			$buffer .= file_get_contents($file);

		}
		else
		{
			//$buffer .= "/** 404  ". $file . "*/\n\n";
		}
	}
	return $buffer;
}

function js_str($s)
{
    return '"' . addcslashes($s, "\0..\37\"\\") . '"';
}

function js_array($array)
{
    $temp = array_map('js_str', $array);
    return '[' . implode(',', $temp) . ']';
}