<?php
session_start(); 
error_reporting(0);
include "../../config/config.php";
try{
  
  $data = json_decode(file_get_contents('php://input'));
    
  //echo $_SERVER['REQUEST_METHOD'];
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
	$request=$_REQUEST;
    $limit = $request['length'];
	$offset = $request['start'];   
//	$offset = $offset+(2*$limit);
    
   
	$col=Array(
					[0] => 'ftNoRekening',
					[1] => 'ftNamaNasabah',
					[2] => 'ftAlamat',
					[3] => 'fnTipeNasabah',
					[4] => 'ftKantorBayar'				
				);
	$fields  = "a.ftNamaNasabah,a.fnTipeNasabah,a.ftKantorBayar,a.ftNoRekening,a.ftAlamat,b.ftCustomer_Code,
        b.fcTotalPelunasanPokok,b.fcTotalPelunasanBunga,b.fcTotalPelunasanAdm,b.fcTotalPelunasanPblt ,
        b.ftTrans_No,b.fcTotalPelunasan, b.fcTotalPelunasanTab";
  $fields2 ="FROM tlnasabah a 
  LEFT JOIN (
        SELECT
            a.`ftTrans_No`       AS `ftTrans_No`,
            a.`ftCustomer_Code`  AS `ftCustomer_Code`,
            a.`fcPlafond`        AS `fcPlafond`,
            a.`fnJW`             AS `fnJW`,
            a.`ffBunga`          AS `ffBunga`,
            a.`fnStatus`         AS `fnstatus`,
            a.`fcPokokAngsuran`  AS `fcPokokAngsuran`,
            a.`fcBunganAngsuran` AS `fcBunganAngsuran`,
            a.`fcAdmAngsuran`    AS `fcAdm`,
            a.`fcPbltAngsuran`   AS `fcPbltAngsuran`,
            (a.`fcPokokAngsuran` * b.`fnSisaJW`) AS `fcTotalPelunasanPokok`,
            (a.`fcBunganAngsuran` * b.`fnSisaJW`) AS `fcTotalPelunasanBunga`,
            (a.`fcAdmAngsuran` * b.`fnSisaJW`) AS `fcTotalPelunasanAdm`,
            (a.`fcPbltAngsuran` * b.`fnSisaJW`) AS `fcTotalPelunasanPblt`,
            (a.`fcTabAngsuran` * b.`fnSisaJW`) AS `fcTotalPelunasanTab`,
            ((((a.`fcPokokAngsuran` * b.`fnSisaJW`) 
            + (a.`fcBunganAngsuran` * b.`fnSisaJW`)) 
            + (a.`fcAdmAngsuran` * b.`fnSisaJW`)) 
            + (a.`fcPbltAngsuran` * b.`fnSisaJW`)+(a.`fcTabAngsuran` * b.`fnSisaJW`)) AS `fcTotalPelunasan`
          FROM `txpinjaman_umum_hdr` a    
          LEFT JOIN (   
              SELECT xx.ftCustomer_Code, xx.ftTrans_No, SUM(xx.fcPlafond) AS fcOutstanding,
              SUM(xx.fcPinjaman) AS fcPinjaman, SUM(xx.fcpokokangsuran) AS fcpokokangsuran,
              SUM(xx.fcPlafond)/SUM(xx.fcpokokangsuran) AS fnSisaJW
              FROM (
                SELECT ftCustomer_Code, ftTrans_No, fcPlafond , fcPlafond AS fcPinjaman, fcpokokangsuran
                FROM txpinjaman_umum_hdr
                WHERE fnstatus = 1
                /*AND ftTrans_No='PJU19111611'  */
                
                UNION ALL

                SELECT IFNULL(a.ftCustomer_Code,'') AS ftCustomer_Code, IFNULL(a.ftTrans_No,'') AS ftTrans_No,
                -IFNULL(b.fcPokokAngsuran,0), 0,0
                FROM txpinjaman_umum_hdr a
                LEFT JOIN txangsuran_umum_hdr b ON a.ftCustomer_Code = b.ftCustomer_Code AND a.ftTrans_No = b.ftLoan_No_Old
                AND b.fnStatus = 1
                WHERE a.fnstatus = 1
                /*AND a.ftTrans_No='PJU19111611'*/
              ) xx
              GROUP BY xx.ftCustomer_Code, xx.ftTrans_No
            ) b ON a.`ftTrans_No`= b.ftTrans_No AND a.ftCustomer_Code = b.ftCustomer_Code
          WHERE a.fnStatus = 1

        ) b ON a.ftNoRekening=b.ftCustomer_Code
				";                             
	$sql ="SELECT ".$fields." ".$fields2." WHERE 1=1 AND a.fnTipeNasabah='UMUM' 
			GROUP BY a.ftNoRekening ORDER BY a.ftNamaNasabah ASC ";
   //echo $sql;
   $query              = mysql_query($sql);  
   $sql .=" LIMIT {$offset},{$limit} ";	
   $totalData=mysql_num_rows($query);       
   $totalFilter=$totalData;

  
	//Search
	$sql ="SELECT ".$fields." ".$fields2." WHERE 1=1 AND a.fnTipeNasabah='UMUM'";
    if(!empty($request['search']['value'])){
        $sql.=" AND (a.ftNoRekening Like '%".$request['search']['value']."%' ";
        $sql.=" OR a.ftNamaNasabah Like '%".$request['search']['value']."%' ";
        $sql.=" OR a.ftAlamat Like '%".$request['search']['value']."%' ";
        $sql.=" OR a.fnTipeNasabah Like '%".$request['search']['value']."%' ";
        $sql.=" OR a.ftKantorBayar Like '%".$request['search']['value']."%' )";
	   
		$query              = mysql_query($sql);  
        $totalData=mysql_num_rows($query);  
	    $totalFilter=$totalData;
    }
   // echo $sql;
   
    //Order
	$sql.=" GROUP BY a.ftNoRekening ORDER BY a.ftNamaNasabah ASC ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".$request['start']."  ,".$request['length']." ";
//	var_dump($sql);
    $query              = mysql_query($sql);  
    $data=array();
	$no1 = $offset + 1;
//	var_dump($no1);
	  while($i=mysql_fetch_array($query)){
     // for($i=0;$i<count($query);$i++){
         $no4=htmlentities($i['ftAlamat']);
		 $no4ex=str_replace("\r\n","",$no4);
          
          $nestedData=array(); 
          $nestedData[]  = $no1;
          $nestedData[]  = $i["ftNoRekening"];
          $nestedData[]  = $i["ftNamaNasabah"];
          $nestedData[]  = $no4ex;
          $nestedData[]  = $i["fnTipeNasabah"];
		  $nestedData[]  = $i["ftKantorBayar"];
		  $nestedData[]  = $i["ftTrans_No"];
		  $nestedData[]=htmlentities(number_format($i['fcTotalPelunasanPokok'], 0 , ',' , ',' ));
		  $nestedData[]=htmlentities(number_format($i['fcTotalPelunasanBunga'], 0 , ',' , ',' ));
		  $nestedData[]=htmlentities(number_format($i['fcTotalPelunasanAdm'], 0 , ',' , ',' ));
		  $nestedData[]=htmlentities(number_format($i['fcTotalPelunasanPblt'], 0 , ',' , ',' ));
		  $nestedData[]=htmlentities($i['ftTrans_No']);
		  $nestedData[]=htmlentities(number_format($i['fcTotalPelunasan'], 0 , ',' , ',' ));
          $nestedData[]=htmlentities(number_format($i['fcTotalPelunasan'], 0 , ',' , ',' ));
          $nestedData[]=htmlentities(number_format($i['fcTotalPelunasanTab'], 0 , ',' , ',' ));
		  $nestedData[]  = '';     
		         
		  $data[]        = $nestedData;
		  $no1++;
	}
	//print_r($data);
   $json_data=array(
        "draw"              =>  intval($request['draw']),
        "recordsTotal"      =>  intval($totalData),
        "recordsFiltered"   =>  intval($totalFilter),
        "data"              =>  $data
    );
    echo json_encode($json_data);
  }
}catch(Exception $e){
    echo $e."\n";
}      


