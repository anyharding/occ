
<td>
    <script>
        checked = false;
        function checkedAll () {
            if (checked == false){checked = true}else{checked = false}
            for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
                document.getElementById('myform').elements[i].checked = checked;
            }
        }
    </script>
    <form id="myform" style="display: block">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
            <?php if (!empty($users)) { ?>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="ListTable">
                            <thead>
                                <tr>
                                    <th width="12%" class="bll">
                                        <a href="javascript:void(0)" onclick="checkedAll()">Select All</a>
                                    </th>
                                    <th width="15%" class="bl">Employee Name</th>
                                    <th width="17%" class="bl">Last Update Date</th>
                                    <th width="13%" class="bl">Worksite Name</th>
                                    <th width="13%" class="bl">Description of final position</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($users as $row) {
                                    ?>
                                    <tr>
                                        <td width="2%" class="bl"><?php echo form_checkbox(array('name' => 'check[]', 'value' => '' . $row->id)); ?></td>
                                        <td width="14%" class="bl"><?php echo $row->lastname . ', ' . $row->firstname; ?></td>
                                        <td width="17%" class="bl">
                                            <?php
                                            echo $row->last_update <> '0000-00-00 00:00:00' ? date("M d, Y h:i a", strtotime($row->last_update)) : "N/A";
                                            ?>
                                        </td>
                                        <td width="13%" class="bl"><?php echo $this->user_model->getWorksiteCompName($row->worksite_id); ?></td>
                                        <td width="13%" class="bl"><?php echo $row->final_position ? $row->final_position : "N/A"; ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                            <tr>
                                <td align="left"><a href="javascript: submitform2()" class="delete_all_worksite"><img src="<?php echo HTTP_PATH; ?>img/deleteBtn.png" width="109" height="42"></a></td>
                                <td align="left"><a href="javascript: submitform()"><div class="submit-button cancel">Cancel</div></a></td>
                            </tr>
                        </table>
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
    </form>
</td>