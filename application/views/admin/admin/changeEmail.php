<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Change Email</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>
                    <div class="Block table">
                    	<div class="BlockContent">
		                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                      <tr>
                        <th>Change Email</th>
                      </tr>
			<tr><td colspan="2">
			
			<?php
			    if(validation_errors()  || $this->session->flashdata('message')){ ?>
					  <div class='ActionMsgBox error' id='msgID'>
					  	<?php
					  		echo validation_errors();
					  		echo $this->session->flashdata('message');
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
                            echo form_open('admin/admin/changeEmail');?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="200">Old Email :</td>
                                <td><?php
								$data = array(
									      'name'        => 'oemail',
									      'value'       => $old_email,
									      'disabled'      => 'disabled'
									    );
								echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">New Email <span class="required">*</span>:</td>
                                <td><?php
								$data = array(
									      'name'        => 'email',
									      'value'       => set_value("email")
									    );
								echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td width="200">Confirm Email <span class="required">*</span>:</td>
                                <td><?php
								$data = array(
									      'name'        => 'cemail',
									      'value'       => set_value("cemail")
									    );
								echo form_input($data); ?></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input type="image" src="<?php echo HTTP_PATH.'img/submitBtn.png';?>">
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
