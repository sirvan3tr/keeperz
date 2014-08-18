<?php
	$ptitle = "Homepage";
	include("includes/header.php");
?>
<!-- Button trigger modal -->
<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#newdatabase">New Database</button>
<hr />
<!-- Modal -->
<div class="modal fade" id="newdatabase" tabindex="-1" role="dialog" aria-labelledby="newdatabaseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="newdatabaseLabel">Modal title</h2>
      </div>
      <div class="modal-body">
		<form id="newdbform" action="" role="form">
			<input type="hidden" value="<?php echo $person->id ?>" name="user_id">
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
<table>
	<tr>
		<td>
			<?php
				$dbarr=array();
				$db = ORM::for_table('client')->find_many();
				foreach ($db as $dbs) {
				    echo '<div class="dbparent" >'.$dbs->name.'</div>';
					array_push($dbarr, $dbs->id);
				}
			?>
		</td>
		<td width="200">
			<?php
				//print_r($dbarr);
				foreach ($dbarr as $dbarrs) {
				    echo '<div class="dbcontainer" dbid="'.$dbarrs.'">';
				    $folders = ORM::for_table('folder')->where('client_id', $dbarrs)->find_many();
				    echo '<ul>';
					foreach ($folders as $folder) {
				    	echo '<li class="folderitem" folderid="'.$folder->id.'"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;'.$folder->name.'</li>';
				    	$items = ORM::for_table('item')->where('folder_id', $folder->id)->find_many();
				    	echo '<ul>';
				    	foreach ($items as $item) {
				    		echo '<li class="anitem" folderid="'.$item->id.'">'.$item->name.'</li>';
						}
						echo '</ul>';
					}
					echo '</ul>';
				    echo '</div>';
				}
			?>
		</td>
		<td width="500">
			<p class="bg-warning">This password seems to be out of date, consider changing it.</p>
			<form class="form-horizontal" role="form">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="tech login details for rbx">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="tech@rockaboxmedia.com">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" value="helloworld">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Password repeat</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" value="helloworld">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">URL</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="tech@rockaboxmedia.com">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">URL</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" rows="3">Rockabox is a platform. A platform. massive platforms
			      </textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Update</button>
			    </div>
			  </div>
			</form>
		</td>
	</tr>
</table>
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
			        console.log(data);
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
