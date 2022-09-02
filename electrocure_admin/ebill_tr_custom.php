
<?php
  include_once('check.php');
  authenticate("bills");



$id = $_GET['id']; 

    //echo $cid;

           //  $name="";
           //  $id="";
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
            $query = "select tr_billing_custom.status as custom_paid, tr_billing_custom.*, transformer.* from tr_billing_custom,transformer where tr_billing_custom.trid = transformer.trid and id = '".$id."'";
                $result = $conn -> query($query) or die("Query error");
                foreach($result as $row)
                {
                    $name=$row['name'];
                    $billingMethod=ucfirst($row['billing_method']);
                    $referenceNo= $row['trid'];
                    //$address= $row['address'];
                   // $email=$row['email'];
                    $billNo=$row ['id'];
                    $generatedOn=$row['date_generated'];
                    $paidOn=$row['paid_on'];
                    $date=date("Y-m-d H:i:s");
                    $currentReading=$row['units_to'];
                    
                    $UnitConsumed=$row['total_units'];
                    $totalBill=$row['total_bill'];
                    $Tarrif=$row['tariff'];
                    $AmountPaid=$row['total_bill'];
                    $gst=$row['gst'];
                    $gstamount=$row['gstamount'];

                    $datefrom = $row['date_from'];
                    $dateto = $row['date_to'];

                    $start_unit = $row['units_from'];
                    $end_unit = $row['units_to'];
                    $status=$row['custom_paid'];




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
	TransPeshawar-ebill
</title><link href="styles/gbPrint.css" rel="stylesheet" type="text/css" />
<link href=".styles/normalize.css" rel="stylesheet" type="text/css" />
<link href="styles/genbill.css" rel="stylesheet" type="text/css" />
<link href="styles/img-zoom/multizoom.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="noprint">
        <br />
        <button style="" onclick="window.location.href='bills_tr_custom_list.php'">Back</button>
        
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
                        <h3 align="center" style="margin-left: -10%;"> TRANSFORMER CUSTOM E-BILL</h3>                                            </div>
                    <div>
                                           </div>
                </div>
            </div>
            <table class="maintable" cellpadding="0" cellspacing="0">
                <tr style="height: 15px; width: 100%; font-size: .8em;">
                    <td class="border-rb" style="width: 206px">
                        <h4>CONNECTION</h4>
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
                        <?php //echo $billingMethod ?>
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
                            <h1><?php echo ($status==0) ? "UNPAID" : "PAID"; ?></h1>
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
                                <td style="width: 130px" class="border-r">
                                    <h4>START DATE</h4>
                                </td>
                                <td style="width: 130px" class="border-r">
                                    <h4>END DATE</h4>
                                </td>
                                <td style="width: 90px" class="border-r">
                                    <h4>STARTING READING</h4>
                                </td>
                                <td style="width: 90px" class="border-r">
                                    <h4>ENDING READING</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>UNIT CONSUMED</h4>
                                </td>
                               
                                <td style="width: 60px" class="border-r">
                                    <h4>CURRENT BILL</h4>
                                </td>
                                <td style="width: 60px" class="border-r">
                                    <h4>GST</h4>
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
                                    <?php echo $datefrom; ?>     
                                </td>
                                <td class="border-r">
                                      <?php echo  $dateto; ?>
                                </td>
                                <td class="border-r">
                                      <?php echo $start_unit; ?> 
                                </td>
                                <td class="border-r">
                                         <?php echo $end_unit; ?>
                                </td>
                                <td class="border-r">
                                        <?php  echo $UnitConsumed; ?>
                                </td>
                                
                                <td class="border-r">
                                        <?php  echo $Tarrif*$UnitConsumed; ?>
                                </td>
                                
                                <!-- <td class="border-r">
                                    <?php //echo $AmountPaid ?>
                                </td> -->
                                <td class="border-r">
                                   <?php echo $gstamount ?>
                                </td>
                                
                                <td class="border-r">
                                   <?php echo $totalBill ?>
                                </td>
                              
                            </tr>
                            <!-- <tr style="height: 30px" class="content">
                                <td class="border-r">
                                    <br />
                                    <br />
                                    
                                </td>
                                <td class="border-r">
                                    <br />
                                    <br />
                                    
                                </td>
                                <td class="border-r">
                                    <br />
                                    <br />
                                    
                                </td>
                                <td class="border-r">
                                    <br />
                                    <br />
                                    
                                </td>
                                <td class="border-r">
                                    <br />
                                    <br />
                                    
                                </td>
                                <td>
                                    <br />
                                    <br />
                                    
                                </td>
                            </tr> -->
                            
                        </table>
                    </td>

                   <!--  <td style="float: right; width: 300pt; height: 243pt">
                        <table style="height: 248pt" class="nested6 ">
                            <tr style="margin-top: -1px; height: 25px">
                                <td class="border-b " style="width: 25%;">
                                    <h4>MONTH</h4>
                                </td>
                                <td class="border-b" style="width: 25%;">
                                    <h4>UNITS</h4>
                                </td>
                                <td class="border-b" style="width: 25%;">
                                    <h4>BILL</h4>
                                </td>
                                <td class="border-b" style="width: 25%;">
                                    <h4>PAYMENT</h4>
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    FEB19
                                </td>
                                <td class="border-r">
                                    
                                    82
                                </td>
                                <td class="border-r">
                                    703
                                </td>
                                <td>
                                    703
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    MAR
                                </td>
                                <td class="border-r">
                                    
                                    76
                                </td>
                                <td class="border-r">
                                    878
                                </td>
                                <td>
                                    878
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    APR
                                </td>
                                <td class="border-r">
                                    
                                    113
                                </td>
                                <td class="border-r">
                                    1004
                                </td>
                                <td>
                                    1004
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    MAY
                                </td>
                                <td class="border-r">
                                    
                                    177
                                </td>
                                <td class="border-r">
                                    1580
                                </td>
                                <td>
                                    1580
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    JUN
                                </td>
                                <td class="border-r">
                                    
                                    176
                                </td>
                                <td class="border-r">
                                    1642
                                </td>
                                <td>
                                    1642
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    JUL
                                </td>
                                <td class="border-r">
                                    
                                    94
                                </td>
                                <td class="border-r">
                                    768
                                </td>
                                <td>
                                    768
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    AUG
                                </td>
                                <td class="border-r">
                                    
                                    196
                                </td>
                                <td class="border-r">
                                    1774
                                </td>
                                <td>
                                    1774
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    SEP
                                </td>
                                <td class="border-r">
                                    
                                    194
                                </td>
                                <td class="border-r">
                                    1754
                                </td>
                                <td>
                                    1754
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    OCT
                                </td>
                                <td class="border-r">
                                    
                                    196
                                </td>
                                <td class="border-r">
                                    1973
                                </td>
                                <td>
                                    1973
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    NOV
                                </td>
                                <td class="border-r">
                                    
                                    895
                                </td>
                                <td class="border-r">
                                    22074
                                </td>
                                <td>
                                    11000
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    DEC
                                </td>
                                <td class="border-r">
                                    
                                    99
                                </td>
                                <td class="border-r">
                                    13382
                                </td>
                                <td>
                                    5000
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    JAN20
                                </td>
                                <td class="border-r">
                                    
                                    145
                                </td>
                                <td class="border-r">
                                    5746
                                </td>
                                <td>
                                    5746
                                </td>
                            </tr>
                        </table>
                    </td> -->
                </tr>
            </table>
            <div class="border-t" style="width: 0pt; height: 0pt">
                <!-- <table class="nested7" style="width: 454pt; height: 411pt; float: left">
                    <tr class="fontsize" style="height: 28px; width: 100%">
                        <td colspan="2" class="border-rb" style="text-align: center; font-size: 16px; background-color: #B2E6FF">
                            <b>
                                PESCO
                            CHARGES
                            </b>
                        </td>
                        <td colspan="2" class="border-rb" style="text-align: center; font-size: 16px; background-color: #FFB2B2;">
                            <b>GOVT CHARGES</b>
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            <b>UNITS CONSUMED</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            155
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>ELECTRICITY DUTY</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            15.38
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            <b>COST OF ELECTRICITY</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            1025.05
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>TV FEE</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            35
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            <b>METER RENT</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            7.50
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>GST</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            189
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            <b>SERVICE RENT</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>INCOME TAX</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF;">
                            <b>FUEL PRICE ADJUSTMENT</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>EXTRA TAX</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF;">
                            
                                <b> F.C SURCHARGE </b>
                            
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            66.65 <br /> 
                                
                            
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>FURTHER TAX</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                            <br />
                            
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF;">
                            
                                <b> T.R SURCHARGE  </b>
                            
                        </td>
                        <td class="border-rb nestedtdwidth content">
                             <br /> 
                                
                            
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>N.J SURCHARGE</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            15.50
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF;">
                            
                        </td>
                        <td  class="border-rb nestedtdwidth">
                            
                        </td>

                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">
                            <b>R-STAX</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                       
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            <b>TOTAL</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            1099.20
                        </td>                     
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2">
                            
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">
                            
                        </td>
                        <td class="border-rb nestedtdwidth content">
                           
                        </td>
                        <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2">
                            
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                           
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-r" colspan="2">
                            <h3>BILL CALCULATION</h3>
                        </td>
                        <td class="border-rb" style="background-color: #FFB2B2;" rowspan="3">
                              
                                <b>GST ON FPA </b> <br />
                                <b>ED ON FPA </b> <br />
                                <b>FURTHER TAX ON FPA</b> <br />
                                <b>S.TAX ON FPA</b> <br />
                                <b>IT ON FPA </b> <br />
                                <b>ET ON FPA</b> <br />
                                <span>&ensp;-----------------------------&ensp;</span> <br />
                                <b>TOTAL TAXES ON FPA</b>
                            
                        </td>
                        <td class="border-rb content" rowspan="3">
                               <br />
                                    <br />`
                                   <br />
                                   <br />
                                   <br />
                                  <br />
                                <span>&ensp;-----------------------------&ensp;</span> <br />
                                0
                            
                        </td>
                    </tr>
                    <tr class="border-b fontsize" style="height: 24px;">
                        <td class="border-rb" colspan="2" rowspan="3">
                            <table style="width: 100%">
                                <tr>
                                    <td colspan="1"> <b>GOP</b> </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tariff
                                    </td>
                                    <td>
                                    </td>
                                    <td>Units
                                    </td>
                                </tr>
                                <tr class="content">
                                    <td>
                                        05.7900   
                                    </td>
                                    <td>X
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr class="content">
                                    <td>
                                        08.1100   
                                    </td>
                                    <td>X
                                    </td>
                                    <td>
                                        55
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb" style="background-color: #FFB2B2;">
                            
                        </td>
                        <td class="border-rb content">
                            
                        </td>
                    </tr>
                    <tr style="height: 32px;" class="fontsize">
                        <td class="border-rb" rowspan="2" colspan="1">
                            
                        </td>
                        <td class="border-rb" rowspan="2" colspan="1">
                            
                        </td>
                        <td class="border-rb" style="background-color: #FFB2B2;">
                            <b>TOTAL</b>
                           
                        </td>
                        <td class="border-rb content" style="text-align: center">
                            254.88
                            
                        </td>
                    </tr>
                    <tr style="height: 32px;" class="fontsize">
                        <td class="border-rb" style="background-color: yellow;">
                            <b>DEFFERRED AMOUNT</b>
                           
                        </td>
                        <td class="border-rb content" style="text-align: center">
                            
                            
                        </td>
                    </tr>
                    <tr style="height: 32px;" class="fontsize">
                        <td class="border-rb content" colspan="2">
                            
                        </td>
                        <td class="border-rb" style="background-color: yellow;">
                            <b>OUTSTANDING AMOUNT</b>
                            
                        </td>
                        <td class="border-rb content" style="text-align: center">
                            
                            
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb" style="background-color: #efeff5;">
                            <b>PROG. GST PAID F-Y</b>
                        </td>
                        <td class="border-rb content">
                            
                        </td>
                        <td class="border-rb" style="background-color: #efeff5;">
                            <b>PROG. IT PAID F-Y</b>
                        </td>
                        <td class="border-rb content">
                            
                        </td>
                    </tr>
                </table>
                <table class="nested7" style="width: 296pt; height: 411pt">
                    <tr class="fontsize" style="height: 28px; background-color: #7ADEFF; text-align: center">
                        <td colspan="2" class="border-b" style="font-size: 16px">
                            <b>TOTAL CHARGES</b>
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <b>ARREAR/AGE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <b>CURRENT BILL</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            1354
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <b>BILL ADJUSTMENT
                            </b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <b>INSTALLEMENT
                            </b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 25px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <div id="bodyPmReleifMsg">
                                <b> </b>
                            </div>
                        </td>
                        <td class="border-b nestedtd2width content">
                            0
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            
                            
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="color: Red; background-color: #7ADEFF">
                            <b>PAYABLE WITHIN DUE DATE</b>
                        </td>
                        <td class="border-b nestedtd2width content">
                            1354
                            <br/> 
                            <span> </span>
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                            <b>L.P.SURCHARGE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            111
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width" style="color: Red; background-color: #7ADEFF">
                            <b>PAYABLE AFTER DUE DATE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            1465
                            <br/> 
                            <span> </span>
                        </td>
                    </tr>
                    
                    <tr class="fontsize border-b" style="height: 145px;">
                        <td colspan="2">
                            <table style="width: 100%">
                                <tr>
                                    <td id="idmtr1img" style="height: 142px;">
                                        
                                        <img id="mtr1img" src="../../../210.56.17.106/26000/26400/26420/202002-13/202002132642401001901E.html" style="height:100%;width:95%;" />
                                    </td>

                                    
                                    
                                    
                                </tr>
                            </table>
                        </td>

                    </tr>
                    
                    <tr id="idComplaint" class="fontsize border-b" style="border: none; height: 18px;">
	<td colspan="1">
                            <b>FOR COMPLAINT CONTACT</b>
                        </td>
</tr>

                    <tr class="fontsize border-b" style="height: 44px;">
                        

                        <td id="idSubDivWisePhoneNo" colspan="1" style="text-align: center" class="border-b">

                            
                                <b>SDO</b> 
                                655925 / 3459-366356

                            
                                <br /> <b>XEN</b> 
                                9310081 / 
                            
                            </td>

                        <td id="id_SE_XEN_LS_ContactNo" colspan="1" style="text-align: center" class="border-b">
                            
                            </td>

                        
                        
                        
                        
                        

                        
                        <td colspan="1" style="text-align: center" class="border-b">
                            
                        </td>
                        
                    </tr>
                </table> -->
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
                                <h4>CONNECTION</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 25%; color: #78578e;">
                                <h4>REFERENCE NO</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; color: red">
                                <h4>CURRENT BILL</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; color: red">
                                <h4>GST</h4>
                            </td>
                           
                            

                            <td class="border-rb border-t" style="width: 15%; color: red">
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
                                  <?php echo  round($Tarrif * $UnitConsumed); ?>
                                <br/> 
                                <span> </span>
                            </td>

                           <td class="border-rb border-r content" style="width: 15%;">
                                <?php  echo round($gstamount) ?>
                            </td>
                                                         <td class="border-rb border-r content" style="width: 15%;">
                                <?php  echo round($totalBill) ?>
                                
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

<!-- Mirrored from 210.56.23.106:888/pescobill/general/13264240100190 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Mar 2020 08:57:24 GMT -->
</html>
<?php  $conn=NULL ;?>