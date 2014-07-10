<?php if (!empty($rents)) { ?>
    <div class="power_mode_listing_head">
        <div class="action"> <a class="select_all_rent" href="javascript:void(0)" onclick="checkedAll()">Select All</a></div>
        <div class="action sort_1 company" alt="company" order="asc">Worksite Name <div class="icon"></div></div>
        <div class="address_rent house_address_name">House Address</div>
        <div class="action">Amount ($)</div>
        <div class="action">Payment Date</div>
        <div class="action">Action</div>
    </div>
    <form id="myform" onsubmit="return validate()" action="<?php echo HTTP_PATH . "rent/generateExcelFile" ?>" method="post" >
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
                <div class="action"> 
                    <?php
                    if ($row->paid == 'no')
                        echo form_checkbox(array('name' => 'check[]', 'value' => '' . $row->id, 'class' => 'checkbox'));
                    else
                        echo form_checkbox(array('name' => 'check[]', 'value' => '' . $row->id, 'class' => 'checkbox', 'paid' => 'yes'));
                    ?>
                </div>
                <div class="phone_no">
                    <?php
                    echo $this->rent_model->get_worksite_name($row->house_id);
                    echo form_hidden("amount[]", $row->amount);
                    echo form_hidden("house_id[]", $row->house_id);
                    ?>
                </div>
                <div class="address_rent house_address_name"><?php echo anchor('/users/employeeInHouse/' . $row->house_id, $this->rent_model->get_houses_address($row->house_id)); ?></div> 
                <div class="phone_no">
                    <?php
                    echo $row->amount;
                    echo form_hidden("amount[]", $row->amount);
                    echo form_hidden("house_id[]", $row->house_id);
                    ?>
                </div>
                <div class="phone_no"><?php echo $row->payment_date; ?></div>
                <div class="action">
                    <?php echo anchor('/rent/editrent/' . $row->id . "/" . $row->amount . "/" . $row->created, "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit'); ?> <?php echo anchor('/rent/deleterent/' . $row->id . "/" . $row->amount . "/" . $row->created, "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?>
                </div>
            </div>	
            <?php
        }
        ?>
        <div  class="user_name_3" style="margin-top: 10px;float: left">

            <div style="margin-top: 0px;float: left;width: 70px;">
                <input name="Submit" value="Paid" type="button" class="input_submit_excel_1" />
            </div>
            <div class="login_button_2" style="float: left">
                <input name="Submit" value="Generate Excel file" type="submit" class="input_submit_excel" />
            </div>
        </div>
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