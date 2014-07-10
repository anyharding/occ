<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Payment Details</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="Block table">
                    <div class="BlockContent">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                            <tr>
                                <th> Payment Details</th>
                            </tr>
                            <tr><td colspan="2" align="center">

                                    <?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                                        <div class='ActionMsgBox error' id='msgID'>
                                            <?php
                                            echo validation_errors();
                                            echo $this->session->userdata('message');
                                            echo $this->session->flashdata('message');
                                            $this->session->unset_userdata('message');
                                            ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
                                        <div class='ActionMsgBox success' id='msgID'>
                                            <?php
                                            echo $this->session->userdata('smessage');
                                            echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage');
                                            ?>
                                        </div>
                                    <?php } ?>
                                </td></tr>
                            <tr>
                                <td>
                                    <table align="center" width="60%" border="0" cellspacing="0" cellpadding="0">

                                        <tr>
                                            <td width="200"><b>Transaction Id</b> <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                echo $payment['id'];
                                                ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Employee Name </b><span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                echo $payment['firstname'] . " " . $payment['lastname'];
                                                ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Worksite Name</b><span class="required"></span>:</td>
                                            <td><?php
                                                echo $payment['company'];
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Hourly Rate</b> <span class="required"></span>:</td>
                                            <td>$
                                                <?php
                                                echo $payment['hourly_rate'];
                                                ?> 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="200"><b>Hours Worked</b> <span class="required"></span>:</td>
                                            <td>
                                                <?php
                                                echo $payment['hours'];
                                                ?> Hours
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Gross Wage Amount</b> :</td>
                                            <td>$
                                                <?php
                                                echo $payment['gross_amount'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Overtime 1 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtime1'];
                                                ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>OT Hour 1 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtimeh1'];
                                                ?> Hours
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Overtime 2 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtime2'];
                                                ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>OT Hour 2 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtimeh2'];
                                                ?> Hours
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Overtime 3 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtime3'];
                                                ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>OT Hour 3 </b>:</td>
                                            <td>
                                                <?php
                                                echo $payment['overtimeh3'];
                                                ?> Hours
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Net Payment Amount </b>:</td>
                                            <td>$
                                                <?php
                                                echo $payment['net_payment'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Rent Deduction </b>:</td>
                                            <td>$
                                                <?php
                                                echo $payment['rent_deduction'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Transport Deduction </b>:</td>
                                            <td>$
                                                <?php
                                                echo $payment['transport_deduction'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Other Deductions</b> :</td>
                                            <td>$
                                                <?php
                                                echo $payment['other_deduction'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Total Payment Amount</b> :</td>
                                            <td>$
                                                <?php
                                                echo $payment['total_payment_amount'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Other Payments</b> :</td>
                                            <td>$
                                                <?php
                                                echo $payment['other_payments'];
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200"><b>Date</b>:</td>
                                            <td>
                                                <?php
                                                echo date('M d, Y', $payment['date']);
                                                ?>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>                      
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
