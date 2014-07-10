<?php if (!empty($rents)) { ?>
    <div class="power_mode_listing_head">
        <div class="action"> <a class="select_all_rent" href="javascript:void(0)" onclick="checkedAll()">Select All</a></div>
        <div class="company">House Address</div>
        <div class="company">Worksite Name</div>
        <div class="action">Payment Amount ($) <span class="required1">*</span></div>
        <div class="action">Rent due date <span class="required1">*</span></div>
    </div>
    <form id="myform" onsubmit="return validate()" action="<?php echo HTTP_PATH . "rent/generateExcelFileBatch" ?>" method="post" >
        <?php
        $i = 0;
        foreach ($rents as $row) {
            ?>
            <div class="power_mode_listing">
                <div class="action"> 
                    <?php echo form_checkbox(array('name' => 'check[]', 'value' => '' . $row->id)); ?>
                </div>
                <div class="company"><?php echo anchor('/users/employeeInHouse/' . $row->house_id, $this->rent_model->get_houses_address($row->house_id)); ?></div> 
                <div class="company">
                    <?php $wishlist = $this->rent_model->get_worksite_name($row->house_id);
                    echo $wishlist ? $wishlist : "Not Available"
                    ?>
                </div>
                <div class="action">
                    <?php
                    $data = array(
                        'name' => "amount[$row->id][]",
                        'class' => 'textfield_input rate_hr3_due_date textfield_input required_true numeric',
                        'value' => $row->amount
                    );
                    echo form_input($data);
                    echo form_hidden("house_id[]", $row->house_id);
                    ?>
                </div>
                <div class="action">
                    <?php
                    $data = array(
                        'name' => "due_date[$row->id][]",
                        'readonly' => 'readonly',
                        'class' => 'textfield_input rate_hr3_due_date due_date required_true',
                        'value' => $row->payment_due_date
                    );
                    echo form_input($data);
                    ?>
                </div>
            </div>	
            <?php
        }
        ?>
        <div  class="user_name_3" style="margin-top: 10px">
            <div class="login_button_2">
                <input name="Submit" value="Submit" type="submit" class="input_submit" />
            </div>
        </div>
    </form>
    <?php
} else {
    ?>
    <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg">
    <?php
}
?>

<div class="pagination_new">
<?php echo $this->jquery_pagination->create_links(); ?>
</div>