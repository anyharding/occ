<?php if (!empty($household)) { ?>
    <div class="power_mode_listing_head">
        <div class="Email">Household Category </div>
        <div class="action">Purchase Date</div>
        <div class="Place_work_2">House Address</div>
        <div class="action">Action</div>

    </div>	
    <?php
    $i = 0;
    foreach ($household as $row) {
        ?>
        <div class="power_mode_listing">
            <div class="Email">
                <?php
                echo $this->household_model->getCategoryName($row->category);
                ?>
            </div> 
            <div class="action"><?php echo date('d M, Y', strtotime($row->purchase_time)); ?></div>
            <div class="Place_work_2">
                <?php
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/household/edithousehold/' . $row->id . "/" . $row->purchase_receipt . "/" . $row->shop_name, $this->rent_model->get_houses_address($row->house_id), 'title = "' . $row->description . '"');
                else
                    echo $this->rent_model->get_houses_address($row->house_id);
                ?>
            </div>

            <div class="action">
                <?php //if($row->status == 0)echo anchor('household/activatehousehold/'.$row->id, "<img src=".HTTP_PATH."img/accept.png"." width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('household/deactivatehousehold/'.$row->id, "<img src=".HTTP_PATH."img/icon1.png"." width='16' height='16' border='0'>", 'title = Deactivate'); ?>
                <?php
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/household/edithousehold/' . $row->id . "/" . $row->purchase_receipt . "/" . $row->shop_name, "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit');
                if ($this->session->userdata('role') == 'poweruser')
                    echo anchor('/household/deletehousehold/' . $row->id . "/" . $row->purchase_receipt . "/" . $row->shop_name, "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')"));
                else
                    echo anchor('/household/viewHousehold/' . $row->id . "/" . md5($row->id), "<img src=" . HTTP_PATH . "img/view.png" . "  border='0'>", 'title = View');
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
