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
use OCP\IConfig;
use OCP\IRequest;

class SettingsController extends Controller {

	/**
	 * @var IConfig
	 */
	private $config;
	public function __construct($AppName, IRequest $request, IConfig $config) {
		parent::__construct($AppName, $request);
		$this->config = $config;
	}

	/**
	 * AJAX handler for getting the config
	 *
	 * @return JSONResponse with the current config
	 */
	public function getDefaultConfig() {
		$includeThumbnails = $this->config->getAppValue('imagestats', 'includeThumbnails', true);
		//convert string to boolean
		if ($includeThumbnails === '1' || $includeThumbnails === 'true' || $includeThumbnails === true) {
			$includeThumbnails = true;
		} else {
			$includeThumbnails = false;
		}
		return new JSONResponse([
			'includeThumbnails' => $includeThumbnails
		]);
	}

	/**
	 * AJAX handler for setting the config
	 *
	 * @param bool $includeThumbnails
	 * @return JSONResponse
	 */
	public function setDefaultConfig( $includeThumbnails ) {
		$this->config->setAppValue('imagestats', 'includeThumbnails', $includeThumbnails);
		return new JSONResponse();
	}

}