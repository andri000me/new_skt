/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.6.17 : Database - db_skt
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_skt` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_skt`;

/*Table structure for table `hak_akses` */

DROP TABLE IF EXISTS `hak_akses`;

CREATE TABLE `hak_akses` (
  `akses_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_level_id` varchar(100) DEFAULT NULL,
  `sub_id` varchar(100) DEFAULT NULL,
  `akses_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`akses_id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

/*Data for the table `hak_akses` */

insert  into `hak_akses`(`akses_id`,`user_level_id`,`sub_id`,`akses_created`) values 
(39,'1','56','2019-04-22 22:46:19'),
(45,'1','47','2019-04-23 20:39:02'),
(47,'1','40','2019-04-23 20:41:54'),
(46,'1','44','2019-04-23 20:40:20'),
(48,'1','41','2019-04-23 20:42:03'),
(49,'1','48','2019-04-23 20:42:10'),
(50,'1','37','2019-04-23 20:42:18'),
(51,'1','12','2019-04-23 20:42:27'),
(52,'1','24','2019-04-23 20:42:37'),
(53,'1','','2019-04-23 20:42:53'),
(54,'1','38','2019-04-23 20:43:07'),
(55,'1','13','2019-04-23 20:43:14'),
(56,'1','25','2019-04-23 20:43:22'),
(57,'1','39','2019-04-23 20:43:30'),
(58,'1','14','2019-04-23 20:43:36'),
(59,'1','26','2019-04-23 20:43:43'),
(60,'1','3','2019-04-23 20:43:52'),
(61,'1','2','2019-04-23 20:44:00'),
(62,'1','28','2019-04-23 20:44:09'),
(63,'1','29','2019-04-23 20:44:18'),
(64,'1','4','2019-04-23 20:44:26'),
(65,'1','16','2019-04-23 20:44:33'),
(66,'1','15','2019-04-23 20:44:40'),
(67,'1','27','2019-04-23 20:44:48'),
(68,'1','53','2019-04-23 20:44:55'),
(69,'1','42','2019-04-23 20:45:02'),
(70,'1','49','2019-04-23 20:45:09'),
(71,'1','35','2019-04-23 20:45:17'),
(72,'1','','2019-04-23 20:45:22'),
(73,'1','10','2019-04-23 20:45:29'),
(74,'1','22','2019-04-23 20:45:35'),
(75,'1','21','2019-04-23 20:45:42'),
(76,'1','34','2019-04-23 20:45:50'),
(77,'1','8','2019-04-23 20:45:59'),
(78,'1','36','2019-04-23 20:46:07'),
(79,'1','11','2019-04-23 20:46:22'),
(80,'1','23','2019-04-23 20:46:34'),
(81,'1','54','2019-04-23 20:46:49'),
(82,'1','50','2019-04-23 20:46:56'),
(83,'1','45','2019-04-23 20:47:03'),
(84,'1','46','2019-04-23 20:47:10'),
(85,'1','33','2019-04-23 20:47:16'),
(86,'1','20','2019-04-23 20:47:23'),
(87,'1','52','2019-04-23 20:47:29'),
(88,'1','51','2019-04-23 20:47:36'),
(89,'1','43','2019-04-23 20:47:43'),
(90,'1','32','2019-04-23 20:47:50'),
(91,'1','31','2019-04-23 20:47:57'),
(92,'1','6','2019-04-23 20:48:04'),
(93,'1','18','2019-04-23 20:48:11'),
(94,'1','7','2019-04-23 20:48:17'),
(95,'1','19','2019-04-23 20:48:27'),
(96,'1','30','2019-04-23 20:48:33'),
(97,'1','5','2019-04-23 20:48:40'),
(98,'1','17','2019-04-23 20:48:47'),
(99,'1','55','2019-04-23 20:48:54'),
(100,'1','57','2019-04-23 20:59:08'),
(101,'4','40','2019-04-23 21:06:09'),
(102,'1','58','2019-04-23 22:50:05'),
(105,'1','63','2019-04-25 21:50:56'),
(123,'2','24','2019-04-29 16:38:40'),
(107,'1','64','2019-04-26 15:29:38'),
(108,'4','41','2019-04-29 16:32:05'),
(109,'4','37','2019-04-29 16:32:15'),
(110,'4','38','2019-04-29 16:32:24'),
(111,'4','39','2019-04-29 16:32:34'),
(112,'4','28','2019-04-29 16:32:52'),
(113,'4','29','2019-04-29 16:33:05'),
(114,'4','27','2019-04-29 16:33:16'),
(115,'4','35','2019-04-29 16:33:27'),
(116,'4','34','2019-04-29 16:33:41'),
(117,'4','36','2019-04-29 16:33:54'),
(118,'4','33','2019-04-29 16:34:08'),
(119,'4','31','2019-04-29 16:34:21'),
(120,'4','32','2019-04-29 16:34:38'),
(121,'4','30','2019-04-29 16:34:56'),
(122,'4','55','2019-04-29 16:35:20'),
(124,'2','25','2019-04-29 16:38:55'),
(125,'2','26','2019-04-29 16:39:08'),
(126,'2','16','2019-04-29 16:39:19'),
(127,'2','15','2019-04-29 16:39:34'),
(128,'2','22','2019-04-29 16:39:53'),
(129,'2','21','2019-04-29 16:40:06'),
(130,'2','20','2019-04-29 16:40:25'),
(131,'2','23','2019-04-29 16:40:38'),
(132,'2','18','2019-04-29 16:40:53'),
(133,'2','17','2019-04-29 16:41:09'),
(134,'2','19','2019-04-29 16:41:31'),
(135,'2','55','2019-04-29 16:41:45'),
(136,'2','5','2019-04-30 09:27:27'),
(137,'2','12','2019-04-30 09:27:41'),
(138,'2','14','2019-04-30 09:27:51'),
(139,'2','3','2019-04-30 09:28:01'),
(140,'2','2','2019-04-30 09:28:08'),
(141,'2','13','2019-04-30 09:28:18'),
(142,'2','4','2019-04-30 09:28:28'),
(143,'2','10','2019-04-30 09:28:44'),
(144,'2','8','2019-04-30 09:28:55'),
(145,'2','11','2019-04-30 09:29:06'),
(146,'2','6','2019-04-30 09:29:19'),
(147,'2','7','2019-04-30 09:29:31'),
(148,'3','12','2019-04-30 09:29:58'),
(149,'3','13','2019-04-30 09:30:08'),
(150,'3','14','2019-04-30 09:30:20'),
(151,'3','3','2019-04-30 09:30:32'),
(152,'3','2','2019-04-30 09:31:27'),
(153,'3','4','2019-04-30 09:31:37'),
(154,'3','8','2019-04-30 14:11:21'),
(155,'3','11','2019-04-30 14:11:35'),
(156,'3','10','2019-04-30 14:11:46'),
(157,'3','6','2019-04-30 14:12:01'),
(158,'3','7','2019-04-30 14:12:18'),
(159,'3','5','2019-04-30 14:12:31'),
(160,'3','55','2019-04-30 14:12:45'),
(161,'1','65','2019-11-20 10:32:52'),
(162,'1','66','2019-11-20 10:35:10'),
(163,'1','68','2019-11-24 10:36:43'),
(164,'1','67','2019-11-24 10:36:52');

/*Table structure for table `jns_simpan` */

DROP TABLE IF EXISTS `jns_simpan`;

CREATE TABLE `jns_simpan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `jns_simpan` varchar(30) NOT NULL,
  `jumlah` double NOT NULL,
  `tampil` enum('Y','T') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `jns_simpan` */

insert  into `jns_simpan`(`id`,`jns_simpan`,`jumlah`,`tampil`) values 
(1,'Simpanan Sukarela',0,'Y'),
(2,'Simpanan Pokok',100000,'Y'),
(3,'Simpanan Wajib',50000,'Y');

/*Table structure for table `mainmenu` */

DROP TABLE IF EXISTS `mainmenu`;

CREATE TABLE `mainmenu` (
  `id_main` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `level_id` int(5) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `mainmenu` */

insert  into `mainmenu`(`id_main`,`nama_menu`,`class`,`link`,`aktif`,`level_id`,`urutan`) values 
(2,'Pinjaman Pensiun','fa-wheelchair','','Y',3,3),
(3,'Pinjaman Umum','fa-share-alt-square','','Y',2,1),
(4,'Pinjaman Mikro','fa-users','','Y',4,2),
(5,'Akuntansi','fa-fax','','Y',1,4),
(6,'Setting','fa-wrench','','Y',1,15),
(13,'Transaksi Kas','fa-cc-mastercard','','Y',NULL,5),
(14,'Simpanan','fa-bank','','Y',NULL,6);

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id_module` int(5) NOT NULL AUTO_INCREMENT,
  `nama_module` varchar(150) DEFAULT NULL,
  `dir_module` varchar(250) DEFAULT NULL,
  `ket_module` varchar(250) DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id_module`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id_module`,`nama_module`,`dir_module`,`ket_module`,`aktif`) values 
