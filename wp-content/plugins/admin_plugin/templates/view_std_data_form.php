
<?php
include_once 'class/std_data_class.php';
$ncrud_std = new crud_std_data_manager();
?>

<?php if ( is_user_logged_in() ) 
    {
    get_header('logout'); 
    }
   else{
 get_header('login'); 
    }
?>

<div class="clearfix"></div>

<div class="container">
    <a href="<?php echo site_url(); ?>/add-std-data/" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
 <table class='table table-bordered table-responsive'>
     <tr>
     <th>Verification No.</th>
     <th>Surname</th>
     <th>Other Names</th>
     <th>Sex</th>
     <th>Level</th>
     <th>Faculty</th>
     <th>Department</th>
     <th>Email</th>
     <th>Phone</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT verification_no, surname, othername, sex, level, faculty, dept, email, phone FROM ".$ncrud_std->std_data_table_name; 
               //$query = "SELECT varification_no, surname, othername, sex, level, faculty, dept, email, phone FROM $ncrud_std->std_data_table_name";
		$records_per_page=50;
		$newquery = paging($query,$records_per_page);
		dataview($newquery);
	 ?>
   
 
</table>
     
</div>
 <div class ="container">
         <?php paginglink($query,$records_per_page); ?>
    </div>

        <?php

function dataview($query)
	{
		 global $wpdb;
                 $ncrud_std_fn = new crud_std_data_manager();
                 
                 $records = $wpdb->get_results($query);
                 
                 $total_no_of_records = $wpdb->get_var("select count(*) from ".$ncrud_std_fn->std_data_table_name);
	
		if( $total_no_of_records>0)
		{
			foreach ($records as $row)
			{
				?>
                 <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->verification_no; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->surname; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->othername; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->sex; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->level; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->faculty; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->dept; ?></td> 
                    <td class="manage-column ss-list-width"><?php echo $row->email; ?></td> 
                    <td class="manage-column ss-list-width"><?php echo $row->phone; ?></td>
                <td align="center">
                        <a class="btn btn-success" href="<?php echo site_url(); ?>/edit-std-data/?edit_id=<?php echo $row->verification_no; ?>" role="button">Edit</a>
                    </td>
                     <td align="center">
                    <a class="btn btn-danger" href="<?php echo site_url(); ?>/delete-std-data/?delete_id=<?php echo $row->verification_no; ?>" role="button">Delete</a>
                </td>
               
                 </tr>
                <?php
			}
		}
		else
		{
			?>
           <tr>
           <td>Nothing here...</td>
            </tr>
               <?php
		}
		
	}

    function paging($query, $records_per_page) 
   {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }
    
     function paginglink($query, $records_per_page) 
        {
       
         //$self = $_SERVER['PHP_SELF'];
         
      
                   
                global $wpdb;
               // $records = $wpdb->get_results($query);
                
                 $ncrud_std_fn_pagelnk = new crud_std_data_manager();
                $total_no_of_records = $wpdb->get_var("select count(*) from ".$ncrud_std_fn_pagelnk->std_data_table_name);
		
		
		
		if($total_no_of_records > 0)
		{
			?>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1; ?>
                            
				<li class="page-item"><a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no=1">First</a></li>
                                <li class="page-item"><a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no= <?php echo $previous ?>">Previous</a></li>
			  <?php
                                }
                      
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
				?>
                                <li class="page-item active"><a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no=<?php echo $i ?>" style="color:red" ><?php echo $i ?></a></li>
                           <?php         
                                }
				else
				{
				 ?>
                              <li class="page-item"><a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no=<?php echo $i ?>" > <?php echo $i ?></a></li>
				  <?php 
                                    }
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
                                ?>
                                    <li class="page-item"> <a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no=<?php echo $next ?>">Next</a></li>
                                    <li class="page-item"> <a class="page-link" href="<?php echo site_url(); ?>/view-std-data/?page_no=<?php echo $total_no_of_pages ?>">Last</a></li>
				
			<?php
                                }
			?></ul>
                            </nav><?php
        
            
        }

}