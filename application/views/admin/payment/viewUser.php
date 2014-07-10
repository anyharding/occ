<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="32">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > User Visa Expiration details</td>
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
                        <th> User Visa Expiration details</th>
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
                            <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                              
                              <tr>
                                <td width="200"><b>Employee Id</b> <span class="required"></span>:</td>
                                <td>
                                   <?php
                                        echo $user_detail['id'];
                                    ?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Employee Name </b><span class="required"></span>:</td>
                                <td>
                                   <?php
                                        echo $user_detail['lastname'].', '.$user_detail['firstname'];
                                    ?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Address</b><span class="required"></span>:</td>
                                <td><?php $houses[0] = 'N/A'; echo $houses[$user_detail['house_id']];?></td>
                              </tr>
                              <tr>
                                <td width="200"><b>Age</b> <span class="required"></span>:</td>
                                <td>
                                    <?php
                                    if($user_detail['dob'] <> '0000-00-00' and $user_detail['dob'] <> '') {
                                        $dob = strtotime($user_detail['dob']);
                                        $y = date('Y', $dob);

                                        if (($m = (date('m') - date('m', $dob))) < 0) {
                                            $y++;
                                        } elseif ($m == 0 && date('d') - date('d', $dob) < 0) {
                                            $y++;
                                        }
                                        echo date('Y') - $y;
                                        echo " Years";
                                    }
                                    else {
                                        echo "N/A";
                                    }
                                    ?> 
                                </td>
                              </tr>
                              
                              <tr>
                                <td width="200"><b>Sex</b> <span class="required"></span>:</td>
                                <td>
                                    <?php if($user_detail['gender'] == 'F'){  echo 'Female';}else {echo 'Male';  }?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Height</b> :</td>
                                <td><?php echo $user_detail['height'];?> CM
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Worksite </b>:</td>
                                <td><?php $worksites[0] = 'N/A';  echo $worksites[$user_detail['worksite_id']];?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Position </b>:</td>
                                <td><?php $options = array('0'=>'N/A','1' => 'General hand','2' => 'Slicer','3' => 'Boner','4' => 'Packer','5' => 'Floor boy','6' => 'Maintenance','7' => 'Cleaning','8' => 'Loading'); echo $options[$user_detail['position']];?> 
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Visa type </b>:</td>
                                <td><?php  $visaoptions = array('0'=>'N/A','1' => 'Working holiday','2' => 'Dependant 457 visa full work rights','3' => 'PR/citizen','4' => 'Bridging visa full work rights','5' => 'Other visa','6' => 'Limited work rights'); echo $visaoptions[$user_detail['visa_type']];?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Visa expiry date </b>:</td>
                                <td><?php if($user_detail['visa_expiry_date'] <> '')  echo date('d M Y ',strtotime($user_detail['visa_expiry_date']));?>
                                </td>
                              </tr>
                              <tr>
                                <td width="200"><b>Contact Number</b> :</td>
                                <td><?php echo $user_detail['contact_no'];?>
                                </td>
                              </tr>
                              
                              
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>
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
