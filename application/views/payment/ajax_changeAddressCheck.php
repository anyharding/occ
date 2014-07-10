<?php if (!empty($users)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no phone_no25 emp_id">Contractor ID</div>
        <div class="company emp_name">Contractor Name </div>
        <div class="company pany_2 place_of_work">Place of work</div>
        <div class="Place_work Place_2 house_address">House Address</div>
        <div class="action 
        <?php if ($this->session->userdata('day') <> 'thee_more') {
            ?>
                 non_comp_address
             <?php }
             ?>
             ">Non company house address</div>
        <div class="action contact_no">Contact No</div>
        <?php if ($this->session->userdata('day') == 'thee_more') {
            ?>
            <div class="action contact_no ">Last Update</div>
        <?php }
        ?>
    </div>	
    <?php
    $i = 0;
    foreach ($users as $row) {
        ?>
        <div class="power_mode_listing address_check">
            <div class="phone_no phone_no25 emp_id"><?php echo $row->id; ?></div> 
            <div class="company emp_name"><?php echo anchor('/users/editUser/' . $row->id . "/" . $row->firstname . "/" . $row->lastname . "/" . $row->house_id, $row->lastname . ', ' . $row->firstname, 'title = View Detail'); ?></div>
            <div class="company pany_2 place_of_work">
                <?php
                $comp = $this->User->getWorksiteCompName($row->worksite_id);
                if ($comp == NULL) {
                    echo 'N/A';
                } else {
                    echo anchor('users/employeeInWorksite/' . $row->worksite_id, $comp);
                }
                ?>
            </div>
            <div class="Place_work Place_2 house_address">
                <?php
                $house = $this->rent_model->get_houses_address($row->house_id);
                if ($house == NULL) {
                    echo 'N/A';
                } else {
                    echo $this->rent_model->get_houses_address($row->house_id);
                }
                ?>
            </div>
            <div class="action <?php if ($this->session->userdata('day') <> 'thee_more') {
                    ?>
                     non_comp_address
                 <?php }
                 ?>">
                     <?php
                     echo $row->non_comp_address ? $row->non_comp_address : "N/A";
                     ?>
            </div>
            <div class="action contact_no">
                <?php
                echo $row->contact_no ? $row->contact_no : "N/A";
                ?>
            </div>
            <?php if ($this->session->userdata('day') == 'thee_more') {
                ?>
                <div class="action contact_no">
                    <?php
                    if ($row->address_update_date == "") {
                        echo 'N/A';
                    } else {
                        echo date("M d, Y", strtotime($row->address_update_date));
                    }
                    ?>
                </div>
            <?php }
            ?>
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
