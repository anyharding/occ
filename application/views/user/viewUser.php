<article id="content"><!-- Page Content -->
    <section class="content_2">
        <section class="top_login_text_head">
            <div class="ribbon_2">
                <p class="ribbon">
                    <strong class="ribbon-content">Contractor Profile</strong>
                </p>
            </div>
        </section>    
        <section class="page-container">
            <?php $this->load->view('user/sideBarLeft.php'); ?>
            <section class="contentCol">
                <h2 class="my_profile">Contractor Profile</h2>
                <div class="login_btm">  
                    <div class="usr_img_dtl_top">
                        <div class="profile">
                            <div class="usr_img_dt2"> 	Account Detail </div>
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
                                <div class="left"><div class="usr_img_dtl_lft2">Contractor Id:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['id']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Admin Id:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['admin_id'] ? $user_detail['admin_id'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Display Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['lastname'] . ', ' . $user_detail['firstname']; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">English Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['enname'] ? $user_detail['enname'] : "Not Specify"; ?></div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Email:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['email'] ? $user_detail['email'] : "Not Specify"; ?></div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Contact Number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['contact_no'] ? $user_detail['contact_no'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Address:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['address'] ? $user_detail['address'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Password:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['password']; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Gender:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($user_detail['gender'] == 'F') {
                                            echo 'Female';
                                        } else {
                                            echo 'Male';
                                        }
                                        ?>
                                    </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Height:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['height'] ? $user_detail['height'] . " CM" : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Weight:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['weight'] ? $user_detail['weight'] . " KG" : "Not Specify"; ?>  </div></div>




                                <div class="left"><div class="usr_img_dtl_lft2">TFN declaration form:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['tfn'] ? ucfirst($user_detail['tfn']) : "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">ABN authority:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['abn'] ? ucfirst($user_detail['abn']) : "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">DOB:</div>
                                    <div class="usr_img_dtl_right"><?php if ($user_detail['dob'] <> '') echo date('d M Y ', strtotime($user_detail['dob'])); ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Vehicle:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['vehicle'] ? ucfirst($user_detail['vehicle']) : "Not Specify"; ?> </div></div>  

                                <div class="left"><div class="usr_img_dtl_lft2">Vaccination status:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['statusvaccination'] == '2') {
                                            echo 'No';
                                        } else {
                                            echo 'Yes';
                                        }
                                        ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Fee Member:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['fee_member'] ? ucfirst($user_detail['fee_member']) : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Fee Amount ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['fee_amount'] ? $user_detail['fee_amount'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Q-fever:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['q_fever'] ? ucfirst($user_detail['q_fever']) : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Q-fever 1:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['q1'] ? $user_detail['q1'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Q-fever 2:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['q2'] ? $user_detail['q2'] : "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Shift Type:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        $options = array('0' => 'Not Specify', '1' => 'Morning', '2' => 'Afternoon', '3' => 'Night');
                                        echo $options[$user_detail['shifttype']];
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Position:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        $options = array(0 => 'Not Specify', '' => 'Not Specify', '1' => 'General hand', '2' => 'Slicer', '3' => 'Boner', '5' => 'Slaughterer', '4' => 'Packer', '6' => 'Maintenance', '7' => 'Cleaning', '8' => 'Loading', '9' => 'Chill room', '10' => 'Loadout', '11' => 'Other');
                                        echo $options[$user_detail['position']];
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Nationality:</div>
                                    <div class="usr_img_dtl_right"><?php echo $countries[$user_detail['country_id']]; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Passport number:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        echo $user_detail['passport_number'] ? $user_detail['passport_number'] : "Not Specify"
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Visa Type :</div>
                                    <div class="usr_img_dtl_right"><?php
                                        $visaoptions = array('0' => 'Not Specify', '1' => 'Working holiday', '2' => 'Dependant 457 visa full work rights', '3' => 'PR/citizen', '4' => 'Bridging visa full work rights', '5' => 'Other visa', '6' => 'Limited work rights');
                                        echo $visaoptions[$user_detail['visa_type']];
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Visa Number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['visa_number'] ? $user_detail['visa_number'] : "Not Specify"; ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Visa Expiry date:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['visa_expiry_date'] ? $user_detail['visa_expiry_date'] : "Not Specify"; ?> </div></div>




                                <div class="left"><div class="usr_img_dtl_lft2">Tax Type :</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['taxtype'] == '1') {
                                            echo 'ABN';
                                        } else {
                                            echo 'TFN';
                                        };
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Has ABN:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['statusofabn'] == '2') {
                                            echo 'Yes';
                                        } elseif ($user_detail['statusofabn'] == '2') {
                                            echo 'No';
                                        } else {
                                            echo 'Not Specify';
                                        }
                                        ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Tax Number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['tax_number'] ? $user_detail['tax_number'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">ABN number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['abnnumber'] ? $user_detail['abnnumber'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Bank:</div>
                                    <div class="usr_img_dtl_right"><?php echo $this->User->getFullbankname($user_detail['bank']); ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Account Name:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['nameofbank'] ? $user_detail['nameofbank'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Account Number:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['numberofbank'] ? $user_detail['numberofbank'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">BSB:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['branchofbank'] ? $user_detail['branchofbank'] : "Not Specify"; ?> </div></div>


                                <div class="left"><div class="usr_img_dtl_lft2">Start employment date:</div>
                                    <div class="usr_img_dtl_right"><?php if ($user_detail['employmentdate'] <> '') echo $user_detail['employmentdate']; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Place of work :</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        $worksites[0] = 'Not Specify';
                                        echo $worksites[$user_detail['worksite_id']];
                                        ?> 
                                    </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Site Rate Name :</div>
                                    <div class="usr_img_dtl_right">
                                        <?php echo $this->User->getWorksiteRateName($user_detail['worksite_id'], $user_detail['site_rate']) ?>
                                    </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Hourly rate description:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['hourlyrate_des'] ? $user_detail['hourlyrate_des'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Hourly rate ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['hourlyrate'] ? $user_detail['hourlyrate'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Probation:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $user_detail['probation'] ? ucfirst($user_detail['probation']) : "Not Specify";
                                        ?>
                                    </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Total One Off Deductions ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['deductions'] ? $user_detail['deductions'] : "Not Specify"; ?> </div></div>

                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Reasons for Deductions:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php echo $user_detail['reason_deductions'] ? $user_detail['reason_deductions'] : "Not Specify"; ?> 
                                    </div>
                                </div>

                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Rental Type:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $user_detail['rental_type'] ? ucfirst($user_detail['rental_type']) : "Not Specify";
                                        ?> 
                                    </div>
                                </div>

                                <?php if ($user_detail['rental_type'] == 'non-company') { ?>
                                    <div class="left">
                                        <div class="usr_img_dtl_lft2">Non Company Address:</div>
                                        <div class="usr_img_dtl_right">
                                            <?php
                                            echo $user_detail['non_comp_address'] ? $user_detail['non_comp_address'] : "Not Specify";
                                            ?> 
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="left">
                                        <div class="usr_img_dtl_lft2">Place of stay:</div>
                                        <div class="usr_img_dtl_right">
                                            <?php
                                            echo $user_detail['house_id'] ? $houses[$user_detail['house_id']] : "Not Specify";
                                            ?> 
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="left">
                                    <div class="usr_img_dtl_lft2">Last Address Update Date:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        echo $user_detail['address_update_date'] ? date("M d, Y", strtotime($user_detail['address_update_date'])) : "Not Specify";
                                        ?> 
                                    </div>
                                </div>
                                <?php if ($user_detail['rental_type'] == 'company') { ?>
                                    <div class="left"><div class="usr_img_dtl_lft2">Weekly rent rate ($):</div>
                                        <div class="usr_img_dtl_right"><?php echo $user_detail['weeklyrent'] ? $user_detail['weeklyrent'] : "Not Specify"; ?> </div></div>
                                    <div class="left"><div class="usr_img_dtl_lft2">Bond Payed:</div>
                                        <div class="usr_img_dtl_right"><?php
                                if ($user_detail['statusofbond'] == '2') {
                                    echo 'No';
                                } else {
                                    echo 'Yes';
                                }
                                    ?> 
                                        </div>
                                    </div>

                                    <div class="left"><div class="usr_img_dtl_lft2">Amount of bond payment ($):</div>
                                        <div class="usr_img_dtl_right"><?php echo $user_detail['bondamount']; ?> </div></div>

                                <?php } ?>
                                <div class="left"><div class="usr_img_dtl_lft2">Currently Employed:</div>
                                    <div class="usr_img_dtl_right"><?php
                                if ($user_detail['employee_employed'] == '2') {
                                    echo 'Yes';
                                } else {
                                    echo 'No';
                                }
                                ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Possible Future employment:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['future_employment'] == '2') {
                                            echo 'Yes';
                                        } else {
                                            echo "No";
                                        };
                                ?> </div></div>



                                <div class="left"><div class="usr_img_dtl_lft2">Description of final position :</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['final_position'] ? $user_detail['final_position'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Resignation Approved By:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['regignation_approve_by'] ? $user_detail['regignation_approve_by'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Resignation reason:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['reason'] ? $user_detail['reason'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Left Australia:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($user_detail['left_australia'] == '2') {
                                            echo 'Yes';
                                        } else {
                                            echo 'No';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Status of issued equipment:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['statusofissued'] == '2') {
                                            echo 'No';
                                        } else {
                                            echo 'Yes';
                                        }
                                        ?> 
                                    </div>
                                </div>
                                <div class="left"><div class="usr_img_dtl_lft2">Equipment name 1:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name1'] ? $user_detail['equipment_name1'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Equipment value 1 ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value1'] ? $user_detail['equipment_value1'] : "Not Specify"; ?> </div></div>
                                <div class="left"><div class="usr_img_dtl_lft2">Paid for by 1:</div>
                                    <div class="usr_img_dtl_right">
                                        <?php
                                        if ($user_detail['paidforby1'] == '2') {
                                            echo 'Contractor';
                                        } else {
                                            echo 'Company';
                                        }
                                        ?>  
                                    </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Equipment name 2:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name2'] ? $user_detail['equipment_name2'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Equipment value 2 ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value2'] ? $user_detail['equipment_value2'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Paid for by 2 :</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['paidforby2'] == '2') {
                                            echo 'Contractor';
                                        } else {
                                            echo 'Company';
                                        }
                                        ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Equipment name 3:</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_name3'] ? $user_detail['equipment_name3'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Equipment value 3 ($):</div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['equipment_value3'] ? $user_detail['equipment_value3'] : "Not Specify"; ?> </div></div>

                                <div class="left"><div class="usr_img_dtl_lft2">Paid for by 3:</div>
                                    <div class="usr_img_dtl_right"><?php
                                        if ($user_detail['paidforby3'] == '2') {
                                            echo 'Contractor';
                                        } else {
                                            echo 'Company';
                                        }
                                        ?> </div>
                                </div>

                                <div class="left"><div class="usr_img_dtl_lft2">Notes: </div>
                                    <div class="usr_img_dtl_right"><?php echo $user_detail['notes'] ? $user_detail['notes'] : "Not Specify"; ?> </div></div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</article>



