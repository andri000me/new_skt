ALTER TABLE tlwilayah ADD ftAdmKredit varchar(150);
ALTER TABLE tlbiayaadmpensiun ADD ffProvisi float AFTER ffAdm,ADD ffPpap float AFTER ffAsuransi;
ALTER TABLE txangsuran_pensiun_hdr ADD ffProvisi double AFTER fcAsuransi,ADD fcProvisi double AFTER ffProvisi;
UPDATE submenu SET module_name= 'pelunasan_pensiun',nama_sub= 'Transaksi Pelunasan Pensiun',link_sub= 'pelunasan-pensiun.html',class_sub= 'fa fa-circle-o text-red',id_main= 2,aktif= 'Y',urutan=3 WHERE id_sub = 7;
INSERT module (id_module,nama_module,dir_module,ket_module,aktif)VALUES('58','pelunasan_pensiun','modul/pelunasan_pensiun/pelunasan.php','Bagian Pelunasan Pensiun','Y')

CREATE TABLE `txpelunasan_pensiun_hdr` (
  `fnid` int(5) NOT NULL AUTO_INCREMENT,
  `ftBranch_Code` varchar(50) NOT NULL,
  `ftTrans_No` varchar(50) NOT NULL,
  `fdTrans_date` datetime NOT NULL,
  `ftCustomer_Code` varchar(50) NOT NULL,
  `ftLoan_No` varchar(50) NOT NULL,
  `fnPaymentMethod` int(50) NOT NULL,
  `fnJW` double NOT NULL,
  `ffBunga` double NOT NULL,
  `fcPlafond` double NOT NULL,
  `ffAdm` double NOT NULL,
  `fcAdm` double NOT NULL,
  `ffAsuransi` double NOT NULL,
  `fcAsuransi` double NOT NULL,
  `ffProvisi` double NOT NULL,
  `fcProvisi` double NOT NULL,
  `fcPblt` double NOT NULL,
  `fcPelunasan` double NOT NULL,
  `fcDiskon` double NOT NULL,
  `fcSimpanan` double NOT NULL,
  `fcTerimaBersih` double NOT NULL,
  `fcPokokAngsuran` double NOT NULL,
  `fcBunganAngsuran` double NOT NULL,
  `fcAdmAngsuran` double NOT NULL,
  `fcPbltAngsuran` double NOT NULL,
  `fcTabAngsuran` double NOT NULL,
  `fcTotalAngsuran` double NOT NULL,
  `fnStatus` int(11) NOT NULL,
  `ftNotes` varchar(50) NOT NULL,
  `ftCreated_User` varchar(50) NOT NULL,
  `fdCreated_Date` datetime NOT NULL,
  `ftModified_User` varchar(50) NOT NULL,
  `fdModified_date` datetime NOT NULL,
  `fcMaterai` double NOT NULL,
  `fcPayment` double NOT NULL,
  `fcOutstanding` double NOT NULL,
  PRIMARY KEY (`fnid`,`ftBranch_Code`,`ftTrans_No`),
  KEY `fnid` (`fnid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;