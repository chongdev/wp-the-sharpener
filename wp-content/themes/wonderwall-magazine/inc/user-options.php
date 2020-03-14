<?php

function wonderwall_magazine_show_extra_profile_fields( $user ) {
	
	?>

	<h3><?php esc_html_e( 'Social Profiles', 'wonderwall-magazine' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="wonderwall_magazine_twitter"><?php esc_html_e( 'Twitter', 'wonderwall-magazine' ); ?></label></th>
			<td>
				<input type="text" name="wonderwall_magazine_twitter" id="wonderwall_magazine_twitter" value="<?php echo esc_attr( get_the_author_meta( 'wonderwall_magazine_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'wonderwall-magazine' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="wonderwall_magazine_facebook"><?php esc_html_e( 'Facebook', 'wonderwall-magazine' ); ?></label></th>
			<td>
				<input type="text" name="wonderwall_magazine_facebook" id="wonderwall_magazine_facebook" value="<?php echo esc_attr( get_the_author_meta( 'wonderwall_magazine_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'wonderwall-magazine' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="wonderwall_magazine_instagram"><?php esc_html_e( 'Instagram', 'wonderwall-magazine' ); ?></label></th>
			<td>
				<input type="text" name="wonderwall_magazine_instagram" id="wonderwall_magazine_instagram" value="<?php echo esc_attr( get_the_author_meta( 'wonderwall_magazine_instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'wonderwall-magazine' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="wonderwall_magazine_behance"><?php esc_html_e( 'Behance', 'wonderwall-magazine' ); ?></label></th>
			<td>
				<input type="text" name="wonderwall_magazine_behance" id="wonderwall_magazine_behance" value="<?php echo esc_attr( get_the_author_meta( 'wonderwall_magazine_behance', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'wonderwall-magazine' ); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="wonderwall_magazine_dribbble"><?php esc_html_e( 'Dribbble', 'wonderwall-magazine' ); ?></label></th>
			<td>
				<input type="text" name="wonderwall_magazine_dribbble" id="wonderwall_magazine_dribbble" value="<?php echo esc_attr( get_the_author_meta( 'wonderwall_magazine_dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'The URL to your profile.', 'wonderwall-magazine' ); ?></span>
			</td>
		</tr>

	</table>

	<?php

} add_action( 'show_user_profile', 'wonderwall_magazine_show_extra_profile_fields' ); add_action( 'edit_user_profile', 'wonderwall_magazine_show_extra_profile_fields' );

function wonderwall_magazine_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'wonderwall_magazine_twitter', $_POST['wonderwall_magazine_twitter'] );
	update_user_meta( $user_id, 'wonderwall_magazine_facebook', $_POST['wonderwall_magazine_facebook'] );
	update_user_meta( $user_id, 'wonderwall_magazine_instagram', $_POST['wonderwall_magazine_instagram'] );
	update_user_meta( $user_id, 'wonderwall_magazine_behance', $_POST['wonderwall_magazine_behance'] );
	update_user_meta( $user_id, 'wonderwall_magazine_dribbble', $_POST['wonderwall_magazine_dribbble'] );

} add_action( 'personal_options_update', 'wonderwall_magazine_save_extra_profile_fields' ); add_action( 'edit_user_profile_update', 'wonderwall_magazine_save_extra_profile_fields' );