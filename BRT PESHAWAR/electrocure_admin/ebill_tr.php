
<?php
  include_once('check.php');
  authenticate("bills");



$trid = $_GET['id']; 

    //echo $cid;

           //  $name="";
           //  $bill_id="";
           //  $billingMethod="";
           //  $referenceNo="";
           // // $address="";
           //  //$email="";
           //  $billNo="";
           //  $generatedOn="";
           //  $paidOn="";
           //  $date="";
           //  $currentReading=0;
           //  $arrears=0;
           //  $UnitConsumed=0;
           //  $totalBill="";
           //  $Tarrif="";
           //  $AmountPaid="";
           //  $gst="";
           //  $gstamount="";
            require_once("opendb.php");
            date_default_timezone_set("Asia/Karachi");
            $query = "select tr_billing_postpaid.status as bill_Status, tr_billing_postpaid.*, transformer.* from tr_billing_postpaid,transformer where tr_billing_postpaid.trid = transformer.trid and bill_id = (select max(bill_id) from tr_billing_postpaid where trid ='".$trid."')";
                $result = $conn -> query($query) or die("Query error");
                $page_name = "";
                foreach($result as $row)
                {
                    $name=$row['name'];
                    $billingMethod=ucfirst($row['billing_method']);
                    $referenceNo= $row['trid'];
                    //$address= $row['address'];
                   // $email=$row['email'];
                    $billNo=$row ['bill_id'];
                    $generatedOn=$row['generated_on'];
                    $paidOn=$row['paid_on'];
                    $date=date("Y-m-d H:i:s");
                    $currentReading=$row['current_reading'];
                    $arrears=$row['last_arrears'];
                    $UnitConsumed=$row['units_consumed'];
                    $totalBill=$row['total_bill'];
                    $Tarrif=$row['tariff'];
                    $AmountPaid=$row['paid_amount'];
                    $gst=$row['gst'];
                    $gstamount=$row['gstamount'];
                    $paid_units=$row['paid_units'];
                    $status=$row['bill_Status'];

                    $page_name = "Transformer eBill - ".$referenceNo." - ".$name;

                    

                }

                if($referenceNo=="")
                {
                    echo "<script>window.location.href='bill_404.php';</script>";
                }

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from 210.56.23.106:888/pescobill/general/13264240100190 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 08:57:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head id="Head1"><title>
	<?php echo $page_name; ?>
