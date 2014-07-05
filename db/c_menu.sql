/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : db_arsipsel

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-07-05 15:11:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `c_menu`
-- ----------------------------
DROP TABLE IF EXISTS `c_menu`;
CREATE TABLE `c_menu` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) NOT NULL,
  `level` int(5) NOT NULL,
  `menu_icon` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `menu_index` int(10) NOT NULL,
  `menu_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `menu_path` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('on','off') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=573 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of c_menu
-- ----------------------------
INSERT INTO `c_menu` VALUES ('2', '0', '1', 'icon-sistem.png', '2', 'System Preference', 'admin/com/jqhome', 'off');
INSERT INTO `c_menu` VALUES ('266', '160', '2', '-', '2', 'Menu', 'admin/com/menu', 'on');
INSERT INTO `c_menu` VALUES ('160', '2', '0', '-', '3', 'Konfigurasi', 'admin/com/sysmenu', 'on');
INSERT INTO `c_menu` VALUES ('368', '0', '0', 'icon-user.png', '20', 'Pengguna', '-', 'on');
INSERT INTO `c_menu` VALUES ('271', '0', '0', 'icon-data.png', '2', 'Data Master', '-', 'on');
INSERT INTO `c_menu` VALUES ('272', '271', '0', '-', '2', 'Sifat', 'admin/com/mstsifat', 'on');
INSERT INTO `c_menu` VALUES ('276', '271', '0', '-', '1', 'Jenis', 'admin/com/mstjenis', 'on');
INSERT INTO `c_menu` VALUES ('479', '271', '0', '-', '6', 'Kode Masalah', 'admin/com/mstkdmasalah', 'on');
INSERT INTO `c_menu` VALUES ('480', '271', '0', '-', '7', 'Lokasi Simpan', 'admin/com/mstlokasisimpan', 'on');
INSERT INTO `c_menu` VALUES ('481', '271', '0', '-', '8', 'Retensi', 'admin/com/mstretensi', 'off');
INSERT INTO `c_menu` VALUES ('476', '271', '0', '-', '3', 'Kode Komponen', 'admin/com/mstkdkomponen', 'off');
INSERT INTO `c_menu` VALUES ('477', '271', '0', '-', '4', 'Kode Pembantu', 'admin/com/mstkdpembantu', 'off');
INSERT INTO `c_menu` VALUES ('478', '271', '0', '-', '5', 'Instansi', 'admin/com/mstunitpengolah', 'on');
INSERT INTO `c_menu` VALUES ('396', '394', '0', '-', '2', 'Daftar Pengguna', 'admin/com/user', 'on');
INSERT INTO `c_menu` VALUES ('397', '2', '0', '-', '5', 'Pengaturan Menu', '-', 'on');
INSERT INTO `c_menu` VALUES ('398', '397', '0', '-', '1', 'Daftar Menu', 'admin/com/menu', 'on');
INSERT INTO `c_menu` VALUES ('394', '2', '0', '-', '4', 'Pengaturan Pengguna', '-', 'on');
INSERT INTO `c_menu` VALUES ('433', '0', '0', 'icon-home.png', '1', 'Beranda', 'admin/com/jqhome', 'on');
INSERT INTO `c_menu` VALUES ('314', '0', '0', 'icon-program.png', '3', 'Pengolahan', 'admin/com/pengolahan', 'on');
INSERT INTO `c_menu` VALUES ('315', '160', '2', '-', '3', 'Group User', 'admin/com/groupuser', 'on');
INSERT INTO `c_menu` VALUES ('316', '160', '0', '-', '4', 'Group Menu', 'admin/com/groupmenu', 'on');
INSERT INTO `c_menu` VALUES ('386', '368', '0', '-', '2', 'Ganti Password', 'admin/com/userpass', 'on');
INSERT INTO `c_menu` VALUES ('350', '160', '0', '-', '1', 'User', 'admin/com/user', 'on');
INSERT INTO `c_menu` VALUES ('359', '0', '0', 'icon-jadwal.png', '6', 'Peminjaman & Pelayanan', 'admin/com/peminjaman', 'on');
INSERT INTO `c_menu` VALUES ('395', '394', '0', '-', '1', 'Grup Pengguna', 'admin/com/groupuser', 'on');
INSERT INTO `c_menu` VALUES ('362', '0', '0', 'icon-setup.png', '7', 'Catatan SKPD', 'admin/com/catatanadmin', 'on');
INSERT INTO `c_menu` VALUES ('382', '0', '0', 'icon-program.png', '4', 'Penyerahan & Akuisisi', 'admin/com/penyerahan', 'on');
INSERT INTO `c_menu` VALUES ('377', '368', '0', '-', '1', 'Informasi Pengguna', 'admin/com/infopengguna', 'on');
INSERT INTO `c_menu` VALUES ('399', '397', '0', '-', '2', 'Daftar Menu Tiap Pengguna', 'admin/com/groupname', 'on');
INSERT INTO `c_menu` VALUES ('400', '0', '0', 'icon-config.png', '9', 'Pengaturan Pengguna', '-', 'on');
INSERT INTO `c_menu` VALUES ('401', '0', '0', 'icon-sistem.png', '12', 'Pengaturan Menu', '-', 'on');
INSERT INTO `c_menu` VALUES ('402', '400', '0', '-', '1', 'Grup Pengguna', 'admin/com/groupuser', 'on');
INSERT INTO `c_menu` VALUES ('403', '400', '0', '-', '2', 'Daftar Pengguna', 'admin/com/user', 'on');
INSERT INTO `c_menu` VALUES ('404', '401', '0', '-', '1', 'Daftar Menu', 'admin/com/menu', 'on');
INSERT INTO `c_menu` VALUES ('405', '401', '0', '-', '2', 'Daftar Menu Tiap Pengguna', 'admin/com/groupmenu', 'on');
INSERT INTO `c_menu` VALUES ('459', '0', '0', '-', '24', 'Analisis Perbandingan', '-', 'off');
INSERT INTO `c_menu` VALUES ('460', '459', '0', '-', '1', 'Perbandingan Antar Tahun', '-', 'off');
INSERT INTO `c_menu` VALUES ('461', '459', '0', '-', '2', 'Perbandingan PPA & RAPBD', '-', 'off');
INSERT INTO `c_menu` VALUES ('462', '460', '0', '-', '1', 'Program & Kegiatan Per SKPD', '-', 'off');
INSERT INTO `c_menu` VALUES ('463', '460', '0', '-', '2', 'Program & Kegiatan Per Urusan', '-', 'off');
INSERT INTO `c_menu` VALUES ('464', '461', '0', '-', '1', 'Program & Kegiatan Per SKPD', '-', 'off');
INSERT INTO `c_menu` VALUES ('465', '461', '0', '-', '2', 'Program & Kegiatan Per Urusan', '-', 'off');
INSERT INTO `c_menu` VALUES ('466', '461', '0', '-', '3', 'Menurut Prioritas Pembangunan', '-', 'off');
INSERT INTO `c_menu` VALUES ('467', '0', '0', '-', '21', 'Beranda', 'admin/com/home', 'on');
INSERT INTO `c_menu` VALUES ('482', '0', '0', '-', '26', 'Tentang KAD', '-', 'on');
INSERT INTO `c_menu` VALUES ('483', '0', '0', '-', '27', 'Program Dan Kegiatan', '-', 'on');
INSERT INTO `c_menu` VALUES ('484', '0', '0', '-', '28', 'Dunia Arsip', '-', 'on');
INSERT INTO `c_menu` VALUES ('485', '0', '0', '-', '29', 'Layanan Arsip', '-', 'on');
INSERT INTO `c_menu` VALUES ('491', '485', '0', '-', '1', 'Produk Layanan', 'web/com/publicproduklayanan', 'on');
INSERT INTO `c_menu` VALUES ('487', '0', '0', '-', '30', 'Pengolahan', '-', 'on');
INSERT INTO `c_menu` VALUES ('488', '487', '0', '-', '1', 'Pengolahan Arsip', 'web/com/publicpengolahanarsip', 'on');
INSERT INTO `c_menu` VALUES ('489', '487', '0', '-', '2', 'Retensi Arsip', 'web/com/publicretensi', 'on');
INSERT INTO `c_menu` VALUES ('490', '487', '0', '-', '3', 'Akuisisi / Penyerahan Arsip', 'web/com/publicpenyerahan', 'on');
INSERT INTO `c_menu` VALUES ('492', '485', '0', '-', '2', 'Daftar Pencarian Arsip', 'web/com/publicdafcariarsip', 'on');
INSERT INTO `c_menu` VALUES ('493', '485', '0', '-', '3', 'Registrasi Peminjaman', 'web/com/publicregistrasipinjam', 'on');
INSERT INTO `c_menu` VALUES ('494', '485', '0', '-', '4', 'Data Peminjaman', 'web/com/publicdatapinjam', 'on');
INSERT INTO `c_menu` VALUES ('495', '484', '0', '-', '1', 'Kode Klarifikasi', 'web/com/catatanadmin', 'on');
INSERT INTO `c_menu` VALUES ('496', '484', '0', '-', '2', 'Daftar Istilah', 'web/com/publicdafistilah', 'on');
INSERT INTO `c_menu` VALUES ('497', '484', '0', '-', '3', 'Peraturan Perundangan', 'web/com/publicperpu', 'on');
INSERT INTO `c_menu` VALUES ('498', '484', '0', '-', '4', 'Saranan dan Prasarana Kegiatan', 'admin/com/publicsaranaprasarana', 'on');
INSERT INTO `c_menu` VALUES ('499', '0', '0', 'icon-display.png', '32', 'Pengaturan Tampilan', '-', 'on');
INSERT INTO `c_menu` VALUES ('501', '499', '0', '-', '5', 'Beranda', 'cms/com/cmsberanda', 'on');
INSERT INTO `c_menu` VALUES ('503', '0', '0', 'icon-artikel.png', '35', 'Pengaturan Konten', 'cms/com/cmsartikel', 'on');
INSERT INTO `c_menu` VALUES ('504', '503', '0', '-', '1', 'Konten Umum', 'cms/com/cmsartikel', 'on');
INSERT INTO `c_menu` VALUES ('505', '503', '0', '-', '2', 'Konten Khusus', 'cms/com/cmssusunanorganisasi', 'on');
INSERT INTO `c_menu` VALUES ('506', '504', '0', '-', '1', 'Artikel', 'cms/com/cmsartikel', 'on');
INSERT INTO `c_menu` VALUES ('507', '504', '0', '-', '2', 'Penulis Artikel', 'cms/com/cmspenulis', 'on');
INSERT INTO `c_menu` VALUES ('508', '504', '0', '-', '3', 'Galeri Foto', 'cms/com/cmsgalerifoto', 'on');
INSERT INTO `c_menu` VALUES ('509', '504', '0', '-', '4', 'Galeri Video', 'cms/com/cmsvideo', 'on');
INSERT INTO `c_menu` VALUES ('510', '504', '0', '-', '5', 'Agenda', 'cms/com/cmsagenda', 'on');
INSERT INTO `c_menu` VALUES ('511', '504', '0', '-', '6', 'Pengumuman', 'cms/com/cmspengumuman', 'on');
INSERT INTO `c_menu` VALUES ('512', '509', '0', '-', '1', 'Kategori Video', 'cms/com/cmskatvideo', 'on');
INSERT INTO `c_menu` VALUES ('513', '509', '0', '-', '2', 'Isi Video', 'cms/com/cmsvideo', 'on');
INSERT INTO `c_menu` VALUES ('514', '0', '0', 'icon-kanal.png', '33', 'Pengaturan Kanal', 'cms/com/cmskanal', 'on');
INSERT INTO `c_menu` VALUES ('515', '0', '0', 'icon-tautan.png', '34', 'Pengaturan Tautan', 'cms/com/cmstautan', 'on');
INSERT INTO `c_menu` VALUES ('516', '514', '0', '-', '1', 'Kanal', 'cms/com/cmskanal', 'on');
INSERT INTO `c_menu` VALUES ('517', '514', '0', '-', '2', 'Group', 'cms/com/cmsgroup', 'on');
INSERT INTO `c_menu` VALUES ('518', '514', '0', '-', '3', 'Rubrik', 'cms/com/cmsrubrik', 'on');
INSERT INTO `c_menu` VALUES ('519', '515', '0', '-', '1', 'Tatutan', 'cms/com/cmstautan', 'on');
INSERT INTO `c_menu` VALUES ('520', '515', '0', '-', '2', 'Banner', 'cms/com/cmsbanermanager', 'on');
INSERT INTO `c_menu` VALUES ('521', '505', '0', '-', '1', 'Dinamika Organisasi', 'cms/com/cmssusunanorganisasi', 'on');
INSERT INTO `c_menu` VALUES ('522', '521', '0', '-', '1', 'Sususnan Organisasi', 'cms/com/cmssusunanorganisasi', 'on');
INSERT INTO `c_menu` VALUES ('523', '521', '0', '-', '2', 'Susunan Jabatan', 'cms/com/cmsjabatansotk', 'off');
INSERT INTO `c_menu` VALUES ('524', '521', '0', '-', '3', 'Riwayat Pemangku Jabatan', 'cms/com/cmsriwayatjabatansotk', 'off');
INSERT INTO `c_menu` VALUES ('525', '0', '0', 'icon-suggest.png', '36', 'Saran dan Kritik', 'cms/com/cmsbukutamu', 'on');
INSERT INTO `c_menu` VALUES ('526', '525', '0', '-', '1', 'Buku Tamu', 'cms/com/cmsbukutamu', 'on');
INSERT INTO `c_menu` VALUES ('527', '525', '0', '-', '2', 'Kategori Buku Tamu', 'cms/com/cmsbukutamukat', 'on');
INSERT INTO `c_menu` VALUES ('528', '525', '0', '-', '3', 'Komentar Artikel', 'cms/com/cmskomentarartikel', 'on');
INSERT INTO `c_menu` VALUES ('529', '499', '0', '-', '1', 'Tema', 'cms/com/cmstemplatemanager', 'on');
INSERT INTO `c_menu` VALUES ('530', '499', '0', '-', '2', 'Header', 'cms/com/cmsheadermanager', 'on');
INSERT INTO `c_menu` VALUES ('531', '499', '0', '-', '3', 'Footer', 'cms/com/cmsfootermanager', 'on');
INSERT INTO `c_menu` VALUES ('532', '499', '0', '-', '4', 'Headline', 'cms/com/cmsheadlinemanager', 'on');
INSERT INTO `c_menu` VALUES ('533', '505', '0', '-', '2', 'Renstra', 'cms/com/cmsrenstra', 'on');
INSERT INTO `c_menu` VALUES ('534', '505', '0', '-', '3', 'Lokasi', 'cms/com/cmslokasi', 'on');
INSERT INTO `c_menu` VALUES ('535', '505', '0', '-', '4', 'Daftar Istilah', 'cms/com/cmsdaftaristilah', 'on');
INSERT INTO `c_menu` VALUES ('536', '505', '0', '-', '5', 'Perencanaan', 'cms/com/cmsperencanaan', 'on');
INSERT INTO `c_menu` VALUES ('537', '505', '0', '-', '6', 'Peraturan Perundangan', 'cms/com/cmsperpu', 'on');
INSERT INTO `c_menu` VALUES ('538', '504', '0', '-', '7', 'Statistik Pengunjung', 'cms/com/cmsstatistik', 'on');
INSERT INTO `c_menu` VALUES ('539', '0', '0', 'icon-program.png', '13', 'Laporan', '-', 'on');
INSERT INTO `c_menu` VALUES ('540', '539', '0', '-', '2', 'Daftar Pencarian Arsip', 'admin/com/lap_pencarian_bulanan', 'on');
INSERT INTO `c_menu` VALUES ('541', '539', '0', '-', '1', 'Rekapitulasi Data Arsip', '-', 'on');
INSERT INTO `c_menu` VALUES ('542', '539', '0', '-', '3', 'Data Pelayanan Arsip', '-', 'on');
INSERT INTO `c_menu` VALUES ('543', '541', '0', '-', '1', 'Laporan Bulanan', 'admin/com/lap_rda/bulanan', 'on');
INSERT INTO `c_menu` VALUES ('544', '541', '0', '-', '2', 'Laporan Identitas Arsip', 'admin/com/lap_rda/identitas', 'on');
INSERT INTO `c_menu` VALUES ('545', '541', '0', '-', '3', 'Kode Klasifikasi dan Tahun  Arsip', 'admin/com/laporan_klasifikasi_tahun', 'off');
INSERT INTO `c_menu` VALUES ('546', '540', '0', '-', '1', 'Laporan Bulanan', 'admin/com/lap_dpa/bulanan', 'on');
INSERT INTO `c_menu` VALUES ('547', '540', '0', '-', '2', 'Laporan Identitas Arsip', 'admin/com/lap_dpa/identitas', 'on');
INSERT INTO `c_menu` VALUES ('548', '540', '0', '-', '3', 'Tahun Arsip', 'admin/com/lap_pencarian_tahun_arsip', 'off');
INSERT INTO `c_menu` VALUES ('549', '540', '0', '-', '4', 'Unit Pengolah', 'admin/com/lap_pencarian_unit_pengolah', 'off');
INSERT INTO `c_menu` VALUES ('550', '542', '0', '-', '1', 'Pelayanan Bulanan', 'admin/com/lap_pelayanan_bulanan', 'on');
INSERT INTO `c_menu` VALUES ('551', '542', '0', '-', '2', 'Rekap Data Pelayanan', 'admin/com/lap_pelayanan_rekap', 'on');
INSERT INTO `c_menu` VALUES ('552', '0', '0', 'icon-program.png', '5', 'Pemusnahan & Retensi', 'admin/com/pemusnahan', 'on');
INSERT INTO `c_menu` VALUES ('553', '0', '0', 'icon-program.png', '11', 'Surat Masuk &amp;  Keluar', 'admin/com/surat', 'on');
INSERT INTO `c_menu` VALUES ('555', '368', '0', '-', '0', 'User Online', 'admin/com/online', 'on');
INSERT INTO `c_menu` VALUES ('556', '539', '0', '-', '0', 'Surat', '-', 'on');
INSERT INTO `c_menu` VALUES ('557', '556', '0', '-', '1', 'Surat Masuk', 'admin/com/lap_surat_masuk', 'on');
INSERT INTO `c_menu` VALUES ('558', '556', '0', '-', '2', 'Surat Keluar', 'admin/com/lap_surat_keluar', 'on');
INSERT INTO `c_menu` VALUES ('559', '556', '0', '-', '3', 'Rekap Surat', 'admin/com/lap_surat_rekap', 'on');
INSERT INTO `c_menu` VALUES ('560', '539', '0', '-', '4', 'Retensi Arsip ', '-', 'on');
INSERT INTO `c_menu` VALUES ('561', '560', '0', 'icon-program.png', '1', 'Bulanan', 'admin/com/lap_retensi/bulanan', 'on');
INSERT INTO `c_menu` VALUES ('563', '539', '0', '-', '5', 'Penyerahan Arsip ', '-', 'on');
INSERT INTO `c_menu` VALUES ('564', '563', '0', 'icon-program.png', '1', 'Daftar Arsip', 'admin/com/lap_penyerahan/gui/daftar_arsip', 'on');
INSERT INTO `c_menu` VALUES ('567', '563', '0', 'icon-program.png', '4', 'Rekap Penyerahan', 'admin/com/lap_penyerahan/gui/rekap', 'on');
INSERT INTO `c_menu` VALUES ('568', '539', '0', '-', '6', 'Pertelaan Arsip ', '-', 'off');
INSERT INTO `c_menu` VALUES ('569', '568', '0', 'icon-program.png', '1', 'Bulanan', 'admin/com/lap_pertelaan/bulanan', 'on');
INSERT INTO `c_menu` VALUES ('570', '568', '0', 'icon-program.png', '2', 'Tahunan', 'admin/com/lap_pertelaan/tahunan', 'on');
INSERT INTO `c_menu` VALUES ('571', '568', '0', 'icon-program.png', '3', 'Unit Pengolah', 'admin/com/lap_pertelaan/unit_pengolah', 'on');
INSERT INTO `c_menu` VALUES ('572', '560', '0', 'icon-program.png', '2', 'Identitas Arsip', 'admin/com/lap_retensi/identitas', 'on');
