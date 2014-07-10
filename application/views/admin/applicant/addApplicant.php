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
        $( "#date1" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            changeYear: true
        });
        $( "#date2" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
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
                        <td class="breadcrumb">Administrator > Add New Applicant</td>
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
                                <th>Add New Applicant</th>
                            </tr>
                            <tr><td colspan="2" align="center">

                                    <?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                                        <div class='ActionMsgBox error' id='msgID'>
                                            <?php
                                            echo validation_errors();
                                            echo $this->session->userdata('message');
                                            echo $this->session->flashdata('message');
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
                                    <?php echo form_open_multipart('admin/applicant/addApplicant', array('name' => 'myform')); ?>
                                    <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="200">First Name <span class="required">*</span>:</td>
                                            <td><?php
                                    $data = array(
                                        'name' => 'firstname',
                                        'value' => $this->input->post('firstname')
                                    );
                                    echo form_input($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Last Name <span class="required">*</span>:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'lastname',
                                                    'value' => $this->input->post('lastname')
                                                );
                                                echo form_input($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Mobile No. <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array('name' => 'mobile', 'value' => $this->input->post('mobile'));
                                                echo form_input($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Email Address <span class="required">*</span>:</td>
                                            <td><?php
                                                $data = array('name' => 'email', 'value' => $this->input->post('email'));
                                                echo form_input($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Referrer <span class="required"></span>:</td>
                                            <td><?php echo form_dropdown('referrer', $users, $this->input->post('referrer')); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender: <font color="red"></font></td>
                                            <td><?php
                                                $array = array('selected' => 'selected');
                                                if ($this->input->post('gender') == 'F') {
                                                    $male = NULL;
                                                    $female = true;
                                                } else {
                                                    $male = true;
                                                    $female = NULL;
                                                }
                                                echo form_radio('gender', 'M', $male);
                                    ?>Male &nbsp;
                                                <?php echo form_radio('gender', 'F', $female); ?>Female<?php echo form_error('gender'); ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="200">Height <span class="required"></span>:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'height',
                                                    'value' => $this->input->post('height')
                                                );
                                                echo form_input($data);
                                                ?> cm</td>
                                        </tr>
                                        <tr>
                                            <td width="200">Passport number:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'passport_no',
                                                    'value' => $this->input->post('passport_no')
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Applicant’s status <span class="required">*</span>:</td>
                                            <td><?php
                                                $array = array('selected' => 'selected');
                                                if ($this->input->post('status') == 'seeking') {
                                                    $terminated = NULL;
                                                    $employed = NULL;
                                                    $seeking = true;
                                                } else if ($this->input->post('status') == 'terminated') {
                                                    $terminated = true;
                                                    $employed = NULL;
                                                    $seeking = NULL;
                                                } else if ($this->input->post('status') == 'employed') {
                                                    $terminated = NULL;
                                                    $employed = true;
                                                    $seeking = NULL;
                                                } else {
                                                    $terminated = NULL;
                                                    $employed = NULL;
                                                    $seeking = NULL;
                                                }
                                                echo form_radio('status', 'seeking', $seeking);
                                                ?>Seeking &nbsp;
                                                <?php echo form_radio('status', 'employed', $employed); ?>Employed
                                                <?php echo form_radio('status', 'terminated', $terminated); ?>Terminated
                                            </td>
                                        </tr>


                                        <tr>
                                            <td width="200">Q-fever date 1:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'date1',
                                                    'readonly' => 'readonly',
                                                    'id' => 'date1',
                                                    'value' => $this->input->post('date1')
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Q-fever date 2:</td>
                                            <td><?php
                                                $data = array(
                                                    'id' => 'date2',
                                                    'name' => 'date2',
                                                    'readonly' => 'readonly',
                                                    'value' => $this->input->post('passport_no')
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">English level:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'english',
                                                    'value' => $this->input->post('english')
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Experience:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'exp',
                                                    'value' => $this->input->post('exp')
                                                );
                                                echo form_input($data);
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Vehicle:</td>
                                            <td>
                                                <?php
                                                $array = array('selected' => 'selected');
                                                if ($this->input->post('vehicle') == '0') {
                                                    $yes = NULL;
                                                    $no = true;
                                                } else {
                                                    $yes = true;
                                                    $no = NULL;
                                                }
                                                echo form_radio('vehicle', '1', $yes);
                                                ?><label>Yes</label> &nbsp;
                                                <?php echo form_radio('vehicle', '0', $no); ?><label>No</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200">Comments:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'comment',
                                                    'value' => $this->input->post('comment')
                                                );
                                                echo form_textarea($data);
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="200">Notes:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'notes',
                                                    'value' => $this->input->post('notes')
                                                );
                                                echo form_textarea($data);
                                                ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td></td>
                                            <td><input type="image" src="<?php echo HTTP_PATH . 'img/submitBtn.png'; ?>"> &nbsp;
                                                <img onclick="document.myform.reset();return false;" src="<?php echo HTTP_PATH . 'img/reset.png'; ?>" style=" cursor: pointer;" width="108" height="39">

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
