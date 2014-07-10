<script>
    checked = false;
    function checkedAll () {
        if (checked == false){checked = true}else{checked = false}
        for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
            document.getElementById('myform').elements[i].checked = checked;
        }
    } 
</script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery-latest.js"> </script>
<script type="text/javascript" src="<?php echo HTTP_PATH; ?>js/jquery.tablesorter.js"> </script>
<link rel="stylesheet" href="<?php echo HTTP_PATH . 'css/sort_style.css'; ?>" type="text/css" />
<script type="text/javascript">
    $(document).ready(function() 
    { 
        $("#ListTable").tablesorter();
        $("#select_method").change(function(){
            if(this.value == '1') {   
                $("#msgID").hide();
                $("#msgID1").hide();
                $(".load_cond").html("<div class='inner_content'><div class='flush-label'>Clear all old employee entries</div><div class='submit-button' id='submit-button'>Submit</div></div>");
            }
            if(this.value == '2') {     
                $("#msgID").hide();
                $("#msgID1").hide();            
                $(".fill_data").html("");
                $("#loading-image").hide();
                $(".load_cond").html("");
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'admin/users/getworksites/'; ?>",
                    type: 'POST',
                    cache: false,
                    success: function(data)
                    {
                        $(".load_cond").html(data);
                        $("#loading-image").hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        alert('Error while contacting server, please try again');
                    },
                    beforeSend:function(){
                        $("#loading-image").show();
                    }
                }); 
            }
            if(this.value == '') {    
                $("#msgID").hide();
                $("#msgID1").hide();        
                $(".fill_data").html("");
                $("#loading-image").hide();
                $(".load_cond").html("");
                $("#select_method").val("");
            }
        });
        
        $("#submit-button").live("click", function(){
            $.ajax({
                url: "<?php echo HTTP_PATH . 'admin/users/getOldUsers/'; ?>",
                type: 'POST',
                cache: false,
                success: function(data)
                {
                    $(".fill_data").html(data);
                    $("#loading-image").hide();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error while contacting server, please try again');
                },
                beforeSend:function(){
                    $("#loading-image").show();
                }
            });            
        });
        
        $(".select_worksite").live("change", function(){
            if(this.value) {
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'admin/users/getOldUsersWorksite/'; ?>"+this.value,
                    type: 'POST',
                    cache: false,
                    success: function(data)
                    {
                        $(".fill_data").html(data);
                        $("#loading-image").hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        alert('Error while contacting server, please try again');
                    },
                    beforeSend:function(){
                        $("#loading-image").show();
                    }
                }); 
            } else {
            
                $(".fill_data").html("");
            }
        });
        
        $(".cancel").live("click", function(){
            $("#msgID").hide();
            $("#msgID1").hide();    
            $(".load_cond").html("");
            $(".fill_data").html("");
            $("#select_method").val("");
        });
        
        $(".delete_all").live("click", function(){
            $.ajax({
                url: "<?php echo HTTP_PATH . 'admin/users/deleteall/'; ?>",
                type: 'POST',
                cache: false,
                success: function(data)
                {
                    $(".fill_data").html("");
                    $("#loading-image").hide();
                    $(".load_cond").html("");
                    $("#select_method").val("");
                    $("#msgID").text(data+" employee entries successfully deleted").show();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error while contacting server, please try again');
                },
                beforeSend:function(){
                    $("#loading-image").show();
                }
            });            
        });
        
        $(".delete_all_worksite").live("click", function(){        
            var values = $('input:checkbox:checked').map(function () {
                return this.value;
            }).get(); 
            if(values == ''){
                $("#msgID1").html("Please select atleast one employee ").show();
            } else {
                $("#msgID1").hide();                
                $.ajax({
                    url: "<?php echo HTTP_PATH . 'admin/users/deleteallSelected/'; ?>",
                    type: 'POST',
                    cache: false,
                    data: "id="+values,
                    success: function(data)
                    {
                        $(".fill_data").html("");
                        $("#loading-image").hide();
                        $(".load_cond").html("");
                        $("#select_method").val("");
                        $("#msgID").text(data+" employee entries successfully deleted").show();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        alert('Error while contacting server, please try again');
                    },
                    beforeSend:function(){
                        $("#loading-image").show();
                    }
                });
            }
                    
        });
    });
</script>

<div style="display: none;" class="load-image" id="loading-image">
    <?php echo img('img/loading4.gif'); ?> 
</div>
<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tl-blue.png" width="8" height="32"></td>
                        <td class="breadcrumb">Administrator > Flush Old Employees</td>
                        <td width="8"><img src="<?php echo HTTP_PATH; ?>img/tr-blue.png" width="8" height="32"></td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td colspan="9" height="70" valign="middle">
                <div class="Block table">
                    <div class="BlockContent">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="DataTable">
                            <tr>
                                <th>Please select option to flush old employees</th>
                            </tr>
                            <tr>
                                <td  height="80">
                                    <?php
                                    $array = array("" => 'Please Select', '1' => 'All Employees', '2' => 'By Worksite');
                                    echo form_dropdown("select_method", $array, "", "id='select_method' style='width:400px'")
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="load_cond">

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="9">
                <div class='ActionMsgBox success' id='msgID' style="display:none"> </div>
                <div class='ActionMsgBox error' id='msgID1' style="display:none"> </div>
            </td>
        </tr>
        <tr class="fill_data">

        </tr>
    </table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr> 