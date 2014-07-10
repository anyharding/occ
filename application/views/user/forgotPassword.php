<article id="content"><!-- Page Content -->

		<section class="content">

<div class="content_bg">
       
<div class=" login_box">
<div class="top_login_text_img"><h1>Forgot Password</h1></div>
<?php echo form_open('welcome/forgotPassword');?>
<div class="user_name">
<label>Email Id <span class="required">*</span></label>
<div class="black_textfield_bg"><?php echo form_input(array('id'=>'email', 'name'=>'email', 'class'=>'input1', 'value'=>$this->input->post('email'))); ?></div>


</div>

<div  class="password_text user_name">
<label>&nbsp;</label>
<div class="login_button"><input name="Submit" value="Submit" type="submit" class="input_submit" />
<span><?php echo anchor('welcome', 'Login'); ?></span>
</div>
</div>
<?php form_close();?>
  <?php
if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
  <div class='ActionfrontMsgBox' id='msgID'>
      <div class='error error2'>
    <?php
                echo validation_errors();
                echo $this->session->userdata('message');
                echo $this->session->flashdata('message');
                $this->session->unset_userdata('message'); 
       ?>
          </div>
  </div>
  <?php } ?>
  <?php
if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
  <div class='ActionfrontMsgBox' id='msgID'>
      <div class='success success2'>
    <?php
                echo $this->session->userdata('smessage');
                echo $this->session->flashdata('smessage');
                $this->session->unset_userdata('smessage');
        ?>
      </div>
  </div>
  <?php } ?>
</div>

</div>

</section>
</article>

