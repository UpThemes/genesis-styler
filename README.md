# Genesis Styler

A simple theme that allows you to style your Genesis website in like 5 seconds using the Theme Customizer.

### Requirements

- WordPress 3.8+
- Genesis Framework - can be purchased directly from [StudioPress](http://studiopress.com)

### What's Cool About It?

This theme allows you to define background colors and fonts for your website and will automagically update the text color that appears on top of it, meaning you don't ever have to worry about text colors that conflict with the background you selected. The other benefit is that Genesis Styler creates a single CSS file. No inline styles or myriad of CSS files to load. Just one clean CSS file that contains all your site customizations.

### How it Works

It utilizes the [UpThemes Framework](https://upthemes.com/upthemes-framework/) to add style options to the Theme Customizer. Using Sass, it regenerates your CSS on-the-fly and allows you to set up base styles for your site without writing a line of CSS.

### How to Extend It

You can inject your own styles and Sass variables into the style regeneration process! Either edit the Sass files located in `assets/scss/` and add your own stuff there, or you can utilize the `gstyler_style_variables` filter to inject a string of CSS or Sass that will be processed every time you edit your site styles from the Customizer and click "Save."

### Things to Know

Right now, we use the page refresh method within the Customizer, so it takes a little bit of time before your style changes are updated. The next step is to make the live preview process faster.
