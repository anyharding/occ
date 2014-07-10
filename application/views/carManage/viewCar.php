<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Car Detail</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Car Detail</h2>
                <div class="login_btm">  
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> 	Car Detail </div>
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
                            <div class="usr_img_dtl">
                                <div class="left"><div class="usr_img_dtl_lft2">Car Id :</div>
                                    <div class="usr_img_dtl_right"><?php echo $car["id"]; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Car Make :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["car_make"] <> NULL) echo $car["car_make"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Car Model :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["model"] <> NULL) echo $car["model"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Car Year :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["year"] <> NULL) echo $car["year"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Seating Capacity :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["seating_capacity"] <> NULL) echo $car["seating_capacity"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Purchase Date :</div>
                                    <div class="usr_img_dtl_right"><?php echo date('M d, Y', strtotime($car["purchase_date"])); ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Ownership company :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["ownership_comp"] <> NULL) echo $this->car_model->getCompanyName($car["ownership_comp"]); else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Rego No. :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["rego_no"] <> NULL) echo $car["rego_no"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Rego expiry :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["rego_exp_date"] <> NULL) echo $car["rego_exp_date"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Vehicle Identification Number :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["vin"] <> NULL) echo $car["vin"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Engine no :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["eng_no"] <> NULL) echo $car["eng_no"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Color :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["color"] <> NULL) echo $car["color"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Next service date :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["next_ser_date"] <> NULL) echo $car["next_ser_date"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Next service KM :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["next_ser_km"] <> NULL) echo $car["next_ser_km"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Service date :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["service_date"] <> NULL) echo $car["service_date"]; else echo "Not Specify" ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Service KM :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["service_km"] <> NULL) echo $car["service_km"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Car User :</div>
                                    <div class="usr_img_dtl_right"><?php echo $this->car_model->getUsername1($car["car_username"]); ?></div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">DOB :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["dob"] <> NULL) echo date('M d, Y', strtotime($car["dob"])); else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">License No :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["licence_no"] <> NULL) echo $car["licence_no"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Latest KM :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["latest_km"] <> NULL) echo $car["latest_km"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Purchase Price($ :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["purchase_price"] <> NULL) echo $car["purchase_price"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Insurance company :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["insurance_comp"] <> NULL) echo $car["insurance_comp"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Policy Number :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["policy_no"] <> NULL) echo $car["policy_no"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Insurance cover start date :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["insurance_start_date"] <> NULL) echo $car["insurance_start_date"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Insurance cover end date  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["insurance_end_date"] <> NULL) echo $car["insurance_end_date"]; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Insurance cover cost($) :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["insurance_cover_cost"] <> NULL) echo $car["insurance_cover_cost"]; else echo "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2"> Assigned location  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["car_use_location"] <> NULL) echo $this->User->getWorksiteCompName($car["car_use_location"]); else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2"> Roadside assist  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["roadside"] == '0') echo "No"; else echo "Yes"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Roadside assist number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["roadside_assist_number"] <> NULL) echo $car["roadside_assist_number"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Roadside assist company:</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["roadside_assist_company"] <> NULL) echo $car["roadside_assist_company"]; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Roadside expiry date:</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["roadside_expiry_date"] <> NULL) echo $car["roadside_expiry_date"]; else echo "Not Specify"; ?> </div></div>




                                <div class="left"><div class="usr_img_dtl_lft2"> E-toll  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["e_troll"] == '0') echo "No"; else echo "Yes"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2"> E-toll account number  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["e_troll_account"] <> NULL) echo $car["e_troll_account"]; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2"> E-toll tag number  :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["e_troll_tag"] <> NULL) echo $car["e_troll_tag"]; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2"> E-toll password   :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["e_troll_password"] <> NULL) echo $car["e_troll_password"]; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2"> Notes   :</div>
                                    <div class="usr_img_dtl_right"><?php if ($car["notes"] <> NULL) echo $car["notes"]; else echo "Not Specify"; ?> </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</article>



