    <article id="content"><!-- Page Content -->
 
		<section class="content_2">
    <section class="top_login_text_head">
<div class="ribbon_2">
<p class="ribbon">
    <strong class="ribbon-content"> User Visa Expiration details</strong>
</p>
</div>


</section>    
<section class="page-container">

<?php $this->load->view('user/sideBarLeft.php'); ?>

<section class="contentCol">
   <h2 class="my_profile"> User Visa Expiration details</h2>
          
    <div class="login_btm">  
                     
  <div class="usr_img_dtl_top">
  
  <div class="profile">
  
  
   <div class="usr_img_dt2">  User Visa Expiration details </div>
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
 	<div class="left"><div class="usr_img_dtl_lft2">Contractor Id:</div>
    <div class="usr_img_dtl_right"><?php
                                        echo $user_detail['id'];
                                    ?> </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Contractor Name:</div>
    <div class="usr_img_dtl_right"><?php
                                        echo $user_detail['lastname'].', '.$user_detail['firstname'];
                                    ?>  </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Address:</div>
    <div class="usr_img_dtl_right"><?php $houses[0] = 'N/A'; echo $houses[$user_detail['house_id']];?> </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Age:</div>
    <div class="usr_img_dtl_right"><?php
                                    if($user_detail['dob'] <> '0000-00-00' and $user_detail['dob'] <> '') {
                                        $dob = strtotime($user_detail['dob']);
                                        $y = date('Y', $dob);

                                        if (($m = (date('m') - date('m', $dob))) < 0) {
                                            $y++;
                                        } elseif ($m == 0 && date('d') - date('d', $dob) < 0) {
                                            $y++;
                                        }
                                        echo date('Y') - $y;
                                        echo " Years";
                                    }
                                    else {
                                        echo "N/A";
                                    }
                                    ?> </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Sex:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['gender'] == 'F'){  echo 'Female';}else {echo 'Male';  }?></div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Height:</div>
    <div class="usr_img_dtl_right"><?php echo $user_detail['height'];?> CM </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Worksite:</div>
    <div class="usr_img_dtl_right"><?php $worksites[0] = 'N/A';  echo $worksites[$user_detail['worksite_id']];?> </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Position:</div>
    <div class="usr_img_dtl_right"><?php $options = array('0'=>'N/A','1' => 'General hand','2' => 'Slicer','3' => 'Boner','4' => 'Packer','5' => 'Floor boy','6' => 'Maintenance','7' => 'Cleaning','8' => 'Loading'); echo $options[$user_detail['position']];?> </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Visa type:</div>
    <div class="usr_img_dtl_right"><?php  $visaoptions = array('0'=>'N/A','1' => 'Working holiday','2' => 'Dependant 457 visa full work rights','3' => 'PR/citizen','4' => 'Bridging visa full work rights','5' => 'Other visa','6' => 'Limited work rights'); echo $visaoptions[$user_detail['visa_type']];?>  </div></div>
 	<div class="left"><div class="usr_img_dtl_lft2">Visa expiry date:</div>
    <div class="usr_img_dtl_right"><?php if($user_detail['visa_expiry_date'] <> '')  echo date('d M Y ',strtotime($user_detail['visa_expiry_date']));?> </div></div>
    
    <div class="left"><div class="usr_img_dtl_lft2">Contact Number:</div>
    <div class="usr_img_dtl_right">
        <?php 
        if($user_detail['contact_no'] <> '') {
            echo $user_detail['contact_no'];
        }
        else {
            echo "N/A";
        }
        ?>
    </div></div>
    
    
    
 </div>
 </div>
      
      
 
    </div>
 
</div>

    </section>

</section>





</section>
</article>



