<?php include 'connection.php'; ?>

<?php
 extract($_POST);
if (isset($_POST['allrecords'])) {
		$data = '<table class="table table-bordered table-striped">
    				<thead>
    				  <tr>
    				    <th>S.No.</th>
    				    <th>First Name</th>
    				    <th>Last Name</th>
    				    <th>Email Address</th>
    				    <th>Contact Number</th>
    				    <th>Actions</th>
    				    <th>Actions</th>
				
    				  </tr>
    				</thead>';
    	$query = "SELECT * FROM `crudtable` ";
    	$result = mysqli_query($conn,$query);
    	if (mysqli_num_rows($result)>0) {
    	$number = 1;
    	while ($row = mysqli_fetch_array($result)) {
    					$data.='<tbody>
    					  <tr>
    					    <td>'.$number.'</td>
    					    <td>'.$row['firstname'].'</td>
    					    <td>'.$row['lastname'].'</td>
    					    <td>'.$row['email'].'</td>
    					    <td>'.$row['mobile'].'</td>
    					     <td><a href="javascript:void(0);"  onclick="editRecord('.$row['id'].')" class="btn btn-info">Edit</a></td>
    					     <td> 
    					        <a href="javascript:void(0);" onclick="deleteRecord('.$row['id'].')"  class="btn btn-danger"> Delete</a></td>
    					        </tr>
    					        </tbody>';
    					        $number++;
    	}
    	}
    	 $data.='</table>';

    	 echo $data;
}
 



 if (isset($_POST['fn']) && isset($_POST['ln']) && isset($_POST['em']) && isset($_POST['cn'])) {

        $query = "INSERT INTO `crudtable`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$fn','$ln','$em','$cn')";
        $results = mysqli_query($conn,$query);  
             
    }

    /*Deelet Records from Data Base*/
    if (isset($_POST['deleteId'])) {
    	$userId  =$_POST['deleteId'];
    	$deleteQuery  ="delete from crudtable where id='$userId'";
    	 $results = mysqli_query($conn,$deleteQuery); 

    }


    // Get data id for update

    if (isset($_POST['id']) && isset($_POST['id']) != "") {
        $updateId = $_POST['id'];

        $query = "SELECT * FROM `crudtable` WHERE id = $updateId";
        if (!$result = mysqli_query($conn,$query)) {
            exit(mysqli_error());
        }

        $response = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response = $row;
            }
        }else{
            $response['status'] = 200;
            $response['message'] = "Data not found";
        }

        echo json_encode($response);

    }else{
        $response['status'] = 200;
        $response['message'] = "Invalid request";
    }


if (isset($_POST['updateId'])) {
        $update_id = $_POST['updateId'];
        $update_firts_name 		= $_POST['up_firstname'];
        $update_last_name 		= $_POST['up_lastname'];
        $update_email_id 		= $_POST['up_email'];
        $update_mobile_number 	= $_POST['up_mobile'];

        $query  = "UPDATE `crudtable` SET `firstname`='$update_firts_name',`lastname`='$update_last_name',`email`='$update_email_id',`mobile`='$update_mobile_number' WHERE id='$update_id'";

        $result = mysqli_query($conn,$query);
         
    }

?>