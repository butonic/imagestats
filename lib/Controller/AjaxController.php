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

class AjaxController extends Controller {

	/**
	 * @var IConfig
	 */
	private $config;
	public function __construct($AppName, IRequest $request, IConfig $config) {
		parent::__construct($AppName, $request);
		$this->config = $config;
	}

	public function nextPowerOf2($number) {
		$number--;
		$number |= $number >> 1;
		$number |= $number >> 2;
		$number |= $number >> 4;
		$number |= $number >> 8;
		$number |= $number >> 16;
		$number++;
		return $number;
	}

	/**
	 * AJAX handler for getting the config
	 *
	 * TODO use eventsource
	 * @NoCSRFRequired TODO remove
	 * @NoAdminRequired
	 * @return JSONResponse with the current config
	 */
	public function calculateStats() {
		$includeThumbnails = $this->config->getAppValue('imagestats', 'includeThumbnails', true);
		//convert string to boolean
		if ($includeThumbnails === '1' || $includeThumbnails === 'true' || $includeThumbnails === true) {
			$includeThumbnails = true;
		} else {
			$includeThumbnails = false;
		}

		$folder = \OC::$server->getUserFolder();
		if ($includeThumbnails) {
			// to include thumbnails start at the real user home
			$folder = $folder->getParent();
		}
		$nodes = $folder->searchByMime('image');
		$max = 0;
		$sizes = [];
		$sum = 0;
		$count = 0;
		foreach ($nodes as $node) {
			$count++;
			$size = (int)$node->getSize(); // I found a "bug"
			if ($max < $size) {
				$max = $size;
			}
			$sum += $size;
			$nextPowerOf2 = $this->nextPowerOf2($size);
			if (empty($sizes[$nextPowerOf2])) {
				$sizes[$nextPowerOf2] = 0;
			}
			$sizes[$nextPowerOf2]++;
		}

		$sorted = array_keys($sizes);
		sort($sorted);

		foreach ($sorted as $key => $value) {
			$sorted[$key] = ['size' => $value, 'count' => $sizes[$value]];
		}

		return new JSONResponse([
			'includeThumbnails' => $includeThumbnails,
			'count' => $count,
			'sum' => $sum,
			'max' => $max,
			'sizes' => $sorted
		]);
	}

}