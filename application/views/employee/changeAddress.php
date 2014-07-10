<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script>
    $(document).ready(function(){
        $(".fill_addresses").hide();
        $('#search-form').submit(function(event)
        {
            event.preventDefault();
            var non_comp_address = $('#non_comp_address').val();
				
            if (!non_comp_address || non_comp_address.length == 0)
            {
                $('#search-block').html('<div class="error ActionMsgBox search-block">Please enter your non company address</div>');
            }
            else
            {
                var submitBt = $(this).find('button[type=submit]');					
                // Target url
                var target = $(this).attr('action');
                if (!target || target == '')
                {
                    // Page url without hash
                    target = document.location.href.match(/^([^#]+)/)[1];
                }					
                // Request
                var data = {
                    non_comp_address: non_comp_address
                },
                redirect = $('#redirect'),
                sendTimer = new Date().getTime();
					
                if (redirect.length > 0)
                {
                    data.redirect = redirect.val();
                }
					
                // Send
                $.ajax({
                    url: target,
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(data, textStatus, XMLHttpRequest)
                    {
                        if(data.redirect) {
                            document.location.href = data.redirect;
                        }
                        else if (data.valid)
                        {
                            $('#search-block').html("");
                            $(".fill_addresses").show();
                            $(".fill_data").html(data.content);
                        }
                        else
                        {
                            $('#search-form').attr('action', "<?php echo HTTP_PATH . "employees/updateNewAddress" ?>");
                            $('#search-form').submit();
                            //                            $('#search-block').html('<div class="error ActionMsgBox search-block">Error while contacting server, please try again</div>');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        $('#search-block').html('<div class="error ActionMsgBox search-block">Error while contacting server, please try again '+errorThrown+'</div>');
                    }
                });					
                // Message
                $('#search-block').html('<div class="success ActionMsgBox search-block">Please wait, checking...</div>');
            }
        });
    });
</script>
<style>
    input[type="radio"]{
        cursor: pointer;
        float: left;
        margin: 7px 0 0 -36px;
        position: relative;

    }

</style>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon"> <strong class="ribbon-content"> Update your current address</strong> </p>
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
            <?php $this->load->view('user/sideBarLeftEmployee'); ?>
            <section class="contentCol2">
                <div style="text-align: left;color: #999999; font: bold 12px Arial,Helvetica,sans-serif;" class="left-name3"> <span class="required1">*</span> is Required Field.</div>
                <div class="form_contant_box_nw">
                    <div id="search-block"></div>
                    <?php echo form_open('s/employees/getsearchRecord', array('id' => 'search-form')); ?>
                    <div style="display: block;">
                        <div class="user_name_box2">
                            <div class="field_name">Please input your current address <span class="required1">*</span></div>
                            <div class="text_field_bg">
                                <?php
                                $data = array(
                                    'name' => 'non_comp_address', 'rows' => "5",
                                    'cols' => "40",
                                    'id' => "non_comp_address",
                                    'class' => 'textfield_input',
                                    'value' => $this->input->post('non_comp_address') ? $this->input->post('non_comp_address') : $user_detail[0]['non_comp_address']
                                );
                                echo form_textarea($data);
                                ?>
                                <div class="address_sample">
                                    Please update your current address using the following format: Unit number (If applicable) Street Number Street or Road Name Suburb, State Post Code. For Example 7 Caler CT Warrnambool, VIC 3280
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="user_name_3">
                        <div class="login_button_2">
                            <input name="Submit" value="Submit" type="submit" class="input_submit" />
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <div style="display: block; float: left; margin-top: 21px;">
                        <div class="fill_addresses">
                            <?php echo form_open('s/employees/updateAddress/', array('id' => 'update-form')); ?>
                            <div class="user_name_box2 fill_data"> </div>
                            <div  class="user_name_3">
                                <div class="login_button_2">
                                    <input name="Submit" value="Save" type="submit" class="input_submit" />
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</article>