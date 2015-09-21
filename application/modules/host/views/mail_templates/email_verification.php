<table>
	<thead>
		<tr>
			<td align="center">
				<a href="<?php echo base_url(); ?>" class="logo">
					<img src="<?php echo base_url(); ?>public/images/logo-houses.png" alt="logo-houses" class="logo-houses" />
					<img src="<?php echo base_url(); ?>public/images/logo-text.png" alt="logo-text" class="logo-text" />
				</a>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td>
				<p>Hello <?php echo $user_name; ?>;</p>
				<p>
					Please click this <a href='<?php echo site_url("/host/profile/verifyemail/$emailType/$id/$encryptedVerificationCode"); ?>'><?php echo site_url("/host/profile/verifyemail/$emailType/$id/$encryptedVerificationCode"); ?></a> to complete the verification procedure for your email <?php echo $email; ?>.
				</p>
				<p>
					Thanks and regards,
					<br/>
					RentnRoam
				</p>
			</td>
		</tr>
	</tbody>
</table>