

<?php if (!empty($users)) { ?>
    <div class="power_mode_listing_head">
        <div class="phone_no">HR ID</div>
        <div class="company">Name </div>
        <div class="Place_work Place_work_2">Phone No</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($users as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="phone_no"><?php echo $row->id; ?></div> 
            <div class="company"><?php echo $row->lastname . ', ' . $row->firstname; ?></div>
            <div class="Place_work Place_work_2"><?php
        if ($row->contact_no == NULL) {
            echo 'N/A';
        } else {
            echo $row->contact_no;
        }
        ?></div>
            <div class="action">
                <?php //if($row->status == 0)echo anchor('users/activateUser/'.$row->id, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('users/deactivateUser/'.$row->id, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate');  ?>
                <?php echo anchor('/users/viewHR/' . $row->id . "/" . $row->lastname . "/" . $row->house_id . "/" . $row->firstname, "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' '; //echo anchor('/users/editHR/'.$row->id, "<img src=".HTTP_PATH."img/edit1.gif"."  border='0'>",  'title = Edit');   ?> <?php //echo anchor('/users/deleteHR/'.$row->id, "<img src=".HTTP_PATH."img/icon2.png"." width='16' height='16' border='0'>",  array('title' => 'Delete','onclick'=>"return confirm('Are you sure you want to delete?')"));   ?>
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

