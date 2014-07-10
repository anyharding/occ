<?php
if (!empty($paycompany)) {
    ?>
    <div class="power_mode_listing_head">
        <div class="Place_work">Account Name</div>
        <div class="action">IF Code </div>
        <div class="company">Account Number  </div>
        <div class="action">BSB</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($paycompany as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="Place_work">
                <?php
                echo $row->account_name;
                ?>
            </div> 
            <div class="action"><?php echo $row->if_code; ?></div>
            <div class="company"><?php echo $row->account_number; ?></div>
            <div class="action"><?php echo $row->bsb; ?></div>
            <div class="action">
                <?php
                echo anchor('/paycompany/editCompany/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit') . ' ';
                ?>
                <?php echo anchor('/paycompany/deleteCompany/' . $row->id . "/" . md5($row->id), "<img width='14' src=" . HTTP_PATH . "img/delete.png" . "  border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?>

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