<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH;?>js/jquery-ui-sliderAccess.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.21/themes/ui-lightness/jquery-ui.css" />
<script>
$(function() {
    $('#time').datetimepicker({
        ampm: true,
        hourMin: 7,
        hourMax: 32
    });            
});
</script>

<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Add New Household</td>
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
                        <th>Add New Household</th>
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
                             echo form_open_multipart('admin/household/addHousehold', array('name'=>'myform'));?>
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                <td width="200">Select Household Category <span class="required">*</span>:</td>
                                <td><?php
                                        echo form_dropdown('category', $category, $this->input->post('category'));
                                     ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Short description of household item:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'des',
                                            'value'       => set_value("des")
                                        );
                                        echo form_textarea($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td width="200">Suppliers Contact Number <span class="required">*</span>:</td>
                                <td><?php
                                        $data = array(
                                            'name'        => 'contact',
                                            'value'       => set_value("contact")
                                        );
                                        echo form_input($data); 
                                        ?></td>
                              </tr>
                              <tr>
                                <td>Purchased Date: <font color="red">*</font></td>
                                <td><?php  $data = array('name'=> 'time', 'id'=> 'time','value'       => set_value("time")); echo form_input($data); ?></td>
                               </tr>
                              <tr>
                                <td width="200"> Supplier Name :</td>
                                <td>
                                    <?php  $data = array('name'=> 'shop', 'id'=> 'shop','value'       => $this->input->post('shop')); echo form_input($data); ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200">Receipt Number  :<span class="required">*</span></td>
                                <td><?php  $data = array('name'=> 'receipt', 'id'=> 'receipt','value'       => set_value("receipt")); echo form_input($data); ?></td> </tr>
                              
                              <tr>
                                <td width="200">Select House :<span class="required">*</span></td>
                                <td><?php $get_houses[''] = "Select house"; echo form_dropdown('house', $get_houses, $this->input->post('house'), "id = 'house'"); ?> </td>
                              </tr>  
                              
                              <tr>
                                <td></td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>"> &nbsp;
                                    <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH.'img/reset.png';?>" width="108" height="39">
                                
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
