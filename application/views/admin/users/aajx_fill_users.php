<td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <?php if (!empty($users)) { ?>
<!--            <tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="ListTable">
                        <thead>
                            <tr>
                                <th width="15%" class="bl">Employee ID</th>
                                <th width="15%" class="bl">Employee Name</th>
                                <th width="17%" class="bl">Email</th>
                                <th width="13%" class="bl">Place of work</th>
                                <th width="13%" class="bl">Phone No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $row) {
                                ?>
                                <tr>
                                    <td width="14%" class="bl"><?php echo $row->id; ?></td>
                                    <td width="14%" class="bl"><?php echo $row->lastname . ', ' . $row->firstname; ?></td>
                                    <td width="17%" class="bl"><?php echo $row->email; ?></td>
                                    <td width="13%" class="bl"><?php echo $this->user_model->getWorksiteCompName($row->worksite_id); ?></td>
                                    <td width="13%" class="bl"><?php echo $row->contact_no; ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>-->
            <tr>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                        <tr>
                            <td align="left"><a href="javascript: submitform2()" class="delete_all"><img src="<?php echo HTTP_PATH; ?>img/deleteBtn.png" width="109" height="42"></a></td>
                            <td align="left"><a href="javascript: submitform()"><div class="submit-button cancel">Cancel</div></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="alert_message" colspan="2">
                    <?php echo count($users); ?> will be deleted from the eCMS permanently, do you wish to continue? 
                </td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td colspan="9" align="center"><img style="margin-top: 20px;" src="<?php echo HTTP_PATH; ?>img/no-record.jpg"></td>
            </tr>
            <?php
        }
        ?>
    </table>
</td>