<?php
function animationList($id, $value = 0, $name = '') {
	?>
	<select <?php if (!empty($id)) echo 'id="' . $id . '"' ?> name="<?php if (!empty($name)) echo $name ?>">
		<option value="0" <?php if ( $value == 0 ) echo 'selected="selected"'; ?>><?php _e('Default', 'animation') ?></option>
		<option value="1" <?php if ( $value == 1 ) echo 'selected="selected"'; ?>><?php _e('Move to left / from right', 'animation') ?></option>
		<option value="2" <?php if ( $value == 2 ) echo 'selected="selected"'; ?>><?php _e('Move to right / from left', 'animation') ?></option>
		<option value="3" <?php if ( $value == 3 ) echo 'selected="selected"'; ?>><?php _e('Move to top / from bottom', 'animation') ?></option>
		<option value="4" <?php if ( $value == 4 ) echo 'selected="selected"'; ?>><?php _e('Move to bottom / from top', 'animation') ?></option>
		<option value="5" <?php if ( $value == 5 ) echo 'selected="selected"'; ?>><?php _e('Fade / from right', 'animation') ?></option>
		<option value="6" <?php if ( $value == 6 ) echo 'selected="selected"'; ?>><?php _e('Fade / from left', 'animation') ?></option>
		<option value="7" <?php if ( $value == 7 ) echo 'selected="selected"'; ?>><?php _e('Fade / from bottom', 'animation') ?></option>
		<option value="8" <?php if ( $value == 8 ) echo 'selected="selected"'; ?>><?php _e('Fade / from top', 'animation') ?></option>
		<option value="9" <?php if ( $value == 9 ) echo 'selected="selected"'; ?>><?php _e('Fade left / Fade right', 'animation') ?></option>
		<option value="10" <?php if ( $value == 10 ) echo 'selected="selected"'; ?>><?php _e('Fade right / Fade left', 'animation') ?></option>
		<option value="11" <?php if ( $value == 11 ) echo 'selected="selected"'; ?>><?php _e('Fade top / Fade bottom', 'animation') ?></option>
		<option value="12" <?php if ( $value == 12 ) echo 'selected="selected"'; ?>><?php _e('Fade bottom / Fade top', 'animation') ?></option>
		<option value="13" <?php if ( $value == 13 ) echo 'selected="selected"'; ?>><?php _e('Different easing / from right', 'animation') ?></option>
		<option value="14" <?php if ( $value == 14 ) echo 'selected="selected"'; ?>><?php _e('Different easing / from left', 'animation') ?></option>
		<option value="15" <?php if ( $value == 15 ) echo 'selected="selected"'; ?>><?php _e('Different easing / from bottom', 'animation') ?></option>
		<option value="16" <?php if ( $value == 16 ) echo 'selected="selected"'; ?>><?php _e('Different easing / from top', 'animation') ?></option>
		<option value="17" <?php if ( $value == 17 ) echo 'selected="selected"'; ?>><?php _e('Scale down / from right', 'animation') ?></option>
		<option value="18" <?php if ( $value == 18 ) echo 'selected="selected"'; ?>><?php _e('Scale down / from left', 'animation') ?></option>
		<option value="19" <?php if ( $value == 19 ) echo 'selected="selected"'; ?>><?php _e('Scale down / from bottom', 'animation') ?></option>
		<option value="20" <?php if ( $value == 20 ) echo 'selected="selected"'; ?>><?php _e('Scale down / from top', 'animation') ?></option>
		<option value="21" <?php if ( $value == 21 ) echo 'selected="selected"'; ?>><?php _e('Scale down / scale down', 'animation') ?></option>
		<option value="22" <?php if ( $value == 22 ) echo 'selected="selected"'; ?>><?php _e('Scale up / scale up', 'animation') ?></option>
		<option value="23" <?php if ( $value == 23 ) echo 'selected="selected"'; ?>><?php _e('Move to left / scale up', 'animation') ?></option>
		<option value="24" <?php if ( $value == 24 ) echo 'selected="selected"'; ?>><?php _e('Move to right / scale up', 'animation') ?></option>
		<option value="25" <?php if ( $value == 25 ) echo 'selected="selected"'; ?>><?php _e('Move to top / scale up', 'animation') ?></option>
		<option value="26" <?php if ( $value == 26 ) echo 'selected="selected"'; ?>><?php _e('Move to bottom / scale up', 'animation') ?></option>
		<option value="27" <?php if ( $value == 27 ) echo 'selected="selected"'; ?>><?php _e('Scale down / scale up', 'animation') ?></option>
		<option value="28" <?php if ( $value == 28 ) echo 'selected="selected"'; ?>><?php _e('Glue left / from right', 'animation') ?></option>
		<option value="29" <?php if ( $value == 29 ) echo 'selected="selected"'; ?>><?php _e('Glue right / from left', 'animation') ?></option>
		<option value="30" <?php if ( $value == 30 ) echo 'selected="selected"'; ?>><?php _e('Glue bottom / from top', 'animation') ?></option>
		<option value="31" <?php if ( $value == 31 ) echo 'selected="selected"'; ?>><?php _e('Glue top / from bottom', 'animation') ?></option>
		<option value="32" <?php if ( $value == 32 ) echo 'selected="selected"'; ?>><?php _e('Flip right', 'animation') ?></option>
		<option value="33" <?php if ( $value == 33 ) echo 'selected="selected"'; ?>><?php _e('Flip left', 'animation') ?></option>
		<option value="34" <?php if ( $value == 34 ) echo 'selected="selected"'; ?>><?php _e('Flip top', 'animation') ?></option>
		<option value="35" <?php if ( $value == 35 ) echo 'selected="selected"'; ?>><?php _e('Flip bottom', 'animation') ?></option>
		<option value="36" <?php if ( $value == 36 ) echo 'selected="selected"'; ?>><?php _e('Fall', 'animation') ?></option>
		<option value="37" <?php if ( $value == 37 ) echo 'selected="selected"'; ?>><?php _e('Newspaper', 'animation') ?></option>
		<option value="38" <?php if ( $value == 38 ) echo 'selected="selected"'; ?>><?php _e('Push left / from right', 'animation') ?></option>
		<option value="39" <?php if ( $value == 39 ) echo 'selected="selected"'; ?>><?php _e('Push right / from left', 'animation') ?></option>
		<option value="40" <?php if ( $value == 40 ) echo 'selected="selected"'; ?>><?php _e('Push top / from bottom', 'animation') ?></option>
		<option value="41" <?php if ( $value == 41 ) echo 'selected="selected"'; ?>><?php _e('Push bottom / from top', 'animation') ?></option>
		<option value="42" <?php if ( $value == 42 ) echo 'selected="selected"'; ?>><?php _e('Push left / pull right', 'animation') ?></option>
		<option value="43" <?php if ( $value == 43 ) echo 'selected="selected"'; ?>><?php _e('Push right / pull left', 'animation') ?></option>
		<option value="44" <?php if ( $value == 44 ) echo 'selected="selected"'; ?>><?php _e('Push top / pull bottom', 'animation') ?></option>
		<option value="45" <?php if ( $value == 45 ) echo 'selected="selected"'; ?>><?php _e('Push bottom / pull top', 'animation') ?></option>
		<option value="46" <?php if ( $value == 46 ) echo 'selected="selected"'; ?>><?php _e('Fold left / from right', 'animation') ?></option>
		<option value="47" <?php if ( $value == 47 ) echo 'selected="selected"'; ?>><?php _e('Fold right / from left', 'animation') ?></option>
		<option value="48" <?php if ( $value == 48 ) echo 'selected="selected"'; ?>><?php _e('Fold top / from bottom', 'animation') ?></option>
		<option value="49" <?php if ( $value == 49 ) echo 'selected="selected"'; ?>><?php _e('Fold bottom / from top', 'animation') ?></option>
		<option value="50" <?php if ( $value == 50 ) echo 'selected="selected"'; ?>><?php _e('Move to right / unfold left', 'animation') ?></option>
		<option value="51" <?php if ( $value == 51 ) echo 'selected="selected"'; ?>><?php _e('Move to left / unfold right', 'animation') ?></option>
		<option value="52" <?php if ( $value == 52 ) echo 'selected="selected"'; ?>><?php _e('Move to bottom / unfold top', 'animation') ?></option>
		<option value="53" <?php if ( $value == 53 ) echo 'selected="selected"'; ?>><?php _e('Move to top / unfold bottom', 'animation') ?></option>
		<option value="54" <?php if ( $value == 54 ) echo 'selected="selected"'; ?>><?php _e('Room to left', 'animation') ?></option>
		<option value="55" <?php if ( $value == 55 ) echo 'selected="selected"'; ?>><?php _e('Room to right', 'animation') ?></option>
		<option value="56" <?php if ( $value == 56 ) echo 'selected="selected"'; ?>><?php _e('Room to top', 'animation') ?></option>
		<option value="57" <?php if ( $value == 57 ) echo 'selected="selected"'; ?>><?php _e('Room to bottom', 'animation') ?></option>
		<option value="58" <?php if ( $value == 58 ) echo 'selected="selected"'; ?>><?php _e('Cube to left', 'animation') ?></option>
		<option value="59" <?php if ( $value == 59 ) echo 'selected="selected"'; ?>><?php _e('Cube to right', 'animation') ?></option>
		<option value="60" <?php if ( $value == 60 ) echo 'selected="selected"'; ?>><?php _e('Cube to top', 'animation') ?></option>
		<option value="61" <?php if ( $value == 61 ) echo 'selected="selected"'; ?>><?php _e('Cube to bottom', 'animation') ?></option>
		<option value="62" <?php if ( $value == 62 ) echo 'selected="selected"'; ?>><?php _e('Carousel to left', 'animation') ?></option>
		<option value="63" <?php if ( $value == 63 ) echo 'selected="selected"'; ?>><?php _e('Carousel to right', 'animation') ?></option>
		<option value="64" <?php if ( $value == 64 ) echo 'selected="selected"'; ?>><?php _e('Carousel to top', 'animation') ?></option>
		<option value="65" <?php if ( $value == 65 ) echo 'selected="selected"'; ?>><?php _e('Carousel to bottom', 'animation') ?></option>
		<option value="66" <?php if ( $value == 66 ) echo 'selected="selected"'; ?>><?php _e('Sides', 'animation') ?></option>
		<option value="67" <?php if ( $value == 67 ) echo 'selected="selected"'; ?>><?php _e('Slide', 'animation') ?></option>
	</select>
	<?php
}
?>