<?php
/**
 * Bootstrap loader for the bundled SEO Framework extension manager.
 *
 * This file mirrors the original standalone plugin bootstrap while omitting
 * plugin headers so WordPress no longer registers it as a separate plugin.
 *
 * @package TSF_Extension_Manager\Bootstrap
 */

defined( 'ABSPATH' ) or die;

/**
 * The SEO Framework - Extension Manager plugin
 * Copyright (C) 2016 - 2024 Sybre Waaijer, CyberWire B.V. (https://cyberwire.nl/)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3 as published
 * by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * The plugin version. Always 3 point.
 *
 * @since 1.0.0
 */
define( 'TSF_EXTENSION_MANAGER_VERSION', '2.7.1' );

/**
 * The plugin's database version.
 *
 * @since 1.5.0
 */
define( 'TSF_EXTENSION_MANAGER_DB_VERSION', '2700' );

/**
 * The plugin file, absolute unix path.
 *
 * @since 1.0.0
 */
define( 'TSF_EXTENSION_MANAGER_PLUGIN_BASE_FILE', __FILE__ );

/**
 * The plugin basename relative to the plugins directory.
 *
 * @since 1.0.0
 */
define( 'TSF_EXTENSION_MANAGER_PLUGIN_BASENAME', plugin_basename( TSF_EXTENSION_MANAGER_PLUGIN_BASE_FILE ) );

/**
 * The plugin's bootstrap folder location.
 *
 * @since 1.5.0
 */
define(
	'TSF_EXTENSION_MANAGER_BOOTSTRAP_PATH',
	dirname( TSF_EXTENSION_MANAGER_PLUGIN_BASE_FILE ) . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR
);

// Define environental constants.
require TSF_EXTENSION_MANAGER_BOOTSTRAP_PATH . 'define.php';

// Load plugin API functions.
require TSF_EXTENSION_MANAGER_DIR_PATH_FUNCTION . 'api.php';

// Load plugin.
require TSF_EXTENSION_MANAGER_BOOTSTRAP_PATH . 'load.php';

// Ensure extension data is initialized without external activation.
require TSF_EXTENSION_MANAGER_BOOTSTRAP_PATH . 'unified-overrides.php';
