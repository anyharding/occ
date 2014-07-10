<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"></script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/datepicker/jquery.ui.all.css'; ?>" type="text/css" />
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/datepicker/jquery.ui.datepicker.js"></script>
<script>
    $(function() {
        $( "#purchase_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#dob" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#rego_exp_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#next_ser_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#roadside_expiry_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#service_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+0",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#insurance_start_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });
        $( "#insurance_end_date" ).datepicker({
            changeMonth: true,
            dateFormat: 'yy-mm-dd',
            yearRange:"-90:+28",
            maxDate: new Date(2500, 0, 1),
            changeYear: true
        });          
    });
</script>
<script>
    $(document).ready(function(){
        $('#car_username').change(function() {
        
            if(this.value != "") {
                $.ajax({
                    url:"<?php echo HTTP_PATH . "admin/carManage/getUserDOB" ?>/"+this.value,
                    success:function(data){
                        $("#dob").val(data);
                    }
                }
            );
            }
            else {
                $("#dob").val('');
            }
        });
        $("#myform").validate();
    });
</script>
<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Add New Cars Details</strong>
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

                    <?php echo form_open_multipart('carManage/addCar', array('name' => 'myform', 'id' => 'myform')); ?>

                    <div class="user_name_box2">
                        <div class="field_name "> Car Id   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            Not Added
                        </div>
                    </div> 

                    <div class="user_name_box2">
                        <div class="field_name "> Car Make   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'car_make',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("car_make")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Car Model   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'model',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("model")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Car Year   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'year',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("year")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Seating Capacity  <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'seating_capacity',
                                'class' => 'textfield_input number',
                                'value' => $this->input->post("seating_capacity")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Purchase date   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'purchase_date',
                                'id' => 'purchase_date',
                                'class' => 'textfield_input required',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("purchase_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Ownership company    <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
//                            $data = array(
//                                'name' => 'ownership_comp',
//                                'class' => 'textfield_input',
//                                'value' => $this->input->post("ownership_comp")
//                            );
//                            echo form_input($data);
                            ?>
                            <?php echo form_dropdown('ownership_comp', $company, $this->input->post('ownership_comp'), 'id="ownership_comp" class = "textfield_input"'); ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Rego No   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'rego_no',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("rego_no")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Rego expiry   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'rego_exp_date',
                                'id' => 'rego_exp_date',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("rego_exp_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Vehicle Identification Number   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'vin',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("vin")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Engine no   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'eng_no',
                                'class' => 'textfield_input required',
                                'value' => $this->input->post("eng_no")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Color   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'color',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("color")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Next service date   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'next_ser_date',
                                'id' => 'next_ser_date',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("next_ser_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Next service KM   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'next_ser_km',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("next_ser_km")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Service date   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'service_date',
                                'id' => 'service_date',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("service_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Service KM   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'service_km',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("service_km")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Car User   <span class="required1">*</span>  </div>
                        <div class="text_field_bg">
                            <?php echo form_dropdown('car_username', $users, $this->input->post('car_username'), 'id="car_username" class = "textfield_input required"'); ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> DOB   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'dob',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'id' => 'dob',
                                'value' => $this->input->post("dob")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> License No   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'licence_no',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("licence_no")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Latest KM   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'latest_km',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("latest_km")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Purchase Price($)   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'purchase_price',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("purchase_price")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Insurance company   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'insurance_comp',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("insurance_comp")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Policy Number   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'policy_no',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("policy_no")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Insurance cover start date   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'insurance_start_date',
                                'class' => 'textfield_input',
                                'id' => 'insurance_start_date',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("insurance_start_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Insurance cover end date   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'insurance_end_date',
                                'class' => 'textfield_input',
                                'id' => 'insurance_end_date',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("insurance_end_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>


                    <div class="user_name_box2">
                        <div class="field_name "> Insurance cover cost($)  <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'insurance_cover_cost',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("insurance_cover_cost")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>



                    <div class="user_name_box2">
                        <div class="field_name "> Assigned location   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
//                            $data = array('name' => 'car_use_location',
//                                'class' => 'textfield_input',
//                                'value' => $this->input->post("car_use_location")
//                            );
//                            echo form_input($data);
                            ?>
                            <?php echo form_dropdown('car_use_location', $worksites, $this->input->post('car_use_location'), 'id="car_use_location" class = "textfield_input"'); ?>
                        </div>
                    </div>








                    <div class="user_name_box2">
                        <div class="field_name "> Roadside assist   <span class="required"></span>  </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('roadside') == '0') {
                                $yes = NULL;
                                $no = true;
                            } else {
                                $yes = true;
                                $no = NULL;
                            }
                            ?>
                            <?php echo form_radio('roadside', '1', $yes); ?><label>Yes</label>
                            <?php echo form_radio('roadside', '0', $no); ?><label>No</label>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Roadside assist number   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'roadside_assist_number',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("roadside_assist_number")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name "> Roadside assist company   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'roadside_assist_company',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("roadside_assist_company")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> Roadside expiry date <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'roadside_expiry_date',
                                'id' => 'roadside_expiry_date',
                                'class' => 'textfield_input',
                                'readonly' => 'readonly',
                                'value' => $this->input->post("roadside_expiry_date")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name ">E-toll   <span class="required"></span>  </div>
                        <div class="text_field_bg3">
                            <?php
                            $array = array('selected' => 'selected');
                            if ($this->input->post('e_troll') == '0') {
                                $yes = NULL;
                                $no = true;
                            } else {
                                $yes = true;
                                $no = NULL;
                            }
                            ?>

                            <?php echo form_radio('e_troll', '1', $yes); ?><label>Yes</label>
                            <?php echo form_radio('e_troll', '0', $no); ?><label>No</label>

                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> E-toll account number   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'e_troll_account',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("e_troll_account")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> E-toll tag number   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'e_troll_tag',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("e_troll_tag")
                            );
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="user_name_box2">
                        <div class="field_name "> E-toll password   <span class="required"></span>  </div>
                        <div class="text_field_bg">
                            <?php
                            $data = array('name' => 'e_troll_password',
                                'class' => 'textfield_input',
                                'value' => $this->input->post("e_troll_password")
                            );
                            echo form_password($data);
                            ?>
                        </div>
                    </div>

                    <div id="fill">
                    </div>

                    <div class="user_name_box2">
                        <div class="field_name">Notes</div>
                        <div class="text_field_bg">
                            <?php
                            $data = array(
                                'name' => 'notes',
                                'rows' => "5",
                                'cols' => "40",
                                'id' => "notes",
                                'class' => 'textfield_input',
                                'value' => $this->input->post('notes')
                            );
                            echo form_textarea($data);
                            ?>
                        </div>
                    </div>
                    <div  class="user_name_3">
                        <div class="login_button_2">
                            <input name="Submit" value="Submit" type="submit" class="input_submit" />
                        </div>
                        <div class="login_button_2">
                            <input name="Button" value="Reset" type="reset" class="input_submit" />
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </section>
            </section>  
        </section>  



    </section>
</article>
