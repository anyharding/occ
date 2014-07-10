
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
                        echo "<option value='" . $i . "'";
                        if ($row->site_rate == $i) {
                            echo 'selected="selected"';
                        }
                        echo " >" . $rate['site_rate_name' . $i] . "</otion>";
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