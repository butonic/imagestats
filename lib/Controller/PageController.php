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

namespace OCA\ImageStats\Controller;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\IRequest;

class PageController extends Controller {

	/**
	 * handler for getting image stats page
	 *
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @return TemplateResponse
	 */
	public function getStats() {
		return new TemplateResponse('imagestats', 'stats');
	}

}