<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Field: Switcher
 *
 */
if ( ! class_exists( 'Exopite_Simple_Options_Framework_Field_switcher' ) ) {

	class Exopite_Simple_Options_Framework_Field_switcher extends Exopite_Simple_Options_Framework_Fields {

		public function __construct( $field, $value = '', $unique = '', $config = array() ) {
			parent::__construct( $field, $value, $unique, $config );
		}

		public function output() {

			$label =

			$classes = ( isset( $this->field['class'] ) ) ? implode( ' ', explode( ' ', $this->field['class'] ) ) : '';

			echo '<label class="checkbox">';
			echo '<input name="' . esc_attr($this->element_name()) . '" value="yes" class="checkbox__input ' . esc_attr($classes) . '" type="checkbox"' . esc_attr($this->element_attributes()) . esc_attr(checked( $this->element_value(), 'yes', false ) ). '>';
			echo '<div class="checkbox__switch"></div>';
			echo '</label>' . ( isset( $this->field['label'] ) ) ? '<div class="exopite-sof-text-desc">' . esc_attr($this->field['label']) . '</div>' : '';

      echo  ( isset( $this->field['info'] ) ) ? '<span class="exopite-sof-text-desc">' . esc_attr($this->field['info']) . '</span>' : '';
			echo ( isset( $this->field['after'] ) ) ? '<div class="exopite-sof-after">' . esc_attr($this->field['after']) . '</div>' : '';


		}

	}

}
