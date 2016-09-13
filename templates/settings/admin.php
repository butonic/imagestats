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

/** @var OC_L10N $l */
script('imagestats', 'settings/admin');
?>
<div class="section" id="imageStats">
	<h2><?php p($l->t('Image Stats')); ?></h2>
	<p>
		<input id="includeThumbnails" type="checkbox" class="checkbox"/>
		<label for="includeThumbnails"><?php p($l->t('Include thumbnails in stats by default')); ?></label>
		<span class="msg"></span>
	</p>
</div>
