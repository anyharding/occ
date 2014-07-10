    <article id="content"><!-- Page Content -->
 
		<section class="content_2">
    <section class="top_login_text_head">
<div class="ribbon_2">
<p class="ribbon">
    <strong class="ribbon-content">HR Profile</strong>
</p>
</div>


</section>    
<section class="page-container">

<?php $this->load->view('user/sideBarLeft.php'); ?>

<section class="contentCol">
   <h2 class="my_profile">HR Profile</h2>
          
    <div class="login_btm">  
                     
  <div class="usr_img_dtl_top">
  
  <div class="profile">
  
  
   <div class="usr_img_dt2"> HR	Account Detail </div>
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
    
    
 </div>
 </div>
      
      
 
    </div>
 
</div>

    </section>

</section>





</section>
</article>



