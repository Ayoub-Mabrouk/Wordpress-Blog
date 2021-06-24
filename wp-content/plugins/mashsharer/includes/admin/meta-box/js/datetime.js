jQuery( function ( $ )
{
	'use strict';

	/**
	 * Update datetime picker element
	 * Used for static & dynamic added elements (when clone)
	 */
	function update()
	{
		var $this = $( this ),
			options = $this.data( 'options' ),
			$inline = $this.siblings( '.mashsb-rwmb-datetime-inline' ),
			$timestamp = $this.siblings( '.mashsb-rwmb-datetime-timestamp' ),
			current = $this.val();

		$this.siblings( '.ui-datepicker-append' ).remove(); // Remove appended text
		if ( $timestamp.length )
		{
			var $picker = $inline.length ? $inline : $this;
			options.onSelect = function ()
			{
				$timestamp.val( getTimestamp( $picker.datetimepicker( 'getDate' ) ) );
			};
		}

		if ( $inline.length )
		{
			options.altField = '#' + $this.attr( 'id' );
			$inline
				.removeClass( 'hasDatepicker' )
				.empty()
				.prop( 'id', '' )
				.datetimepicker( options )
				.datetimepicker( 'setDate', current );
		}
		else
		{
			$this.removeClass( 'hasDatepicker' ).datetimepicker( options );
		}
	}

	/**
	 * Convert date to Unix timestamp in milliseconds
	 * @link http://stackoverflow.com/a/14006555/556258
	 * @param date
	 * @return number
	 */
	function getTimestamp( date )
	{
		var milliseconds = Date.UTC( date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds() );
		return Math.floor( milliseconds / 1000 );
	}

	// Set language if available
	if ( $.timepicker.regional.hasOwnProperty( MASHSB_RWMB_Datetimepicker.locale ) )
	{
		$.timepicker.setDefaults( $.timepicker.regional[MASHSB_RWMB_Datetimepicker.locale] );
	}
	else if ( $.timepicker.regional.hasOwnProperty( MASHSB_RWMB_Datetimepicker.localeShort ) )
	{
		$.timepicker.setDefaults( $.timepicker.regional[MASHSB_RWMB_Datetimepicker.localeShort] );
	}

	$( ':input.mashsb-rwmb-datetime' ).each( update );
	$( '.mashsb-rwmb-input' ).on( 'clone', ':input.mashsb-rwmb-datetime', update );
} );
