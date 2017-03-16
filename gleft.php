<?php
/*
Plugin Name: Single Tour Details
Plugin URI: none
Description: display 4 columns in a row. Duration, Languages, Meeting Point and text
Version: 0.2
Author: gleft
Author URI: none
License: GPLv2
*/
?>
<?php
class gleft_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(

        // base ID of the widget
            'gleft_widget',

            // name of the widget
            __('show_the_fields', 'gleft' ),

            // widget options
            array (
                'description' => __( 'show some values', 'gleft' )
            )

        );
    }

    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }

    function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

        //try this

        //end try




        function dur_sc()
        {
            $dur = get_field("duration");
            if ($dur) {
                //  echo "duration :  ";
                echo $dur;
                return ($dur);
            }
        }
        add_shortcode('my_shortcode', 'dur_sc');



        //try with html code
        ?>
        <div class="container">
	<div class="row">
        <div class="col-xs-12 col-sm-4 col-lg-3">
			<div style="border-right: 2px solid #e0e0e0;" class="box">
				<div class="icon">
					<div class="image"><i class="fa fa-clock-o fa-4x"></i></div>
					<div class="info">
						<h3 class="title">duration</h3>
    					<p><?php $durat = get_field("duration");
                            if ($durat) {
                                //  echo "duration :  ";
                                //echo $durat;
                                echo"<p style='text-align: center;'>" .$durat."</p>";

                            } ?>						</p>

					</div>
				</div>
				<div class="space"></div>
			</div>
		</div>



                <div class="col-xs-12 col-sm-4 col-lg-3">
                    <div style="border-right: 2px solid #e0e0e0;" class="box">
                        <div class="icon">
                            <div class="image"><i class="fa fa-language fa-4x"></i></div>
                            <div class="info">
                                <h3 class="title">languages</h3>
                                <p><?php
                                    $languages = get_field('languages');
                                    if($languages)
                                    {
                                        echo '<ul>';

                                        foreach($languages as $language)
                                        {
                                            echo '<li style="text-align: center;">' . $language . '</li>';
                                        }

                                        echo '</ul>';
                                    }
                                     ?>						</p>

                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-4 col-lg-3">
                    <div class="box">
                        <div class="icon">
                            <div class="image"><i class="fa fa-compass fa-4x"></i></div>
                            <div class="info">
                                <h3 class="title">meeting point</h3>
                                <p><?php $meetpoint = get_field("meeting_point");
                                    if ($meetpoint) {
                                        //echo ' meeting_point:  ,';
                                        //echo $meetpoint ;
                                        echo"<p style='text-align: center;'>" .$meetpoint."</p>";

                                    } ?>						</p>

                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-4 col-lg-3">
                    <div style="border-left: 2px solid #e0e0e0;" class="box">
                        <div class="icon">
                            <div class="image"><i style="margin: auto;" class="fa fa-american-sign-language-interpreting fa-4x"></i></div>
                            <div class="info">
                                <h3 class="title">keimeno</h3>
                                <p style='text-align: center;'><?php
                                        echo "keimeno";

                                    ?>						</p>

                            </div>
                        </div>
                        <div class="space"></div>
                    </div>
                </div>
            </div>
        </div>

<?php   //end html






function lan_sc()
{ $lan = get_field("languages");
    if ($lan) {
        //echo '<ul>';
        foreach ($lan as $lang) {
            return  '<li>' . $lang . '</li>';
        }
       // echo '</ul>';
    }}
        add_shortcode('lan_shortcode', 'lan_sc');





        $pername = get_post("person_type_id");
        //echo"this";
        if ($pername) {
            echo ' name  ,';
            echo $pername;
        }
function meet_sc() {
    global $meetpoint;
    $meetpoint = get_field("meeting_point");
    if ($meetpoint) {
        //echo ' meeting_point:  ,';
        return $meetpoint ;
    }
}
        add_shortcode('meet_shortcode', 'meet_sc');


    }

}
?>
<?php
function gleft_register_widget() {

    register_widget( 'gleft_Widget' );

}
add_action( 'widgets_init', 'gleft_register_widget' );
?>