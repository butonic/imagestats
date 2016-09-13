<?php
/**
 * ownCloud
 *
 * @author Jörn Friedrich Dreyer <jfd@butonic.de>
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

return [
	'routes' => [
		[
			// This magic route will instantiate the PageController and call getStats() on it
			'name' => 'page#getStats',
			// matches hostname/path/to/oc/(index.php)/apps/<appid>/<url>, eg.
			// https://cloud.myserver.com/index.php/apps/imagestats
			'url' => '/stats',
			// The type of HTTP request, eg. GET, POST, PUT, DELETE
			'verb' => 'GET',
		],
		[
			'name' => 'ajax#calculateStats',
			'url' => '/ajax/stats',
			'verb' => 'GET',
		],
		[
			'name' => 'settings#getDefaultConfig',
			'url' => '/admin/default',
			'verb' => 'GET',
		],
		[
			'name' => 'settings#setDefaultConfig',
			'url' => '/admin/default',
			'verb' => 'PUT',
		],
		// TODO add route with query parameters?
	],
];