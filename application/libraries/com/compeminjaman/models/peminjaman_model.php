<?php
class Peminjaman_model extends CI_Model {
    function __construct (){
        parent::__construct();
//		$this->responce = array();
	}
 	function tahun(){
		$arr_tahun = array();
		$th = '2025';
		for($i=1980; $i <= $th	; $i++){
			$arr_tahun[] = $i;
		}
		return $arr_tahun;
	}
	
	function lokasi_penyimpanan(){
		$this->db->select('id_lokasi_simpan, name');
		$this->db->where('id_parent',0);
		$data = $this->db->get('arsip_lokasi_simpan')->result();
		return $data;
	}
	
	function jenis_arsip(){
		$data = $this->db->get('arsip_jenis_cat')->result();
		return $data;
	}

	function sifat_arsip(){
		$data = $this->db->get('arsip_sifat_cat')->result();
		return $data;
	}
	
	function simpan(){
		$oper = $this->input->post('oper');
		$status = $this->input->post('status');
		$kode_arsip = $this->input->post('kode_arsip');
		// $judul_arsip = $this->input->post('judul_arsip');
		$klpilih = $this->input->post('klpilih');
			if($klpilih == 'instansi'){
				$id_skpd = $this->input->post('id_skpd');
				$nama_klient = $this->input->post('nama_klient_skpd');
				$alamat_klient = '';//
				$nik = '';//
				$pemberi_kuasa = $this->input->post('pemberi_kuasa_skpd');
				$nipk = $this->input->post('nipk_skpd');
				$stamp = strtotime($this->input->post('tgl_pinjam_skpd'));
				$tanggal_pinjam = date("Y-m-d", $stamp);
				$copy = $this->input->post('copy_skpd');
				$jumlah_arsip = $this->input->post('jml_arsip_skpd');
				$nsp = $this->input->post('nsp_skpd');
				$verifikasi = '';//
				$keperluan = '';//
				$status_hasil = $this->input->post('status_hasil_skpd');
				$stamp_kembali = strtotime($this->input->post('tgl_kembali_skpd'));
				$tanggal_kembali = date("Y-m-d", $stamp_kembali);
				$nama_petugas = $this->input->post('nama_petugas_skpd');
			}else{
				$id_skpd = '';//
				$nama_klient = $this->input->post('nama_klient_lp');
				$alamat_klient = $this->input->post('alamat_klient');
				$nik = $this->input->post('nik');
				$pemberi_kuasa = $this->input->post('pemberi_kuasa_lp');
				$nipk = $this->input->post('nipk_lp');
				$stamp_pinjam = strtotime($this->input->post('tgl_pinjam_lp'));
				$tanggal_pinjam = date("Y-m-d", $stamp_pinjam);
				$copy = $this->input->post('copy_lp');
				$jumlah_arsip = $this->input->post('jml_arsip_lp');
				$nsp = $this->input->post('nsp_lp');
				$verifikasi = $this->input->post('verifikasi');
				$keperluan = $this->input->post('keperluan');
				$status_hasil = $this->input->post('status_hasil_lp');
				$stamp_kembali = strtotime($this->input->post('tgl_kembali_lp'));
				$tanggal_kembali = date("Y-m-d", $stamp_kembali);
				$nama_petugas = $this->input->post('nama_petugas_lp');				
			}
		
	
		$this->responce = '';
		switch($oper){
			case 'add':
				$this->db->set('type_client',$klpilih);
				$this->db->set('status',$status);
				$this->db->set('id_data',$kode_arsip);
				$this->db->set('id_skpd',$id_skpd);
				$this->db->set('nama_peminjam',$nama_klient);
				$this->db->set('alamat',$alamat_klient);
				$this->db->set('no_identitas',$nik);
				$this->db->set('nama_pemberi_kuasa',$pemberi_kuasa);
				$this->db->set('no_identitas_pemberi_kuasa',$nipk);
				$this->db->set('tanggal_pinjam',$tanggal_pinjam);
				$this->db->set('type_arsip',$copy);
				$this->db->set('jumlah_arsip',$jumlah_arsip);
				$this->db->set('no_surat',$nsp);
				$this->db->set('bukti_verifikasi',$verifikasi);
				$this->db->set('keperluan',$keperluan);
				$this->db->set('status_hasil',$status_hasil);
				$this->db->set('tanggal_kembali',$tanggal_kembali);
				$this->db->set('nama_petugas',$nama_petugas);
				$this->db->insert('arsip_peminjaman');
				$this->responce['rows'] = array('result'=>'succes','message'=>'Data  berhasil Diinput','oper'=>$oper);
			break;
			
			case 'edit':
				$this->db->where('id_peminjaman',$this->input->post('id_peminjaman'));
				$this->db->set('type_client',$klpilih);
				$this->db->set('status',$status);
				$this->db->set('id_data',$kode_arsip);
				$this->db->set('id_skpd',$id_skpd);
				$this->db->set('nama_peminjam',$nama_klient);
				$this->db->set('alamat',$alamat_klient);
				$this->db->set('no_identitas',$nik);
				$this->db->set('nama_pemberi_kuasa',$pemberi_kuasa);
				$this->db->set('no_identitas_pemberi_kuasa',$nipk);
				$this->db->set('tanggal_pinjam',$tanggal_pinjam);
				$this->db->set('type_arsip',$copy);
				$this->db->set('jumlah_arsip',$jumlah_arsip);
				$this->db->set('no_surat',$nsp);
				$this->db->set('bukti_verifikasi',$verifikasi);
				$this->db->set('keperluan',$keperluan);
				$this->db->set('status_hasil',$status_hasil);
				$this->db->set('tanggal_kembali',$tanggal_kembali);
				$this->db->set('nama_petugas',$nama_petugas);
				$this->db->update('arsip_peminjaman');
				$this->responce['rows']= array('result'=>'succes','message'=>'Data  berhasil Diedit','oper'=>$oper);
			break;
			case 'del':
				$this->db->where('id_peminjaman',$this->input->post('id_peminjaman'));
				$this->db->delete('arsip_peminjaman');
				// dump($this->db->last_query());
				$this->responce['rows']= array('result'=>'succes','message'=>'Data  berhasil Didelet','oper'=>$oper);
			break;
			
			
		}
			return $this->responce;
	}