</title><link href="styles/gbPrint.css" rel="stylesheet" type="text/css" />
<link href=".styles/normalize.css" rel="stylesheet" type="text/css" />
<link href="styles/genbill.css" rel="stylesheet" type="text/css" />
<link href="styles/img-zoom/multizoom.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="noprint">
        <br />
        <button style="" onclick="window.location.href='bills_tr.php'">Back</button>
        <button style="" onclick="window.print()">Print Bill</button>
        <br />
        <br />
    </div>


    <?php  
   

     ?>

    <form method="post" action="" id="form1">



        <div class="maincontent fontsize">
            <div class="header">
                <div class="headerimg">
                    <img style="margin-left: 10%; margin-top: 3%; width: 100%; height: 70%;"
                        src="images/brtlogo.png" alt="Electrocure" / style="height: 100%">
                </div>
                <br>
                <div class="heading">
                    <h1 style="margin: 10px 10px 10px 35px">
                        Bus Rapid Transit(BRT) Peshawar
                        <span style="color: #1a75ff; float: right;">
                            Billing Method<br/><?php echo $billingMethod ?> <br/>
                        </span>

                    </h1>

                    <div> 
                        <h3 align="center" style="margin-left: -10%;"> TRANSFORMER E-BILL </h3>                                            </div>
                    <div>
                                           </div>
                </div>
            </div>
            <table class="maintable" cellpadding="0" cellspacing="0">
                <tr style="height: 15px; width: 100%; font-size: .8em;">
                    <td class="border-rb" style="width: 206px">
                        <h4>CONNECTION NUMBER</h4>
                    </td>
                    <td class="border-rb">
                        <h4>BILLING METHOD</h4>
                    </td>
                                       <td class="border-rb" style="width: 129px">
                        <h4>GENERATED ON</h4>
                    </td>
                  
                    <td class="border-b" style="color: green;">
                        <h4>PAID ON</h4>
                    </td>
                </tr>
                
                <tr style="height: 26px; width: 100%; font-size: .8em;" class="content">
                    <td class="border-rb" style="text-align: center;">
                        <?php echo $name; ?>
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        <?php echo $billingMethod ?>
                    </td>
                   
                    <td class="border-rb" style="text-align: center;">
                        <?php echo  date( 'M d Y g:i A ', strtotime($generatedOn)) ?>
                    </td>
                   
                    <td class="border-b" style="text-align: center;">
                        <?php echo $paidOn ?>
                    </td>
                </tr>
            </table>
            <div style="height: auto; width: 453pt; float: left">
                <table class="nestable1" style="width: 100%">
                    <tr style="height: 27px;" class="fontsize">
                        <td class="border-rb">
                            <h4>REFERENCE NO</h4>
                        </td>
                        <td class="border-rb">
                            <h4>BILL NO</h4>
                        </td>
                        <td class="border-rb">
                            <h4>TARIF</h4>
                        </td>
                        <td class="border-rb">
                            <h4>GST</h4>
                        </td>
                        <td class="border-rb">
                            <h4> PRINT DATE</h4>
                        </td>
                    </tr>
                    <tr style="height: 27px;" class="fontsize content">
                        <td class="border-rb" style="text-align: center;">
                        <?php echo $referenceNo ?>
                        </td>
                        <td class="border-rb" style="text-align: center;">
                             <?php  echo $billNo ?>
                        </td>
                        <td class="border-rb" style="text-align: center;">
                            <?php echo $Tarrif ?>
                        </td>
                        <td class="border-rb" style="text-align: center;">
                            <?php echo $gst ?>%
                        </td>

                        <td class="border-rb" style="text-align: center;">
                            <?php  echo date( 'M d Y g:i A ', strtotime($date)) ?>
                        </td>
                    </tr>
                  
                    <tr style="height: 27px;" class="fontsize content">
                        
                        <td class="border-r" style="text-align: center;">
                            
                        </td>
                        <td class="border-r ">
                            
                        </td>
                        <td class=" border-r" style="text-align: center;">
                            
                        </td>
                        <td class=" border-r" style="text-align: center;">
                            
                        </td>
                        <td class=" border-r" style="text-align: center;">
                            
                        </td>
                    </tr>
                </table>
            </div>
            <div style="height: auto; width: 400px; float: right;">
                <table style="width: 100%" cellpadding="0" cellspacing="0">
                    
                   
                  
                    <tr style="height: 27px; width: 100%;" class="fontsize">
                        <td colspan="2"> <br><br>
                            <h1><?php echo ($status == 0) ? "UNPAID" : "PAID"; ?></h1>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="maintable" cellpadding="0" cellspacing="0">
                <tr style="height: auto;" class="fontsize">

                    <td colspan="4" style="width: 453pt" >
                        <table class="nested4">
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="2">
                                    
                                </td>
                                <td colspan="2">
                                    
                                </td>
                                <td colspan="2">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="margin: 0; text-align: left; padding-left: 5px">
                                        
                                    </p>
                                </td>
                                <td colspan="5" style="text-align: left">
                                    
                                    <h2 class="color-red">Say No To Corruption</h2>
                                    
                                     <br />
                                     <br />
                                     <br />
                                   
                                </td>
                            </tr>
                            <tr>
                                <td style="margin-top: 0;" class="border-b">
                                    
                                    
                                    <br />
                                     <br />
                                    
                                </td>
                                <td colspan="1" style="margin-top: 0;" class="border-b">
                                   
                                </td>

                                <td colspan="2" style="margin-top: 0;" class="border-b">
                                    <div style="font-size: 12pt;">
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 7%;" class="border-tb">
                               
                                <td style="width: 90px" class="border-r">
                                    <h4>PREVIOUS READING</h4>
                                </td>
                                <td style="width: 90px" class="border-r">
                                    <h4>CURRENT READING</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>UNIT CONSUMED</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>Paid Units</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>TARIF</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>CURRENT BILL</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>GST</h4>
                                </td>
                                 <td style="width: 60px" class="border-r">
                                    <h4>ARREARS</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>TOTAL BILL</h4>
                                </td>
                                <!-- <td style="width: 60px" class="border-r">
                                    <h4>AMOUNT PAID</h4>
                                </td>
 -->                                 
                            </tr>
                            <tr style="height: 30px" class="content">
                               
                                <td class="border-r">
                                      <?php echo round($currentReading - $UnitConsumed,2); ?>
                                </td>
                                <td class="border-r">
                                      <?php echo round($currentReading,2); ?> 
                                </td>
                                <td class="border-r">
                                         <?php echo round($UnitConsumed,2); ?>
                                </td>
                                <td class="border-r">
                                         <?php echo round($paid_units,2); ?>
                                </td>
                                <td class="border-r">
                                        <?php  echo round($Tarrif,2); ?>
                                </td>
                                <td class="border-r">
                                    <?php echo  round($Tarrif * $UnitConsumed,2);; ?>
                                        
                                </td>
                                <td class="border-r">
                                        <?php  echo round($gstamount,2); ?>
                                </td>
                                <td class="border-r">
                                    
                                     <?php echo round($arrears,2); ?>
                                </td>
                                <!-- <td class="border-r">
                                    <?php //echo $AmountPaid ?>
                                </td> -->
                                <td class="border-r">
                                   <?php echo round($totalBill,2); ?>
                                </td>
                              
                            </tr>
                            
                        </table>
                    </td>

                </tr>
            </table>
            <div class="border-t" style="width: 0pt; height: 0pt">
                
            </div>
            <div class="border-b" style="width: 100%; height: 0px" id="Tr1">
