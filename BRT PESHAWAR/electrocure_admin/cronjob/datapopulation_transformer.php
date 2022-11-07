<?php
//date_default_timezone_set("Asia/Karachi");
$dbtype = "electrocure";
$subdivid = "26217";

$dbhost = "10.13.144.3";
$dbuser = "user_".$subdivid;
$dbpass =  "Adm1n@".$subdivid;
$dbname =  $dbtype."_".$subdivid;

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$sql = "select * from transformer order by trid ";

$arrayData = array();
$arrayData_index = array();
$transformer_update_index = array();
	//	$yeild_update_index = array();
		$transformer_index = 0;
		$result = mysqli_query($db,$sql);
		
		while($row = mysqli_fetch_array($result))
		{  
			$arrayData_index[]=$row['trid'];
                array_push($arrayData,array($row['trid'],$row['offpeak'],$row['peak'],$row['datetime'],$row['c1'],$row['c2'],$row['c3'],$row['v1'],$row['v2'],$row['v3'],$row['pf1'],$row['pf2'],$row['pf3'],$row['kwh_offpeak1'],$row['kwh_offpeak2'],$row['kwh_offpeak3'],$row['kwh_peak1'],$row['kwh_peak2'],$row['kwh_peak3'],$row['ltlength'],$row['cresistance'],$row['NC'],$row['NL'],$row['NUL']));	
		}

