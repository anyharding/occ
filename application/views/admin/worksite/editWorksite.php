<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#rent_due_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });             
    });
</script>
<td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Edit Worksite</td>
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
                                <th>Edit Worksite</th>
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
                                    <?php echo form_open_multipart('admin/worksite/editWorksite/' . $this->uri->segment(4), array('name' => 'myform')); ?>
                                    <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="200">Contacted company <span class="required">*</span>:</td>
                                            <td><?php
                                    $data = array(
                                        'name' => 'company',
                                        'value' => $edit_worksite[0]['company']
                                    );
                                    echo form_input($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200">Worksite Address <span class="required">*</span>:</td>
                                            <td><?php
                                                $data = array(
                                                    'name' => 'address',
                                                    'value' => $edit_worksite[0]['address']
                                                );
                                                echo form_textarea($data);
                                    ?></td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number ($): <font color="red">*</font></td>
                                            <td><?php
                                                $data = array('name' => 'contact',
                                                    'value' => $edit_worksite[0]['contact']
                                                );
                                                echo form_input($data);
                                    ?>
                                            </td>
                                        </tr> 

                                        <?php
                                        for ($i = 1; $i < 16; $i++) {
                                            ?>   
                                            <tr>
                                                <td>Site rate<?php echo $i; ?> ($): <font color="red">*</font></td>
                                                <td>
                                                    <?php
                                                    $data = array('name' => 'site_rate' . $i,
                                                        'value' => set_value("site_rate" . $i) ? set_value("site_rate" . $i) : $edit_worksite[0]["site_rate" . $i]
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </td>
                                            </tr> 
                                            <tr>
                                                <td width="200">Site rate name<?php echo $i; ?> <span class="required">*</span>:</td>
                                                <td>
                                                    <?php
                                                    $data = array('name' => 'site_rate_name' . $i,
                                                        'value' => set_value("site_rate_name" . $i) ? set_value("site_rate_name" . $i) : $edit_worksite[0]["site_rate_name" . $i]
                                                    );
                                                    echo form_input($data);
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                        <tr>
                                            <td></td>
                                            <td><input type="image" src="<?php echo HTTP_PATH . 'img/submitBtn.png'; ?>"> &nbsp;


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
