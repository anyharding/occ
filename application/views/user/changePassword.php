<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.pstrength-min.1.2.js"></script>
<script type="text/javascript">
$(function() {
$('.password').pstrength();
});
</script>
<style>
.password {
  background: none repeat scroll 0 0 transparent;
    border: medium none;
    font-size: 12px;
    height: 23px;
    margin: 0;
    padding-left: 3px;
    padding-top: 5px;
    width: 205px;
}
.pstrength-minchar {
font-size : 10px;
}
</style>
<article id="content"><!-- Page Content -->

		<section class="content_2">
    <section class="top_login_text_head">
<div class="ribbon_2">
<p class="ribbon">
    <strong class="ribbon-content">Change Password</strong>
</p>
</div>


</section>    
<section class="page-container">

<?php $this->load->view('user/sideBarLeft'); ?>

<section class="contentCol">
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
      
                     
  <div class="login_btm">
 			<div class="contact-container">
            <?php echo form_open('welcome/changePassword'); ?>
   
               <div class="left-name2" style="text-align: left;width:700px;"> <span class="red-mark">*</span> Please note that all fields that have an asterisk (*) are required.</div>
              
              <div class="cntct_mdl">
                <div class="left-name">Old Password <span class="red-mark">*</span> </div>
                 <div class="text_field_bg right-inputs_2">
                      <?php echo form_password(array('id'=>'opassword', 'class'=>'textfield_input', 'name'=>'opassword','value' => set_value("opassword"))); ?>
                </div>
               
              </div>
              <div class="cntct_mdl">
                <div class="left-name">New Password <span class="red-mark">*</span></div>
                 <div class="text_field_bg">
                  <?php echo form_password(array('id'=>'password', 'class'=>'textfield_input password', 'name'=>'password', 'value' => set_value("password"))); ?>
                </div>
              </div>
               <div class="cntct_mdl">
                <div class="left-name">Confirm Password<span class="red-mark">*</span></div>
                <div class="text_field_bg right-inputs_2">
                  <?php echo form_password(array('id'=>'cpassword', 'class'=>'textfield_input', 'name'=>'cpassword', 'value' => set_value("cpassword"))); ?>
                </div>
              </div>
            
            
              
              
              <div class="cntct_mdl">
                <div class="left-name">&nbsp;</div>
                <div class="right-inputs">
                  <input type="submit" name="submit" value="Update" class="update_btn" >
                 
                </div>
              </div>
         <?php echo form_close(); ?>
          </div>
 
 </div>
 


    </section>

</section>





</section>
</article>


