    <article id="content"><!-- Page Content -->
 
		<section class="content_2">
    <section class="top_login_text_head">
<div class="ribbon_2">
<p class="ribbon">
    <strong class="ribbon-content">My Account</strong>
</p>
</div>


</section>    
<section class="page-container">

<?php $this->load->view('user/sideBarLeft.php'); ?>

<section class="contentCol">
   <h2 class="my_profile">My Profile</h2>
          
    <div class="login_btm">  
                     
  <div class="usr_img_dtl_top">
  
  <div class="profile">
  
  
   <div class="usr_img_dt2"> 	Account Summary </div>
 <?php
			    if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
					  <div class='ActionMsgBox error' id='msgID'>
					  	<?php
					  		echo validation_errors();
					  		echo $this->session->userdata('message');
					  		echo $this->session->flashdata('message');
					  		$this->session->unset_userdata('message');
					  	?>
					  </div>
			  <?php } ?>
                                <?php
                            if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
                            <div class='ActionMsgBox success' id='msgID'>
                                <?php
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                    ?>
                            </div>
                            <?php } ?>
  <div class="usr_img_dtl">
 	<div class="left"><div class="usr_img_dtl_lft2">Display Name:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['lastname'].', '.$user_detail['firstname'];?> </div></div>
    <div class="left"><div class="usr_img_dtl_lft2">Email:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['email'];?></div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Contact No:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['contact_no'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Gender:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['gender'] == 'F'){  echo 'Female';}else {echo 'Male';  }?> </div></div>
    <div class="left"><div class="usr_img_dtl_lft2">DOB:</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['dob']));?> </div></div>
    <div class="left"><div class="usr_img_dtl_lft2">Nationality:</div>
    <div class="usr_img_dtl_right"><?php echo $countries[$user_detail['country_id']];?> </div></div>
    <?php if($user_detail['role'] == 3) {?>
    
    <div class="left"><div class="usr_img_dtl_lft2">Height:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['height'];?> CM</div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Weight:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['weight'];?> KG </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Tax Type :</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['taxtype'] == '2'){  echo 'ABN';}else {echo 'TFN'; };?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Tax Number:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['tax_number'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">ABN number:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['abnnumber'];?> </div></div>
    
    
    <div class="left"><div class="usr_img_dtl_lft2">Vaccination status:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['statusvaccination'] == '2'){  echo 'No';}else { echo 'Yes'; }?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Shift Type:</div>
    <div class="usr_img_dtl_right"><?php $options = array('0'=>'N/A','1' => 'Morning','2' => 'Afternoon','3' => 'Night'); echo $options[$user_detail['shifttype']];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Position:</div>
    <div class="usr_img_dtl_right"><?php $options = array('1' => 'General hand','2' => 'Slicer','3' => 'Boner','4' => 'Packer','5' => 'Floor boy','6' => 'Maintenance','7' => 'Cleaning','8' => 'Loading'); echo $options[$user_detail['position']];?> </div></div>
    
    
    <div class="left"><div class="usr_img_dtl_lft2">Passport number:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['passport_number'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Visa Type :</div>
    <div class="usr_img_dtl_right"><?php  $visaoptions = array('0'=>'','1' => 'Working holiday','2' => 'Dependant 457 visa full work rights','3' => 'PR/citizen','4' => 'Bridging visa full work rights','5' => 'Other visa','6' => 'Limited work rights'); echo $visaoptions[$user_detail['visa_type']];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">First visa start date:</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['firstvisastart']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">First visa end date:</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['firstvisaend']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Second visa start date:</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['secondvisastart']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Second visa end date :</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['secondvisaend']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Has ABN:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['statusofabn'] == '2'){  echo 'Yes';}else {echo 'No';}?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Account Name:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['nameofbank'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Account Number:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['numberofbank'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">BSB:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['branchofbank'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Start employment date:</div>
    <div class="usr_img_dtl_right"><?php echo date('d M Y ',strtotime($user_detail['employmentdate']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Hourly rate description:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['hourlyrate_des'];?> </div></div>
    <div class="left"><div class="usr_img_dtl_lft2">Hourly rate ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['hourlyrate'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Total One Off Deductions ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['deductions'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Reasons for Deductions:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['reason_deductions'];?> </div></div>
    
    
    <div class="left"><div class="usr_img_dtl_lft2">Weekly rent rate ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['weeklyrent'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Bond Payed:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['statusofbond'] == '2'){  echo 'No';}else{echo 'Yes';}?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Amount of bond payment ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['bondamount'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Status of issued equipment:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['statusofissued'] == '2'){  echo 'No';}else {echo 'Yes';  }?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment name 1:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name1'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment value 1 ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value1'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Paid for by 1:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['paidforby1'] == '2'){ echo 'Contractor';}else {echo 'Company';}?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment name 2:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name2'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment value 2 ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value2'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Paid for by 2 :</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['paidforby2'] == '2'){ echo 'Contractor';}else {echo 'Company';}?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment name 3:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name3'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Equipment value 3 ($):</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value3'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Paid for by 3:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['paidforby3'] == '2'){ echo 'Contractor';}else {echo 'Company';}?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Possible Future employment:</div>
    <div class="usr_img_dtl_right"><?php  if($user_detail['future_employment'] == '2'){  echo 'Yes';}else {echo "No";  };?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Currently Employed:</div>
    <div class="usr_img_dtl_right"><?php  if($user_detail['employee_employed'] == '2'){ echo 'Yes';}else {echo 'No'; }?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Description of final position :</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['final_position'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Resignation Approved By:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['regignation_approve_by'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Resignation reason:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['reason'];?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Left Australia:</div>
    <div class="usr_img_dtl_right"><?php  if($user_detail['left_australia'] == '2'){ echo 'Yes';}else {echo 'No';  }?> </div></div>
    
    <?php }?>
 </div>
 </div>
      
      
 
    </div>
 
</div>

    </section>

</section>





</section>
</article>



