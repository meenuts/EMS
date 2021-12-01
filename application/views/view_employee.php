<!doctype html>
<html>
    <head>
        
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
  <style>
  .row {
  margin-top: 10px;
  margin-bottom: 20px;
}
.form-actions {
  margin-top: 0;
  margin-bottom: 0;
  margin-left: 15px;
}

  </style>
    
    </head>
    <body>
       
       
        
                <div style="background-color: #304268;height: 100px">
                    <h1>Employee Management System</h1>
                </div>
                <div class="container">
                    
                        <div class="pull-left">
                            <h1>Employee List</h1>
                        </div>
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                            if ($this->session->flashdata('msg') == 'row_error') {
                                ?>
                                <div class="alert alert-danger alert-dismissable margin-top20">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>No. of rows exceeded!.You can upload upto 20 rows</strong> .
                                </div>
                            <?php } if ($this->session->flashdata('msg') == 'header_error') {
                                ?>
                                <div class="alert alert-danger alert-dismissable margin-top20">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Error!.</strong> Header mismatching. Field Options are Employee Code,Name,Department,Date of Birth,Joining Date.Please follow the same order.
                                </div>
                            <?php } if ($this->session->flashdata('msg') == 'success') {
                                ?>
                                <div class="alert alert-success alert-dismissable margin-top20">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success!.</strong> Data imported successfully.
                                </div>
                            <?php } ?>
                            
                            
                        </div>
                    </div>

                    <div class="row">
                          <div class="col-sm-6" >

                             
                                     <form action="" method="POST" class='form-vertical form-validate' id="upload_employee" enctype="multipart/form-data">                                     
                                      
                                        <div class="form-group">									

                                            <label for="employee_list_file">CSV File</label>                        
                                            
                                                <input type="file" name="employee_list_file" required=""/>				                   
                                           

                                        </div>
                                         <div class="row">
                                            <div class="form-actions">
                                                <input type="submit" class="btn btn-primary" value="Upload" name="import">
                                               
                                            </div>
                                         </div>
                                    </form>
                            
                        </div>
                        
                        
                        
                    </div>
                    <?php if(isset($employee_details)){ ?>
                        
                    <div class="row">
                      
                        <div class="col-sm-12">
                            
                            <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employee Code</th>
                                    <th>Employee Name</th>
                                    <th>Age</th>
                                    <th>Department</th>
                                    <th>Experience</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($employee_details) { 
                                    $i = 1;
                                    foreach ($employee_details as $employee) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $employee['employee_code']; ?></td>
                                            <td>
                                                <?php echo $employee['employee_name']; ?>
                                            </td>

                                            <td>
                                                <?php 
                                                if($employee['dob']!="0000-00-00"){

                                                    $age = (date('Y') - date('Y',strtotime($employee['dob'])));
                                                    echo $age; 

                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $employee['department']; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                   if($employee['date_of_join']!="0000-00-00"){

                                                    $years = (date('Y') - date('Y',strtotime($employee['date_of_join'])));
                                                    echo $years." years"; 

                                                  }
                                                ?>
                                            </td>


                                        </tr>
                                        <?php $i++;
                                    } ?>


                               <?php  }else{ ?>
                                        <tr><td colspan="5">No data found!!!<td></tr>
                               <?php }
                                    ?>
                            </tbody>
                            </table>
                          
                        </div>
                    </div>
                    
                    
                    <?php }
                    ?>
                        
                
                </div>
       
  
</body>
</html>



