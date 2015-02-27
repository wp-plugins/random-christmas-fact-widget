<?php

/*
Plugin Name: Random Christmas Fact Widget
Plugin URI: http://christmaswebmaster.com/random-christmas-fact-widget/
Description: Displays a random Christmas fact widget in your sidebar.
Author: Monica Mays
Version: 1
Author URI: http://christmaswebmaster.com/


Random Christmas Fact Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or 
any later version.

Random Christmas Fact Widget is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Random Christmas Fact Widget. If not, see <http://www.gnu.org/licenses/>.

*/


//Enqueue Countdown Scripts and Styles

function cw_randomtext_script() {
   wp_enqueue_script( 'randomtext-scripts', plugins_url( 'scripts/scriptfile.js', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'cw_randomtext_script' );



//Extends Countdown Widget

class cw_randomtext extends WP_Widget {
  function cw_randomtext()
  {
    $widget_ops = array('classname' => 'cw_randomtext', 'description' => 'Drag this widget to your sidebar to display random Christmas facts.' );
    $this->WP_Widget('cw_randomtext', 'Random Christmas Fact', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
}
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 

    echo '<script type="text/javascript">
          <!--
          cw_randomtext();
          //--></script>';
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("cw_randomtext");') );
