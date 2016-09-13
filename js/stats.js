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

/*
 * This js file is requested by templates/stats.php and contains the ui logic
 */
$(document).ready(function () {

	// find the interesting dom elements from templates/stats.php
	var $section = $('#imageStats');

	// search the children of $section to not parse the whole dom every time
	// PROTIP: actually browsers start at the right side of selectors but that is a different topic
	var $imageStatsBars = $section.find('#imageStatsBars');
	var $msg = $section.find('.msg');

	// load config

	OC.msg.startAction($msg, t('imagestats', 'Loading…'));
	$.get(OC.generateUrl('apps/imagestats/ajax/stats'))
		.done(function(data) {
			// add a row for every size in data.sizes
			$.each(data.sizes, function (i, e) {
				// TODO calculate with based on biggest size span to make bars span 100%
				var width = (e.count/data.count)*100;
				$imageStatsBars.append('<div class="statrow"><div class="widthbar" style="width: '+width+'%"><span>'+e.size+' ('+e.count+')</span></div></div>');

			});
			// add a summary row with count, sum, max and avg image size
			//TODO use human readable sizes and detailed bytes on hover via tooltip... or toggle by clicking?
			$imageStatsBars.append('<div>'+data.count+' images, '+data.sum+' total bytes, '+data.max+' max size, '+data.sum/data.count+' avg size</div>');

			// tell the user everything is ok, will fade out automatically
			var data = { status: 'success',	data: {message: t('imagestats', 'Loaded')} };
			OC.msg.finishedAction($msg, data);
		})
		.fail(function(result) {
			// tell the user what went wrong
			var data = { status: 'error', data:{message:result.responseJSON.message} };
			OC.msg.finishedAction($msg, data);
		});

});
