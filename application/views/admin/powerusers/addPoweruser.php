<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH.'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/datepicker/jquery.ui.datepicker.js"></script>
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
			changeMonth: true,
                        dateFormat: 'yy-mm-dd',
                        yearRange:"-90:+0",
                        maxDate: new Date(1995, 0, 1),
			changeYear: true
		});             
	});
</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New Power User</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <div class="Block table">
                    	<div class="BlockContent">
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                      <tr>
                        <th>Personal Details</th>
                      </tr>
			<tr><td colspan="2" align="center">
			
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
			</td></tr>
					  <tr>
                        <td>
                        <?php
                             echo form_open_multipart('admin/powerusers/addPoweruser', array('name'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="200">First Name <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'firstname',
                                            'value'       => $this->input->post('firstname')
                                        );
                                        echo form_input($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td width="200">Last Name <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'lastname',
                                            'value'       => $this->input->post('lastname')
                                        );
                                        echo form_input($data);
                                       ?></td>
                              </tr>
                              <tr>
                                <td width="200">Email Address <span class="required">*</span>:</td>
                                <td><?php  $data = array('name'=> 'email','value'       => $this->input->post('email')); echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Username <span class="required">*</span>:</td>
                                <td><?php  $data = array('name'=> 'username','value'       => $this->input->post('username')); echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Password <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                                        'name'        => 'password'
                                                    );
                                        echo form_password($data); 
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Confirm Password <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                                        'name'        => 'cpassword'
                                                    );
                                        echo form_password($data);
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Contact Number :</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'contact',
                                            'value'       => $this->input->post('contact')
                                        );
                                        echo form_input($data); ?></td>
                              </tr>
                             
                              <!--tr>
                                <td width="200">Image : </td>
                                <td> <?php
                                      /*  $data = array(
                                                        'name'        => 'image'
                                                    );
                                        echo form_upload($data);*/
                                        ?><br>Supported File Types: gif, jpg, png (Max. 200KB)</td>
                              </tr-->
                              
                              <tr>
                                <td></td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>"> &nbsp;
                                    <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH.'img/reset.png';?>" style=" cursor: pointer;" width="108" height="39">
                                
                                </td>

                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
			<?php echo form_close();?>
                        </td>
                      </tr>                      
                    </table>
                    	</div>
                    </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
