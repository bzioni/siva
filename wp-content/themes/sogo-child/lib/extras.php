<?php

function sogo_print_btn( $args = '' ) {
	$defaults = array(
		'href'     => '',
		'target'   => '',
		'button'   => false,
		'type'     => 'button',
		'text'     => '',
		'class'    => '',
		'id'       => '',
		'data'     => array(),
		'disabled' => false,
		'value'    => '',
		'download' => false,
		'icon'     => ''
	);
	$r        = wp_parse_args( $args, $defaults );

	$dom = new DOMDocument();

	$el      = $r['button'] ? 'button' : 'a';
	$element = $dom->createElement( $el );

	$r['class'] ? $element->setAttribute( "class", $r['class'] ) : null;
	$r['id'] ? $element->setAttribute( "id", $r['id'] ) : null;

	if ( $el === 'a' ) {
		$element->setAttribute( 'href', $r['href'] );
		if ( ! empty( $r['target'] ) ) {
			$element->setAttribute( 'target', $r['target'] );
		}
		if ( $r['download'] ) {
			$element->setAttribute( 'download', true );
		}
	}
	if ( $el === 'button' ) {
		$element->setAttribute( 'type', $r['type'] );
	}

	if ( $r['data'] ) {
		foreach ( $r['data'] as $key => $data ) {
			$element->setAttribute( "data-{$key}", $data );
		}
	}

	if ( $r['icon'] ) {
		$icon = $dom->createElement( 'span', '' );
		$icon->setAttribute( 'class', $r['icon'] . ' m' . (is_rtl() ? 'l' : 'r') . '-1' );
		$element->appendChild( $icon );
	}

	$text = $dom->createElement( 'span', $r['text'] );

	$element->appendChild( $text );
	$dom->appendChild( $element );
	echo $dom->saveHTML();
}

function sogo_print_bg( $args ) {
	if ( $args ) {
		$defaults = array(
			'url'      => '',
			'repeat'   => 'no-repeat',
			'size'     => 'cover',
			'position' => 'center center',
			'style'    => '',
		);
		$r        = wp_parse_args( $args, $defaults );
		echo sprintf( 'style="background-image:url(\'%s\'); background-repeat: %s ; background-size: %s; background-position: %s; %s"',
			$r['url'], $r['repeat'], $r['size'], $r['position'], $r['style'] );
	}

	return false;
}

function sogo_print_input( $label, $id, $required = false, $value = '', $name = '', $args = array() ) {
	if ( ! $name ) {
		$name = $id;
	}
	if ( $required ) {
		$required = '*';
	}
	$defaults = array( 'type' => 'text', 'label-class' => '' ); // can add whatever you want
	if ( $args ) {
		$defaults = wp_parse_args( $args, $defaults );
	}

	$input = "<div class='form-group'>";
	$input .= "<label class='{$defaults['label-class']}' for='{$id}'>{$label}{$required}</label>";
	$input .= "<input type='{$defaults['type']}' name='{$name}' id='{$id}' value='{$value}' class='form-control'>";
	$input .= '</div>';

	return $input;
}

function sogo_print_textarea( $label, $id, $required = false, $value = '', $rows = 3, $cols = 0, $name = '', $inline = true, $args = array() ) {
	if ( ! $name ) {
		$name = $id;
	}
	if ( $required ) {
		$required = '*';
	}
	$defaults = array( 'label-class' => '' ); // can add whatever you want
	if ( $args ) {
		$defaults = wp_parse_args( $args, $defaults );
	}

	$input = "<div class='form-group'>";
	$input .= $inline ? '<div class="row">' : ''; // for this project only
	$input .= $inline ? '<div class="col-md-3">' : ''; // for this project only
	$input .= "<label class='{$defaults['label-class']}' for='{$id}'>{$label}{$required}</label>";
	$input .= $inline ? '</div>' : ''; // for this project only
	$input .= $inline ? '<div class="col-md-9">' : ''; // for this project only
	$input .= "<textarea name='{$name}' id='{$id}' class='form-control' rows='{$rows}' cols='{$cols}'>{$value}</textarea>";
	$input .= $inline ? '</div>' : ''; // for this project only
	$input .= $inline ? '</div>' : ''; // for this project only
	$input .= '</div>';

	return $input;
}

function sogo_print_checkbox( $label, $name, $id, $value = '' ) {
	if ( ! $name ) {
		$name = $id;
	}


	$checked = '';
	if ( $value === 'true' ) {
		$checked = 'checked';
	} else {
		$value = 'false';
	}

	$input = "<div class='custom-control custom-checkbox'>";
	$input .= "<input type='hidden' name='{$name}' value='{$value}'>";
	$input .= "<input type='checkbox' class='custom-control-input' name='{$name}' id='{$id}' {$checked}>";
	$input .= "<label class='custom-control-label' for='{$id}'>{$label}</label>";
	$input .= '</div>';

	return $input;
}

function sogo_print_radio( $title, $name, $options = array( 'id_value' => 'Text' ), $required = false, $inline = false, $value = '' ) {

	if ( $inline ) {
		$inline = 'custom-control-inline';
	}

	if ( $required ) {
		$required = '*';
	}

	$checked = '';
	$input   = "<div>{$title}{$required}</div>";
	foreach ( $options as $key => $option ) {
		if ( $value && $value === $key ) {
			$checked = 'checked';
		}
		$input   .= "<div class='custom-control custom-radio {$inline}'>";
		$input   .= "<input type='radio' class='custom-control-input' name='{$name}' id='{$key}' value='{$key}' {$checked}>";
		$input   .= "<label class='custom-control-label' for='{$key}'>{$option}</label>";
		$input   .= '</div>';
		$checked = '';
	}

	return $input;
}

function sogo_print_select( $label, $id, $options = array( 'id_value' => 'Text' ), $placeholder = false, $required = false, $value = '', $name = '', $args = array() ) {
	if ( ! $name ) {
		$name = $id;
	}
	if ( $required ) {
		$required = '*';
	}

	$defaults = array( 'label-class' => '' ); // can add whatever you want
	if ( $args ) {
		$defaults = wp_parse_args( $args, $defaults );
	}


	$placeholder_selected = 'selected';
	$option_selected      = '';
	if ( $value ) {
		$placeholder_selected = '';
	}
	$input = "<div class='form-group'>";
	$input .= "<label class='{$defaults['label-class']}' for='{$id}'>{$label}{$required}</label>";
	$input .= '<div class="arrowdown">';
	$input .= "<select name='{$name}' id='{$id}' class='form-control'>";
	if ( $placeholder ) {
		$input .= "<option {$placeholder_selected} value=''>{$placeholder}</option>";
	}
	foreach ( $options as $key => $option ) {
		if ( $value && $value === $key ) {
			$option_selected = 'selected';
		}
		$input           .= "<option {$option_selected} value='{$key}'>{$option}</option>";
		$option_selected = '';
	}
	$input .= '</select>';
	$input .= '</div>';
	$input .= '</div>';

	return $input;
}


