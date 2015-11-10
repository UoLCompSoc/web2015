<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
/*
 * This should be the first "require" because it contains the charset,
 * which should come directly after the <head> tag.
 */
$this->load->view ( 'include/head_common.php' );
?>

<title>CompSoc :: Projects</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>

<div class="col-lg-9">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>CompSoc Projects</h2>
						</div>
						<p>We like to show off the cool stuff we've done. A great example of that is this portfolio: a CompSoc project with multiple team members taking part to make the end product.</p>

						<p>
							Check out our site's repo <a href="https://github.com/UoLCompSoc/web2015" target="_blank">on <i class="fa fa-github"></i>GitHub
							</a> and throw us a star! While you're at it, have a look at the various other projects we have, from Game Dev to our bonus lecture slides on various topics!
						</p>

						<p>
							<iframe src="https://ghbtns.com/github-btn.html?user=UoLCompSoc&repo=web2015&type=star&count=true&size=large"
								frameborder="0" scrolling="0" width="160px" height="30px"></iframe>
						</p>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>CompSoc Projects</h2>
						</div>

<?php

function timeAgo($time_ago) {
	$time_ago = strtotime ( $time_ago );
	$cur_time = time ();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed;
	$minutes = round ( $time_elapsed / 60 );
	$hours = round ( $time_elapsed / 3600 );
	$days = round ( $time_elapsed / 86400 );
	$weeks = round ( $time_elapsed / 604800 );
	$months = round ( $time_elapsed / 2600640 );
	$years = round ( $time_elapsed / 31207680 );
	// Seconds
	if ($seconds <= 60) {
		return "just now";
	}  // Minutes
else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "one minute ago";
		} else {
			return "$minutes minutes ago";
		}
	}  // Hours
else if ($hours <= 24) {
		if ($hours == 1) {
			return "an hour ago";
		} else {
			return "$hours hrs ago";
		}
	}  // Days
else if ($days <= 7) {
		if ($days == 1) {
			return "yesterday";
		} else {
			return "$days days ago";
		}
	}  // Weeks
else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	}  // Months
else if ($months <= 12) {
		if ($months == 1) {
			return "a month ago";
		} else {
			return "$months months ago";
		}
	}  // Years
else {
		if ($years == 1) {
			return "one year ago";
		} else {
			return "$years years ago";
		}
	}
}

?>

<?php foreach($githubFeed as $repo) { ?>
<div class="row">
							<div class="col-lg-12">
								<h2>
									<a href="<?php echo $repo->html_url;?>"><?php echo $repo->name; ?></a> <small><?php echo $repo->collaborator_count; ?> Contributors</small>
								</h2>
								<p><?php echo $repo->description; ?></p>
								<p><?php echo "Last updated " . timeAgo($repo->pushed_at); ?></p>
							</div>
						</div>
<?php } ?>

</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('include/social_sidebar.php'); ?>
	</div>

	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