	function view($id_peminjaman){
		if(!$id_peminjaman)
			$id_peminjaman = $this->input->post('id_peminjaman');
		$this->db->select('a.*,b.judul,b.id_data as id_arsip_data,b.id_lokasisimpan');
		$this->db->where('id_peminjaman',$id_peminjaman);
		$this->db->from('arsip_peminjaman a');
		$this->db->join('arsip_data b','a.id_data=b.id_data');
		$data = $this->db->get()->result();
		// dump($this->db->last_query());
		return $data;	
	}	
	
	function rak($id){
		$this->db->select('a.*',false);
		$this->db->from('arsip_lokasi_simpan a');
		$this->db->join('arsip_lokasi_simpan b','b.path like concat(a.path,\'%\') and b.id_lokasi_simpan='.@$id);
		$data = @$this->db->get()->result();
		// dump($this->db->last_query());
		return @$data;
	}


	
	function get_data(){
		$id_peminjaman = $this->input->post('id_peminjaman');
		$this->db->select('a.*,b.judul,c.id_skpd,c.nama_lengkap');
		$this->db->where('id_peminjaman',$id_peminjaman);
		$this->db->from('arsip_peminjaman a');
		$this->db->join('arsip_data b','a.id_data=b.id_data');
		$this->db->join('m_skpd c','a.id_skpd=c.id_skpd','left');
		$data = $this->db->get()->result();
		// if(count($data) > 0)
		// {
		// 	foreach ($data as &$item) {
		// 		# code...
		// 		$item->nomor_berkas = $item->no_arsip;
		// 	}
		// }
		// dump($this->db->last_query());
		return $data;	
	}
	function autocomplete__($param=false){
		$sql = "select judul from arsip_data where judul like "."'%$param%'";
		$query = $this->db->query($sql);
		return $query->result();  
	}	

	function autocomplete($param=false,$type=false){
		
		if($type=='judul'){
			$sql = "select b.judul as hasil from arsip_peminjaman a join arsip_data b on b.id_data=a.id_data where judul like "."'%$param%' group by a.id_data";
		}else if($type=='nama'){
			$sql = "select nama_peminjam as hasil from arsip_peminjaman where nama_peminjam like "."'%$param%'";
		}
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();  
	}
	function data_image($id){
		$this->db->where('id_data',$id);
		$data = $this->db->get('arsip_galery')->result();
		// dump($this->db->last_query());
		return $data;
	}

	function data_image1($id,$chk){
		$a = explode(',',$chk);
		foreach($a as $i){
		$this->db->or_where('id_galery',$i);
		}
		$this->db->where('id_data',$id);
		$data = $this->db->get('arsip_galery')->result();
		//dump($this->db->last_query());
		return $data;
	}	
	
	function data_cetak($id_data){
		if(!$id_data)
			$id_data = $this->input->post('id_data');
		$this->db->select('a.*,b.name as depo,c.name as nama_masalah,d.nama_lengkap, e.desc as nama_retensi, f.name as nama_jenis, g.name as nama_sifat');
		$this->db->where('a.id_data',$id_data);
		$this->db->from('arsip_data a');
		$this->db->join('arsip_lokasi_simpan b','a.id_lokasisimpan=b.id_lokasi_simpan','left');
		$this->db->join('arsip_kode_masalah c','a.id_kode_masalah=c.id_kode_masalah','left');
		$this->db->join('m_skpd d','a.id_unit_pengolah=d.id_skpd','left');
		$this->db->join('arsip_retensi e','a.id_retensi=e.id_retensi','left');
		$this->db->join('arsip_jenis_cat f','a.id_jenis=f.id_jenis','left');
		$this->db->join('arsip_sifat_cat g','a.id_sifat=g.id_sifat','left');
		$data = $this->db->get()->result();
		return $data;	
	}		
		
}	
