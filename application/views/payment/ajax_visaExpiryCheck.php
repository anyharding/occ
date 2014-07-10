<?php if (!empty($users)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no phone_no25">AdminID</div>
        <div class="company">Contractor Name </div>
        <div class="company pany_2">Place of work</div>
        <div class="Place_work Place_2">House Address</div>
        <div class="action ">Visa Expiry Date</div>

    </div>	
    <?php
    $i = 0;
    foreach ($users as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="phone_no"><?php echo $row->admin_id; ?></div> 
            <div class="company pany_2_2_new2"><?php echo anchor('/users/editUser/' . $row->id . "/" . $row->firstname . "/" . $row->lastname . "/" . $row->house_id, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?></div>
            <div class="company pany_2">
                <?php
                $comp = $this->User->getWorksiteCompName($row->worksite_id);
                if ($comp == NULL) {
                    echo 'N/A';
                } else {
                    echo anchor('users/employeeInWorksite/' . $row->worksite_id, $comp);
                }
                ?>
            </div>
            <div class="Place_work Place_2">
                <?php
                $house = $this->rent_model->get_houses_address($row->house_id);
                if ($house == NULL) {
                    echo 'N/A';
                } else {
                    echo $this->rent_model->get_houses_address($row->house_id);
                }
                ?>
            </div>
            <div class="action ">
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
