<?php
	$ptitle = "Homepage";
	include("includes/header.php");
?>
<h1>Hello world </h1>

<!-- Button trigger modal -->
<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#newdatabase">
  New Database
</button>

<!-- Modal -->
<div class="modal fade" id="newdatabase" tabindex="-1" role="dialog" aria-labelledby="newdatabaseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="newdatabaseLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<form id="newdbform" action="" role="form">
			<input type="hidden" value="<?php echo $person->id ?>">
		  <div class="form-group">
		    <label for="newdbclient">Title</label>
		    <input type="text" class="form-control" id="newdbclient" placeholder="Enter Title of Database" name="title">
		  </div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="newdatabasebtn" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		$(document).on('click', "#newdatabasebtn", function (e) {
			e.preventDefault();
			var data = $("#newdbform").serialize();
			console.log(data);
			$.ajax({ url: 'scripts/newdb.php',
			    type: 'post',
			    data: data,
			     beforeSend: function ( xhr ) {
			    xhr.overrideMimeType("text/plain; charset=x-user-defined");
			    },
			    success: function(data) {
			        alert(data);
			        //$("#id" + date + userid).html("Loading").load("td_refresh.php", {date: date, userid: userid, workinghrs: workinghrs });
			    },
			    error: function (data) {
			        alert("There was an error. Image could not be added, please try again");
			    } // Success function
			}); // Ajax Function
		});
	});
</script>
<!-- Footer -->
<?php include("includes/footer.php");
