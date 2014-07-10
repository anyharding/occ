<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
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
          <p class="ribbon"> <strong class="ribbon-content">Reset Password</strong> </p>
        </div>
      </section>
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
      <section class="page-container">
    <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name2"> <span class="required">*</span> is Required Field.</div>
                       
        <div class="form_contant_box">
          <?php echo form_open('welcome/resetPassword/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>
            <div style="display: block;">
              
              <div class="user_name_box">
                <div class="field_name">Password <span class="required">*</span></div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                                    'name'        => 'password',
                            'class'     => 'textfield_input password'
                                );
                    echo form_password($data); 
                    ?>
                </div>
              </div>
              <div class="user_name_box">
                <div class="field_name">Confirm Password <span class="required">*</span></div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                                    
                            'class'     => 'textfield_input','name'        => 'cpassword'
                                );
                    echo form_password($data);
                    ?>
                </div>
              </div>
              
            <div  class="user_name_2">
              <div class="login_button_2">
                <input name="Submit" value="Submit" type="submit" class="input_submit" />
                <input name="Reset" value="Reset" type="reset"  class="input_submit" />
              </div>
            </div>
          <?php echo form_close() ?>
        </div>
      </section>
    </section>
  </article>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
        
}
</script>