(1,'tipe','modul/tipe/tipe.php','Bagian Tipe','Y'),
(2,'jenis','modul/jenis/jenis.php','Bagian Jenis','Y'),
(3,'kantor_bayar','modul/kantor_bayar/kantor_bayar.php','Bagian Kantor Bayar','Y'),
(4,'perusahaan','modul/kantor_bayar/kantor_bayar.php','Bagian Perusahaan','Y'),
(5,'nasabah_pensiun','modul/nasabah/nasabah.php','Bagian Nasabah Pensiun','Y'),
(6,'nasabah_umum','modul/nasabah/nasabah.php','Bagian Nasabah Umum','Y'),
(7,'nasabah_mikro','modul/nasabah/nasabah.php','Bagian Nasabah Mikro','Y'),
(8,'wilayah','modul/wilayah/wilayah.php','Bagian Wilayah','Y'),
(9,'kelompok','modul/kelompok/kelompok.php','Bagian Kelompok','Y'),
(10,'transaksi_pensiun','modul/transaksi_pensiun/transaksi.php','Bagian Transaksi Pensiun','Y'),
(11,'transaksi_umum','modul/transaksi_umum/transaksi_umum.php','Bagian Transaksi Umum','Y'),
(12,'transaksi_mikro','modul/transaksi_mikro/transaksi_mikro.php','Bagian Transaksi Mikro','Y'),
(13,'company_info','modul/company_info/company_info.php','Bagian Company Info','Y'),
(14,'jabatan','modul/jabatan/jabatan.php','Bagian Jabatan','Y'),
(15,'pinjaman_pensiun','modul/pinjaman_pensiun/pinjaman_pensiun.php','Bagian pinjaman_pensiun','Y'),
(16,'pinjaman_umum','modul/pinjaman_umum/pinjaman_umum.php','Bagian Pinjaman Umum','Y'),
(17,'pinjaman_mikro','modul/pinjaman_mikro/pinjaman_mikro.php','Bagian Pinjaman Mikro','Y'),
(18,'general_jurnal','modul/general_jurnal/general_jurnal2.php','Bagian General Jurnal','Y'),
(19,'angsuran_pensiun','modul/angsuran_pensiun/angsuran.php','Bagian Angsuran Pensiun','Y'),
(20,'angsuran_umum','modul/angsuran_umum/angsuran.php','Bagian Angsuran Umum','Y'),
(21,'angsuran_mikro','modul/angsuran_mikro/angsuran.php','Bagian Angsuran Mikro','Y'),
(22,'pelunasan_mikro','modul/pelunasan_mikro/pelunasan.php','Bagian Pelunasan Mikro','Y'),
(23,'pelunasan_umum','modul/pelunasan_umum/pelunasan.php','Bagian Pelunasan Umum','Y'),
(24,'realisasi_tagihan_mikro','modul/realisasi_tagihan_mikro/realisasi_tagihan_mikro.php','Bagian Realisasi Tagihan Mikro','Y'),
(25,'realisasi_tagihan_umum','modul/realisasi_tagihan_umum/realisasi_tagihan_umum.php','Bagian Realisasi Tagihan Umum','Y'),
(26,'laporan_penyaluran_kredit_pensiun','modul/laporan_penyaluran_kredit_pensiun/laporan_penyaluran_kredit_pensiun.php','Bagian Laporan Penyaluran Kredit Pensiun','Y'),
(27,'laporan_pelunasan_kredit_pensiun','modul/laporan_pelunasan_kredit_pensiun/laporan_pelunasan_kredit_pensiun.php','Bagian Laporan Pelunasan Kredit Pensiun','Y'),
(28,'laporan_setor_sendiri_kredit_pensiun','modul/laporan_setor_sendiri_kredit_pensiun/laporan_setor_sendiri_kredit_pensiun.php','Bagian Laporan Setor Sendiri Kredit Pensiun','Y'),
(29,'laporan_daftar_nominatif_pensiun','modul/laporan_daftar_nominatif_pensiun/laporan_daftar_nominatif_pensiun.php','Bagian Laporan Daftar Nominatif Pensiun','Y'),
(30,'laporan_daftar_pelunasan_pensiun','modul/laporan_daftar_pelunasan_pensiun/laporan_daftar_pelunasan_pensiun.php','Bagian Laporan Daftar Pelunasan Pensiun','Y'),
(31,'laporan_daftar_tagihan_pensiun','modul/laporan_daftar_tagihan_pensiun/laporan_daftar_tagihan_pensiun.php','Bagian Laporan Daftar Tagihan Pensiun','Y'),
(32,'laporan_penyaluran_kredit_umum','modul/laporan_penyaluran_kredit_umum/laporan_penyaluran_kredit_umum.php','Bagian Laporan Penyaluran Kredit Umum','Y'),
(33,'laporan_pelunasan_kredit_umum','modul/laporan_pelunasan_kredit_umum/laporan_pelunasan_kredit_umum.php','Bagian Laporan Pelunasan Kredit Umum','Y'),
(34,'laporan_setor_sendiri_kredit_umum','modul/laporan_setor_sendiri_kredit_umum/laporan_setor_sendiri_kredit_umum.php','Bagian Laporan Setor Sendiri Kredit Umum','Y'),
(35,'laporan_daftar_nominatif_umum','modul/laporan_daftar_nominatif_umum/laporan_daftar_nominatif_umum.php','Bagian Laporan Daftar Nominatif Umum','Y'),
(36,'laporan_daftar_pelunasan_umum','modul/laporan_daftar_pelunasan_umum/laporan_daftar_pelunasan_umum.php','Bagian Laporan Daftar Pelunasan Umum','Y'),
(37,'laporan_daftar_tagihan_umum','modul/laporan_daftar_tagihan_umum/laporan_daftar_tagihan_umum.php','Bagian Laporan Daftar Tagihan Umum','Y'),
(38,'cetak_bukti_angsuran_umum','modul/cetak_bukti_angsuran_umum/cetak_bukti_angsuran_umum.php','Bagian Cetak Bukti Angsuran Umum','Y'),
(39,'laporan_penyaluran_kredit_mikro','modul/laporan_penyaluran_kredit_mikro/laporan_penyaluran_kredit_mikro.php','Bagian Laporan Penyaluran Kredit Mikro','Y'),
(40,'laporan_pelunasan_kredit_mikro','modul/laporan_pelunasan_kredit_mikro/laporan_pelunasan_kredit_mikro.php','Bagian Laporan Pelunasan Kredit Mikro','Y'),
(41,'laporan_setor_sendiri_kredit_mikro','modul/laporan_setor_sendiri_kredit_mikro/laporan_setor_sendiri_kredit_mikro.php','Bagian Laporan Setor Sendiri Kredit Mikro','Y'),
(42,'laporan_daftar_nominatif_mikro','modul/laporan_daftar_nominatif_mikro/laporan_daftar_nominatif_mikro.php','Bagian Laporan Daftar Nominatif Mikro','Y'),
(43,'laporan_daftar_pelunasan_mikro','modul/laporan_daftar_pelunasan_mikro/laporan_daftar_pelunasan_mikro.php','Bagian Laporan Daftar Pelunasan Mikro','Y'),
(44,'laporan_daftar_tagihan_mikro','modul/laporan_daftar_tagihan_mikro/laporan_daftar_tagihan_mikro.php','Bagian Laporan Daftar Tagihan Mikro','Y'),
(45,'cetak_bukti_angsuran_mikro','modul/cetak_bukti_angsuran_mikro/cetak_bukti_angsuran_mikro.php','Bagian Cetak Bukti Angsuran Mikro','Y'),
(46,'cetak_form_terima_bagi_hasil_mikro','modul/cetak_form_terima_bagi_hasil_mikro/cetak_form_terima_bagi_hasil_mikro.php','Bagian Cetak Form Terima Bagi Hasil Mikro','Y'),
(47,'no_perkiraan','modul/no_perkiraan/no_perkiraan.php','Bagian No Perkiraan','Y'),
(48,'sub_group_perkiraan','modul/sub_group_perkiraan/sub_group_perkiraan.php','Bagian Sub Group Perkiraan','Y'),
(49,'setting_coa','modul/setting_coa/setting_coa.php','Bagian Setting COA','Y'),
(50,'layout','modul/layout/layout.php','Bagian Layout','Y'),
(51,'hak_akses','modul/hak_akses/hak_akses.php','Bagian Hak Akses','Y'),
(52,'group_menu','modul/group_menu/group_menu.php','Bagian Group Menu','Y'),
(53,'menu','modul/menu/menu.php','Bagian Menu','Y'),
(54,'log_user','modul/log_user/log_user.php','Bagian Log User','Y'),
(55,'users','modul/users/users.php','Bagian User','Y'),
(56,'module','modul/module/module.php','Bagian Module','Y'),
(58,'pelunasan_pensiun','modul/pelunasan_pensiun/pelunasan.php','Bagian Pelunasan Pensiun','Y'),
(59,'pemasukan_kas','modul/transaksi_kas/pemasukan_kas.php','Module Pemasukan Kas','Y'),
(60,'pengeluaran_kas','modul/transaksi_kas/pengeluaran_kas.php','Module Pengeluaran Kas','Y'),
(61,'setoran_tunai','modul/simpanan/setoran_tunai.php','Module Setoran Tunai','Y'),
(62,'penarikan_tunai','modul/simpanan/penarikan_tunai.php','Module Penarikan Tunai','Y');

