<?php
/**
 * Autocomplete field class.
 */
class MASHSB_RWMB_Autocomplete_Field extends MASHSB_RWMB_Multiple_Values_Field
{
	/**
	 * Enqueue scripts and styles.
	 */
	static function admin_enqueue_scripts()
	{
		wp_enqueue_style( 'mashsb-rwmb-autocomplete', MASHSB_RWMB_CSS_URL . 'autocomplete.css', array( 'wp-admin' ), MASHSB_RWMB_VER );
		wp_enqueue_script( 'mashsb-rwmb-autocomplete', MASHSB_RWMB_JS_URL . 'autocomplete.js', array( 'jquery-ui-autocomplete' ), MASHSB_RWMB_VER, true );
		wp_localize_script( 'mashsb-rwmb-autocomplete', 'MASHSB_RWMB_Autocomplete', array( 'delete' => __( 'Delete', 'meta-box' ) ) );
	}

	/**
	 * Get field HTML
	 *
	 * @param mixed $meta
	 * @param array $field
	 * @return string
	 */
	static function html( $meta, $field )
	{
		if ( ! is_array( $meta ) )
			$meta = array( $meta );

		$field   = apply_filters( 'mashsb_rwmb_autocomplete_field', $field, $meta );
		$options = $field['options'];

		if ( ! is_string( $field['options'] ) )
		{
			$options = array();
			foreach ( (array) $field['options'] as $value => $label )
			{
				$options[] = array(
					'value' => $value,
					'label' => $label,
				);
			}
			$options = wp_json_encode( $options );
		}

		// Input field that triggers autocomplete.
		// This field doesn't store field values, so it doesn't have "name" attribute.
		// The value(s) of the field is store in hidden input(s). See below.
		$html = sprintf(
			'<input type="text" class="mashsb-rwmb-autocomplete-search" size="%s">
			<input type="hidden" name="%s" class="mashsb-rwmb-autocomplete" data-options="%s" disabled>',
			$field['size'],
			$field['field_name'],
			esc_attr( $options )
		);

		$html .= '<div class="mashsb-rwmb-autocomplete-results">';

		// Each value is displayed with label and 'Delete' option
		// The hidden input has to have ".mashsb-rwmb-*" class to make clone work
		$tpl = '
			<div class="mashsb-rwmb-autocomplete-result">
				<div class="label">%s</div>
				<div class="actions">%s</div>
				<input type="hidden" class="mashsb-rwmb-autocomplete-value" name="%s" value="%s">
			</div>
		';

		if ( is_array( $field['options'] ) )
		{
			foreach ( $field['options'] as $value => $label )
			{
				if ( in_array( $value, $meta ) )
				{
					$html .= sprintf(
						$tpl,
						$label,
						__( 'Delete', 'meta-box' ),
						$field['field_name'],
						$value
					);
				}
			}
		}
		else
		{
			foreach ( $meta as $value )
			{
				if ( empty( $value ) )
					continue;
				$label = apply_filters( 'mashsb_rwmb_autocomplete_result_label', $value, $field );
				$html .= sprintf(
					$tpl,
					$label,
					__( 'Delete', 'meta-box' ),
					$field['field_name'],
					$value
				);
			}
		}

		$html .= '</div>'; // .mashsb-rwmb-autocomplete-results

		return $html;
	}

	/**
	 * Normalize parameters for field
	 *
	 * @param array $field
	 * @return array
	 */
	static function normalize( $field )
	{
		$field = parent::normalize( $field );
		$field = wp_parse_args( $field, array(
			'size' => 30,
		) );
		return $field;
	}
}
