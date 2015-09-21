<?php
$this->load->view('header');
?>
<div class="container">
    <div class="row">
        <div class="content-box">
            <h1>Profile</h1>
            <hr/>
            <?php
			$sessionData = $this->session->userdata('user');

			if ($sessionData):
			    echo "<h2>Welcome $sessionData[first_name] $sessionData[last_name]</h2>";
			endif;
			?>
			<br/>
			<?php
			if ($sessionData && 'googleplus' == $sessionData['user_source']):
			?>
			<a href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo site_url("/host/logout/$sessionData[user_source]"); ?>' class="btn btn-primary">Log Out</a>
			<?php
			elseif ($sessionData && 'facebook' == $sessionData['user_source']):
			?>
			<a href="<?php echo $fbLogoutUrl; ?>"  class="btn btn-primary">Log Out</a>
			<?php
			else:
				//
			endif;
			?>
        </div>
    </div>
</div>
<?php
$this->load->view('footer');
?>