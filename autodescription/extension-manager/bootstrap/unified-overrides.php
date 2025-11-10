<?php
/**
 * Opinionated overrides that make the extension manager behave like a bundled module.
 *
 * @package TSF_Extension_Manager\Bootstrap
 */

namespace TSF_Extension_Manager;

defined( 'TSF_EXTENSION_MANAGER_PRESENT' ) or die;

ensure_unified_defaults();
\add_action( 'init', __NAMESPACE__ . '\\ensure_unified_defaults', 0 );

/**
 * Ensure the extension manager options always reflect an activated installation.
 */
function ensure_unified_defaults() {
        $options  = (array) \get_option( \TSF_EXTENSION_MANAGER_SITE_OPTIONS, [] );
        $defaults = [
                '_instance_version'         => '3.0',
                '_activated'                => 'Activated',
                '_activation_level'         => 'Enterprise',
                '_requires_domain_transfer' => false,
                '_remote_subscription_status' => [
                        'timestamp' => time(),
                        'divider'   => \MINUTE_IN_SECONDS * 5,
                        'status'    => [
                                'status_check'      => 'active',
                                '_activation_level' => 'Enterprise',
                                '_instance'         => '',
                                'activation_domain' => \wp_parse_url( \home_url(), PHP_URL_HOST ),
                        ],
                ],
                'license_grace'               => 0,
                'api_key'                     => '',
                'activation_email'            => \get_option( 'admin_email', '' ),
        ];

        if ( empty( $options['_instance'] ) ) {
                $options['_instance'] = \wp_generate_password( 29, false ) . \mt_rand( 100, 999 );
        }

        $merged   = array_merge( $defaults, $options );
        $updated  = $merged !== $options;
        $merged['_timestamp'] = time();

        $merged['_remote_subscription_status']['status']['_instance'] = $options['_instance'] ?? $merged['_instance'];
        $merged['_remote_subscription_status']['status']['activation_domain'] = \wp_parse_url( \home_url(), PHP_URL_HOST );

        if ( $updated ) {
                \update_option( \TSF_EXTENSION_MANAGER_SITE_OPTIONS, $merged );
        }

        $active = (array) \get_option( \TSF_EXTENSION_MANAGER_ACTIVE_EXTENSIONS_OPTIONS, [] );
        $slugs  = array_fill_keys( get_all_extension_slugs(), true );

        if ( $slugs && $slugs !== $active ) {
                \update_option( \TSF_EXTENSION_MANAGER_ACTIVE_EXTENSIONS_OPTIONS, $slugs );
        }
}

/**
 * Retrieve all available extension slugs from the bundled directory structure.
 *
 * @return array
 */
function get_all_extension_slugs() {
        static $slugs;

        if ( null !== $slugs ) {
                return $slugs;
        }

        $slugs = [];
        $tiers = glob( \TSF_EXTENSION_MANAGER_EXTENSIONS_PATH . '*', GLOB_ONLYDIR );

        if ( ! $tiers ) {
                return $slugs;
        }

        foreach ( $tiers as $tier ) {
                $extensions = glob( \trailingslashit( $tier ) . '*', GLOB_ONLYDIR );

                if ( ! $extensions ) {
                        continue;
                }

                foreach ( $extensions as $extension ) {
                        $slugs[] = basename( $extension );
                }
        }

        sort( $slugs );

        return $slugs;
}
