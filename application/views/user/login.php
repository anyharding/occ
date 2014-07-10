<script>
$(document).ready(function(){
    $('#check1').click(function(e) {
        window.location = "<?php echo HTTP_PATH;?>welcome/registration/"
    });
});

</script>

<div class="contant2">
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
  <div class="login_box2"> 
  	<div class="fl column1">
	<?php echo form_open('welcome/login');?>
    <div class="login_head_text"><?php echo anchor('/welcome/login', 'Login'); ?> / <?php echo anchor('/welcome/registration', 'Register'); ?></div>
    <div class="login_head_r_btn"><?php echo form_radio(array('name'=>'check', 'value'=>'already', 'id'=>'check', 'checked'=>'checked'));?><span>I already have an account</span> <?php echo form_radio(array('name'=>'check', 'value'=>'newuser', 'id'=>'check1'));?><span>I am a new user</span></div>
    <div class="contact-container">
      <div class="cntct_mdl">
        <div class="left-name">Username : </div>
        <div class="right-inputs"> <?php echo form_input(array('id'=>'f_name', 'name'=>'username', 'value'=>$this->session->userdata("username"), 'class'=>'input1')); ?> </div>
      </div>
      <div class="cntct_mdl">
        <div class="left-name">Password : </div>
        <div class="right-inputs"> <?php echo form_password(array('id'=>'f_password', 'name'=>'password', 'value'=>$this->session->userdata("password"), 'class'=>'input1')); ?> </div>
      </div>
      <div class="cntct_mdl">
        <div class="right-inputs2"> <?php echo form_checkbox(array('name'=>'remember', 'value'=>'remember', 'class'=>'input1'));?><span>Remember me on this computer</span> </div>
      </div>
      <div class="cntct_mdl">
        <div class="right-inputs2">
          <input type="submit" name="login" value="Login" class="btn">
          <span class="forgot_passwprd new_forgot"><?php echo anchor('/welcome/forgotPassword', 'Forgot password ?');?></span> </div>
      </div>
    </div>
    <?php form_close();?>
    </div>
    <div class="fr column2">
    	<p><b>Have a Facebook Account ?</b></p>
         <?php
    //include('application/files/facebook.php');
    
//    $facebook = new Facebook(array(
//                                'appId'=>FACEBOOK_APP_ID,
//                                'secret'=>FACEBOOK_SECRET,
//                                'cookie'=>true
//                                  ));
//
//    $rurl    =   HTTP_PATH."welcome/chklogin";
//    $arrayv =   array("next"=>$rurl);
//    echo "<a href='".$facebook->getLoginUrl($arrayv)."'><img src='".HTTP_PATH."img/fb_signup.jpg' alt='' /></a>";
 ?>
    </div>
  </div>
  <div class="login_box2_bott">
    <?php $this->load->view('user/middleBottomLink');?>
  </div>
</div>
