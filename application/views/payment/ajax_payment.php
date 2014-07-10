<?php if (!empty($payment)) { ?>
    <div class="power_mode_listing_head">
        <div class="action">BatchID</div>
        <div class="Place_work">Worksite </div>
        <div class="Place_work">Batch Payment Date</div>
        <div class="action">Batch Total</div>
        <div class="action">Action</div>
    </div>	
    <?php
    $i = 0;
    foreach ($payment as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="action"><?php echo $row->id; ?></div> 
            <div class="Place_work"><?php echo $row->company; ?></div>
            <div class="Place_work" ><?php echo anchor('/payment/viewPayment/' . $row->id . "/" . md5($row->id), date('M d, Y h:i A', $row->date), 'style="color: #333333;font:14px Arial,Helvetica,sans-serif"'); ?></div>
            <div class="action">$<?php echo $row->batch_total; ?></div>
            <div class="action">
                <?php
                echo anchor('/payment/viewPayment/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
                echo anchor('/payment/deletePayment/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')"));
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
