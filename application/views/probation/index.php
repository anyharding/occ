<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.numeric.js"></script>
<script type="text/javascript">
    function validate(){
        var flag = 1;
        $('.required_true').map(function() {
            var value= $(this).val();
            //var id=this.id;
            if(value=="")
            { 
                flag = 0;
                $(this).addClass('error-true');
                return false;
                    
            }else
            {   
                $(this).removeClass('error-true'); 
            } 
        });
        if(flag == 1 ) {
            return true;
        }
        alert('All fields are required');
        return false;
    }
    
    $(document).ready(function(){
        $(".numeric").numeric();
        $('#worksite').change(function(e) {
            $.ajax({
                url: "<?php echo HTTP_PATH . 'probation/getList/'; ?>"+this.value,
                beforeSend: function() {
                    $("#loading-image").show();
                },
                complete: function() {
                    $("#loading-image").hide();
                },
                success: function(data) {
                    $('#middle-content').attr('innerHTML',data);
                    $("#recently").css('display', 'none'); 
                    $("#all").css('display', 'block'); 
                }
            });
        });
    });

</script>
<style>
    .error-true{
        border: #b9171d solid 1px;
    }
</style>
<div style="display: none;" class="load-image" id="loading-image">
    <?php echo img('img/loading4.gif'); ?> 
</div>  
<article id="content" class="batch_pay_probation"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_3">
                <p class="ribbon_probation">
                    <strong class="ribbon-content">Probation Users </strong>
                </p>
            </div>
        </section>    
        <section class="page-container">

            <?php $this->load->view('user/sideBarLeft'); ?>

            <section class="contentCol batch-payment">
                <h2 class="my_profile">Probation Users </h2>
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

                <?php echo form_open_multipart('probation/updateDetail', array('name' => 'myform', 'onsubmit' => 'return validate()')); ?>
                <div style="margin-bottom: 50px;">
                    <div class="field_name"><b>Select Worksite </b></div>
                    <div class="text_field_bg">
                        <?php echo form_dropdown('worksite_id', $worksites, $this->uri->segment(3), "class = 'textfield_input' id='worksite'"); ?>
                    </div>
                </div>
                <div class="login_btm" id="middle-content">
                    <?php if (!empty($users)) { ?>
                        <div class="power_mode_listing_head_probation">
                            <div class="company pany_probation">AdminID </div>
                            <div class="company pany_probation">Contractor Name </div>
                            <div class="company pany_probation">Contractor Start Date <span class="required1">*</span></div>
                            <div class="company pany_probation">Work Site Name <span class="required1">*</span></div>
                            <div class="company pany_probation">Work Site Rate Name  <span class="required1">*</span></div>
                            <div class="company pany_probation">Hourly Rate($) <span class="required1">*</span></div>
                            <div class="company pany_probation">Probation <span class="required1">*</span></div>
                        </div>	
                        <?php
                        $j = 0;
                        foreach ($users as $row) {
                            $j += 1;
                            ?>
                            <div class="power_mode_listing_probation">
                                <div class="company pany_probation">
                                    <label>
                                        <?php
                                        echo $row->admin_id
                                        ?> 
                                    </label>
                                </div>
                                <div class="company pany_probation">
                                    <label>
                                        <?php
                                        echo form_hidden('employee_id[]', $row->id);
                                        echo $row->lastname . ", " . $row->firstname
                                        ?> 
                                    </label>
                                </div>
                                <div class="company pany_probation">
                                    <label>
                                        <?php
//                                    $data = array('class' => 'textfield_input rate_probation required_true', 'id' => 'firstname' . $row->id, 'name' => 'firstname[]', 'value' => $row->firstname);
//                                    echo form_input($data);
//                                    echo form_hidden('employee_id[]', $row->id);
                                        echo date("M d, Y", strtotime($row->employmentdate));
                                        ?> 
                                    </label>
                                </div>

                                <div class="company pany_probation">
                                    <?php
                                    if ($this->uri->segment(3)) {
                                        $rate = $this->User->getWorksiteRateAndName($this->uri->segment(3));
                                    } else {
                                        $rate = $this->User->getWorksiteRateAndName($row->worksite_id);
                                    }
                                    echo $rate['company'];
                                    ?>
                                </div>
                                <div class="company pany_probation">
                                    <select class = 'textfield_input_nw  required_true' id="site_rate" name="site_rate[]">
                                        <?php
                                        if ($this->uri->segment(3)) {
                                            $rate = $this->User->getWorksiteRateAndName($this->uri->segment(3));
                                        } else {
                                            $rate = $this->User->getWorksiteRateAndName($row->worksite_id);
                                        }
                                        echo '<option value="">Select Site Rate Name</option>';
                                        for ($i = 1; $i < 10; $i++) {
                                            if ($rate['site_rate_name' . $i]) {
                                                echo "<option value='" . $i . "'";
                                                if ($row->site_rate == $i) {
                                                    echo 'selected="selected"';
                                                }
                                                echo " >" . $rate['site_rate_name' . $i] . "</otion>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!--                                <div class="company pany_probation">
                                <?php
                                $data = array(
                                    'name' => 'hourlyrate_des[]',
                                    'value' => $row->hourlyrate_des,
                                    'class' => 'textfield_input rate_probation required_true',
                                    'id' => 'hourlyrate_des' . $row->id
                                );
                                echo form_input($data);
                                ?> 
                                                                </div>-->

                                <div class="company pany_probation">
                                    <?php
                                    $data = array(
                                        'name' => 'hourlyrate[]',
                                        'value' => $row->hourlyrate,
                                        'class' => 'textfield_input rate_probation numeric required_true',
                                        'id' => 'hourlyrate' . $row->id
                                    );
                                    echo form_input($data);
                                    ?>
                                </div>

                                <div class="company pany_probation">
                                    <?php
                                    $array = array('selected' => 'selected');
                                    if ($row->probation == 'no') {
                                        $yes = NULL;
                                        $no = true;
                                    } else if ($row->probation == 'yes') {
                                        $yes = true;
                                        $no = NULL;
                                    } else {
                                        $yes = NULL;
                                        $no = NULL;
                                    }
                                    ?>
                                    <?php echo form_radio('probation' . $j, 'yes', $yes, "class='required'"); ?><label>YES</label>
                                    <?php echo form_radio('probation' . $j, 'no', $no, "class='required'"); ?><label>NO</label> &nbsp;
                                </div>

                            </div>	
                            <?php
                        }
                    } else {
                        ?>
                        <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
                        <?php
                    }
                    if (!empty($users)) {
                        ?>
                        <div  class="user_name_4">
                            <div class="login_button_2">
                                <input name="Submit" value="Submit" type="submit" class="input_submit" />
                            </div>
                            <div class="login_button_2">
                                <input name="Button" value="Reset" type="reset"  class="input_submit" />
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php echo form_close(); ?>
                <div class="pagination_new">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </section>
        </section>
    </section>
</article>


