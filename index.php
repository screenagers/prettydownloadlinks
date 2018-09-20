<?php
require("php/directoryFiles.class.php");

$config = array(
  'index_path' => '../../download/',                            // path to directory that should be indexed
  'base_url' => 'https://your-download-site.example/uploads/',  // base URL for generating the download links
  'display_limit' => 20,                                        // how many files to list by default
);

$list = new directoryFiles($config['index_path'], $config['base_url']);

$files = $list->scan();                   // get list of files
ksort($files);                            // sort by file modified time
$files = array_reverse($files, TRUE);     // sort descending, preserve keys

// only show subset of results
$OFFSET = 0;
$LIMIT = $config['display_limit'];
if(!empty($_GET['show'])) { $LIMIT = (int) $_GET['show']; }
$totalfiles = count($files);
if($LIMIT > 0) {
  $files = array_slice($files, $OFFSET, $LIMIT, TRUE);  
}

// prepare output html
$output = $list->display($files);

?><!DOCTYPE html>
<html>
<head>
	<title>Pretty Download Links | by screenagers</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
					<div class="table">

						<div class="row header">
							<div class="cell">
								<a href="https://www.screenagers.com/" target="_blank"><img src="elroy.png" alt="screenagers"></a>
							</div>							
						</div>
          </div>

					<div class="table">

						<div class="row header">
							<div class="cell">
								Filename
							</div>
							<div class="cell">
								Size
							</div>
							<div class="cell">
								URL
							</div>
							<div class="cell">
								Date
							</div>
						</div>

<?php
echo $output;
?>

<?php
if($LIMIT < $totalfiles) {
?>
						<div class="row footer">
							<div class="cell">
							  <?php echo $LIMIT . " / " . $totalfiles . " files shown"; ?>
							</div>
							<div class="cell">
								
							</div>
							<div class="cell">
								  <a href="?show=<?php echo $totalfiles; ?>">&raquo; Show All</a>
							</div>
							<div class="cell">
							</div>
						</div>
<?php
}
?>
						

					</div>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>