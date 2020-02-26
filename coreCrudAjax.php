
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
</head>
<body>
<?php include 'connection.php';?>
<div class="container">
  <h1 class="text-center text-primary">AJAX CRUD OPERATION!</h1>
  <div class="d-flex justify-content-end">
  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Open modal
</button>
</div>
<h2 class="text-warning">All Records</h2>
<div id ="allrecords"></div>
 <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">AJAX CRUD OPERATION!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form action="" method="post">
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname">
    </div>
    <div class="form-group">
      <label for="email">Email Id:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="phone">Contct Number:</label>
      <input type="number" class="form-control" id="phone" placeholder="Enter contact number" name="phone">
    </div>
    <button onclick="addRecords();" type="button" name="submit" id="submit" class="btn btn-success">Submit Data</button>
  </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
       
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
 <div class="modal" id="myEditModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">AJAX CRUD OPERATION!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form action="" method="post">
    <div class="form-group">
      <label for="updatefirstname">First Name:</label>
      <input type="text" class="form-control" id="updatefirstname" placeholder="Enter first name" name="updatefirstname">
    </div>
    <div class="form-group">
      <label for="updatelastname">Last Name:</label>
      <input type="text" class="form-control" id="updatelastname" placeholder="Enter last name" name="updatelastname">
    </div>
    <div class="form-group">
      <label for="updateemail">Email Id:</label>
      <input type="email" class="form-control" id="updateemail" placeholder="Enter email" name="updateemail">
    </div>
    <div class="form-group">
      <label for="updatephone">Contct Number:</label>
      <input type="number" class="form-control" id="updatephone" placeholder="Enter contact number" name="updatephone">
    </div>
    <div class="form-group">
     <input type="hidden" class="form-control" id="updatebyId"  name="updatebyId">
    </div>
    <button onclick="UpdateRecords();" type="button" name="submit" id="submit" class="btn btn-success">Update</button>
  </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
       
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</div>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      allRecords();
    })
  	function allRecords() {
      var allrecords  = "allrecords";
      $.ajax({
           url:"backend.php",
           type:"post",
           data:{allrecords:allrecords},
           success:function (data,status) {
             $('#allrecords').html(data);
           }
      });
    }

     function addRecords() {
      var fname = $('#firstname').val();
      var lname = $('#lastname').val();
      var email = $('#email').val();
      var cnum = $('#phone').val();

      $.ajax({
        url: 'backend.php',
        type: 'post',
        data: {fn:fname, ln:lname, em:email, cn:cnum},
        success:function(data, status) {
           allRecords();
        }
      });
     
    }
  ///// Delete Records

    function deleteRecord(deleteId) {
      var conf  =confirm('Are you sure');
      if (conf == true) {
        $.ajax({
          url: 'backend.php',
        type: 'post',
        data:{deleteId:deleteId},
        success:function(data, status) {
        allRecords();
      }
  });
  }
}

function editRecord(id) {
  $('#updatebyId').val(id);
      $.post({
        url: 'backend.php',
        type: 'post',
        data: {id:id},
        success: function(data, status) {
          var user = JSON.parse(data);

            $('#updatefirstname').val(user.firstname);
            $('#updatelastname').val(user.lastname);
            $('#updateemail').val(user.email);
            $('#updatephone').val(user.mobile);
        }
      });

      $("#myEditModal").modal('show');
}


function UpdateRecords() {
      var up_firstname  = $('#updatefirstname').val();
      var up_lastname  = $('#updatelastname').val();
      var up_email      = $('#updateemail').val();
      var up_mobile     = $('#updatephone').val();
      var up_id         = $('#updatebyId').val();
      $.post({
       url:'backend.php',
       type:'post',
       data:{up_firstname:up_firstname,
             up_lastname:up_lastname,
             up_email :up_email ,
             up_mobile:up_mobile,
             updateId:up_id
           },
       success:function(data,status){
      $("#myEditModal").modal('hide');
      allRecords();
       }
      });

}
  </script>
</body>
</html>



