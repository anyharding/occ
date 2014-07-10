<?php if (!empty($users)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no phone_no25">AdminID</div>
        <div class="company1">Contractor Name </div>
        <div class="phone_no phone_no25">Contact Number </div>
        <div class="company1">Place of work</div>
        <div class="phone_no phone_no25">Position</div>
        <div class="phone_no phone_no25 ">Visa Expiry Date</div>

    </div>	
    <?php
    $i = 0;
    foreach ($users as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="phone_no phone_no25">
                <?php echo $row->admin_id; ?>
            </div> 
            <div class="company1">
                <?php echo anchor('/users/editUser/' . $row->id . "/" . $row->firstname . "/" . $row->lastname . "/" . $row->house_id, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?>
            </div>
            <div class="phone_no phone_no25">
                <?php
                echo $row->contact_no ? $row->contact_no : "N/A";
                ?>
            </div>
            <div class="company1">
                <?php
                $comp = $this->User->getWorksiteCompName($row->worksite_id);
                if ($comp == NULL) {
                    echo 'N/A';
                } else {
                    echo anchor('users/employeeInWorksite/' . $row->worksite_id, $comp);
                }
                ?>
            </div>
            <div class="phone_no phone_no25">
                <?php
                $options = array('1' => 'General hand', '2' => 'Slicer', '3' => 'Boner', '5' => 'Slaughterer', '4' => 'Packer', '6' => 'Maintenance', '7' => 'Cleaning', '8' => 'Loading', '9' => 'Chill room', '10' => 'Loadout', '11' => 'Other');
                echo isset($options[$row->position]) ? $options[$row->position] : "N/A";
                ?>
            </div>
            <div class="phone_no phone_no25 ">
                <?php
                if ($row->visa_expiry_date == NULL or $row->visa_expiry_date == '0000-00-00') {
                    echo 'N/A';
                } else {
                    echo date("M d, Y", strtotime($row->visa_expiry_date));
                }
                ?>
            </div>
        </div>	
        <?php
    }
} else {
    ?>
    <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
    <?php
}
?>

<div class="pagination_new">
    <?php echo $this->jquery_pagination->create_links(); ?>
</div>
