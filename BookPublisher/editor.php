<?php
	$servername = "mysql.zacheryhysong.com";
	$username = "zacheryhysongcom";
	$password = "JnYkuxhr";
	$dbname = "bookpublisherdb";
	
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

		<title>Collapsible sidebar using Bootstrap 3</title>

		<!-- Bootstrap CSS CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Our Custom CSS -->
		<link rel="stylesheet" href="css/style.css" id="themeCSS">

		<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
	</head>

	<body>
		<div class="wrapper">
			<nav id="sidebarDiv"></nav>
			<!-- Page Content Holder -->

			<div class="container-fluid">
				<div id="content">
					<nav class="navbar navbar-inverse">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" id="sidebarCollapse" class="btn btn-default navbar-btn">
									<i class="glyphicon glyphicon-chevron-left"></i>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav navbar-right">
									<li>
										<div class="btn-toolbar" role="toolbar">
											<div class="btn-group">
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-bold"></span>
											</button>
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-italic"></span>
											</button>
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-text-color"></span>
											</button>
											</div>
											<div class="btn-group">
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-align-left"></span>
											</button>
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-align-center"></span>
											</button>
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-align-right"></span>
											</button>
												<button type="button" class="btn btn-default navbar-btn">
												<span class="glyphicon glyphicon-align-justify"></span>
											</button>
											</div>
											<button type="button" id="ThemeChooser" onclick="themeChanger()" class="btn btn-default navbar-btn">
												Go Light
										</button>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</nav>
					<div class="row">
						<div class="col-xs-12">
							<h2>Editor</h2>
							<br>
						</div>
					</div>
					<div class="row ed">
						<div class="col-xs-12" id="editor">
							<form>
								<textarea name="editor1" id="editor1" rows="10" cols="80">
										<?php echo $content ?>
									</textarea>
								<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									CKEDITOR.replace('editor1');
								</script>
							</form>
							<br>
							<button class="btn btn-block btn-primary" id="submit">Submit</button>
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
				$('#sidebarCollapse').on('click', function() {
					$('#sidebarDiv').toggleClass('active');
				});
			});

			function themeChanger() {
				if (theme == "dark") {
					theme = "light";
					document.getElementById('themeCSS').href = 'css/lighttheme.css';
					document.getElementById('ThemeChooser').innerHTML = 'Go Dark';
					console.log("Light theme selected");
				} else if (theme == "light") {
					theme = "dark";
					document.getElementById('themeCSS').href = 'css/style.css';
					document.getElementById('ThemeChooser').innerHTML = 'Go Light';
					console.log("Dark theme selected");
				};
			}

			$('#submit').click(function() {
				$content = $('textarea[name=editor1]').html();
				$.ajax({
					url: 'save.php',
					type: 'POST',
					data: {
						editor1:  $content
					},
					success: function(msg) {
						alert($content);
					}
				});
			});
		</script>
	</body>

	</html>