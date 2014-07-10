<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
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
<script>
 //http://en.wikipedia.org/wiki/Lists_of_people_by_nationality
$(document).ready(function(){
    $('#country').change(function(e) {
        $('#example').fadeIn();
        $('#state').load('<?php echo HTTP_PATH;?>admin/powerusers/getstate/'+this.value);
        $('#example').fadeOut();
    });   
});
	$(function() {
		$( "#dob" ).datepicker({
                    maxDate:new Date(), yearRange: 'c-30:c+10',
			changeMonth: true,
                        dateFormat: 'yy-mm-dd',
			changeYear: true
		});             
	});
        function popitup() {
	window.open ("<?php echo HTTP_PATH.'welcome/termAndConditions' ?>", "mywindow","location=1,status=1,scrollbars=1, width=1000,height=500");

}
</script>  
<article id="content"><!-- Page Content -->
    
    <section class="content_2">
        
      <section class="top_login_text_head">
        <div class="ribbon_2">
          <p class="ribbon"> <strong class="ribbon-content">Power User Registration</strong> </p>
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
      <section class="Registration_box">
    <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name2"> <span class="required">*</span> is Required Field.</div>
                        
        <div class="form_contant_box">
          <?php echo form_open('welcome/puRegistration'); ?>
            <div style="display: block;">
              <div class="user_name_box">
                <div class="field_name">First Name <span class="required">*</span></div>
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
              <div class="user_name_box">
                <div class="field_name">Last Name <span class="required">*</span></div>
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
              <div class="user_name_box">
                <div class="field_name">Email <span class="required">*</span></div>
                <div class="text_field_bg">
                  <?php  $data = array('name'=> 'email',
                            'class'     => 'textfield_input','value'       => set_value("email")); echo form_input($data); ?>
                </div>
              </div>
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
              <div class="user_name_box">
                <div class="field_name">Gender</div>
                <div class="text_field_bg3">
                 <?php
                $array = array('selected'=>'selected');
                if($this->input->post('gender') == 'F'){  $male = NULL;$female = true;}else {$male = true;$female = NULL;  }
                echo form_radio('gender', 'M', $male);?><label>Male</label> &nbsp;
                <?php echo form_radio('gender', 'F', $female);?><label>Female</label><?php echo form_error('gender'); ?>
                </div>
              </div>
              
              <div class="user_name_box">
                <div class="field_name">DOB</div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                        'name'        => 'dob', 'readonly'=>"readonly",
                            'class'     => 'textfield_input',
                        'id'        => 'dob',
                        'value'       => $this->input->post('dob')
                    );
                    echo form_input($data);
                   ?>
                </div>
              </div>
              
              <div class="user_name_box">
                <div class="field_name">Contact Number</div>
                <div class="text_field_bg">
                  <?php
                    $data = array(
                        'name'        => 'contact',
                            'class'     => 'textfield_input',
                        'value'       => $this->input->post('contact')
                    );
                    echo form_input($data); ?>
                </div>
              </div>
              <div class="user_name_box">
                <div class="field_name">Nationality <span class="required">*</span></div>
                <div class="text_field_bg">
                  <?php $countries[''] = "Select Nationality"; echo form_dropdown('country_id', $countries, $this->input->post('country_id'), "class = 'select_box'"); ?> 
                </div>
              </div>
              
              <div class="user_name_box">
                <div class="field_name">Left Australia</div>
                <div class="text_field_bg">
                  <?php
                    $array = array('selected'=>'selected');
                    if($this->input->post('left_australia') == '2'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                    echo form_checkbox('left_australia', '2', $no);?><label>yes</label>
                </div>
              </div>
              
              <div class="user_name_box">
                <div class="field_name">Please fill the text below text <span class="required">*</span></div>
                <div class="text_field_bg">
                   <?php
                    $data = array(
                        'name'        => 'capcha',
                        'value'       => $this->input->post('capcha'),
                        'class'       => 'input1 textfield_input'
                    );
                    echo form_input($data); ?><br><br><img src="<?php echo HTTP_PATH;?>img/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' />
                    <br><small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
                </div>
              </div>
                
              <div class="user_name_box">
                <div class="field_name"></div>
                <div class="text_field_bg">
                  <?php
                    $array = array('selected'=>'selected');
                    if($this->input->post('Yes') == 'yes'){  $yes = NULL;$no = true;}else {$yes = true;$no = NULL;  }
                    echo form_checkbox('Yes', 'yes', $no);?>
                  <label>I agree to the <a title="Terms and Conditions" href="#"  onclick="popitup()"
	> Terms and Conditions</a></label>
                </div>
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