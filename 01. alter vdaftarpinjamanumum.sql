DELIMITER $$

ALTER ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vdaftarpinjamanumum` AS (
SELECT
  `a`.`fnid`            AS `fnid`,
  `a`.`fdTrans_date`    AS `fdTrans_date`,
  `a`.`ftTrans_No`      AS `ftTrans_No`,
  `a`.`ftCustomer_Code` AS `ftCustomer_Code`,
  `b`.`ftNamaNasabah`   AS `ftNamaNasabah`,
  `a`.`fcPlafond`       AS `fcPlafond`,
  `a`.`fnStatus`        AS `fnStatus`,
`b`.`ftKantorBayar`        AS `ftKantorBayar`
FROM (`txpinjaman_umum_hdr` `a`
   LEFT JOIN `tlnasabah` `b`
     ON ((`a`.`ftCustomer_Code` = `b`.`ftNoRekening`))))$$

DELIMITER ;