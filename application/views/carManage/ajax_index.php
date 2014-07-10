<?php if (!empty($cars)) { ?>
    <div class="power_mode_listing_head">
        <div class="action_vin">Car Username</div>
        <div class="action_vin">Car Make</div>
        <div class="action_vin">Car Model</div>
        <div class="action_vin">Rego expiry </div>
        <div class="action_vin">Insurance cover end date </div>
        <div class="action_vin" style="width:50px;">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($cars as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="action_vin"><?php echo $this->car_model->getUsername($row->car_username); ?></div> 
            <div class="action_vin"><?php if ($row->car_make <> NULL) echo anchor('/carManage/editCar/' . $row->id . "/" . $row->licence_no . "/" . $row->policy_no, $row->car_make, 'title = Edit'); else echo anchor('/carManage/editCar/' . $row->id . "/" . $row->licence_no . "/" . $row->policy_no, "N/A", 'title = Edit'); ?></div>
            <div class="action_vin"><?php if ($row->model <> NULL) echo anchor('/carManage/editCar/' . $row->id . "/" . $row->licence_no . "/" . $row->policy_no, $row->model, 'title = Edit'); else echo anchor('/carManage/editCar/' . $row->id . "/" . $row->licence_no . "/" . $row->policy_no, "N/A", 'title = Edit'); ?></div>
            <div class="action_vin"><?php if ($row->rego_exp_date <> NULL) echo $row->rego_exp_date; else echo "N/A"; ?></div>
            <div class="action_vin"><?php if ($row->insurance_end_date <> NULL) echo $row->insurance_end_date; else echo "N/A"; ?></div>
            <div class="action_vin" style="width:auto;">
                <?php
                echo anchor('/carManage/viewCarDetail/' . $row->id . "/" . $row->car_make, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
                ?>
                <?php
                echo anchor('/carManage/editCar/' . $row->id . "/" . $row->licence_no . "/" . $row->policy_no, "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = View') . ' ';
                ?>
                <?php echo anchor('/carManage/deleteCar/' . $row->id . "/" . md5($row->id), "<img width='14' src=" . HTTP_PATH . "img/delete.png" . "  border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?>

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