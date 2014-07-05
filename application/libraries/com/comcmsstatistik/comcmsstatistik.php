<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Comcmsstatistik{

	function Comcmsstatistik(){
		 $this->CI = &get_instance();
	}
	
	function index($arr_params=array()){
		$data['hits'] = $this->hits();
		$data['theCount'] = $this->counter();
		$data['now_online'] = $this->now_online();
		$data['today_online'] = $this->today_online();
		$data['month_online'] = $this->month_online();
		// $page = 'home/statistik_web';
		// $this->CI->load->view($this->CI->template->viewPath.$page, $field);
		$data['com_url'] = 'admin/com/cmsstatistik/';
		$this->CI->load->com('comcmsstatistik','view',array('name'=>'default','data'=>$data));
	}
	
	function hits(){
		$this->CI->db->select('*');
		$this->CI->db->from('stat_usercounter');
		$this->CI->db->where('id', 1);
		$res = $this->CI->db->get()->result_array();
		foreach($res as $row) {
			return $row['hits'];			
		}
	}
	
	function counter(){
		$IPnum = "0.0.0.0";
		$userStatus = 0;
		$maxadmindata = !isset($maxadmindata) ? 5 : $maxadmindata;
		
		$IPnum = getenv("REMOTE_ADDR");
		
		$this->CI->db->select('*');
		$this->CI->db->from('stat_usercounter');
		$this->CI->db->where('id', 1);
		$res = $this->CI->db->get()->result_array();
		$total = count($res);
		if ($total <= 0){
			$this->CI->db->set("id", 1);
			$this->CI->db->set("ip", $IPnum);
			$this->CI->db->set("counter", 1);
			$this->CI->db->set("hits", 1);
			$this->CI->db->insert("stat_usercounter");
		}
		
		foreach($res as $row) {
			$IPdata = $row['ip'];
			$theCount = $row['counter'];
			$hits = $row['hits'];
		}
		
		$IParray = explode("-",$IPdata);
		
		for($ipCount=0;$ipCount<count($IParray);$ipCount++){
			if($IParray[$ipCount]==$IPnum){$userStatus = 1;}                           
		}
		
		$IPdata="";

		if($userStatus == 0){
				$IPdata="$IPnum-";
				for ($i=0; $i<$maxadmindata; $i++):
					$IPdata .= "$IParray[$i]-";		
				endfor;
		
				$theCount++;
				
				$this->CI->db->set("ip", $IPdata);
				$this->CI->db->set("counter", $theCount);
				$this->CI->db->where('id', 1);
				$this->CI->db->update("stat_usercounter");
		}
		
		$hits++;
		$this->CI->db->set("hits", $hits);
		$this->CI->db->where('id', 1);
		$this->CI->db->update("stat_usercounter");
		
		return $theCount;
	}
	
	function now_online(){
		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', getenv("HTTP_X_FORWARDED_FOR")) == ''){
			$uipanda = getenv('REMOTE_ADDR');
		}else{
			$uipanda = getenv('HTTP_X_FORWARDED_FOR');
		}
		
		$uproxyserver=getenv("HTTP_VIA");
		$uipproxy=getenv("REMOTE_ADDR");
		$uhost=gethostbyaddr($uipproxy);
		$utime=time();
		$now=$utime-600;
		
		$this->CI->db->where('timevisit <', $now);
		$this->CI->db->delete('stat_useronline');
		
		$this->CI->db->where('ipproxy', $uipproxy);
		$this->CI->db->from('stat_useronline');
		$uexists = $this->CI->db->count_all_results();
		
		if ($uexists>0){
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->where('ipproxy', $uipproxy);
			$this->CI->db->update("stat_useronline");
		} else {
			$this->CI->db->set("ipproxy", $uipproxy);
			$this->CI->db->set("host", $uhost);
			$this->CI->db->set("ipanda", $uipanda);
			$this->CI->db->set("proxyserver", $uproxyserver);
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->insert("stat_useronline");
		}
		
		//$this->CI->db->select('*');
		//$this->CI->db->from('stat_useronline');
		
		$jmlonline = $this->CI->db->count_all('stat_useronline');
		return $jmlonline; 
	}
	
	function today_online(){
		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', getenv("HTTP_X_FORWARDED_FOR")) == ''){
			$uipanda = getenv('REMOTE_ADDR');
		}else{
			$uipanda = getenv('HTTP_X_FORWARDED_FOR');
		}
		$uproxyserver=getenv("HTTP_VIA");
		$uipproxy=getenv("REMOTE_ADDR");
		$uhost=gethostbyaddr($uipproxy);
		$utime=time();
		$day=$utime-86400; // (in seconds)
		
		$this->CI->db->where('timevisit <', $day);
		$this->CI->db->delete('stat_useronlineday');
		
		$this->CI->db->where('ipproxy', $uipproxy);
		$this->CI->db->from('stat_useronlineday');
		$uexists = $this->CI->db->count_all_results();
		
		if ($uexists>0){
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->where('ipproxy', $uipproxy);
			$this->CI->db->update("stat_useronlineday");
		} else {
			$this->CI->db->set("ipproxy", $uipproxy);
			$this->CI->db->set("host", $uhost);
			$this->CI->db->set("ipanda", $uipanda);
			$this->CI->db->set("proxyserver", $uproxyserver);
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->insert("stat_useronlineday");
		}
		
		$jmlonline = $this->CI->db->count_all('stat_useronlineday');
		
		return $jmlonline;
	}
	
	function month_online(){
		if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', getenv("HTTP_X_FORWARDED_FOR")) == ''){
			$uipanda = getenv('REMOTE_ADDR');
		}else{
			$uipanda = getenv('HTTP_X_FORWARDED_FOR');
		}
		
		$uproxyserver=getenv("HTTP_VIA");
		$uipproxy=getenv("REMOTE_ADDR");
		$uhost=gethostbyaddr($uipproxy);
		$utime=time();
		$month=$utime-2592000; // (in seconds)
		
		$this->CI->db->where('timevisit <', $month);
		$this->CI->db->delete('stat_useronlinemonth');
		
		$this->CI->db->where('ipproxy', $uipproxy);
		$this->CI->db->from('stat_useronlinemonth');
		$uexists = $this->CI->db->count_all_results();
		
		if ($uexists>0){
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->where('ipproxy', $uipproxy);
			$this->CI->db->update("stat_useronlinemonth");
		} else {
			$this->CI->db->set("ipproxy", $uipproxy);
			$this->CI->db->set("host", $uhost);
			$this->CI->db->set("ipanda", $uipanda);
			$this->CI->db->set("proxyserver", $uproxyserver);
			$this->CI->db->set("timevisit", $utime);
			$this->CI->db->insert("stat_useronlinemonth");
		}
		$jmlonline = $this->CI->db->count_all('stat_useronlinemonth');
		
		return $jmlonline;
	}
	
	function detail(){
		$tengah  = '<div class="title" style="font-size:"> <img src="styles/'.getThemes().'/img/red_bullet.gif" />
					<h3>Statistik Web</h3>
					</div><br />';
		
		$this->CI->db->select('*');
		$this->CI->db->from('stat_browse');
		$res = $this->CI->db->get()->result_array();
		
		$a=1;
		foreach($res as $row) {
			$PJUDUL = $row["pjudul"];
			$PPILIHAN = explode("#", $row["ppilihan"]);
			$PJAWABAN = explode("#", $row["pjawaban"]);
			$jmlpil = count($PPILIHAN);
			$JMLVOTE = array();
			
			for($i=0;$i<$jmlpil;$i++)
			{
				@$JMLVOTE[$a] = $JMLVOTE[$a] + $PJAWABAN[$i];
				//dump(@$JMLVOTE[$a]);
			}
			
			if($JMLVOTE[$a] == 0)
			{
				@$JMLVOTE[$a] = 1;
			}
			
			$tengah .= '<table width="100%" border="0" cellpadding="3" cellspacing="3" class="table-list-view" bgcolor="#FFFFFF">';
			$tengah .= '<tr class="head"><th colspan="4">'.$PJUDUL.'</th></tr>';
			
			for($i=0;$i<$jmlpil;$i++)
			{
				if($i % 2 == 0){
					$class = 'class="blink"';
				}else{
					$class = '';
				}
				$persentase = round($PJAWABAN[$i] / $JMLVOTE[$a] * 100, 2);
				$tengah .= '<tr '.$class.'>';
				$tengah .= '<td>'.$PPILIHAN[$i].'</td>';
				$loop = floor($persentase)* 2;
				$tengah .= '<td><img src="'.BASE_URL.'assets/media/file/statistik_img/aqua.gif" alt="" width="'.$loop.'" height="9" /></td>';
				$tengah .= '<td>'.$PJAWABAN[$i] . ' = ('.$persentase.'%)</td>';
				$tengah .= '</tr>';
			}
			
			$tengah .= '</table>';
			$tengah .= '<div id="article_body"><h1>Total : '.$JMLVOTE[$a].'</h1></div><br />';
			$a++;
		}
		echo $tengah;
	}
}

?>