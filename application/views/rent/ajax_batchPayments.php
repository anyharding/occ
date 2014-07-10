<?php if (!empty($rents)) { ?>
    <div class="power_mode_listing_head">
        <div class="address">House Address</div>
        <div class="action">Amount ($)</div>
        <div class="company">Payment Date</div>
    </div>	
    <?php
    $i = 0;
    foreach ($rents as $row) {
        ?>
        <div class="power_mode_listing
            <?php
             if ($row->paid == 'no') {
                 echo ' bold';
             }
             ?>
             ">
            <div class="address"><?php echo anchor('/users/employeeInHouse/' . $row->house_id, $this->rent_model->get_houses_address($row->house_id)); ?></div> 
            <div class="action"><?php echo $row->amount; ?></div>
            <div class="company"><?php echo $row->payment_date; ?></div>
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