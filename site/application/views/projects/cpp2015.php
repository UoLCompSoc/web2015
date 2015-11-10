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

<title>CompSoc :: C++ Project 2015</title>
</head>

<body>
	<?php
	$this->load->view ( 'include/navbar.php' );
	?>

	<!-- Page Content -->
	<div class="container">
		<?php $this->load->view('include/sitewide_banner.php'); ?>
		
		<div class="row">
			<div class="col-lg-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="page-header">
							<h2>CompSoc&apos;s 2015 C++ Project</h2>
						</div>
						<p>CompSoc is doing some gamedev and you can be a part of it!</p>
						<h3>What + Why?</h3>
						<p>
							Making games is some of the best fun you can have as a programmer. You control pretty much everything about the game,
							for better or for worse and that appeals to a lot of software developers. On top of that
							it represents the coming-together of several fields and disciplines to create an
							end-product:
							
							<ul>
								<li>Realtime 3D graphics rendering (including shaders and various optimisations/techniques)</li>
								<li>Physics simulations</li>
								<li>Low-level optimisation (including sometimes dropping into raw assembly</li>
								<li>Audio management including composing music and creating sound effects</li>
							</ul>

							We intend to mimic as closely as possible a "real world" game development project in the "AAA" industry, using technologies
							such as:

							<ul>
								<li>C++, the industry gold-standard for games</li>
								<li><a href="https://www.unrealengine.com/what-is-unreal-engine-4" target="_blank">Unreal 4</a></li>
								<li><a href="https://www.perforce.com/" target="_blank">Perforce</a></li>
								<li>And anything else we think is relevant!</li>
							</ul>
						</p>

						<h3>Get Involved!</h3>
						<p>
							CompSoc will be running a this game development project to create a polished game which would look good on
							any CV, and we're open to being as inclusive as possible; if you want to get involved please do get in 
							touch on <a href="<?php echo Social::FACEBOOK_URL; ?>">our Facebook group</a> or by any of our other social media channels.
						</p>

						<p>
							We've got plenty of programmers, but we're happy to talk about further programmer involvement <em>if you have strong C++ skills</em>.
							 We would especially love to hear from any
							<strong>artists (especially 3D)</strong> or <strong>sound engineers/musicians</strong> or anybody in general who has relevant skills!
						</p>
						<p>
							We're doing this for a mixture of fun and for the experience; if you want to get involved it should be for the same reasons.

							Note that we have no intention to sell the finished product or make any kind of profit; this would be a great way to gain experience in the
							technologies listed above, or just to try something a bit different to what you're used to, but we won't become millionaires from the project.
						</p>

						<p>We're also open to sponsorship or mentoring; please get in touch <a href="<?php echo Social::TWITTER_URL; ?>">on Twitter</a> if you
						could provide anything relevant to the project. We'd love to organise something!</p>
					</div>
				</div>
			</div>
			
			<?php $this->load->view('include/social_sidebar.php'); ?>
		</div>
	</div>
	
	<?php
	$this->load->view ( 'include/footer.php' );
	$this->load->view ( 'include/bootstrapjs.php' );
	?>
</body>
</html>
