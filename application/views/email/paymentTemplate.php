<div style="margin:0 5px;padding:5px;background: none; clear: both; width:740px; margin:0 auto;">
    <div style="clear: both; padding-top:40px;">
    <div class="side1-tl" style="background: url(<?php echo HTTP_PATH; ?>/img/mail-box-tl.jpg) no-repeat top left;">
      <div class="side1-tr" style="background:url(<?php echo HTTP_PATH; ?>/img/mail-box-tr.jpg) no-repeat right top;">
        <div class="side1-tm" style="margin:0 19px;height:19px;background:url(<?php echo HTTP_PATH; ?>/img/mail-box-tm.jpg) repeat-x left top">
        </div>
      </div>
    </div>
    <div class="side1-cl" style="background:url(<?php echo HTTP_PATH; ?>/img/mail-box-ml.jpg) repeat-y left top">
      <div class="side1-cr" style="background:url(<?php echo HTTP_PATH; ?>/img/mail-box-mr.jpg) repeat-y right top;">
            <div class="block2-inner" style="margin:0 19px;padding:25px 5px 5px;background:#fff; clear:both;">
             <div style="position:relative;">
                  <div class="logo" style="padding: 0 0 0 20px;">
                      <img alt="<?php echo SITE_TITLE; ?>" src="<?php echo HTTP_PATH; ?>/img/logo.jpg"/>	
                  </div>
              </div>
             <div style="margin:0 auto; width:100%; padding:10px;">
              <h1 style="color:#4D4D4D; padding:0 0 0 20px; font:normal 30px Arial, Helvetica, sans-serif;">Welcome To <?php echo SITE_TITLE; ?></h1>
              <div style="padding:0 20px;  ">
                    <h2 style="color:#6dad3b; font-weight:26px; font:bold 23px Arial, Helvetica, sans-serif;">Dear <?php echo $firstname;?> </h2>
                     <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                             <?php echo $text; ?>.
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Worksite:</b> <?php echo $data['worksite']; ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Hourly Rate:</b> <?php echo "$".$data['hourly_rate']; ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Hours Worked:</b> <?php echo $data['hours']."Hours"; ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Gross Wage Amount :</b> <?php echo "$".$data['gross_amount']; ?>
                    </p>
                    
                    
                    
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtime1:</b>  <?php if($data['overtime1'] == NUll){echo "N/A";} else { echo $data['overtime1']."Hours"; } ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtimeh1:</b>  <?php if($data['overtimeh1'] == NUll){echo "N/A";} else { echo $data['overtimeh1']."Hours"; } ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtime2:</b>  <?php if($data['overtime2'] == NUll){echo "N/A";} else { echo $data['overtime2']."Hours"; } ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtimeh2:</b>  <?php if($data['overtimeh2'] == NUll){echo "N/A";} else { echo $data['overtimeh2']."Hours"; } ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtime3:</b>  <?php if($data['overtime3'] == NUll){echo "N/A";} else { echo $data['overtime3']."Hours"; } ?> 
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Overtimeh3:</b>  <?php if($data['overtimeh3'] == NUll){echo "N/A";} else { echo $data['overtimeh3']."Hours"; } ?> 
                    </p>
                    
                    
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Net Payment Amount :</b>  <?php if($data['net_payment'] == NUll){echo "N/A";} else {  echo "$".$data['net_payment'];} ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Rent Deduction:</b>  <?php  if($data['rent_deduction'] == NUll){echo "N/A";} else {  echo "$".$data['rent_deduction'];} ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Transport Deduction:</b>   <?php if($data['transport_deduction'] == NUll){echo "N/A";} else {  echo "$".$data['transport_deduction']; }?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Other Deductions:</b> <?php if($data['other_deduction'] == NUll){echo "N/A";} else {   echo "$".$data['other_deduction'];} ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Total Payment Amount :</b> <?php if($data['total_payment_amount'] == NUll){echo "N/A";} else {    echo "$".$data['total_payment_amount'];} ?>
                    </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">
                        <b>Other Payments :</b> <?php if($data['other_payments'] == NUll){echo "N/A";} else {    echo "$".$data['other_payments'];} ?>
                    </p>
                   
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">If you still require assistance, please submit an enquiry and the <?php echo SITE_TITLE; ?> team will be in touch with you soon. </p>
                    <p style="color:#4D4D4D; font:normal 13px Arial, Helvetica, sans-serif;">Thanks,<br />
                       The <?php echo SITE_TITLE; ?> Team</p>
              </div>
              <div style="float:left; width:220px; height:100px; margin:25px 10px 0 32px;">
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side1-bl" style="background:url(<?php echo HTTP_PATH; ?>/img/mail-box-bl.jpg) no-repeat left bottom;">
        <div class="side1-br" style="background:url(<?php echo HTTP_PATH; ?>/img/mail-box-br.jpg) no-repeat right bottom;">
          <div class="side1-bm" style="margin:0 19px;height:19px;background:url(<?php echo HTTP_PATH; ?>/img/mail-box-bm.jpg) repeat-x left bottom;"></div>
        </div>
    </div>
    </div>
</div>
<div style="margin-bottom: 50px;"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></div>
<?php //exit;?>