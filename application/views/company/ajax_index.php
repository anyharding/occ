<?php
if (!empty($company)) {
    ?>
    <div class="power_mode_listing_head">
        <div class="Place_work">Company</div>
        <div class="action">Address </div>
        <div class="company">ABN </div>
        <div class="action">ACN</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($company as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="Place_work">
                <?php
                echo $row->company;
                ?>
            </div> 
            <div class="action"><?php echo $row->address; ?></div>
            <div class="company"><?php echo $row->abn; ?></div>
            <div class="action"><?php echo $row->acn; ?></div>
            <div class="action">
                <?php
                echo anchor('/company/editCompany/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit') . ' ';
                ?>
                <?php echo anchor('/company/deleteCompany/' . $row->id . "/" . md5($row->id), "<img width='14' src=" . HTTP_PATH . "img/delete.png" . "  border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?>

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