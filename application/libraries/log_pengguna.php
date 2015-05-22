<?php

class Log_pengguna {
	public function push($com,$menu,$operation,$id_data)
	{
		$log = array(
			'user_id' => $_SESSION['user_id'],
			'operation' => $operation,
			'com' => $com,
			'menu' => $menu,
			'id_data' => $id_data,
			'tgl_oper' => date('Y-m-d H:i:s')
		);

		$ci = get_instance();
		$ci->db->insert('arsip_log_user',$log);
	}
}