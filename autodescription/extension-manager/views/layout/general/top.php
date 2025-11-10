<?php
/**
 * @package TSF_Extension_Manager\Core\Views\General
 */

// phpcs:disable, VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable -- includes.
// phpcs:disable, WordPress.WP.GlobalVariablesOverride -- This isn't the global scope.

defined( 'TSF_EXTENSION_MANAGER_PRESENT' ) and tsfem()->_verify_instance( $_instance, $bits[1] ) or die;

$about = $actions = '';

if ( $options ) {
        $message = esc_html__( 'All extensions are bundled with The SEO Framework and active on this site.', 'the-seo-framework-extension-manager' );
        $account = "<div class=tsfem-top-account><span class=tsfem-top-account__notice>$message</span></div>";
        $actions = '<div class="tsfem-top-actions tsfem-flex tsfem-flex-row">' . $account . '</div>';
}

?>
<div class=tsfem-title>
	<header><h1>
		<?php
		$size = '1em';
		printf(
			'<span class=tsfem-logo>%sExtension Manager</span>',
			sprintf(
				'<svg width="%1$s" height="%1$s">%2$s</svg>',
				esc_attr( $size ),
				sprintf(
					'<image href="%1$s" width="%2$s" height="%2$s" />',
					esc_url( $this->get_image_file_location( 'tsflogo.svg', true ), [ 'https', 'http' ] ),
					esc_attr( $size )
				)
			)
		);
		?>
	</h1></header>
</div>
<?php

// phpcs:ignore, WordPress.Security.EscapeOutput -- Already escaped.
echo $about, $actions;
