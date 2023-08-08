<!DOCTYPE html>
<html>
<head>
	<title>PHP import Excel data</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<style>
		body{
			align-items:center;
		}
		form {
  margin:10px; 
  padding: 5px 5px;
}
label {
  display:block;
  font-weight:bold;
  margin:5px 5px;
}
input {
  padding:2px;
  margin:5px 5px 5px 5px;
  border:1px solid #eee;
  font: normal 1em Verdana, sans-serif;
}
select {
  padding:2px;
  margin:5px 5px 5px 5px;
  border:1px solid #eee;
  font: normal 1em Verdana, sans-serif;
}
button{
	padding:2px;
  margin:5px 5px 5px 5px;
}
	</style>
</head>
<body>
<div class="container" style="width: 90%;  bg-color:red;margin-top:10px">
	<h4 style="text-align:center;">Upload Profitability File</h4>
	<form id ="data1" method="POST" action="profitability_upload_acn.php" enctype="multipart/form-data">
		<div class="form-group" align="left"style="margin-bottom:10px">
			<label>Choose File</label>
			<input type="file" name="uploadFile" class="form-control" />
			<select name="year" id="year" class="form-control" required="">
			  <option value="">Select Year</option>
			  <option value="2022">2022</option>
			  <option value="2023">2023</option>
			</select>
			<select name="month" id="month" class="form-control" required>
			  <option value="">Select month</option>
			  <option value="1">January</option>
			  <option value="2">February</option>
			  <option value="3">March</option>
			  <option value="4">April</option>
			  <option value="5">May</option>
			  <option value="6">June</option>
			  <option value="7">July</option>
			  <option value="8">August</option>
			  <option value="9">September</option>
			  <option value="10">October</option>
			  <option value="11 ">November </option>
			  <option value="12">December</option>
			</select>
		</div>
		<div class="form-group">
			<button  type="Submit" name="Submit" class="btn btn-success" id="myButton1">Upload</button>
		</div>
	</form>
</div>
<script type="text/javascript">
$("form#data1").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        //url: window.location.pathname,
        url: 'http://localhost/excel_upload_single_table/saca_acn.php',
         contentType: "application/vnd.ms-excel",
        type: 'POST',
        data: formData,
       success: function (data) {
            alert(data)
            if(data == 'Please upload excel file'){
             $("#myButton1").css('background', 'red').html("FILE 1 uploded Failed");  
            }
             if(data == 'Data inserted in Database'){
             $("#myButton1").html("FILE 1 uploded success").css('background', 'green');
            }else{
            	$("#myButton1").css('background', 'red').html("FILE 1 uploded Failed");  
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>


</body>
</html>