//var_dump($arrayData);

    $sql = "SELECT a.* from raw_transfocure_log a
            inner join(SELECT moduleid, MAX(server_date_time) pdt
            FROM raw_transfocure_log where server_date_time > now() - interval 3 minute  GROUP BY moduleid)b on a.moduleid = b.moduleid and a.server_date_time = b.pdt and a.server_date_time >now() - interval 3 minute";
		$result = mysqli_query($db,$sql);
		$insert = "INSERT INTO tr_current_logs (trid, v1,v2,v3,pf1,pf2,pf3,B1U, B1M, B1L, datetime,NC,NL,NUL) VALUES";
		$insertkwh = "INSERT INTO  `tr_kwh_logs`  (`trid`, `offpeak`, `peak`,`Datetime`,`offpkunits`,`pkunits`,`val1`,`val2`,`val3`,`cval1`,`cval2`,`cval3`,`pf1`,`pf2`,`pf3`,`kwh1`,`kwh2`,`kwh3`,`pkflg`) VALUES";
	$index_row= 0 ;
    $count = mysqli_num_rows($result);
    
    while($rowdata = mysqli_fetch_array($result))
	{
       
       
      
                $transformer_index = array_search($rowdata['moduleid'],$arrayData_index);
        
		 $arrayData[$transformer_index][0];
		if ($rowdata['moduleid']==$arrayData[$transformer_index][0])
		{
			
			 if ($index_row==0)
				 {
					 $index_row = $index_row+1;
				 }
				 else
				 {
					 $insert = $insert.",";
					 $insertkwh = $insertkwh.",";
//					 $insertyeild = $insertyeild. ",";
				 }
				$datetime 	= $rowdata['server_date_time'];
				$time = date('H',strtotime($datetime));
				$month = date('m',strtotime($datetime));
				$frommontharray = array(12,3,6,9);
				$tomontharray = array(2,5,8,11);
				$fromtimearray = array('2000-01-01 17:00:00','2000-01-01 18:00:00','2000-01-01 19:00:00','2000-01-01 18:00:00');
				$totimearray = array('2000-01-01 21:00:00', '2000-01-01 22:00:00','2000-01-01 23:00:00','2000-01-01 22:00:00');
				$index = 0;
				while($index<4)
				{
					$frommonth = $frommontharray[$index] ;
					$tomonth = $tomontharray[$index] ;
					$fromtime = date('H', strtotime($fromtimearray[$index])) ;
					$totime = date('H', strtotime($totimearray[$index])) ;       
					if ($frommonth>$tomonth)
					$frommonth = 0;

					if(($month==$frommonth or $month>$frommonth) and ($month==$tomonth or $month<$tomonth))
					{
						if(($time==$fromtime or $time>$fromtime) and ($time==$totime or $time<$totime))
						{
							$ispeak = 1;
						}
						else
						{
						$ispeak = 0;
						}
					}
					$index = $index+1;
				}

				$moduleid=$rowdata['moduleid'];
				$arrvoltage = array($rowdata['v_red'],$rowdata['v_blue'],$rowdata['v_yellow']);
				$arrpf = array($rowdata['pf_red'],$rowdata['pf_blue'],$rowdata['pf_yellow']);
            //    var_dump($arrpf);
				$arrc1 = array($rowdata['i_red'],$rowdata['i_blue'],$rowdata['i_yellow']);
				$peakflg    = $ispeak;
				$i1 = $arrc1[0];
				$i2 = $arrc1[1];
				$i3 = $arrc1[2];

				$pf1 = $arrpf[0];
				$pf2 = $arrpf[1];
				$pf3 = $arrpf[2];

				$angle1 = acos($pf1);
				$angle2 = acos($pf2);
				$angle3 = acos($pf3);

				$angle12 = deg2rad(120) + $angle2 - $angle1;
				$angle13 = deg2rad(240) + $angle3 - $angle1;

				$A = $i1 + ($i2 * cos($angle12)) + ($i3 * cos($angle13));	//Real Components
				$B = ($i2 * sin($angle12)) + ($i3 * sin($angle13));			//Imaginary Components
				$C = sqrt( $A*$A + $B*$B );									//Magnitude
				$neutral = round($C, 2);
		//-------------------------------------------------------------------------

		//Power Factor Correction (Avoid 1 on Transformers)------------------------
				if($arrpf[0]>0.99)
					$arrpf[0] = 0.98;

				if($arrpf[1]>0.99)
					$arrpf[1] = 0.98;

				if($arrpf[2]>0.99)
					$arrpf[2] = 0.98;
				
			    $kva1= round($arrc1[0]*$arrvoltage[0]/1000,2);
		        $kva2= round($arrc1[1]*$arrvoltage[1]/1000,2);
	         	$kva3= round($arrc1[2]*$arrvoltage[2]/1000,2);
		
				$currenttime = strtotime($datetime);				
				$prevdatetime = $arrayData[$transformer_index][3];
				$prevdatetime = strtotime($prevdatetime);
				$lasttime=$prevdatetime; 
				$timediff = ceil(($currenttime-$lasttime));
				$totalOffpk = $arrayData[$transformer_index][1];
				$totalpeak = $arrayData[$transformer_index][2];
                $NL = round($arrayData[$transformer_index][19] * $arrayData[$transformer_index][20] * $neutral *$neutral,2);
                $arrayData[$transformer_index][21] = $neutral;
                $arrayData[$transformer_index][22] = $NL;
                $arrayData[$transformer_index][23] = $NUL;
			    $NUL = $NL * $timediff;
                $NUL = round($NUL/(60*60),2);
				$insert = $insert."('".$moduleid."','".$arrvoltage[0]."','".$arrvoltage[1]."','".$arrvoltage[2]."','".$arrpf[0]."','".$arrpf[1]."','".$arrpf[2]."','".$arrc1[0]."','".$arrc1[1]."','".$arrc1[2]."','".$datetime."','".$neutral."','".$NL."','".$NUL."')";
                $arrayData[$transformer_index][4]=$arrc1[0];
                $arrayData[$transformer_index][5]=$arrc1[1];
                $arrayData[$transformer_index][6]=$arrc1[2];
                $arrayData[$transformer_index][7]=$arrvoltage[0];
                $arrayData[$transformer_index][8]=$arrvoltage[1];
                $arrayData[$transformer_index][9]=$arrvoltage[2];
               
                $arrayData[$transformer_index][10]=$arrpf[0];
                $arrayData[$transformer_index][11]=$arrpf[1];
                $arrayData[$transformer_index][12]=$arrpf[2];
               
            
                if($arrpf[0]<0.5)
                {
                    $pf1 = 0.7;
                   //  $arrayData[$transformer_index][10]=0.7;
                }
                else
                    $pf1 = $arrpf[0];
                if($arrpf[1]<0.5)
                {
                    $pf2 = 0.7;
                }
                else
                    $pf2 = $arrpf[1];
                
                if($arrpf[2]<0.5)
                 {
                    $pf3 = 0.7;
//$arrayData[$transformer_index][12]=0.7;
                }
                else
                    $pf3 = $arrpf[2];
            
            
                //    echo $pf1;
                //    echo $pf2;
                //    echo $pf3;
                 $mankwh = (($arrvoltage[0] * $arrc1[0] *$pf1)  +  ($arrvoltage[1] * $arrc1[1] * $pf2) +  ($arrvoltage[2] * $arrc1[2] * $pf3) );
                 //echo $mankwh;
				$mankwh = $mankwh*$timediff;
				$mankwh = $mankwh / (3600000);
				$arrkwh = array(($arrvoltage[0] * $arrc1[0] *$pf1*$timediff)/3600000,($arrvoltage[1] * $arrc1[1] * $pf2*$timediff)/3600000,($arrvoltage[2] * $arrc1[2] * $pf3*$timediff)/3600000);
				$offpeak = 0;
				$pk		 = 0;
				if($ispeak== 1)  
				{
					$offpeak = $totalOffpk;
					$pk		 = $totalpeak + $mankwh;
				//	$arrayData[$transformer_index][10] = $arrayData[$transformer_index][10] + $mankwh;
					$realval = $mankwh;
                    $arrayData[$transformer_index][13]=$arrayData[$transformer_index][13] +$arrkwh[0];
                    $arrayData[$transformer_index][14]=$arrayData[$transformer_index][14] +$arrkwh[1];
                    $arrayData[$transformer_index][15]=$arrayData[$transformer_index][15] +$arrkwh[2];
				}
				else  
				{		
					$pk = $totalpeak;
					$offpeak		 = $totalOffpk + $mankwh;
				//	$arrayData[$transformer_index][11] = $arrayData[$transformer_index][11] + $mankwh;
					$realval = $mankwh;
                    $arrayData[$transformer_index][16]=$arrayData[$transformer_index][16] +$arrkwh[0];
                    $arrayData[$transformer_index][17]=$arrayData[$transformer_index][17] +$arrkwh[1];
                    $arrayData[$transformer_index][18]=$arrayData[$transformer_index][18] +$arrkwh[2];
				}
				if($ispeak ==1)
				{
					$pkunits 	= $mankwh;
					$offpkunits = 0;
				}
				else
				{
					$offpkunits = $mankwh;
					$pkunits 	= 0;
				}
				$arrayData[$transformer_index][1]= $offpeak;
				$arrayData[$transformer_index][2]= $pk;
				$insertkwh = $insertkwh."('".$moduleid."','".$offpeak."','".$pk."','".$datetime."','".$offpkunits."','".$pkunits."','".$arrvoltage[0]."','".$arrvoltage[1]."',	'".$arrvoltage[2]."','".$arrc1[0]."','".$arrc1[1]."','".$arrc1[2]."','".$arrpf[0]."','".$arrpf[1]."','".$arrpf[2]."','".$arrkwh[0]."','".$arrkwh[1]."','".$arrkwh[2]."','" . $peakflg ."')";
			    $arrayData[$transformer_index][3] = $rowdata['server_date_time'];
              //  var_dump($arrayData[$transformer_index]);
				$transformer_update_index[]=$transformer_index;
			
		}
        $transformer_index = 0;
       
	}
