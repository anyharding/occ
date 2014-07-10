<article id="content"><!-- Page Content -->
<section class="content">
<div class="content_bg">
     <?php
if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
  <div class='ActionfrontMsgBox' id='msgID'>
      <div class='error'>
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
      <div class='success'>
    <?php
                echo $this->session->userdata('smessage');
                echo $this->session->flashdata('smessage');
                $this->session->unset_userdata('smessage');
        ?>
      </div>
  </div>
  <?php } ?>
<div class=" login_box">
<div class="top_login_text_img"><img src="<?php echo HTTP_PATH;?>img/employee-login_text.png" alt="" /></div>
<?php echo form_open('welcome/login');?>
<div class="user_name">
<label>User Name</label>
<div class="black_textfield_bg">
    <?php echo form_input(array('id'=>'f_name', 'name'=>'username', 'onfocus'=>"if(this.value=='Username') this.value='';", 'onblur'=>"if(this.value=='') this.value='Username';", 'value'=>"Username")); ?>
</div>
</div>
<div  class="password_text user_name">
<label>Password</label>
<div class="black_textfield_bg">
    <?php echo form_password(array('id'=>'f_password', 'name'=>'password','onfocus'=>"if(this.value=='Password') this.value='';", 'onblur'=>"if(this.value=='') this.value='Password';", 'value'=>"Password")); ?>
</div>
</div>
<div  class="password_text user_name">
<label></label>
<div class="login_button">
    <?php
    $data = array(
    'name'    => 'login',    // button name
    'content' => 'Login',    // this is the button text
    'type'    => 'submit',  // button type (important!)
    'class'   => 'input_text'
);
    echo form_submit($data)?>   
<span><a href="#">Forgot Password?</a></span>
</div>
<strong class="register_here"><a href="#">Register here</a></strong>
</div>
<?php echo form_close();?>
</div>
</div>
</section>
</article>