<!--                 <img src="images/cuthere.gif" alt="cuthere" id="Img2" />
 -->            </div>
            <div class="headertable fontsize">
                <div style="height: 70px;">
                    <div style="height: 100%; width: 100px; float:left; display:inline-block">
                        <img style="margin: auto; max-width: 100%; max-height: 100%; margin-left: 10%; margin-top: 2%" src="images/brtlogo.png"
                            alt="PESCO" id="Img1" />
                    </div>
                    <div style="width: 670px; display:inline-block">
                        <table style="width: 100%; text-align: right;">
                            <tr>
                                <td colspan="3">
                                    <h1 style="float: left; font-weight: 800; margin-left: 0px; margin-bottom: 0px;">
                                        Bus Rapid Transit(BRT) Peshawar
                                    </h1>
                                    <div> 
                        <h3 align="center" style="margin-left: -10%;"> TRANSFORMER E-BILL </h3>                                            </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left; width: 215px; color: #1a75ff;">
                                    <span style="font-size: 11px; color: #1a75ff;"> <b>Consumer Bill</b> </span>
                                </td>
                                <td style="text-align: left; width: 170px; color: #1a75ff;">
                                   
                                </td>
                                <td>
                                    <table style="width: 230px; margin-right: 20px; float: right; border-collapse: collapse; text-align: center">
                                        <tr>
                                            <td class="border-rb border-t" style="border-left: 1px solid #78578e; color: #78578e;">
                                                <h4>REFERENCE NO</h4>
                                            </td>
                                            <td class="border-rb border-t content">
                                                <?php  echo $referenceNo ?> 
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                        </table>
                    </div>

                    <div style="width: 15%; margin-top: 20px; float:right; display:inline-block">
                        <span>BILL NO <br /> <?php  echo $billNo ?></span>

                    </div>

                </div>
                <!-- <div style="display: inline-block; border: 1px solid #1a75ff; color: #1a75ff; padding: 20px; border-radius: 100%; width: 35px;">BANK <br /> STAMP</div>
 -->                <div style="float: right; margin-right: 206px; height: 70px; margin-bottom: 15px; overflow: hidden;">
                    <!-- <img src="images/barcode.png" id="LinearBarcode1" style="background-color:White;font-family:Times New Roman;font-size:10pt;font-weight:normal;font-style:normal;text-decoration:none;height:89px;width:336px;" /> -->
                     <?php 
                    
                      echo "<img alt='testing' src='barcode.php?codetype=Code39&size=40&text=".$referenceNo."&print=true'/>"; ?>

                </div>
                <div style="width: 98%; margin: 0 auto 10px;">

                    <table style="text-align: center; width: 100%; border-collapse: collapse;">
                        <tr style="height: 30px;">
                            <td class="border-rb border-t" style="width: 15%; color: #78578e; border-left: 1px solid #78578e;">
                                <h4>GENERATED ON</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; color: #78578e;">
                                <h4>CONNECTION NO</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 25%; color: #78578e;">
                                <h4>REFERENCE NO</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 25%; color: red">
                                <h4>CURRENT BILL</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 25%; color: red">
                                <h4>ARREARS </h4>
                            </td>
                            

                            <td class="border-rb border-t" style="width: 25%; color: red">
                                <h4>TOTAL BILL</h4>
                            </td>
                             
                            
                        </tr>
                        <tr style="height: 40px;">
                            <td class="border-rb content" style="width: 15%; text-align: center; border-left: 1px solid #78578e;">
                                 <?php echo  date( 'M d Y g:i A ', strtotime($generatedOn)) ?>
                            </td>
                            <td class="border-rb content" style="width: 15%; text-align: center;">
                                <?php echo $name ?>
                            </td>
                            <td class="border-rb content" style="width: 25%; text-align: Center;">
                                <?php echo $referenceNo ?>
                            </td>
                            <td class="border-rb border-r content" style="width: 15%;">
                                  <?php echo  round($Tarrif * $UnitConsumed,2); ?>
                                <br/> 
                                <span> </span>
                            </td>

                           <td class="border-rb border-r content" style="width: 15%;">
                                <?php  echo round($arrears,2) ?>
                            </td>
                                                         <td class="border-rb border-r content" style="width: 15%;">
                                <?php  echo round($totalBill,2) ?>
                                
                            </td>
                           
                        </tr>
                    </table>
                </div>
            </div>
    </form>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/disable_inspect_element.js"></script>
    <script type="text/javascript" src="js/multizoom.js"></script>
    <script type="text/javascript" src="js/implementation_zoomJs.js"></script>

</body>

</html>
<?php  $conn=NULL ;?>