echo $insert;
$result = $db->query($insert);
//        echo $insertkwh;
		$result = $db->query($insertkwh);
//var_dump($transformer_update_index);

for ($i = 0; $i<count($transformer_update_index);$i++)
        {
       //    echo $arrayData[$transformer_update_index[$i]][0];
            var_dump($arrayData[$transformer_update_index[$i]]);
            $sql = "update  transformer set `offpeak` = '". $arrayData[$transformer_update_index[$i]][1]."',
                `peak` = '". $arrayData[$transformer_update_index[$i]][2]."',
                `datetime` = '". $arrayData[$transformer_update_index[$i]][3]."',
                `c1` = '". $arrayData[$transformer_update_index[$i]][4]."',
                `c2` = '". $arrayData[$transformer_update_index[$i]][5]."',
                `c3` = '". $arrayData[$transformer_update_index[$i]][6]."',
                `v1` = '". $arrayData[$transformer_update_index[$i]][7]."',
                `v2` = '". $arrayData[$transformer_update_index[$i]][8]."',
                `v3` = '". $arrayData[$transformer_update_index[$i]][9]."',
                `pf1` = '". $arrayData[$transformer_update_index[$i]][10]."',
                `pf2` = '". $arrayData[$transformer_update_index[$i]][11]."',
                `pf3` = '". $arrayData[$transformer_update_index[$i]][12]."',
                `kwh_peak1` = '". $arrayData[$transformer_update_index[$i]][13]."',
                `kwh_peak2` = '". $arrayData[$transformer_update_index[$i]][14]."',
                `kwh_peak3` = '". $arrayData[$transformer_update_index[$i]][15]."',
                `kwh_offpeak1` = '". $arrayData[$transformer_update_index[$i]][16]."',
                `kwh_offpeak2` = '". $arrayData[$transformer_update_index[$i]][17]."',
                `kwh_offpeak3` = '". $arrayData[$transformer_update_index[$i]][18]."',
                `NC` = '".$arrayData[$transformer_update_index[$i]][21]."',
                `NL` = '".$arrayData[$transformer_update_index[$i]][22]."',
                `NUL`= '".$arrayData[$transformer_update_index[$i]][23]."'
                where trid = '". $arrayData[$transformer_update_index[$i]][0]."'";
            //echo $sql;
            $result = $db->query($sql);
                
                
        }
        
		
		$db->close();
?>