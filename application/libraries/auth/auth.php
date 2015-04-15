<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth {

	var $CI = null;

	function Auth()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('auth/fungsi','auth/simplival');
	}
	function checkIP()
	{
		$domain = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
		 ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$this->CI->db->from('allowed_ip');
		$this->CI->db->where('ip_address',$domain);
		$exist = $this->CI->db->count_all_results();
		if($exist == 0)
		{
			echo $this->CI->fungsi->warning($this->CI->config->item('project_name').' tidak memperbolehkan Login di Area Anda',site_url());
			die();
		}
	}
	function checkOnline($id)
	{
		$this->CI->db->where('user_id',$id);
		$this->CI->db->from('c_online');
		return $this->CI->db->count_all_results();
	}
	function getLastActivity($id)
	{
		$this->CI->db->select('last_activity');
		$this->CI->db->from('c_online');
		$this->CI->db->where('user_id',$id);
		$data = $this->CI->db->get();
		$row = $data->row();
		return $row->last_activity;
	}
	function getDiff($old,$now)
	{
	    if($old == '' OR $now == '')
	    {
	       return TRUE;
	    }
		$old_y = date('Y',$old);
		$old_m = date('n',$old);
		$old_d = date('j',$old);
		$old_g = date('G',$old);
		$old_i = date('i',$old);
		//$old_s = date('s',$old);
		$now_y = date('Y',$now);
		$now_m = date('n',$now);
		$now_d = date('j',$now);
		$now_g = date('G',$now);
		$now_i = date('i',$now);
		//$now_s = date('s',$now);
		//start checking
		if($now_y!=$old_y){return TRUE;}
		if($now_m!=$old_m){return TRUE;}
		if($now_d!=$old_d){return TRUE;}
		if($now_g!=$old_g){return TRUE;}
		// ignore second
		$diff_minute = $now_i - $old_i;
		if($diff_minute >= 10){ return TRUE;}
		return FALSE;
	}
	function process_login($login = NULL)
	{
		
	     	// A few safety checks
	    	// Our array has to be set
	    	// $this->checkIP();
	    	if(!isset($login))
		        return FALSE;
		
	    	//Our array has to have 2 values
	     	//No more, no less!
	    	if(count($login) != 2)
	         	return FALSE;
		
	     	$user_name = $login['user_name'];
	     	$password = $this->CI->encrypt->sha1($login['user_password']);

	     	//die($password);
	
			$where = array('a.user_name'=>$user_name,'a.user_password'=>$password);
			$this->CI->db->where($where);
			$this->CI->db->join('c_group b','a.group_id=b.id_group');
			// $data = $this->db->CI->get('c_user a')->row();		
			$query = $this->CI->db->get('c_user a');
			// echo var_dump($this->CI->db->last_query());
		foreach ($query->result() as $row)
        	{

			$section 		= $row->group_name;
			$section_type 	= $row->section_name;
			$user_id		= $row->user_id;
			$group_id 		= $row->group_id;
			$user_name		= $row->user_name;
			$user_password	= $row->user_password;

			//$instansi 		= $row->instansi;
			$id_skpd 		= $row->id_unit_pengolah;

			$nama_pengguna 	= $row->nama_pengguna;
			$status_online 	= $this->checkOnline($user_id);
			// $count++;
				// if($status_online == 1)
				// {
				// 	$now = time();
				// 	$old = $this->getLastActivity($user_id);
				// 	if(!$this->getDiff($old,$now))
				// 	{
				// 		$responce = array('result'=>'failed','message'=>"Anda masih tercatat dalam database sebagai user online.\nIni mungkin terjadi karena :\n1. Anda belum \"Logout\" pada waktu terakhir kali Anda login, atau \n2. Ada orang lain yang sedang menggunakan user Anda. \nJika kemungkinan pertama memang benar, Anda hanya perlu menunggu sekitar 10 menit dari \nsejak aktivitas terakhir Anda di sistem. Jika 10 menit berselang namun \nAnda masih tetap tidak bisa login, maka kemungkinan kedua bisa jadi benar. \nJika Anda tidak yakin, silakan hubungi Administrator untuk konfirmasi. \nHal ini penting untuk mengindari adanya pemakaian user oleh orang yang tidak bertanggung jawab.");
				// 		echo json_encode($responce);
				// 		die();
				// 	}else{
				// 		$this->CI->db->delete('c_online',array('user_id'=>$user_id));
				// 	}
				// }
        	}
	
	     	if ($query->num_rows() == 1)
	     	{
				//===================== Get skpd query=========================	
				// $this->->db->select('d.id_skpd_sotk,d.id_skpd');
				// $this->CI->db->from('m_skpd_sotk d');
				// $this->CI->db->join('m_skpd e','d.id_skpd=e.id_skpd');
				// $this->CI->db->join('m_sotk f','d.id_aturan_skpd=f.id_aturan_skpd');
				// $this->CI->db->where('d.id_skpd_sotk',$id_skpd_sotk);
				// $this->CI->db->where('f.status','on');
				//$skpd = $this->CI->db->get()->row(); 
				if($id_skpd)
				{
					$skpd = $this->CI->db->where('id_skpd',$id_skpd)->get('m_skpd')->row();
				}
			//=============================================================
				$_SESSION['id_skpd'] 		= $id_skpd;

				$_SESSION['section'] 		= $section_type;
				$_SESSION['nama'] 			= $section;
				$_SESSION['user_id']		= $user_id;
				$_SESSION['user_name']	    = $user_name;
				$_SESSION['user_group'] 	= $group_id;
				$_SESSION['nama_pengguna'] 	= $nama_pengguna;
				$_SESSION['logged_in']      = TRUE;
			switch ($section):
				case 'superadmin':
					$_SESSION['superadmin'] = $section;
					break;
				case 'admin':
					$_SESSION['admin'] = $section;
					break;
				case 'operator':
				// die;
					$_SESSION['operator'] = $section;
					$_SESSION['skpd_data'] = $skpd;
					break;
				break;
				default:
				break;
			endswitch;
			
			// insert user_id to table 'online'
			if(!$status_online){
				$this->CI->db->insert('c_online',array('user_id'=>$user_id));
			}
			return TRUE;
		}
		else 
		{
		    // No existing user.
		    return FALSE;
		}
	}
 
       /**
         *
         * This function restricts users from certain pages.
         * use restrict(TRUE) if a user can't access a page when logged in
         *
         * @access	public
         * @param	boolean	wether the page is viewable when logged in
         * @return	void
         */	
    	function restrict($logged_out = FALSE)
    	{
		// $this->checkIP();
		// If the user is logged in and he's trying to access a page
		// he's not allowed to see when logged in,
		// redirect him to the index!
		if ($logged_out && $this->logged_in())
		{
		      echo $this->CI->fungsi->warning('Maaf, sepertinya Anda sudah login...',site_url($_SESSION['nama'] ));
				// $responce = array('result'=>'failed','message'=>'Maaf, sepertinya Anda sudah login...');
		      die();
		}
		
		// If the user isn' logged in and he's trying to access a page
		// he's not allowed to see when logged out,
		// redirect him to the login page!
		if ( ! $logged_out && ! $this->logged_in()) 
		{
		      echo $this->CI->fungsi->warning('Anda diharuskan untuk Login bila ingin mengakses halaman Administrasi.',site_url('login'));
			  // $responce = array('result'=>'failed','message'=>'Anda diharuskan untuk Login bila ingin mengakses halaman Administrasi.');
		      die();
		}
     	}

/**
 *
 * Checks if a user is logged in
 *
 * @access	public
 * @return	boolean
 */	
    	function logged_in()
      	{
      		if (@$_SESSION['user_id'] == FALSE)
	         {
	    	    	return FALSE;
	         }
	        else 
	         {
	         return TRUE;
	         }
    }
    function logout() 
    {
		// $kegiatan='Logout '.$this->CI->config->item('project_name').' by '.$this->CI->session->userdata('nama');
		// $this->CI->fungsi->catat($kegiatan);
		// delete the 'online' status 
		$user_id=$_SESSION['user_id'];
		$this->CI->db->delete('c_online',array('user_id'=>$user_id));
		// destroy the session
		$this->CI->session->sess_destroy();	
		return TRUE;
    }
	
}
// End of library class
// Location: system/application/libraries/Auth.php
