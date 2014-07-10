<article id="content"><!-- Page Content -->
 
		<section class="content_2">
    <section class="top_login_text_head">
<div class="ribbon_2">
<p class="ribbon">
    <strong class="ribbon-content">List Applicants </strong>
</p>
</div>


</section>    
<section class="page-container">

<?php $this->load->view('user/sideBarLeft'); ?>

<section class="contentCol">
    
   <h2 class="my_profile">List Applicants </h2>
      <?php
if(validation_errors()  || $this->session->userdata('message')  || $this->session->flashdata('message')){ ?>
    <div class='ActionMsgBox error' id='msgID'>
        <?php
                echo validation_errors();
                echo $this->session->flashdata('message');
        ?>
    </div>
<?php } ?>
      <?php
if($this->session->userdata('smessage')  || $this->session->flashdata('smessage')){ ?>
  <div class='ActionMsgBox success' id='msgID'>
    <?php
                echo $this->session->flashdata('smessage');
        ?>
  </div>
  <?php } ?>      
      
                     
  <div class="login_btm">
      <?php if(!empty($applicant)) { ?>
    <div class="power_mode_listing_head">
        <div class="Email">First Name</div>
        <div class="r_n">Last Name </div>
        <div class="r_n">Email</div>
        <div class="action">Action</div>

    </div>	
 <?php
    $i=0;
    foreach($applicant as $row){
            ?>
    <div class="power_mode_listing">
        <div class="Email"><?php echo $row->firstname;?></div> 
        <div class="r_n"><?php echo $row->lastname;?></div>
        <div class="r_n"><?php echo $row->email;?></div>

        <div class="action">
            <?php echo anchor('/applicant/editApplicant/'.$row->id."/".$row->firstname."/".$row->lastname, "<img src=".HTTP_PATH."img/edit1.gif"."  border='0'>",  'title = Edit');?>
            <?php echo anchor('/applicant/deleteApplicant/'.$row->id."/".$row->firstname."/".$row->lastname, "<img src=".HTTP_PATH."img/icon2.png"." width='16' height='16' border='0'>",  array('title' => 'Delete','onclick'=>"return confirm('Are you sure you want to delete?')")); ?>
        </div>
    </div>	
 <?php
    }
      }
      else {
          ?>
      <img style="margin-top: 20px; margin-left: 200px;" src="<?php echo HTTP_PATH;?>img/no-record.jpg">
      <?php
      }
    ?>
 </div>
  <div class="pagination_new">
 <?php  echo $this->pagination->create_links(); ?>
      </div>
    </section>
 
</section>





</section>
</article>


