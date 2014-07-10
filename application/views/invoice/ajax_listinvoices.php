<?php
$payment = $invoice;
if (!empty($payment)) {
    ?>
    <div class="power_mode_listing_head">
        <div class="Place_work">Invoice Id</div>
        <div class="action">Contractor </div>
        <div class="company">Company </div>
        <div class="action">Gross Wage Amount</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($payment as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="Place_work">#<?php
        echo str_pad($row->invoice_id, 3, "0", STR_PAD_LEFT);
        ?>
            </div> 
            <div class="action"><?php echo $row->firstname . " " . $row->lastname; ?></div>
            <div class="company"><?php echo $row->company; ?></div>
            <div class="action">$<?php echo $row->gross_amount; ?></div>
            <div class="action">
                <?php
                echo anchor('/invoice/viewInvoice/' . $row->invoice_id . "/" . md5($row->invoice_id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View') . ' ';
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