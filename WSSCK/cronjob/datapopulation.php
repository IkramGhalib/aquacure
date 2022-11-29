<?php
$subdiv_array = array('pda');//,'mes01c1','mes30c1','mes05c1','swtphlt');
for ($x = 0 ; $x< sizeof($subdiv_array); $x++)
{
       // date_default_timezone_set("Asia/Karachi");
		$subdivid =$subdiv_array[$x];
// $subdivid = $_GET['subdivid'];
echo $subdivid; 
       $dbhost = "10.13.144.6";
		$dbuser = "user_".$subdivid;
		$dbpass =  "Adm1n@".$subdivid;
	        $dbname =  "waterscada_".$subdivid;

//		echo $dbname;
		$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		
		$sql = "select transformer.trid, transformer.offpeak, transformer.peak,transformer.datetime, transformer.`switch_time`, transformer.status,kva_capacity,pumping_capacity,cause,status_out,yeildpk,yeildoffpk,c1,c2,c3,v1,v2,v3,pf1,pf2,pf3, name, pump_operator1, pump_operator2, pump_operator3,`switch_offtime`, `switch_ontime`,`on_cause`,`off_cause` from transformer order by trid ";
		echo $sql;
		$arrayData = array();
		$pump_update_index = array();
	//	$yeild_update_index = array();
		$pump_index = 0;
		$result = mysqli_query($db,$sql);
		$arrayData_index = array();
		while($row = mysqli_fetch_array($result))
		{  
            $arrayData_index[]=$row['trid'];
			array_push($arrayData,array($row['trid'],$row['offpeak'],$row['peak'],$row['datetime'], $row['switch_time'], $row['status'],$row['status_out'],$row['kva_capacity'], $row['pumping_capacity'], $row['cause'], $row['yeildpk'], $row['yeildoffpk'],0,$row['c1'],$row['c2'],$row['c3'],$row['v1'],$row['v2'],$row['v3'],$row['pf1'],$row['pf2'],$row['pf3'],$row['name'],$row['pump_operator1'],$row['pump_operator2'],$row['pump_operator3'],$row['switch_ontime'],$row['switch_offtime'],$row['on_cause'],$row['off_cause']));			
			
		}
		
		$sql = "select * from raw_pump_log where packet_date_time > now() -interval 1 minute order by moduleid desc";
		$result = mysqli_query($db,$sql);
		echo $sql;
		$insert = "INSERT INTO tr_current_logs (trid, v1,v2,v3,pf1,pf2,pf3,B1U, B1M, B1L, datetime) VALUES";
		$insertkwh = "INSERT INTO  `tr_kwh_logs`  (`trid`, `offpeak`, `peak`,`Datetime`,`offpkunits`,`pkunits`,`val1`,`val2`,`val3`,`cval1`,`cval2`,`cval3`,`pf1`,`pf2`,`pf3`,`mankwh`,`realval`,`pkflg`) VALUES";
		 $insertyeild = "INSERT INTO `tr_kwh_daily`( `trid`, `offpeak`, `peak`, `year`, `month`, `day`, `timeswitchedOn`, `timeswitchedoff`, `total`,`yield`) VALUES";
		$sqllogs="INSERT INTO `transformer_delay_logs`( `trid`, `offline_entry`, `date_time`) VALUES";
		$index_row= 0 ;
        $count = mysqli_num_rows($result);
        $index_yeild = 0;
		while($rowdata = mysqli_fetch_array($result))
		{
            
                $pump_index=array_search($rowdata['moduleid'],$arrayData_index);
           
            
			if ($rowdata['moduleid']==$arrayData[$pump_index][0])
			{
			 	 if ($index_row==0)
				 {
					 $index_row = $index_row+1;
				 }
				 else
				 {
					 $insert = $insert.",";
					 $insertkwh = $insertkwh.",";
					  $sqllogs = $sqllogs.",";
					 
				 }
                
                $ispeak = 0;
				$datetime 	= $rowdata['packet_date_time'];

				 $time = date('H',strtotime($datetime));
        //echo $time;
                $month = date('m',strtotime($datetime));
//echo $month;

                $datetimeArray = array(array(1,17,21),array(2,17,21),array(3,17,22),array(4,17,22),array(5,17,22),array(6,17,23),array(7,17,23),array(8,17,23),array(9,17,22));

                if ($time >= $datetimeArray[$month-1][1] and $time <= $datetimeArray[$month-1][2]) {
                        $ispeak = 1;
                }else{
                        $ispeak = 0;
                }


				$moduleid=$rowdata['moduleid'];
				$arrvoltage = array($rowdata['v_red'],$rowdata['v_blue'],$rowdata['v_yellow']);
				$arrpf = array($rowdata['pf_red'],$rowdata['pf_blue'],$rowdata['pf_yellow']);
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

		
				$currenttime = strtotime($datetime);				
				$prevdatetime = $arrayData[$pump_index][3];
				$prevdatetime = strtotime($prevdatetime);
				$lasttime=$prevdatetime; 
				$timediff = ceil(($currenttime-$lasttime));
				$minutes = floor($timediff/60);

				if ($minutes<=1)
				{
					$minutes  = 0;
				}
				$sqllogs = $sqllogs." ('".$rowdata['moduleid']."','".$minutes."','".$rowdata['server_date_time']."' )";
				
				$totalOffpk = $arrayData[$pump_index][1];
				$totalpeak = $arrayData[$pump_index][2];
				$insert = $insert."('".$moduleid."','".$arrvoltage[0]."','".$arrvoltage[1]."','".$arrvoltage[2]."','".$arrpf[0]."','".$arrpf[1]."','".$arrpf[2]."','".$arrc1[0]."','".$arrc1[1]."','".$arrc1[2]."','".$datetime."')";
		                $arrayData[$pump_index][13]=$arrc1[0];
                		$arrayData[$pump_index][14]=$arrc1[1];
		                $arrayData[$pump_index][15]=$arrc1[2];
                		$arrayData[$pump_index][16]=$arrvoltage[0];
		                $arrayData[$pump_index][17]=$arrvoltage[1];
                		$arrayData[$pump_index][18]=$arrvoltage[2];
		                $arrayData[$pump_index][19]=$arrpf[0];
                		$arrayData[$pump_index][20]=$arrpf[1];
		                $arrayData[$pump_index][21]=$arrpf[2];
				$name = $arrayData[$pump_index][22];
				$phone1 = $arrayData[$pump_index][23];
				$phone2 = $arrayData[$pump_index][24];
				$phone3 = $arrayData[$pump_index][25];
				//echo $name;
				$totalOffpk_device = $rowdata['kwh_offpeak_red'] + $rowdata['kwh_offpeak_blue']  + $rowdata['kwh_offpeak_yellow'] ;
				echo $totalOffpk_device." ".$arrayData[$pump_index][1];
				$totalpk_device = $rowdata['kwh_peak_red'] + $rowdata['kwh_peak_blue']  + $rowdata['kwh_peak_yellow'] ;
				echo $totalpk_device." ".$arrayData[$pump_index][2];
				if ($totalOffpk < $totalOffpk_device )
				{
					$totalOffpk = $totalOffpk_device;
				}
				
				if ($totalpeak < $totalpk_device )
				{
					$totalpeak = $totalpk_device;
				}
				
				$mankwh = (($arrvoltage[0] * $arrc1[0] * $arrpf[0])  +  ($arrvoltage[1] * $arrc1[1] * $arrpf[1]) +  ($arrvoltage[2] * $arrc1[2] * $arrpf[2]) );
				$mankwh = $mankwh*$timediff;
				$mankwh = $mankwh / (3600000);
				$arrkwh = array(($arrvoltage[0] * $arrc1[0] * $arrpf[0]*$timediff)/3600000,($arrvoltage[1] * $arrc1[1] * $arrpf[1]*$timediff)/3600000,($arrvoltage[2] * $arrc1[2] * $arrpf[2]*$timediff)/3600000);
				$offpeak = 0;
				$pk		 = 0;
				if($ispeak== 1)  
				{
					$offpeak = $totalOffpk;
					$pk		 = $totalpeak + $mankwh;
					$arrayData[$pump_index][10] = $arrayData[$pump_index][10] + $mankwh;
					$realval = $mankwh;
				}
				else  
				{		
					$pk = $totalpeak;
					$offpeak		 = $totalOffpk + $mankwh;
					$arrayData[$pump_index][11] = $arrayData[$pump_index][11] + $mankwh;
					$realval = $mankwh;
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
				$arrayData[$pump_index][1]= $totalOffpk;
				$arrayData[$pump_index][2]= $totalpeak;
				$insertkwh = $insertkwh."('".$moduleid."','".$offpeak."','".$pk."','".$datetime."','".$offpkunits."','".$pkunits."','".$arrvoltage[0]."','".$arrvoltage[1]."',	'".$arrvoltage[2]."','".$arrc1[0]."','".$arrc1[1]."','".$arrc1[2]."','".$arrpf[0]."','".$arrpf[1]."','".$arrpf[2]."','".$mankwh."','".$realval."','" . $peakflg ."')";
				
			
				$lasttime=strtotime($arrayData[$pump_index][4]);
				$timediff = ceil(($currenttime-$lasttime)/60);
				
				$pump_power = 0.7457 * $arrayData[$pump_index][7];
    				$pumping_capacity = $arrayData[$pump_index][8];
    				$voltageThreshHigh = 287.5;
    				$voltageThreshLow  = 172.5;
    				$phaseCurrent = $pump_power*1000/(3*230*0.86);
				$phaseCurrentLow =  $phaseCurrent * 0.2;
				
				if ($timediff <=7 and ($arrayData[$pump_index][9] == 'Online'  or $arrayData[$pump_index][9] == 'Auto-Online'   ) ) 
				{
            
					if($arrayData[$pump_index][5] == "On")
					{
						$arrayData[$pump_index][6] = 1;
					}

					if($arrayData[$pump_index][5] == "Off")
					{
						$arrayData[$pump_index][6] = 0;
					}
        		}
				else
				{
					echo $name;
					$id = "wsscs";
					$key = "3ecb61dda411351df4e25391e75b903c";
                	$mask = "CISNR-WSSC";
                	// Data for text message
                	$to = "923339480992";               
                	$lang = "en";
					if ($arrc1[0] < $phaseCurrentLow  and $arrc1[1] < $phaseCurrentLow  and $arrc1[2] < $phaseCurrentLow)
					{
                    
						if ($arrayData[$pump_index][5] == 'On')
						{
                            if ($index_yeild > 0 )
                            {
                                $insertyeild = $insertyeild. ",";
                            }
							 $year 	  = date('Y');
                        	 $month	  = date('F');
                        
                        	 $day= explode('-',date('d-m-y'));
							 $gallonhr = round($timediff * $pumping_capacity/60,2);
							 $insertyeild = $insertyeild. "('".$moduleid."','".$arrayData[$pump_index][11]."','".$arrayData[$pump_index][10]."','".$year."','".$month."','".$day[0]."','".$arrayData[$pump_index][4]."','".$datetime."','".($arrayData[$pump_index][11]+$arrayData[$pump_index][10])."','".$gallonhr."')";
                             $index_yeild= $index_yeild + 1;
                            if(($arrc1[0] + $arrc1[1] + $arrc1[2])==0 or (($arrvoltage[0] + $arrvoltage[1] + $arrvoltage[2])/3 )<110 )
							{	$arrayData[$pump_index][9] = 'Manual';
							    $cause = " manually";
							}
							else
							{
                             $arrayData[$pump_index][9] = 'Manual';
								$cause = " manually.";
							}
								$arrayData[$pump_index][5] = 'Off';
                             $arrayData[$pump_index][4] = $datetime;
                             $arrayData[$pump_index][10] = 0;
                             $arrayData[$pump_index][11] = 0;
							if ($subdivid == 'swtwssc')
							{
								//$cause = " manually or due to load shedding";
								if (!empty($phone1)) {
									sendMessage($moduleid, $name,"switched off",$phone1, $datetime, $cause);	
								}
								if (!empty($phone2)) {
									sendMessage($moduleid, $name,"switched off",$phone2, $datetime, $cause);	
								}
								if (!empty($phone3)) {
									sendMessage($moduleid, $name,"switched off",$phone3, $datetime, $cause);	
								}
								
							}
						}
						elseif($timediff <= 9 and $arrayData[$pump_index][5] == 'Off' )
						{
							if ($arrayData[$pump_index][27]!= $arrayData[$pump_index][4])
							{
								$arrayData[$pump_index][27] = $arrayData[$pump_index][4];
								$arrayData[$pump_index][29] = $arrayData[$pump_index][9];
								$event_insert = "INSERT INTO `event_logs` (`pump_id`, `event`, `cause`, `datetime`, `previous_event`, `prev_cause`, `prev_datetime`) VALUES( '".$arrayData[$pump_index][0]."', 'Off', '".$arrayData[$pump_index][29]."', '".$arrayData[$pump_index][4]."', 'On', '".$arrayData[$pump_index][28]."', '".$arrayData[$pump_index][26]."')";
								$result_event =  $db->query($event_insert); 
							}
						}
						
                        
					}
                    elseif ($arrc1[0] > $phaseCurrentLow  or $arrc1[1] > $phaseCurrentLow  or $arrc1[2] > $phaseCurrentLow)
                    {
                       if ($arrayData[$pump_index][5] == 'Off')
                           {
                               $arrayData[$pump_index][9] = 'Manual';
                               $arrayData[$pump_index][5] = 'On';
                               $arrayData[$pump_index][4] = $datetime;
						   	   if ($subdivid == 'swtwssc')
							   {
							   		$cause = " Manually.";
							   		if (!empty($phone1)) {
							   			sendMessage($moduleid, $name,"switched on",$phone1, $datetime, $cause);	
							   		}
							   		if (!empty($phone2)) {
							   			sendMessage($moduleid, $name,"switched on",$phone2, $datetime, $cause);	
							   		}
							   		if (!empty($phone3)) {
							   			sendMessage($moduleid, $name,"switched on",$phone3, $datetime, $cause);	
							   		}
							   		
							   		
							   }
                           }
						elseif($timediff <= 9 and $arrayData[$pump_index][5] == 'On' )
						{
							if ($arrayData[$pump_index][26]!= $arrayData[$pump_index][4])
							{
								$arrayData[$pump_index][26] = $arrayData[$pump_index][4];
								$arrayData[$pump_index][28] = $arrayData[$pump_index][9];
								$event_insert = "INSERT INTO `event_logs` (`pump_id`, `event`, `cause`, `datetime`, `previous_event`, `prev_cause`, `prev_datetime`) VALUES( '".$arrayData[$pump_index][0]."', 'On', '".$arrayData[$pump_index][28]."', '".$arrayData[$pump_index][4]."', 'Off', '".$arrayData[$pump_index][29]."', '".$arrayData[$pump_index][27]."')";
								$result_event =  $db->query($event_insert); 
							}
						}
							
						
                    }
                    
                    $arrayData[$pump_index][6] = 2;
                    					
				}
				

				
				
				$arrayData[$pump_index][12] = $rowdata['fault'];
                $arrayData[$pump_index][3] = $rowdata['packet_date_time'];
            //    var_dump($arrayData[$pump_index]);
				$pump_update_index[]=$pump_index;
                
			}
            $pump_index = 0;
            
		}
echo $insert;
echo $insertkwh;
		$result = $db->query($insert);
		$result = $db->query($insertkwh);
	$result_performance = $db->query($sqllogs);
echo $sqllogs;
        if ($index_yeild>0)
		$result = $db->query($insertyeild);
		for ($i = 0; $i<count($pump_update_index);$i++)
        {
            $sql = "update transformer set `offpeak` = '". $arrayData[$pump_update_index[$i]][1]."',
                `peak` = '". $arrayData[$pump_update_index[$i]][2]."',
                `datetime` = '". $arrayData[$pump_update_index[$i]][3]."',
                `switch_time` = '". $arrayData[$pump_update_index[$i]][4]."',
                `status` = '". $arrayData[$pump_update_index[$i]][5]."',
                `status_out` = '". $arrayData[$pump_update_index[$i]][6]."',
                `kva_capacity` = '". $arrayData[$pump_update_index[$i]][7]."',
                `pumping_capacity` = '". $arrayData[$pump_update_index[$i]][8]."',
                `cause` = '". $arrayData[$pump_update_index[$i]][9]."',
                `yeildpk` = '". $arrayData[$pump_update_index[$i]][10]."',
                `yeildoffpk` = '". $arrayData[$pump_update_index[$i]][11]."',
                `c1` = '". $arrayData[$pump_update_index[$i]][13]."',
                `c2` = '". $arrayData[$pump_update_index[$i]][14]."',
                `c3` = '". $arrayData[$pump_update_index[$i]][15]."',
                `v1` = '". $arrayData[$pump_update_index[$i]][16]."',
                `v2` = '". $arrayData[$pump_update_index[$i]][17]."',
                `v3` = '". $arrayData[$pump_update_index[$i]][18]."',
                `pf1` = '". $arrayData[$pump_update_index[$i]][19]."',
                `pf2` = '". $arrayData[$pump_update_index[$i]][20]."',
                `pf3` = '". $arrayData[$pump_update_index[$i]][21]."',
				`switch_ontime` = '". $arrayData[$pump_update_index[$i]][26]."',
				`switch_offtime` = '". $arrayData[$pump_update_index[$i]][27]."',
				`on_cause` = '".$arrayData[$pump_update_index[$i]][28]."',
				`off_cause` = '".$arrayData[$pump_update_index[$i]][29]."'
				where trid = '".$arrayData[$pump_update_index[$i]][0]."'";
			echo $sql;
            $result = $db->query($sql);          
                
        }
        
		
		$db->close();
		
}
function sendMessage($pump_id,$pump_name,$switched,$to,$dt,$cause){
        $id = "wsscs";
        $key = "3ecb61dda411351df4e25391e75b903c";
        $mask = "WSSCS";
        $lang = "en";
        $message = "Pump Loc: ".$pump_name." (ID: ".$pump_id.") ".$switched." at ".$dt." ".$cause;
        // must URL encode to safely send all characters to the API URL
        $message = urlencode($message);
        $data ="id=".$id."&key=".$key."&mask=".$mask."&to=".$to."&msg=".$message."&lang=".$lang;
        $ch = curl_init('http://www.brandedsms.pk/api/sendsms.php');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        echo "Message Sent.........!";
    }

?>

