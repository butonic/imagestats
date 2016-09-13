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

\OCP\App::registerAdmin('imagestats', 'settings/admin');
\OCP\App::registerPersonal('imagestats', 'settings/personal');


\OC::$server->getNavigationManager()->add(function () {
	$urlGenerator = \OC::$server->getURLGenerator();
	$l = \OC::$server->getL10N('imagestats');
	return [
		'id' => 'imagestats_index',
		'order' => 1,
		'href' => $urlGenerator->linkToRoute('imagestats.page.getStats'),
		'icon' => $urlGenerator->imagePath('core', 'filetypes/image.svg'),
		'name' => $l->t('Image Stats'),
	];
});