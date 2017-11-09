<?php
	$servername = "REDACTED";
	$username = "REDACTED";
	$password = "REDACTED";
	$dbname = "REDACTED";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$getID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT content FROM test WHERE id = '1'"));
	$content = $getID['content'];	

?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Book Editor</title>

		<!-- Bootstrap CSS CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Our Custom CSS -->
		<link rel="stylesheet" href="css/style.css" id="themeCSS">

		<script src="ckeditor/ckeditor.js"></script>
	</head>

	<body>
		<div class="wrapper">
			<nav id="sidebarDiv"></nav>
			<!-- Page Content Holder -->

			<div class="container">
				<div id="content">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h2>Editor</h2>
							<br>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12" id="editor">
							<form>
								<div id="makewide">
									<textarea name="editor1" id="editor1" rows="10">
											<?php echo $content ?>
										</textarea>
								</div>
								<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									CKEDITOR.replace( 'editor1', {
										skin: "moono-dark",
										removePlugins: 'elementspath'
									} );
								</script>
							</form>
							<br/>
							<button class="btn btn-block btn-primary download" id="submit">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<!-- Bootstrap Js CDN -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script type="text/javascript">
			var theme = "dark";

			$(document).ready(function() {
				$('#sidebarDiv').load("sections/sidebar.html");
			});

			$('#submit').click(function() {
				var data = CKEDITOR.instances.editor1.getData();
				$.ajax({
					url: 'save.php',
					type: 'POST',
					data: {
						editor1: data
					},
					success: function(msg) {
						alert(data);
					}
				});
			});
		</script>
	</body>

	</html>