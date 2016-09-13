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
$(document).ready(function () {
	var $section = $('#imageStats');
	var $includeThumbnails = $section.find('#includeThumbnails');
	var $msg = $section.find('.msg');

	// load config

	OC.msg.startAction($msg, t('imagestats', 'Loading…'));
	$.get(OC.generateUrl('apps/imagestats/admin/default'))
		.done(function(data) {
			$includeThumbnails.prop('checked', data.includeThumbnails);
			var data = { status: 'success',	data: {message: t('imagestats', 'Loaded')} };
			OC.msg.finishedAction($msg, data);
		})
		.fail(function(result) {
			var data = { status: 'error', data:{message:result.responseJSON.message} };
			OC.msg.finishedAction($msg, data);
		});

	// save config

	$includeThumbnails.change(function() {
		OC.msg.startSaving($msg);
		$.ajax({
			url: OC.generateUrl('/apps/imagestats/admin/default'),
			contentType: 'application/json',
			data: JSON.stringify({
				includeThumbnails: $(this).is(":checked")
			}),
			dataType: 'json',
			type: 'PUT'
		}).success(function() {
			var data = { status:'success', data:{message:t('imagestats', 'Saved')} };
			OC.msg.finishedSaving($msg, data);
		}).fail(function(result) {
			var data = { status: 'error', data:{message:result.responseJSON.message} };
			OC.msg.finishedSaving($msg, data);
		});
	});

});
