<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    //http://en.wikipedia.org/wiki/Lists_of_people_by_nationality
    $(document).ready(function(){
        $('#country').change(function(e) {
            $('#example').fadeIn();
            $('#state').load('<?php echo HTTP_PATH; ?>admin/powerusers/getstate/'+this.value);
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
            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Update Power User Detail</td>
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
                                <th>Personal Details</th>
                            </tr>
                            <tr><td colspan="2">

                                    <?php if (validation_errors() || $this->session->userdata('message')) { ?>
                                        <div class='ActionMsgBox error' id='msgID'>
                                            <?php
                                            echo validation_errors();
                                            echo $this->session->userdata('message');
                                            $this->session->unset_userdata('message');
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
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
                                    <?php echo form_open_multipart('/admin/powerusers/editPoweruser/' . $this->uri->segment(4)); ?>
                                    <table width="60%" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                            <td width="200">First Name <span class="required">*</span>:</td>
                                            <td><?php echo form_input(array('name' => 'firstname', 'id' => 'firstname', 'value' => ($this->input->post('firstname') ? $this->input->post('firstname') : $poweruser_detail[0]['firstname']))) ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Last Name <span class="required">*</span>:</td>
                                            <td><?php echo form_input(array('name' => 'lastname', 'id' => 'lastname', 'value' => ($this->input->post('lastname') ? $this->input->post('lastname') : $poweruser_detail[0]['lastname']))) ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Email Address <span class="required">*</span>:</td>
                                            <td><?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => ($this->input->post('email') ? $this->input->post('email') : $poweruser_detail[0]['email']))) ?></td>
                                        </tr>

                                        <tr>
                                            <td width="200">Username <span class="required">*</span>:</td>
                                            <td><?php
                                    $data = array('name' => 'username', 'value' => ($this->input->post('username') ? $this->input->post('username') : $poweruser_detail[0]['username']));
                                    echo form_input($data);
                                    ?></td>
                                        </tr> 
                                        <tr>
                                            <td width="200">Password <span class="required">*</span>:</td>
                                            <td><?php
                                                $data = array('name' => 'password', 'value' => $poweruser_detail[0]['password']);
                                                echo form_input($data);
                                    ?></td>
                                        </tr>                          

                                        <tr>
                                            <td width="200">Contact Number :</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'contact',
                                                    'value' => ($this->input->post('contact_no') ? $this->input->post('contact_no') : $poweruser_detail[0]['contact_no'])
                                                );
                                                echo form_input($data);
                                    ?></td>
                                        </tr>


                                        <!--tr>
                                          <td width="200">Image : </td>
                                          <td> <?php
                                                /* $data = array(
                                                  'name'        => 'image'
                                                  );
                                                  echo form_upload($data); */
                                    ?><br>Supported File Types: gif, jpg, png (Max. 200KB)<br>
                                        <?php //if($poweruser_detail[0]['image'] <> NULL || $poweruser_detail[0]['image'] <> '') {    ?><img width="140" height="140" src="<?php //if($poweruser_detail[0]['image'] == $poweruser_detail[0]['facebook_id'])echo "https://graph.facebook.com/".$poweruser_detail[0]['facebook_id']."/picture?type=large "; else echo HTTP_PATH.'poweruser_images/'.$poweruser_detail[0]['image']    ?>" /> <?php //}   ?>
                                          
                                          </td>
                                        </tr-->
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="image" src="<?php echo HTTP_PATH . 'img/submitBtn.png'; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                    <?php echo form_close(); ?>
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
