<article id="content"><!-- Page Content -->

    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">House Detail</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">House Detail</h2>
                <div class="login_btm">  
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> 	House Detail </div>
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
                                <div class="left"><div class="usr_img_dtl_lft2">House Id:</div>
                                    <div class="usr_img_dtl_right"><?php echo $house_detail[0]['id']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Address of House:</div>
                                    <div class="usr_img_dtl_right"><?php echo $house_detail[0]['address']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Payment cycle:</div>
                                    <div class="usr_img_dtl_right"><?php
                            if ($house_detail[0]['payment_cycle'] == 'W') {
                                echo 'Weekly';
                            } else if ($house_detail[0]['payment_cycle'] == 'F') {
                                echo 'Fortnightly';
                            } else {
                                echo 'Monthly';
                            }
                            ?></div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Rent per week ($) :</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($house_detail[0]['payment_cycle'] == 'W') {
                                            $rent = $house_detail[0]['rent_payment_amount'];
                                        }
                                        if ($house_detail[0]['payment_cycle'] == 'M') {
                                            $rent = $house_detail[0]['rent_payment_amount'] * (0.25);
                                        }
                                        if ($house_detail[0]['payment_cycle'] == 'F') {
                                            $rent = $house_detail[0]['rent_payment_amount'] * (0.5);
                                        }
                                        echo $rent;
                                        ?> 
                                    </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Rent bond amount($):</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['rent_bound'] <> NULL) echo $house_detail[0]['rent_bound']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Realtor Company Name:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['company_name'] <> NULL) echo $house_detail[0]['company_name']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Realor Name/Contact:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['realtor_name'] <> NULL) echo $house_detail[0]['realtor_name']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Realtor Bank:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['realtor_bank'] <> NULL) echo $house_detail[0]['realtor_bank']; else echo "Not Specify"; ?>  </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Realtor Account Number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['realtor_account'] <> NULL) echo $house_detail[0]['realtor_account']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Realtor Account BSB:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['realtor_account_bsb'] <> NULL) echo $house_detail[0]['realtor_account_bsb']; else echo "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Lease commence date:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['lcd'] <> NULL) echo $house_detail[0]['lcd']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Lease expire date:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['led'] <> NULL) echo $house_detail[0]['led']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Internet connection :</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($house_detail[0]['internet'] == '0') {
                                            echo "No";
                                        } else {
                                            echo "Yes";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">ISP:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['isp'] <> NULL) echo $house_detail[0]['isp']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">ISP Username:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['isp_username'] <> NULL) echo $house_detail[0]['isp_username']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">ISP Password:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['isp_password'] <> NULL) echo $house_detail[0]['isp_password']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Phone number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['phone'] <> NULL) echo $house_detail[0]['phone']; else echo "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Electricity company name:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['ele_comp'] <> NULL) echo $house_detail[0]['ele_comp']; else echo "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Electricity account number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['ele_account'] <> NULL) echo $house_detail[0]['ele_account']; else echo "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Electricity Meter number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['electricity_meter'] <> NULL) echo $house_detail[0]['electricity_meter']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Electricity Co contact number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['electricity_co'] <> NULL) echo $house_detail[0]['electricity_co']; else echo "Not Specify"; ?> </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Water utility company:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['water_utility_company'] <> NULL) echo $house_detail[0]['water_utility_company']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Water account number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['water_account'] <> NULL) echo $house_detail[0]['water_account']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Water meter number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['water_meter'] <> NULL) echo $house_detail[0]['water_meter']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Water utility contact number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['water_utility_contact'] <> NULL) echo $house_detail[0]['water_utility_contact']; else echo "Not Specify"; ?> </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Gas company name:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['gas_comp'] <> NULL) echo $house_detail[0]['gas_comp']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Gas account number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['gas_account'] <> NULL) echo $house_detail[0]['gas_account']; else echo "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Landlord email address:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['langlord'] <> NULL) echo $house_detail[0]['langlord']; else echo "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Worksite:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($house_detail[0]['worksite_id'] <> NULL)
                                            echo isset($worksites[$house_detail[0]['worksite_id']]) ? $worksites[$house_detail[0]['worksite_id']] : "Not Specify";
                                        else
                                            echo "Not Specify";
                                        ?>
                                    </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Insurance:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['insurance'] <> NULL) echo $house_detail[0]['insurance']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Insurance company:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['insurance_company'] <> NULL) echo $house_detail[0]['insurance_company']; else echo "Not Specify"; ?> </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Insurance Policy Number:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['insurance_policy'] <> NULL) echo $house_detail[0]['insurance_policy']; else echo "Not Specify"; ?> </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Active:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['status']) echo "Active"; else echo "Inactive"; ?> </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Notes:</div>
                                    <div class="usr_img_dtl_right"><?php if ($house_detail[0]['notes']) echo $house_detail[0]['notes']; else echo "Not Specify"; ?> </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="my_profile">Contractors In House (<?php echo $this->house_model->noOfEmployees($this->uri->segment(3)) ?>)</h2>

                <div class="login_btm">
                    <?php if (!empty($users)) { ?>
                        <div class="power_mode_listing_head">
                            <div class="phone_no">Contractor ID</div>
                            <div class="company">Contractor Name </div>
                            <div class="Place_work">Place of work</div>
                            <div class="action">Phone No</div>
                            <div class="action">Action</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($users as $row) {
                            ?>
                            <div class="power_mode_listing">
                                <div class="phone_no"><?php echo $row->id; ?></div> 
                                <div class="company"><?php echo anchor('/users/viewUser/' . $row->id, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?></div>
                                <div class="Place_work">
                                    <?php
                                    $comp = $this->User->getWorksiteCompName($row->worksite_id);
                                    if ($comp == NULL) {
                                        echo 'Not Specify';
                                    } else {
                                        echo $comp;
                                    }
                                    ?>
                                </div>
                                <div class="action">
                                    <?php
                                    if ($row->contact_no == NULL or $row->contact_no == '') {
                                        echo 'Not Specify';
                                    } else {
                                        echo $row->contact_no;
                                    }
                                    ?>
                                </div>
                                <div class="action">
                                    <?php echo anchor('/users/viewUser/' . $row->id, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' '; ?>
                                </div>
                            </div>	
                            <?php
                        }
                    } else {
                        ?>
                        No Contractors
                        <?php
                    }
                    ?>
                </div> 
                <h2  class="my_profile">Household Items (<?php echo $this->house_model->noOfHouseholds($this->uri->segment(3)) ?>)</h2>
                <div class="login_btm">
                    <?php if (!empty($household)) { ?>
                        <div class="power_mode_listing_head">
                            <div class="Email">Supplier Name </div>
                            <div class="company">Purchase Time</div>
                            <div class="Place_work">Contact No</div>
                            <div class="action">Action</div>

                        </div>	
                        <?php
                        $i = 0;
                        foreach ($household as $row) {
                            ?>
                            <div class="power_mode_listing">
                                <div class="Email"><?php echo $row->shop_name; ?></div> 
                                <div class="company"><?php echo $row->purchase_time; ?></div>
                                <div class="Place_work"><?php echo $row->contact_no; ?></div>

                                <div class="action">
                                    <?php //if($row->status == 0)echo anchor('household/activatehousehold/'.$row->id, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('household/deactivatehousehold/'.$row->id, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate');    ?>
                                    <?php echo anchor('/household/viewHousehold/' . $row->id, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' '; ?>
                                </div>
                            </div>	
                            <?php
                        }
                    } else {
                        ?>
                        No Households
                        <?php
                    }
                    ?>
                </div>
            </section>
        </section>
    </section>
</article>