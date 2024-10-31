<?php
__autoload("helper");
__autoload("validator");

class WidgetController extends \WP_Widget {

    private $data;
    private $option;
    private $widgetKey;
    private $widget;
    private $helper;
    private $rentivoWidgets;
    protected $loader;
    protected $twig;

    public function __construct() {



        // Start at option array and key first widget key
        $this->rentivoWidgets = get_option("rentivoWidgets");
        if (array_key_exists(0, $this->rentivoWidgets)) {
            $this->widgetKey = $this->rentivoWidgets[0];
            array_splice($this->rentivoWidgets, 0, 1);
            update_option("rentivoWidgets", $this->rentivoWidgets);
        } else {
            return "";
        }

        /*
        if(count($this->rentivoWidgets) > 0) {
            //print_r($this->rentivoWidgets);
            //unset($this->rentivoWidgets[0]);
            //reset($this->rentivoWidgets);
            array_splice($array, 1, 1);
            update_option("rentivoWidgets", $this->rentivoWidgets);
        }
        */


        $this->loader = new Twig_Loader_Filesystem(ROOT . DS .'app/views/');
        $this->twig = new Twig_Environment($this->loader);
        $this->helper = new Helper();
        $this->widget = $this->helper->getConfig("widgets")[$this->widgetKey];
        $this->option = get_option($this->widgetKey);


        $widget_ops = array(
            'classname' => 'widget-' . $this->widgetKey,
            'description' => $this->widget["meta"]["description"],
        );

        echo "--------------<br>";
        echo $this->widget["meta"]["shortcode"];
        echo "<br>";


        parent::__construct( $this->widget["meta"]["shortcode"], $this->widget["meta"]["title"], $widget_ops );
        /*
        $widget_ops = array(
            'classname' => 'rw_booking_button_widget',
            'description' => "Rentivo live availability & booking button widget.",
        );
        parent::__construct( 'rw_booking_button_widget', 'Rentivo Booking Button', $widget_ops );
        */

    }


    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        echo "hello";
        /*
        // If not active
        if (filter_var(get_option("rentivoWidgetsGeneral")["active"], FILTER_VALIDATE_BOOLEAN) == false or filter_var($this->option["active"], FILTER_VALIDATE_BOOLEAN) == false) {
            return "";
        }

        echo $args['before_widget'];


        // Setup vars for template
        $this->data["widgetKey"] = $this->widgetKey;
        //$this->set("params", $this->helper->convertBoolsToBinaryString($attributes));
        $this->data["containerId"] = $this->helper->generateRandomString();

        // Check data bridge
        if (get_option("dataBridgeOption") == false) {
            update_option("dataBridgeOption", true);
            $this->data["dataBridgeOption"] = "PropertyDataBridge, ";
        } else {
            update_option("dataBridgeOption", false);
            $this->data["dataBridgeOption"] = "";
        }

        // Return booking button javascript/html
        //echo $this->twig->render("injectables/front/rentivo-widget.html.twig", $this->data);
        echo "HELLO IT'S ME YOU'RE LOOKING FOR";

        echo $args['after_widget'];
        */

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        echo "form";
        /*
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Book now', 'text_domain' );
        $entityId = ! empty( $instance['entityId'] ) ? $instance['entityId'] : __( '', 'text_domain' );
        $calendarName = ! empty( $instance['calendarName'] ) ? $instance['calendarName'] : __( '', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'entityId' ); ?>"><?php _e( 'Rentivo property ID:' ); ?> <a href="https://www.rentivo.com/docs/Property_Owners/Create_Listing/getting_your_rental_id.html" target="_blank">How do I get my property ID?</a></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'entityId' ); ?>" name="<?php echo $this->get_field_name( 'entityId' ); ?>" type="text" value="<?php echo esc_attr( $entityId ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'calendarName' ); ?>"><?php _e( 'Calendar name (optional):' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'calendarName' ); ?>" name="<?php echo $this->get_field_name( 'calendarName' ); ?>" type="text" value="<?php echo esc_attr( $calendarName ); ?>">
        </p>
    <?php
        */
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        /*
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['entityId'] = ( ! empty( $new_instance['entityId'] ) ) ? strip_tags( $new_instance['entityId'] ) : '';
        $instance['calendarName'] = ( ! empty( $new_instance['calendarName'] ) ) ? strip_tags( $new_instance['calendarName'] ) : '';
        return $instance;
        */
    }

}