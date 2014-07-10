
<?php if (!empty($worksites)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no phone_no25">Worksite Id</div>
        <div class="houses">Company</div>
        <div class="phone_no">No Of Contractors </div>
        <div class="houses">No Of Houses Assigned</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($worksites as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="phone_no phone_no25"><?php echo $row->id; ?></div>
            <div class="houses"><?php echo $row->company; ?></div> 
            <div class="phone_no"><?php echo anchor('/users/employeeInWorksite/' . $row->id, $this->worksite_model->noOfEmployees($row->id)); ?></div>
            <div class="houses"><?php echo anchor('/houses/housesInWorksite/' . $row->id, $this->worksite_model->noOfHouses($row->id)); ?></div>

            <div class="action">
                <?php //if($row->status == 0)echo anchor('worksite/activateworksite/'.$row->id, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('worksite/deactivateworksite/'.$row->id, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate'); ?>
                <?php echo anchor('/worksite/editworksite/' . $row->id . "/" . $row->company . "/" . $row->site_rate_name7, "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit'); ?> <?php echo anchor('/worksite/deleteworksite/' . $row->id . "/" . $row->company . "/" . $row->site_rate_name7, "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?>
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