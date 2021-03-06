<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Buttonset control
 */
class Kirki_Controls_Dimensions_Responsive_Control extends Kirki_Control_Base {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'dimensions-responsive';

    protected $controls = [];

    protected $device = '';

    /**
     * Enqueue control related scripts/styles.
     *
     * @access public
     */
    public function enqueue() {

        wp_enqueue_script( 'analytica-dimensions', analytica()->theme_url . '/assets/admin/js/modules/customizer/controls/dimensions.js', array( 'jquery', 'customize-base' ), analytica()->theme_version, true );
        wp_localize_script( 'analytica-dimensions', 'analyticaL10n', $this->l10n() );

        wp_enqueue_style( 'analytica-dimensions', analytica()->theme_url . '/assets/admin/css/customizer/controls/dimensions.min.css', analytica()->theme_version );
    }

    /**
     * Renders the control wrapper and calls $this->render_content() for the internals.
     *
     * @see WP_Customize_Control::render()
     */
    protected function render() {
        $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
        $class = 'customize-control has-switchers customize-control-' . $this->type;

        ?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
            <?php $this->render_content(); ?>
        </li><?php
    }

    /**
     * Fetch a setting's value.
     * Grabs the main setting by default.
     *
     * @since 3.4.0
     *
     * @param string $setting_key
     * @return mixed The requested setting's value, if the setting exists.
     */
    public function get_value( $setting_key = 'default' ) {
        $value = $this->value();

        if ( isset( $value[ $setting_key ] ) ) {
            return $value[ $setting_key ];
        }
    }

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @see WP_Customize_Control::to_json()
     */
    public function to_json() {
        parent::to_json();

        $this->json['id'] 		= $this->id;
        $this->json['l10n']    	= $this->l10n();
        $this->json['title'] 	= esc_html__( 'Link values together', 'analytica' );
        $this->json['choices'] = $this->choices;
        $this->json['device']   = $this->device ? $this->device : 'desktop';

        $this->json['inputAttrs'] = '';
        foreach ( $this->input_attrs as $attr => $value ) {
            $this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
        }

        foreach ( $this->choices as $control ) {
            $this->json[ $this->device ][ $control ] = array(
                'id'        => $control,
                'link'      => $this->get_link( $control ),
                'value'     => $this->get_value( $control ),
            );
        }
    }

    /**
     * An Underscore (JS) template for this control's content (but not its container).
     *
     * Class variables for this control class are available in the `data` JS object;
     * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
     *
     * @see WP_Customize_Control::print_template()
     *
     * @access protected
     */
    protected function content_template() {
        ?>
        <# if ( data.label ) { #>
            <span class="customize-control-title">
                <span>{{{ data.label }}}</span>
                <ul class="responsive-switchers">
                    <li class="desktop">
                        <button type="button" class="preview-desktop active" data-device="desktop">
                            <i class="dashicons dashicons-desktop"></i>
                        </button>
                    </li>
                    <li class="tablet">
                        <button type="button" class="preview-tablet" data-device="tablet">
                            <i class="dashicons dashicons-tablet"></i>
                        </button>
                    </li>
                    <li class="mobile">
                        <button type="button" class="preview-mobile" data-device="mobile">
                            <i class="dashicons dashicons-smartphone"></i>
                        </button>
                    </li>
                </ul>
            </span>
        <# } #>

        <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

            <ul class="control-wrap">
            <# _.each( data[ data.device ], function( args, key ) {
                #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                    <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
            <# } ); #>

            <li class="dimension-wrap">
                <div class="link-dimensions">
                    <span class="dashicons dashicons-admin-links analytica-linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                    <span class="dashicons dashicons-editor-unlink analytica-unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                </div>
            </li>
        </ul><?php

    }

    /**
     * Returns an array of translation strings.
     *
     * @access protected
     * @param string|false $id The string-ID.
     * @return string
     */
    protected function l10n( $id = false ) {
        $translation_strings = array(
            'top' 		=> esc_attr__( 'Top', 'analytica' ),
            'right' 	=> esc_attr__( 'Right', 'analytica' ),
            'bottom' 	=> esc_attr__( 'Bottom', 'analytica' ),
            'left' 		=> esc_attr__( 'Left', 'analytica' ),
        );
        if ( false === $id ) {
            return $translation_strings;
        }
        return $translation_strings[ $id ];
    }
}

add_action( 'customize_register', 'analytica_customize_register_dimensions_controls' );
// Register control with kirki
function analytica_customize_register_dimensions_controls( $wp_customize ) {
    $wp_customize->register_control_type( 'Kirki_Controls_Dimensions_Responsive_Control' );
}

add_filter( 'kirki_control_types', 'analytica_register_dimensions_kirki_control_type' );
// Register our custom control with Kirki
function analytica_register_dimensions_kirki_control_type( $controls ) {
    $controls['dimensions-responsive'] = 'Kirki_Controls_Dimensions_Responsive_Control';
    return $controls;
}
