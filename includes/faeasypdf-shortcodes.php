<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
* [faeasypdf-button]
* This shortcode is used to display FA Easy WP to PDF Button
* doesn't has attributes, uses settings from DK PDF Settings / PDF Button
*/
function faeasypdf_button_shortcode( $atts, $content = null ) {

	$template = new faeasypdf_Template_Loader;

	ob_start();

	$template->get_template_part( 'faeasypdf-button' );

	return ob_get_clean();

}

add_shortcode( 'faeasypdf-button', 'faeasypdf_button_shortcode' );

/**
* [faeasypdf-remove tag="gallery"]content to remove[/faeasypdf-remove]
* This shortcode is used remove pieces of content in the generated PDF
* @return string
*/
function faeasypdf_remove_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts( array(
			'tag' => ''
		), $atts );
		$pdf = get_query_var( 'pdf' );
		$tag = sanitize_text_field( $atts['tag'] );
		if( $tag !== '' && $pdf )  {
				remove_shortcode( $tag );
				add_shortcode( $tag, '__return_false' );
				return do_shortcode( $content );
		} else if( $pdf ) {
				return '';
		}

		return do_shortcode( $content );
}
add_shortcode( 'faeasypdf-remove', 'faeasypdf_remove_shortcode' );

/**
* [faeasypdf-pagebreak]
* Allows adding page breaks for sending content after this shortcode to the next page.
* Uses <pagebreak /> http://mpdf1.com/manual/index.php?tid=108
* @return string
*/
function faeasypdf_pagebreak_shortcode( $atts, $content = null ) {

	$pdf = get_query_var( 'pdf' );

  	if( apply_filters( 'faeasypdf_hide_button_isset', isset( $_POST['faeasypdfg_action_create'] ) ) ) {
    	if ( $pdf || apply_filters( 'faeasypdf_hide_button_equal', $_POST['faeasypdfg_action_create'] == 'faeasypdfg_action_create' )  ) {

			$output = '<pagebreak />';

		} else {

			$output = '';

		}

	} else {

		if( $pdf ) {

			$output = '<pagebreak />';

		} else {

			$output = '';

		}

	}

	return $output;

}
add_shortcode( 'faeasypdf-pagebreak', 'faeasypdf_pagebreak_shortcode' );

/**
 * [faeasypdf-columns]text[/faeasypdf-columns]
 * https://mpdf.github.io/what-else-can-i-do/columns.html
 *
 * <columns column-count=”n” vAlign=”justify” column-gap=”n” />
 * column-count = Number of columns. Anything less than 2 sets columns off. (Required)
 * vAlign = Automatically adjusts height of columns to be equal if set to J or justify. Default Off. (Optional)
 * gap = gap in mm between columns. Default 5. (Optional)
 *
 * <columnbreak /> <column_break /> or <newcolumn /> (synonymous) can be included to force a new column.
 * (This will automatically disable any justification or readjustment of column heights.)
 */
function faeasypdf_columns_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'columns' => '2',
		'equal-columns' => 'false',
		'gap' => '10'
	), $atts );

	$pdf = get_query_var( 'pdf' );

	if( $pdf ) {
		$columns = sanitize_text_field( $atts['columns'] );
		$equal_columns = sanitize_text_field( $atts['equal-columns'] );
		$vAlign = $equal_columns == 'true' ? 'vAlign="justify"' : '';
		$gap = sanitize_text_field( $atts['gap'] );
		return '<columns column-count="'.$columns.'" '.$vAlign.' column-gap="'.$gap.'" />'.do_shortcode( $content ).'<columns column-count="1">';
	} else {
		remove_shortcode( 'faeasypdf-columnbreak' );
		add_shortcode( 'faeasypdf-columnbreak', '__return_false' );
		return do_shortcode( $content );
	}

}
add_shortcode( 'faeasypdf-columns', 'faeasypdf_columns_shortcode' );

/**
* [faeasypdf-columnbreak] forces a new column
* @uses <columnbreak />
*/
function faeasypdf_columnbreak_shortcode( $atts, $content = null ) {
	$pdf = get_query_var( 'pdf' );
	if( $pdf ) {
		return '<columnbreak />';
	}
}
add_shortcode( 'faeasypdf-columnbreak', 'faeasypdf_columnbreak_shortcode' );
