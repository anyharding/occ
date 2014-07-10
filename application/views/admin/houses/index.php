<script>
    checked = false;
    function checkedAll () {
        if (checked == false){checked = true}else{checked = false}
        for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
            document.getElementById('myform').elements[i].checked = checked;
        }
    }
    function submitform()
    {
        document.forms["myform"].submit();
    }
    function submitform1()
    {
        document.forms["myform"].action = "<?php if ($this->uri->segment(3) == 'advOwners') echo base_url() . 'admin/houses/deactivateallhouse/advOwners'; else echo base_url() . 'admin/houses/deactivateallhouse'; ?>";
        document.forms["myform"].submit();
    }
    function submitform2()
    {
        document.forms["myform"].action = "<?php echo base_url() . 'admin/houses/deleteallhouse'; ?>";
        document.forms["myform"].submit();
    }
    
</script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"> </script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.tablesorter.js"> </script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/sort_style.css'; ?>" type="text/css" />
<script type="text/javascript">

    //$(function() {
    //       $("table").tablesorter({debug: true});
    //});
    $(document).ready(function() 
    { 
        $("#ListTable").tablesorter();
    }   
); 

</script>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > List Houses</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                    </tr>
                </table></td>
        </tr>
        <?php
        if (!empty($houses)) {
            ?>
            <tr>
                <td class="paging"><?php echo $this->pagination->create_links(); ?></td>
            </tr>
            <tr>
                <td colspan="9"><?php if (validation_errors() || $this->session->userdata('message') || $this->session->flashdata('message')) { ?>
                        <div class='ActionMsgBox error' id='msgID' style='margin:10 10 0 0;margin-top: 10px;'>
                            <?php
                            echo validation_errors();
                            echo $this->session->flashdata('message');
                            ?>
                        </div>
                    <?php }
                    ?>
                    <?php if ($this->session->userdata('smessage') || $this->session->flashdata('smessage')) { ?>
                        <div class='ActionMsgBox success' id='msgID'>
                            <?php
                            //
                            echo $this->session->userdata('smessage');
                            echo $this->session->flashdata('smessage');
                            $this->session->unset_userdata('smessage');
                            ?>
                        </div>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><?php echo form_open('/admin/houses/activateallhouse', array('id' => 'myform')); ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="ListTable">
                                    <thead>
                                        <tr>
                                            <?php
                                            if ($this->uri->segment(3) <> 'housesInWorksite') {
                                                ?>
                                                <th width="12%" class="bll">
                                                    <?php echo anchor('#', 'Select All', array('onclick' => 'checkedAll()')); ?>
                                                </th>
                                            <?php }
                                            ?>
                                            <th width="14%" class="bl">House Id</th>
                                            <th width="14%" class="bl">Address</th>
                                            <th width="14%" class="bl">Realtor Company name</th>
                                            <th width="17%" class="bl">Realtor name</th>
                                            <th width="13%" class="bl">Realtor account number</th>
                                            <?php
                                            if ($this->uri->segment(3) <> 'housesInWorksite') {
                                                ?>
                                                <th width="13%" class="bll last">Action</th>
                                            <?php }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($houses as $row) {
                                            if ($this->uri->segment(3) == 'advOwners')
                                                $link = "/advOwners";else
                                                $link = '';
                                            ?>
                                            <tr>
                                                <?php
                                                if ($this->uri->segment(3) <> 'housesInWorksite') {
                                                    ?>
                                                    <td width="2%" class="bl"><?php echo form_checkbox(array('name' => 'check[]', 'value' => '' . $row->id)); ?></td><?php } ?>

                                                <td width="14%" class="bl"><?php echo $row->id; ?></td>
                                                <td width="14%" class="bl"><?php echo $row->address; ?></td>
                                                <td width="14%" class="bl"><?php echo $row->company_name; ?></td>
                                                <td width="17%" class="bl"><?php echo $row->realtor_name; ?></td>
                                                <td width="13%" class="bl"><?php echo $row->realtor_account; ?></td>
                                                <?php
                                                if ($this->uri->segment(3) <> 'housesInWorksite') {
                                                    ?>
                                                    <td width="13%" class="bl last"><?php if ($row->status == 0) echo anchor('admin/houses/activatehouse/' . $row->id . $link, "<img src=" . HTTP_PATH . "img/accept.png" . " width='16' height='16' border='0'>", 'title = Activate'); else echo anchor('admin/houses/deactivatehouse/' . $row->id . $link, "<img src=" . HTTP_PATH . "img/icon1.png" . " width='16' height='16' border='0'>", 'title = Deactivate'); ?>
                                                        <?php echo anchor('/admin/houses/edithouse/' . $row->id, "<img src=" . HTTP_PATH . "img/edit1.gif" . "  border='0'>", 'title = Edit'); ?><?php echo anchor('/admin/users/employeeInHouse/' . $row->id, "<img src=" . HTTP_PATH . "img/user.png" . " width='16' height='16'  border='0'>", 'title = "Tenants List"'); ?> <?php echo anchor('/admin/houses/deletehouse/' . $row->id . $link, "<img src=" . HTTP_PATH . "img/icon2.png" . " width='16' height='16' border='0'>", array('title' => 'Delete', 'onclick' => "return confirm('Are you sure you want to delete?')")); ?></td><?php } ?>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table></td>
                            <?php
                            if ($this->uri->segment(3) <> 'housesInWorksite') {
                                ?>
                            <tr>
                                <td><table border="0" cellspacing="0" cellpadding="0" class="NoDataTable">
                                        <tr>
                                            <td align="left"><a href="javascript: submitform()"><img src="<?php echo HTTP_PATH; ?>img/activeBtn.png" width="109" height="42"></a></td>
                                            <td align="left"><a href="javascript: submitform1()"><img src="<?php echo HTTP_PATH; ?>img/deactiveBtn.png" width="107" height="41"></a></td>
                                            <td><td align="left"><a href="javascript: submitform2()"><img src="<?php echo HTTP_PATH; ?>img/deleteBtn.png" width="109" height="42"></a></td></td>
                                        </tr>
                                    </table>
                                <?php } echo form_close(); ?></td>
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
                </table></td>
        </tr>
    </table></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 