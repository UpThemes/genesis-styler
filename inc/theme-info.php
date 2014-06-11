<?php


/**
* Create a sub-page to explain this theme.
*
* @uses add_submenu_page()
*
* @return void
*
* @since 0.1
*/
function easystyle_info_menu() {
		add_menu_page('Easy Style Theme Info', 'Easy Style Info', 'manage_options', 'easystyle_theme', 'easystyle_theme_page','dashicons-welcome-widgets-menus');
}
add_action('admin_menu', 'easystyle_info_menu');

/**
* Display a page with info on this theme.
*
*
* @return void
*
* @since 0.1
*/
function easystyle_theme_page() {
	?>
	<div class="wrap">
		<h2>Easy Style Theme Info</h2>

		<p>Easy Style is a simple, free theme from <a href="https://upthemes">UpThemes</a> that allows you to style your Genesis website in like 5 seconds using the Theme Customizer.</p>

		<h3>What's Cool About It?</h3>

		<p>This theme allows you to define background colors and fonts for your website and will automagically update the text color that appears on top of it, meaning you don't ever have to worry about text colors that conflict with the background you selected. The other benefit is that Easy Style creates a single CSS file. No inline styles or myriad of CSS files to load. Just one clean CSS file that contains all your site customizations.</p>

		<h3>How it Works</h3>

		<p>It utilizes the <a href="https://upthemes.com/upthemes-framework/">UpThemes Framework</a> to add style options to the Theme Customizer. Using Sass, it regenerates your CSS on-the-fly and allows you to set up some base styles for your site without writing a line of CSS.</p>

		<h3>How to Extend It</h3>

		<p>You can inject your own styles and Sass variables into the style regeneration process! Either edit the Sass files located in <code>assets/scss/</code> and add your own stuff there, or you can utilize the <code>easystyle_style_variables</code> filter to inject a string of CSS or Sass that will be processed every time you edit your site styles from the Customizer and click "Save."</p>

		<h3>Things to Know</h3>

		<p>Right now, we use the page refresh method within the Customizer, so it takes a little bit of time before your style changes are updated. The next step is to make the live preview process faster.</p>

	<?php
}