<?php
/*
Plugin Name: Random Messages
Version: 1.3
Plugin URI: http://shirasaka.tv
Description: Show random messages where you like
Domain Path: /languages/
Author: shoshirasaka
Author URI: http://shirasaka.tv/
Text Domain: random-messages
*/

load_plugin_textdomain( 'random-messages', false, basename( dirname( __FILE__ ) ) . '/languages' );

function random_messages_show() {
	$random_messages_value = get_option('random_messages_value');
  $cr = array("\r\n", "\r");
  $random_messages_value = trim($random_messages_value);
  $random_messages_value = str_replace($cr, "\n", $random_messages_value);
  $random_messages_value = explode("\n", $random_messages_value);
	echo $random_messages_value[array_rand($random_messages_value)];
}

add_action('admin_menu', 'random_messages_menu');

function random_messages_menu() {
	add_menu_page(
		'Random Messages',
		'Random Messages',
		'administrator',
		'random_messages',
		'random_messages_setting'
	);
}

function random_messages_setting() {
if (isset($_POST['random_messages'])) {
  $random_messages= htmlspecialchars($_POST['random_messages']);
  update_option('random_messages_value', $random_messages);
}

$random_messages = get_option('random_messages_value');
?>
<div class="wrap">
<h2>Random Messages</h2>
<p><?php _e('Enter messages to display, one message per line.', 'random-messages');?></p>
    <form action="" method="post">
  <textarea name="random_messages" rows="16" cols="" class="large-text" placeholder="<?php _e('Sample message (use a line break after each message)', 'random-messages');?>"><?php echo isset($random_messages) ? $random_messages : '' ?></textarea>    
    <p><input type="submit" class="button-primary" value="<?php _e('Submit', 'random-messages');?>" /></p>
    </form>
<h3><?php _e('Usage', 'random-messages');?></h3>
<p><?php _e('Use &lt;?php random_messages_show();?&gt; in your template where you want to show your random message.', 'random-messages');?></p>

</div>

<?php
}


