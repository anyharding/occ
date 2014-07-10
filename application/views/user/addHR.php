 <script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script><script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.pstrength-min.1.2.js"></script>
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
<script>
$(function() {
    $("#dob").datepicker({
            changeMonth: true,
            maxDate:new Date(),yearRange: 'c-30:c+10',
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#firstvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#firstvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#secondvisastart" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#secondvisaend" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });
    $( "#employmentdate" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            changeYear: true
    });

});
function showhide()
{            
     if($('input:radio[name=statusofabn]:checked').val()=='1'){
      $("#namebank").show(1000);   
     }
     if($('input:radio[name=statusofabn]:checked').val()=='2'){
      $("#namebank").hide(500);   
     }
} 

function popitup() {
	window.open ("<?php echo HTTP_PATH.'welcome/termAndConditions' ?>", "mywindow","location=1,status=1,scrollbars=1, width=1000,height=500");
}
</script>
<article id="content"><!-- Page Content -->
    
    <section class="content_2">
        
      <section class="top_login_text_head">
        <div class="ribbon_2">
          <p class="ribbon"> <strong class="ribbon-content">Add HR</strong> </p>
        </div>
      </section><?php
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
          
          <?php $this->load->view('user/sideBarLeft.php'); ?>
          <section class="contentCol2">
    <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
        <div class="form_contant_box_nw">
          <?php echo form_open('users/addHRRecr'); ?>
            <div style="display: block;">
              <div class="user_name_box2">
                <div class="field_name">First Name <span class="required1">*</span></div>
                <div class="text_field_bg">
                      <?php
                        $data = array(
                            'name'        => 'firstname',
                            'class'     => 'textfield_input',
                            'value'       => set_value("firstname")
                        );
                        echo form_input($data); 
                        ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Last Name <span class="required1">*</span></div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                        'name'        => 'lastname',
                            'class'     => 'textfield_input',
                        'value'       => set_value("lastname")
                    );
                    echo form_input($data);
                   ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Email Address <span class="required1">*</span></div>
                <div class="text_field_bg">
                  <?php  $data = array('name'=> 'email',
                            'class'     => 'textfield_input','value'       => set_value("email")); echo form_input($data); ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Username <span class="required1">*</span></div>
                <div class="text_field_bg">
                  <?php  $data = array('name'=> 'username',
                            'class'     => 'textfield_input','value'       =>$this->input->post("username")); echo form_input($data); ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Contact Number</div>
                <div class="text_field_bg">
                  <?php  $data = array('name'=> 'contact',
                            'class'     => 'textfield_input','value'       => $this->input->post("contact")); echo form_input($data); ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Password <span class="required1">*</span></div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                                    'name'        => 'password',
                            'class'     => 'textfield_input password',
                            'value'       => $this->input->post("password")
                                );
                    echo form_password($data); 
                    ?>
                </div>
              </div>
              <div class="user_name_box2">
                <div class="field_name">Confirm Password <span class="required1">*</span></div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                                    
                            'class'     => 'textfield_input','name'        => 'cpassword',
                            'value'       => $this->input->post("cpassword")
                                );
                    echo form_password($data);
                    ?>
                </div>
              </div>
                             
            </div>
            <div  class="user_name_3">
              <div class="login_button_2">
                <input name="Submit" value="Submit" type="submit" class="input_submit" />
                
              </div>
            </div>
          <?php echo form_close() ?>
        </div>
      </section>
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