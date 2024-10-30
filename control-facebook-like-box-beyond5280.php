<?php
/*
Plugin Name: Control Facebook Like Box by Beyond 5280
Plugin URI: http://beyond5280.com/2011/02/09/facebook-like-box-plugin/
Description: Adds a widget that will allow you to control the default setting for the Facebook Like Box.
Version: 1.1
Author: Beyond 5280 (T. Ricker)
Author URI: http://www.beyond5280.com
License: GPL2

*/

error_reporting(E_ALL);
add_action("widgets_init", array('Widget_name', 'register'));
register_activation_hook( __FILE__, array('Widget_name', 'activate'));
register_deactivation_hook( __FILE__, array('Widget_name', 'deactivate'));
class Widget_name {
  function activate(){
    $data = array( 'fbURL' => 'yourfacebookurl' ,'width' => 292, 'height' => 427, 'colorScheme' => 'light', 'showFaces' => 'true', 'stream' => 'true', 'header' => 'true', 'scrolling' => 'no', 'style' => 'border: none;', 'cssClass' => '');
    if ( ! get_option('widget_name')){
      add_option('widget_name' , $data);
    } else {
      update_option('widget_name' , $data);
    }
  }
  function deactivate(){
    delete_option('widget_name');
  }
    function control(){
      $data = get_option('widget_name');
      ?>
      <p><label>Facebook Page URL (include http://)<input name="widget_name_fbURL"
    type="text" value="<?php echo $data['fbURL']; ?>" /></label></p>
      <p><label>Width<input name="widget_name_width"
    type="text" value="<?php echo $data['width']; ?>" /></label></p>
    <p><label>Height<input name="widget_name_height"
    type="text" value="<?php echo $data['height']; ?>" /></label></p>
        <p><label>Color Scheme <select name="widget_name_colorScheme">
            <option value="light" <?php if ($data['colorScheme'] == 'light')  echo 'selected="1"'; ?>>light</option>
            <option value="dark" <?php if ($data['colorScheme'] == 'dark')  echo 'selected="1"'; ?>>dark</option>
        </select></label></p>
        <p><label>Show Faces 
        <input name="widget_name_showFaces" type="checkbox" value="true"  <?php
      if ($data['showFaces'] == 'true') echo 'checked="1"' ?> /></label></p>
         <p><label>Show Stream
        <input name="widget_name_stream" type="checkbox" value="true" <?php
      if ($data['stream'] == 'true') echo 'checked="1"' ?> /></label></p>
         <p><label>Show Header
        <input name="widget_name_header" type="checkbox" value="true" <?php
      if ($data['header'] == 'true') echo 'checked="1"' ?> /></label></p>
      <p><label>iframe scrolling <select name="widget_name_scrolling">
        <option value="no" <?php if ($data['scrolling'] == 'no') echo 'selected="1"'; ?>>No</option>
        <option value="auto" <?php if ($data['scrolling'] == 'auto') echo 'selected="1"'; ?>>Auto</option>
        <option value="yes" <?php if ($data['scrolling'] == 'yes') echo 'selected="1"'; ?>>Yes</option>
        </select></label></p>
        <p><label>Inline css style options <input name="widget_name_style" type="text" value="<?php echo $data['style']; ?>" /></label></p>
        <p><label>Set a css class name <input name="widget_name_cssClass" type="text" value="<?php echo $data['cssClass']; ?>" /></label></p>
      <?php
       if (isset($_POST['widget_name_fbURL'])){
        $data['fbURL'] = attribute_escape($_POST['widget_name_fbURL']);
        $data['width'] = attribute_escape($_POST['widget_name_width']);
        $data['colorScheme'] = attribute_escape($_POST['widget_name_colorScheme']);
        $data['showFaces'] = attribute_escape($_POST['widget_name_showFaces']);
        $data['stream'] = attribute_escape($_POST['widget_name_stream']);
        $data['header'] = attribute_escape($_POST['widget_name_header']);
        $data['height'] = attribute_escape($_POST['widget_name_height']);
        $data['scrolling'] = attribute_escape($_POST['widget_name_scrolling']);
        $data['style'] = attribute_escape($_POST['widget_name_style']);
        $data['cssClass'] = attribute_escape($_POST['widget_name_cssClass']);
        update_option('widget_name', $data);
      }
    }
  function widget($args){
    $data = get_option('widget_name');
   print_r($data);
    echo $args['before_widget']; ?>
    <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $data['fbURL']; ?>&amp;width=<?php echo $data['width']; ?>&amp;colorscheme=<?php echo $data['colorScheme']; ?>&amp;show_faces=<?php echo $data['showFaces']; ?>&amp;stream=<?php echo $data['stream']; ?>&amp;header=<?php echo $data['header']; ?>&amp;height=<?php echo $data['height']; ?>" scrolling="<?php echo $data['scrolling']; ?>" frameborder="0" style="<?php if($data['style'] == '' || $data['style'] == 'null') echo 'border: none;'; ?> <?php if($data['scrolling'] == 'no') echo 'overflow: hidden;'; ?> width:<?php echo $data['width']; ?>px; height:<?php echo $data['height']; ?>px;" <?php if($data['cssClass'] != '' || $data['cssClass'] != 'null') echo 'class="'.$data['cssClass'].'"'; ?> allowTransparency="true"></iframe>
<?php
    echo $args['after_widget'];
  }
  function register(){
    register_sidebar_widget('Control Facebook Like Box', array('Widget_name', 'widget'));
    register_widget_control('Control Facebook Like Box', array('Widget_name', 'control'));
  }
}

?>