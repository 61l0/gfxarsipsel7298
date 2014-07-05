<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Notifikasi extends Modul {

	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}
	public function index()
	{
		error_reporting(E_ALL);
		//die('op');
		$key = md5('notifikasi-pinjam');
		// CEK DB DARI logstat
		$logstat = $this->CI->db->where(array('log_key'=>$key))->get('log_stat')->row();

		//print_r($logstat);
		if( $this->CI->input->post('aksi')=='update')
		{
			if($logstat)
			{
				$log_value = explode(',', $logstat->log_value );

				$total_peminjaman_lama 		= intval($log_value[0]); // 8
				$total_peminjaman_baru 		= intval($log_value[1]); // 7
			}

			$logstat=array(
				'status'		=>'0',
				'log_value'		=> ($total_peminjaman_baru + $total_peminjaman_lama ) . ',0'
			);
			$status = $this->CI->db->where(array('log_key'=>$key))->update('log_stat',$logstat);
			echo json_encode(array('status'=>$status['result']?1:0));
			exit;
		}
		
		if( $this->CI->input->post('aksi')!='get')
		{
			die('Invalid Request');
		}
		// GET JUMLAH VALID FROM arsip_peminjaman
		$data =  $this->CI->db->select('COUNT(arsip_peminjaman.id_peminjaman) total')
					 ->where(array('arsip_peminjaman.status'=>'pinjam'))
					 ->from('arsip_peminjaman')
					 ->join('arsip_data','arsip_peminjaman.id_data = arsip_data.id_data','right')
					 ->get()
					 ->row();
		$total_peminjaman = $data->total;
		

		
		
		//$status	 = '';

		if( !$logstat )
		{
			$logstat = array(
				'log_key' 	=> $key,
				'log_value' => '0,'.$total_peminjaman,
				'status'	=> '1'
			);

			$this->CI->db->insert('log_stat',$logstat);
		}
		else
		{
			// EXTRACT LOG VALUE
			$log_value = explode(',', $logstat->log_value );

			$total_peminjaman_lama 		= intval($log_value[0]); // 8
			$total_peminjaman_baru 		= intval($log_value[1]); // 2


			$total_peminjaman_tersimpan = $total_peminjaman_lama + $total_peminjaman_baru; // 10 


			//        11			>			<  10
			if( $total_peminjaman  > $total_peminjaman_tersimpan)
			{
				//print_r($log_value);
				//echo 'NEDD UPDATE';	
				//echo "$total_peminjaman_tersimpan";
				// 3										// 11       -    10						+  2	
				$n_total_peminjaman_baru 		= ($total_peminjaman - $total_peminjaman_tersimpan) + $total_peminjaman_baru;
				$n_total_peminjaman_lama 		= $total_peminjaman_lama; // 8
				

				$logstat=array(
					'status'		=>'1',
					'log_value'		=> $n_total_peminjaman_lama . ',' . $n_total_peminjaman_baru
				);
				//$logstat->log_value = ;
				//$logstat->status = '1';
				$this->CI->db->where(array('log_key'=>$key))->update('log_stat',$logstat);
			}	
		}
		//print_r($data);
		echo json_encode($logstat);
	}
}