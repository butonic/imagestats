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
 * This js file is requested by templates/settings/admin.php and contains the ui logic
 */

// jail the code into an anonymous namespace so it does not interfere with any other apps
// TODO how DO you interact with other apps, eg OCA.Files?
$(document).ready(function () {

	// find the interesting dom elements from templates/settings/admin.php
	var $section = $('#imageStats');

	// search the children of $section to not parse the whole dom every time
	// PROTIP: actually browsers start at the right side of selectors but that is a different topic
	var $includeThumbnails = $section.find('#includeThumbnails');
	var $msg = $section.find('.msg');

	// load config via ajax, in this case the settings controller TODO use an admin controller

	// tell the user what is happening
	OC.msg.startAction($msg, t('imagestats', 'Loading…'));

	// do a get request with jquery to the url of the controller/method you want to call
	$.get(OC.generateUrl('apps/imagestats/admin/default'))
		.done(function(data) {
			// the call was successful and we have the result in `data`
			// update the ui
			// TODO the template should start with a disabled checkbox that is only enabled on success or show a spinner instead of the checkbox?
			$includeThumbnails.prop('checked', data.includeThumbnails);

			// tell the user everything is ok, will fade out automatically
			var data = { status: 'success',	data: {message: t('imagestats', 'Loaded')} };
			OC.msg.finishedAction($msg, data);
		})
		.fail(function(result) {
			// tell the user what went wrong
			var data = { status: 'error', data:{message:result.responseJSON.message} };
			OC.msg.finishedAction($msg, data);
		});

	// save config via ajax

	// listen to change events on the checkbox
	$includeThumbnails.change(function() {

		// tell the user what is happening
		OC.msg.startSaving($msg);

		// go the extra mile and make jquery actually send a PUT request containing a JSON object
		$.ajax({
			url: OC.generateUrl('/apps/imagestats/admin/default'),
			contentType: 'application/json',
			// JavaSript != JSON: you need to manually convert it to a string based representation
			data: JSON.stringify({
				// this will use the current checked state of the checkbox and
				// create a string like '{"includeThumbnails":true}' which is
				// then sent as the body of a PUT request
				includeThumbnails: $(this).is(":checked")
			}),
			dataType: 'json',
			type: 'PUT'
		}).success(function() {
			// tell the user everything is ok, will fade out automatically
			// TODO why od we need a 'Saved' message when this is using `finishSaving`?
			// It should be added automatically by default, as with `startSaving` above
			var data = { status:'success', data:{message:t('imagestats', 'Saved')} };
			OC.msg.finishedSaving($msg, data);
		}).fail(function(result) {
			// tell the user what went wrong
			var data = { status: 'error', data:{message:result.responseJSON.message} };
			OC.msg.finishedSaving($msg, data);
		});
	});

});
