<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script>
    $(document).ready(function(){        
        jQuery.validator.addMethod("BSB", function(value, element) {
            return this.optional(element) || value.match(/^[0-9]{3}[0-9]{3}$/);
        }, 'Please enter valid formate.');
        $("#myform").validate({
            rules: {
                bsb: {
                    BSB: true
                }
            },
            messages: {
                bsb: {
                    BSB: "Format should be ‘xxxxxx’"
                }
            }
        });
    });
    
    function preventCharecter(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)){  
            return false;
        }
    }
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Edit Pay Company</strong>
                </p>
            </div>


        </section>   
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
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft'); ?>
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <section class="form_contant_box_nw">

                    <?php echo form_open_multipart('paycompany/editCompany/' . $this->uri->segment(3), array('name' => 'myform', 'id' => 'myform')); ?>
                    <div class="user_name_box2">
                        <div class="field_name ">Account Name <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'account_name',
                                'id' => 'account_name',
                                'maxlength' => 26,
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('account_name') ? $this->input->post('account_name') : $comp_detail['account_name']
                            );
                            echo form_input($data);
                            ?>
                        </div>

                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> IF Code  <span class="required1">*</span> </div>
                        <div class="text_field_bg">
                            <?php
                            echo form_dropdown('if_code', $banks, ($this->input->post('if_code') ? $this->input->post('if_code') : $comp_detail['if_code']), 'id="if_code" class="textfield_input required"')
                            ?> 
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Account Number  <span class="required1">*</span> </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'account_number',
                                'maxlength' => 8,
                                'id' => 'account_number',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post('account_number') ? $this->input->post('account_number') : $comp_detail['account_number']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">BSB <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'bsb',
                                'class' => 'textfield_input required',
                                'maxlength' => 6,
                                'onkeypress' => 'return preventCharecter(event)',
                                'value' => $this->input->post('bsb') ? $this->input->post('bsb') : $comp_detail['bsb']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">DE User ID <span class="required1">*</span></div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'de_user_id',
                                'class' => 'textfield_input required digits',
                                'maxlength' => 6,
                                'minlength' => 6,
                                'value' => $this->input->post('de_user_id') ? $this->input->post('de_user_id') : $comp_detail['de_user_id']
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <!--  ---------------------------------------------------- -->

                    <div  class="user_name_3">
                        <div class="login_button_2"><input name="Submit" value="Submit" type="submit" class="input_submit" />

                        </div>

                        <div class="login_button_2">
                            <input name="Button" value="Back" type="button" onclick="window.history.back()" class="input_submit" />
                        </div>
                    </div>

                    <?php echo form_close(); ?>
                </section>
            </section>  



        </section>
</article>