/*Table structure for table `nama_kas_tbl` */

DROP TABLE IF EXISTS `nama_kas_tbl`;

CREATE TABLE `nama_kas_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(225) CHARACTER SET latin1 NOT NULL,
  `aktif` enum('Y','T') CHARACTER SET latin1 NOT NULL,
  `tmpl_simpan` enum('Y','T') CHARACTER SET latin1 NOT NULL,
  `tmpl_penarikan` enum('Y','T') CHARACTER SET latin1 NOT NULL,
  `tmpl_pinjaman` enum('Y','T') CHARACTER SET latin1 NOT NULL,
  `tmpl_bayar` enum('Y','T') CHARACTER SET latin1 NOT NULL,
  `tmpl_pemasukan` enum('Y','T') NOT NULL,
  `tmpl_pengeluaran` enum('Y','T') NOT NULL,
  `tmpl_transfer` enum('Y','T') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `nama_kas_tbl` */

insert  into `nama_kas_tbl`(`id`,`nama`,`aktif`,`tmpl_simpan`,`tmpl_penarikan`,`tmpl_pinjaman`,`tmpl_bayar`,`tmpl_pemasukan`,`tmpl_pengeluaran`,`tmpl_transfer`) values 
(1,'Kas Tunai','Y','Y','Y','Y','Y','Y','Y','Y'),
(2,'Kas Besar','Y','T','T','Y','T','Y','Y','Y'),
(3,'Bank BNI','Y','T','T','T','T','Y','Y','Y');

/*Table structure for table `submenu` */

DROP TABLE IF EXISTS `submenu`;

CREATE TABLE `submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `class_sub` varchar(50) DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `id_submain` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `urutan` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_sub`,`id_submain`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

/*Data for the table `submenu` */

insert  into `submenu`(`id_sub`,`module_name`,`nama_sub`,`link_sub`,`class_sub`,`id_main`,`id_submain`,`aktif`,`urutan`) values 
(2,'kantor_bayar','Data Kantor Bayar','kantor-bayar.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(3,'jenis','Data Jenis Pensiun','jenis.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(4,'nasabah_pensiun','Data Nasabah Pensiun','nasabah-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(5,'transaksi_pensiun','Transaksi Pinjaman Pensiun','transaksi.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(6,'angsuran_pensiun','Transaksi Angsuran Pensiun','angsuran-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(7,'pelunasan_pensiun','Transaksi Pelunasan Pensiun','pelunasan-pensiun.html','fa fa-circle-o text-red',2,0,'Y',3),
(8,'laporan_penyaluran_kredit_pensiun','Laporan Penyaluran Kredit','laporan-penyaluran-kredit-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(10,'laporan_pelunasan_kredit_pensiun','Laporan Pelunasan Kredit','laporan-pelunasan-kredit-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(11,'laporan_setor_sendiri_kredit_pensiun','Laporan Setor Sendiri','laporan-setor-sendiri-kredit-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(12,'laporan_daftar_nominatif_pensiun','Daftar Nominatif Pensiun','laporan-daftar-nominatif-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(13,'laporan_daftar_pelunasan_pensiun','Daftar Pelunasan Pensiun','laporan-daftar-pelunasan-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(14,'laporan_daftar_tagihan_pensiun','Daftar Tagihan Pensiun','laporan-daftar-tagihan-pensiun.html','fa fa-circle-o text-red',2,0,'Y',NULL),
(15,'perusahaan','Data Perusahaan','perusahaan.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(16,'nasabah_umum','Data Nasabah Umum','nasabah-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(17,'transaksi_umum','Transaksi Pinjaman Umum','transaksi-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(18,'angsuran_umum','Transaksi Angsuran Umum','angsuran-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(19,'pelunasan_umum','Transaksi Pelunasan Umum','pelunasan-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(20,'realisasi_tagihan_umum','Realisasi Tagihan Umum','realisasi-tagihan-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(21,'laporan_penyaluran_kredit_umum','Laporan Penyaluran Kredit','laporan-penyaluran-kredit-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(22,'laporan_pelunasan_kredit_umum','Laporan Pelunasan Kredit','laporan-pelunasan-kredit-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(23,'laporan_setor_sendiri_kredit_umum','Laporan Setor Sendiri','laporan-setor-sendiri-kredit-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(24,'laporan_daftar_nominatif_umum','Daftar Nominatif Umum','laporan-daftar-nominatif-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(25,'laporan_daftar_pelunasan_umum','Daftar Pelunasan Umum','laporan-daftar-pelunasan-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(26,'laporan_daftar_tagihan_umum','Daftar Tagihan Umum','laporan-daftar-tagihan-umum.html','fa fa-circle-o text-yellow',3,0,'Y',NULL),
(27,'wilayah','Data Wilayah','wilayah.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(28,'kelompok','Data Kelompok','kelompok.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(29,'nasabah_mikro','Data Nasabah Mikro','nasabah-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(30,'transaksi_mikro','Transaksi Pinjaman Mikro','transaksi-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(31,'angsuran_mikro','Transaksi Angsuran Mikro','angsuran-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(32,'pelunasan_mikro','Transaksi Pelunasan Mikro','pelunasan-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(33,'realisasi_tagihan_mikro','Realisasi Tagihan Mikro','realisasi-tagihan-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(34,'laporan_penyaluran_kredit_mikro','Laporan Penyaluran Kredit','laporan-penyaluran-kredit-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(35,'laporan_pelunasan_kredit_mikro','Laporan Pelunasan Kredit','laporan-pelunasan-kredit-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(36,'laporan_setor_sendiri_kredit_mikro','Laporan Setor Sendiri','laporan-setor-sendiri-kredit-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(37,'laporan_daftar_nominatif_mikro','Daftar Nominatif Mikro','laporan-daftar-nominatif-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(38,'laporan_daftar_pelunasan_mikro','Daftar Pelunasan Mikro','laporan-daftar-pelunasan-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(39,'laporan_daftar_tagihan_mikro','Daftar Tagihan Mikro','laporan-daftar-tagihan-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(40,'cetak_bukti_angsuran_mikro','Cetak Bukti Angsuran','cetak-bukti-angsuran-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(41,'cetak_form_terima_bagi_hasil_mikro','Cetak Form Terima Bagi Hasil','cetak-form-terima-bagi-hasil-mikro.html','fa fa-circle-o text-aqua',4,0,'Y',NULL),
(42,'general_jurnal','General Jurnal','general-jurnal.html','fa fa-file',5,0,'Y',NULL),
(43,'tipe','Tipe Pinjaman','tipe.html','fa fa-file',6,0,'Y',NULL),
(44,'','Administrasi          >>','#','fa fa-calendar-o',6,0,'Y',NULL),
(45,'pinjaman_pensiun','Pinjaman Pensiun','pinjaman-pensiun.html','fa fa-circle-o text-aqua',6,44,'Y',NULL),
(46,'pinjaman_umum','Pinjaman Umum','pinjaman-umum.html','fa fa-circle-o text-aqua',6,44,'Y',NULL),
(47,'pinjaman_mikro','Pinjaman Mikro','pinjaman-mikro.html','fa fa-circle-o text-aqua',6,44,'Y',NULL),
(48,'company_info','Company Info','company-info.html','fa fa-university',6,0,'Y',NULL),
(49,'jabatan','Jabatan','jabatan.html','fa fa-sitemap',6,0,'Y',NULL),
(50,'no_perkiraan','No Perkiraan Info','no-perkiraan.html','fa fa-calendar-o',6,0,'Y',NULL),
(51,'sub_group_perkiraan','Sub Group Perkiraan','sub-group-perkiraan.html','fa fa-balance-scale',6,0,'Y',NULL),
(52,'setting_coa','Setting COA Info','setting-coa.html','fa fa-university',6,0,'Y',NULL),
(53,'layout','Edit Layout','layout.html','fa fa-object-ungroup',6,0,'Y',NULL),
(54,'log_user','Log User','log-user.html','fa fa-circle-o text-aqua',6,0,'Y',NULL),
(55,'users','Users','users.html','fa fa-user-plus',6,0,'Y',NULL),
(56,'hak_akses','Hak Akses','hak-akses.html','fa fa-circle-o text-aqua',6,63,'Y',NULL),
(57,'group_menu','Group Menu','group-menu.html','fa fa-circle-o text-aqua',6,63,'Y',NULL),
(58,'menu','Menu','menu.html','fa fa-circle-o text-aqua',6,63,'Y',NULL),
(63,'','Setting Menu  >>','#','fa-navicon',6,0,'Y',NULL),
(64,'module','Module','module.html','fa-dropbox',6,63,'Y',NULL),
(65,'pemasukan_kas','Pemasukan','pemasukan-kas.html','fa-500px',13,0,'Y',0),
(66,'pengeluaran_kas','Pengeluaran','pengeluaran-kas.html','fa-500px',13,0,'Y',1),
(67,'setoran_tunai','Setoran Tunai','setoran-tunai.html','fa-dropbox',14,0,'Y',1),
(68,'penarikan_tunai','Penarikan Tunai','penarikan-tunai.html','fa-toggle-on',14,0,'Y',1);

/*Table structure for table `tbl_trans_kas` */

DROP TABLE IF EXISTS `tbl_trans_kas`;

CREATE TABLE `tbl_trans_kas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_catat` datetime NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `akun` enum('Pemasukan','Pengeluaran','Transfer') NOT NULL,
  `dari_kas_id` bigint(20) DEFAULT NULL,
  `untuk_kas_id` bigint(20) DEFAULT NULL,
  `ftKodePerkiraan` varchar(10) DEFAULT NULL,
  `dk` enum('D','K') DEFAULT NULL,
  `update_data` datetime NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`),
  KEY `dari_kas_id` (`dari_kas_id`,`untuk_kas_id`),
  KEY `untuk_kas_id` (`untuk_kas_id`),
  KEY `jns_trans` (`ftKodePerkiraan`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_trans_kas` */

insert  into `tbl_trans_kas`(`id`,`tgl_catat`,`jumlah`,`keterangan`,`akun`,`dari_kas_id`,`untuk_kas_id`,`ftKodePerkiraan`,`dk`,`update_data`,`user_name`) values 
(3,'2019-12-31 00:00:00',10000000,'sepuluh juta rupiah','Pemasukan',NULL,1,'1100.0000','D','2019-11-21 14:28:51','Administrator'),
(4,'2019-11-20 13:41:00',200000,'pengeluaran','Pengeluaran',1,NULL,'1100.0002','K','0000-00-00 00:00:00','admin'),
(5,'2019-11-30 00:00:00',1000000,'satu juta rupiah','Pemasukan',NULL,2,'1100.0002','D','2019-11-21 14:27:24','Administrator'),
(6,'2019-11-20 00:00:00',3200000,'tes 2000','Pemasukan',NULL,1,'1100.0000','D','0000-00-00 00:00:00','Administrator'),
(7,'2019-10-08 00:00:00',2000000,'dua juta','Pemasukan',NULL,3,'1100.0001','D','2019-11-21 13:56:20','Administrator'),
(9,'2019-11-21 00:00:00',4000000,'empat juta','Pemasukan',NULL,2,'1100.0001','D','2019-11-21 16:28:39','Administrator'),
(10,'2019-11-20 00:00:00',3500000,'Pinjam dulu','Pemasukan',NULL,1,'1100.0001','D','2019-11-22 16:16:03','Administrator'),
(11,'2019-11-18 00:00:00',2000000,'Pink','Pemasukan',NULL,2,'1100.0000','D','2019-11-22 16:16:40','Administrator'),
(12,'2019-11-06 00:00:00',1500000,'qwerty','Pemasukan',NULL,3,'1100.0001','D','2019-11-22 16:16:59','Administrator'),
(13,'2019-11-24 00:00:00',2500000,'qwerty','Pemasukan',NULL,2,'1100.0002','D','2019-11-22 16:20:00','Administrator'),
(14,'2019-11-29 00:00:00',4500000,'werwer','Pemasukan',NULL,1,'1100.0002','D','2019-11-22 16:20:15','Administrator'),
(15,'2019-11-20 00:00:00',450000,'qweqwe','Pemasukan',NULL,1,'1100.0001','D','2019-11-22 16:20:31','Administrator'),
(16,'2019-11-04 00:00:00',350000,'qwe','Pengeluaran',2,1,'1100.0001','D','2019-11-23 22:19:06','Administrator'),
(17,'2019-11-13 00:00:00',200000,'dasdasd','Pemasukan',NULL,2,'1100.0001','D','2019-11-23 11:51:36','Administrator'),
(18,'2019-11-05 00:00:00',120000,'qweqw','Pemasukan',NULL,1,'1100.0002','D','2019-11-23 13:00:59','Administrator'),
(19,'2019-11-30 00:00:00',250000,'qwerty','Pemasukan',NULL,1,'1100.0002','D','2019-11-23 22:04:57','Administrator'),
(20,'2019-11-13 00:00:00',550000,'qweqweqwe','Pengeluaran',3,NULL,'1100.0001','K','2019-11-23 22:14:56','Administrator'),
(21,'2019-11-13 00:00:00',270000,'qweqwe','Pengeluaran',3,NULL,'1100.0002','K','2019-11-23 22:15:34','Administrator'),
(22,'2019-11-23 22:54:00',155000,'qwe','Pemasukan',NULL,1,'1100.0000','D','2019-11-23 22:54:20','Administrator'),
(23,'2019-11-23 22:56:00',3500000,'wsdfds','Pengeluaran',3,NULL,'1100.0001','K','2019-11-23 22:56:38','Administrator');

/*Table structure for table `tbl_trans_sp` */

DROP TABLE IF EXISTS `tbl_trans_sp`;

CREATE TABLE `tbl_trans_sp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` datetime NOT NULL,
  `wilayah` varchar(60) DEFAULT NULL,
  `ftKodeKelompok` varchar(60) DEFAULT NULL,
  `anggota_id` bigint(20) NOT NULL,
  `jenis_id` int(5) NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `akun` enum('Setoran','Penarikan') NOT NULL,
  `dk` enum('D','K') NOT NULL,
  `kas_id` bigint(20) NOT NULL,
  `update_data` datetime NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `nama_penyetor` varchar(255) NOT NULL,
  `no_identitas` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_id` (`anggota_id`),
  KEY `jenis_id` (`jenis_id`),
  KEY `kas_id` (`kas_id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_trans_sp` */

insert  into `tbl_trans_sp`(`id`,`tgl_transaksi`,`wilayah`,`ftKodeKelompok`,`anggota_id`,`jenis_id`,`jumlah`,`keterangan`,`akun`,`dk`,`kas_id`,`update_data`,`user_name`,`nama_penyetor`,`no_identitas`,`alamat`) values 
(1,'2019-11-21 18:29:00',NULL,NULL,3,3,50000,'qwerty qwerty','Setoran','D',3,'2019-11-25 14:53:00','Administrator','imam godzali','123123','Jl. Bintara 12,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi Barat'),
(2,'2019-11-24 10:11:00',NULL,NULL,4,1,12000,'','Penarikan','K',1,'0000-00-00 00:00:00','admin','','',''),
(4,'2019-11-24 20:33:00','SETU','',4887,3,345000,'Simpanan Wajib','Setoran','D',2,'2019-11-25 22:06:00','Administrator','Aris','97239123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(9,'2019-11-25 14:48:00','TAMBELANG','BALONG TUA',1699,3,60000,'qweqwe','Setoran','D',3,'2019-11-25 21:27:00','Administrator','qwe12312','7877677','Jl. Bintara 12,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(10,'2019-11-25 14:54:00','TAMBUN','ALFA PM',1262,2,78000,'qweqwe','Setoran','D',2,'2019-11-25 20:58:00','Administrator','werrwer','123123123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi Barat'),
(11,'2019-11-25 16:12:00','TAMBELANG','GLONGGONG',1629,2,100000,'qweqwe','Setoran','D',2,'2019-11-25 20:53:00','Administrator','werrwer','3123123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(12,'2019-11-25 16:59:00','TAMBELANG','BALONG GUBUG',855,2,100000,'qweqwe','Setoran','D',2,'2019-11-25 19:49:00','Administrator','werrwer','13123123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(13,'2019-11-25 19:46:00','TAMBUN','ALFA PM',1258,2,100000,'qwerty3434','Setoran','D',1,'0000-00-00 00:00:00','Administrator','kupret','2313123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(14,'2019-11-25 20:58:00','TAMBUN','BEDENG BK',3378,3,50000,'qwerty3434','Setoran','D',1,'0000-00-00 00:00:00','Administrator','ARIL','2343432423','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(15,'2019-11-25 21:02:00','TAMBELANG','BALONG GUBUG',856,1,0,'qweqwe','Setoran','D',2,'0000-00-00 00:00:00','Administrator','qwenk','31231123123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(16,'2019-11-25 21:02:00','SETU','ANGGREK SARBAT',4883,3,50000,'qweqwe','Setoran','D',2,'0000-00-00 00:00:00','Administrator','joko','2343432423','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(17,'2019-11-25 21:23:00','TAMBUN','AMPERA',4698,2,100000,'qweqwe','Setoran','D',3,'0000-00-00 00:00:00','Administrator','dito','312312312','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(18,'2019-11-26 10:50:00','TAMBUN','AMPERA',4695,2,100000,'qweqwe','Penarikan','K',1,'0000-00-00 00:00:00','Administrator','werrwer','2343432423','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(19,'2019-11-26 10:54:00','TAMBELANG','BALONG GUBUG',855,2,100000,'qweqwe','Penarikan','K',1,'2019-11-26 10:55:00','Administrator','werrwer','2343432423','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(22,'2019-11-26 11:19:00','TAMBUN','AMPERA',4695,3,50000,'qweqwe','Penarikan','K',1,'2019-11-26 11:19:00','Administrator','','',''),
(23,'2019-11-26 11:31:00','TAMBUN','',505,1,754785,'qweqwe','Penarikan','K',1,'2019-11-26 13:18:00','Administrator','qwerty','123123','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B'),
(24,'2019-11-26 13:12:00','TAMBUN','ALFA PM',498,1,23450,'qwerty3434','Penarikan','K',1,'2019-11-26 13:49:00','Administrator','Gibson','123455789','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi Barat'),
(25,'2019-11-26 13:28:00','TAMBUN','ALFA PM',499,1,350786,'qweqwe','Setoran','D',1,'2019-11-26 13:29:00','Administrator','werrwer','2343432423','Jl. Bintara 14,  Gg. H. Salih 2,\r\nRT 02/14, kel.  Bintara,  Kec.  Bekasi B');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
