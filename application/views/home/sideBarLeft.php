<script>
    function validateForm1()
    {
    var x=document.forms["myForm"]["email"].value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
    alert("-Please Enter valid e-mail address");
    return false;
    }
}
</script>
<div class="side_bar_left">
<img src="<?php echo HTTP_PATH;?>img/select_a_category.jpg" alt="" />
<div class="left_side_bar">
<ul>
<?php
for($i = 0; $i < count($categories); $i++) 
{
    if(count($categories)-1 == $i) {
    ?><li class="end_list"> <a href="<?php echo HTTP_PATH.'advertisement/addvList/'.$categories[$i]['category_name'].'/ALL/l/lat'; ?>"><span class="cat_icon1"><img src="<?php echo HTTP_PATH;?><?php if($categories[$i]['image'] == NULL or $categories[$i]['image'] == '') echo 'img/cat_icon1.png'; else echo 'category_images/'.$categories[$i]['image']?>" alt="" /></span> <?php echo $categories[$i]['category_name'] ?></a></li>
    <?php }else {?>
    <li> <a href="<?php echo HTTP_PATH.'advertisement/addvList/'.$categories[$i]['category_name'].'/ALL/l/lat'; ?>"><span class="cat_icon1"><img src="<?php echo HTTP_PATH;?><?php if($categories[$i]['image'] == NULL or $categories[$i]['image'] == '') echo 'img/cat_icon1.png'; else echo 'category_images/'.$categories[$i]['image']?>" alt="" /></span> <?php echo $categories[$i]['category_name'] ?></a></li>
    <?php }}
?>
</ul>
</div>
<div class="side_bar_bottom_img"><img src="<?php echo HTTP_PATH;?>img//cat_bottom_img.jpg" alt="" /></div>

<div class="sociel_icon">
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s1.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s2.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s3.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s4.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s5.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s6.png" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//s7.png" alt="" /></a>
</div>


<h3>Feature Ads</h3>


<div class="add_bx">
<a href="#"><img src="<?php echo HTTP_PATH;?>img//feature_ad_1.jpg" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//feature_ad_2.jpg" alt="" /></a>
<a href="#"><img src="<?php echo HTTP_PATH;?>img//advertise_img.jpg" alt="" /></a>
</div>

<div class="subscribe_box_bg">
<h1>Subscribe<br />
  
<span>your business needs</span></h1>
<?php echo form_open('welcome/newsletter', array('name'=>'myForm', 'onsubmit'=>'return validateForm1()')); ?>
<input type="text" name="email" id="email" value="Enter your email Address" onblur="if(this.value=='') this.value='Enter your email Address';" onfocus="if(this.value=='Enter your email Address') this.value='';">
<input name="" type="submit" />
<?php echo form_close(); ?>
</div>

<div class="add_bx">
<a href="#"><img src="<?php echo HTTP_PATH;?>img//here_ad.png" alt="" /></a>

</div>
</div>
