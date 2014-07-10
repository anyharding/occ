<div class="invoce_matter_bg">
    <div class="company_struchers">
        <div class="company_contents_left">
            <div class="comp_add" id="company_address">Please select company through dropdown</div>
            <div class="clr"></div>
            <div class="comp_step_tow" id="abn">A.B.N.: -- --- --- ---</div>
            <div class="comp_step_tow" id="acn">A.C.N.: -- --- --- ---</div>
        </div>
        <div class="company_contents_right">
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div class="invoce_matter_bg_first">
    <div class="company_struchers">
        <div class="company_contents_left">
            <div class="comp_add" id="employee_address">
                <?php echo $user_detail['firstname'] . " " . $user_detail['lastname']; ?>
                <?php
                echo form_hidden('payment_id', $payment['id']);
                ?>
            </div>
            <div class="clr"></div>
        </div>
        <div class="company_contents_right">
            <div class="comp_add_right">Recipient Created Tax Invoice<br />
                Purchase #: -------<br /></div>
            <div class="ship_to"></div>
            <div class="comp_add_right_ship" id="company_address1">
                Please select company through dropdown</div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
        <div class="table">
            <div class="table-row-heading">
                <div class="th width20">SALESPERSON</div>
                <div class="th width20">YOUR NO.</div>
                <div class="th width20">SHIP VIA</div>
                <div class="th width20">COL</div>
                <div class="th width20">PPD</div>
                <div class="th width20">SHIP DATE</div>
                <div class="th width20">TERMS</div>
                <div class="th width20">DATE</div>
                <div class="th width20">PG</div>
            </div>
            <div class="table-row-heading">
                <div class="th width20"></div>
                <div class="th width20"></div>
                <div class="th width20"></div>
                <div class="th width20"></div>
                <div class="th width20"></div>
                <div class="th width20"></div>
                <div class="th width20">Net 7 Days</div>
                <div class="th width20"><?php echo date('m/d/Y'); ?></div>
                <div class="th width20">1</div>
            </div>
            <div class="spacer"></div>
        </div>
        <div class="list_table">
            <div class="table-row alt">
                <div class="td width10 first"><div class="wd_inn1">QTY.</div></div>
                <div class="td width10"><div class="wd_inn2">ITEM NO.</div></div>
                <div class="td width30"><div class="wd_inn3">DESCRIPTION</div></div>
                <div class="td width5"><div class="wd_inn4">PRICE</div></div>
                <div class="td width10"><div class="wd_inn5">UNIT</div></div>
                <div class="td width10"><div class="wd_inn6">DISC %</div></div>
                <div class="td width10"><div class="wd_inn7">EXTENDED</div></div>
                <div class="td width5"><div class="wd_inn8">CODE</div></div>
            </div>
        </div>
        <div class="list_table">
            <div class="table-row alt">
                <div class="td width10 first"><div class="cwd_inn1"><?php echo $payment['hours']; ?></div></div>
                <div class="td width10"><div class="cwd_inn2"></div></div>
                <div class="td width30">Processing Units 1  </div>
                <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['hourly_rate']; ?></div></div>
                <div class="td width10"><div class="cwd_inn5"></div></div>
                <div class="td width10"><div class="cwd_inn6"></div></div>
                <div class="td width10"><div class="cwd_inn7">$<?php echo $payment['hours'] * $payment['hourly_rate']; ?></div></div>
                <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
            </div>
        </div>

        <?php
        $count = 1;
        if ($payment['overtime1'] * $payment['overtimeh1']) {
            $count += 1;
            ?>

            <div class="list_table">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1"><?php echo $payment['overtimeh1']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Processing Units <?php echo $count; ?>  </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['overtime1']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">$<?php echo $payment['overtime1'] * $payment['overtimeh1']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
            <?php
        }
        if ($payment['overtime2'] * $payment['overtimeh2']) {
            $count += 1;
            ?>

            <div class="list_table">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1"><?php echo $payment['overtimeh2']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Processing Units <?php echo $count; ?> </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['overtime2']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">$<?php echo $payment['overtime2'] * $payment['overtimeh2']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
            <?php
        }
        if ($payment['overtime3'] * $payment['overtimeh3']) {
            $count += 1;
            ?>

            <div class="list_table">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1"><?php echo $payment['overtimeh3']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Processing Units <?php echo $count; ?>  </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['overtime3']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">$<?php echo $payment['overtime3'] * $payment['overtimeh3']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
            <?php
        }
        if ($payment['rent_deduction']) {
            ?>
            <div class="list_table">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1">1</div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Labour Subcontract Rent Deduction </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['rent_deduction']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">-$<?php echo $payment['rent_deduction']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
        <?php } ?>
        <?php
        if ($payment['transport_deduction']) {
            ?>
            <div class="list_table last">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1">1</div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Transport Fee Deduction </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['transport_deduction']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">-$<?php echo $payment['transport_deduction']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
        <?php } ?>
        <?php
        if ($payment['other_deduction']) {
            ?>
            <div class="list_table last">
                <div class="table-row alt">
                    <div class="td width10 first"><div class="cwd_inn1">1</div></div>
                    <div class="td width10"><div class="cwd_inn2"></div></div>
                    <div class="td width30">Other Deduction </div>
                    <div class="td width5"><div class="cwd_inn4">$<?php echo $payment['other_deduction']; ?></div></div>
                    <div class="td width10"><div class="cwd_inn5"></div></div>
                    <div class="td width10"><div class="cwd_inn6"></div></div>
                    <div class="td width10"><div class="cwd_inn7">-$<?php echo $payment['other_deduction']; ?></div></div>
                    <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
                </div>
            </div>
        <?php } ?>
        <div class="list_table last" id="appendst">
            <div class="table-row alt">
                <div class="td width10 first"><div class="cwd_inn1">1</div></div>
                <div class="td width10"><div class="cwd_inn2"></div></div>
                <div class="td width30"><div class="cwd_inn3">
                        <?php
                        $array = array(
                            '' => 'Select',
                            2 => 'Processing Units 2',
                            3 => 'Processing Units 3',
                            4 => 'Processing Units 4',
                            5 => 'Processing Units 5',
                            6 => 'Processing Units 6',
                            7 => 'Processing Units 7',
                            8 => 'Processing Units 8',
                            9 => 'Processing Units 9',
                            10 => 'Rent Bond Deduction'
                        );
                        echo form_dropdown('description', $array, '', 'id="description"');
                        ?>
                    </div> </div>
                <div class="td width5"><div class="cwd_inn4" id="prize1">$0</div></div>
                <div class="td width10"><div class="cwd_inn5"></div></div>
                <div class="td width10"><div class="cwd_inn6"></div></div>
                <div class="td width10"><div class="cwd_inn7" id="ex1"></div></div>
                <div class="td width5 last"><div class="cwd_inn8">N-T</div></div>
            </div>
        </div>
        <div class="list_table_2">
            <div class="table-row alt_one">
                <div class="td width10 first"><div class="lwd_inn1">COMMENT<br />
                        <?php echo form_textarea("comment", $payment['comment'], 'style="margin-top: 2px; width: 169px;margin-bottom: 2px; height: 72px;"'); ?>
                        <?php //echo $payment['comment']; ?> 

                    </div></div>
                <div class="td width30"><div class="lwd_inn3">CODE<br />GST<br /><br />N-T</div></div>
                <div class="td width5"><div class="lwd_inn4">RATE<br />10%<br />0%</div></div>
                <div class="td width10"><div class="lwd_inn5">GST<br />$<?php echo $payment['gross_amount'] * 10 / 100; ?></div></div>
                <div class="td width10"><div class="lwd_inn6">SALE AMOUNT</div></div>
                <div class="td width10"><div class="lwd_inn7">GROSS AMOUNT<br />FREIGHT<br />GST<br />TOTAL<br />PAID TODAY</div></div>
                <div class="td width5"><div class="lwd_inn8">$<?php echo $payment['gross_amount']; ?><br />$0.00<br>$<?php echo $payment['gross_amount'] * 10 / 100; ?> GST<br /><input type="hidden" value="<?php echo $payment['total_payment_amount']; ?>" id="total_text"><span id="total_amount">$<?php echo $payment['total_payment_amount']; ?></span><br />$0.00</div></div>
            </div>
        </div>
        <div class="list_table_3">
            <div class="table-row alt_three">
                <div class="login_button_3">
                    <input type="submit" class="input_submit" value="Save" name="Button">
                </div>
                <div class="login_button_3">
                    <input type="button" class="input_submit" onclick="window.location.href='<?php echo HTTP_PATH . "invoice/listinvoices" ?>'" value="Back" name="Button">
                </div>
            </div>
        </div>
    </div>
</div>