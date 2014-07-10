
<?php if (!empty($users)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no phone_no25">AdminID</div>
        <div class="company pany_2">Contractor Name </div>
        <div class="company phone_no27">Place of work</div>
        <div class="Place_work Place_2">House Address</div>
        <div class="action action_25">Phone No</div>
        <div class="action action21">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($users as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="phone_no phone_no26"><?php echo $row->admin_id; ?></div> 
            <div class="company pany_2">
                <?php
                if ($user_detail['role'] <> 4) {
                    echo anchor('/users/editUser/' . $row->id . "/" . md5($row->id), $row->lastname . ', ' . $row->firstname, 'title = View Detail');
                } else {
                    echo $row->lastname . ", " . $row->firstname;
                }
                ?>
            </div>
            <div class="company pany_2">

                <?php
                $comp = $this->User->getWorksiteCompName($row->worksite_id);
                if ($comp == NULL) {
                    echo 'N/A';
                } else {
                    if ($user_detail['role'] <> 4) {
                        echo anchor('users/employeeInWorksite/' . $row->worksite_id, $comp);
                    } else {
                        echo $comp;
                    }
                }
                ?>
            </div>
            <div class="Place_work Place_2">
                <?php
                if ($row->rental_type == 'company') {
                    $house = $this->rent_model->get_houses_address($row->house_id);
                    if ($house == NULL) {
                        echo 'N/A';
                    } else {
                        echo $house;
                    }
                } else {
                    echo $row->non_comp_address;
                }
                ?>
            </div>
            <div class="action action_25">
                <?php
                if ($row->contact_no == NULL or $row->contact_no == '') {
                    echo 'N/A';
                } else {
                    echo $row->contact_no;
                }
                ?>
            </div>
            <div class="action action21">
                <?php //if($row->status == 0)echo anchor('users/activateUser/'.$row->id, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('users/deactivateUser/'.$row->id, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate');  ?>
                <?php
                echo anchor('/users/viewUser/' . $row->id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
                echo anchor('/users/deleteUserResign/' . $row->id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')"));
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

