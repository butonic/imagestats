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

// Add an entry in the admin settings, will load settings/admin.php
\OCP\App::registerAdmin('imagestats', 'settings/admin');

// Add an entry in the personal settings, will load settings/personal.php
\OCP\App::registerPersonal('imagestats', 'settings/personal');

// Add an entry to the main navigation menu
\OC::$server->getNavigationManager()->add(function () {
	// get the URLGenerator to build correct url
	$urlGenerator = \OC::$server->getURLGenerator();
	// get the localization for this app
	$l = \OC::$server->getL10N('imagestats');
	return [
		// the unique id of this navigation entry
		// TODO why do we need this?
		'id' => 'imagestats_index',
		// influence the ordering of apps
		// TODO what are the known app orders, eg in the release, probably allow usor to change order?
		'order' => 2,
		// the route name imagestats.page.getStats consists of the app id,
		// the controller and the method seperated by '.', eg
		// imagestats page#getStats (see router.php) -> imagestats.page.getStats
		// TODO why not imagestats.page#getStats
		'href' => $urlGenerator->linkToRoute('imagestats.page.getStats'),
		// what icon to show, this one is actually too small
		// TODO - can we change the size via CSS?
		// Apps should be self contained, so place in image into img und use that
		'icon' => $urlGenerator->imagePath('core', 'filetypes/image.svg'),
		// Show a translated app name under the icon
		'name' => $l->t('Image Stats'),
	];
});