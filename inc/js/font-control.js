/*
* Font tester
*/

var styleproperty = {};
jQuery(".custom_slider").on("input change", function() {
    var randId 		= jQuery(this).attr('data-id');
	var fontStyle	= jQuery(this).attr('data-font');
	var textSize 	= jQuery('#text-size-'+randId).val();
	var textHeight 	= jQuery('#text-height-'+randId).val();
	var textSpacing 	= jQuery('#text-spacing-'+randId).val();
	styleproperty[randId] = {
		fontStyle : fontStyle,
		textSize : textSize,
		lineHeight : (parseInt(textHeight)/100 * parseInt(textSize)),
		textSpacing : textSpacing,
	};
	set_style(randId);
	
	
	console.log(randId);
});

function change_font_setting(id,fontStyle) {	
	console.log("textSize",textSize);
}

function set_aliment(id,align) {
	if(styleproperty.hasOwnProperty(id) && styleproperty[id].hasOwnProperty('align')) {
		var preVal = styleproperty[id]['align'];
		styleproperty[id]['align'] = align;
		jQuery('.align-'+preVal+'-'+id).removeClass('current');
		jQuery('.align-'+align+'-'+id).addClass('current');
	} else {
		if(!styleproperty.hasOwnProperty(id)) {
			var fontStyle	= jQuery(this).attr('data-font');
			styleproperty[id] = {
				fontStyle : fontStyle,
				textSize : 80,
				lineHeight : 80,
			}
		}
		styleproperty[id]['align'] = align;
		jQuery('.align-left-'+id).removeClass('current');
		jQuery('.align-'+align+'-'+id).addClass('current');
	}
	set_style(id);
}

function set_style(randId) {

	var align = 'left';
	if(styleproperty.hasOwnProperty(randId) && styleproperty[randId].hasOwnProperty('align'))
	{
		align = styleproperty[randId]['align'];
	}
	
	jQuery('#text-output-'+randId).css('font-family',styleproperty[randId]['fontStyle']);
	jQuery('#text-output-'+randId).css('font-size',styleproperty[randId]['textSize']+'px');
	jQuery('#text-output-'+randId).css('line-height',styleproperty[randId]['lineHeight']+'px');
	jQuery('#text-output-'+randId).css('letter-spacing',styleproperty[randId]['textSpacing']+'px');
	jQuery('#content-'+randId).css('text-align',align);
	//jQuery('#text-output-'+randId).css('padding-top',styleproperty[randId]['textSize']+'px');
	//jQuery('#text-output-'+randId).css('padding-bottom',styleproperty[randId]['textSize']+'px');
}

/*
* variable fonts
*/
// var variableobject = {};
// function stop_it(id,type) {
// 	jQuery('#play-pause-'+id+'-'+type).removeClass('uil-pause');
// 	jQuery('#play-pause-'+id+'-'+type).addClass('uil-play');
// 	clearInterval(variableobject[id][type]['setinterval']);
// }

// function start_it(id,type) {
// 	var currentValue = jQuery('#slider-'+id+'-'+type).val();
// 	var currentMinValue = parseInt(jQuery('#slider-'+id+'-'+type).attr('min'));
// 	var currentMaxValue = parseInt(jQuery('#slider-'+id+'-'+type).attr('max'));
// 	var action = 'increment';
	
// 	if(jQuery('#play-pause-'+id+'-'+type).hasClass('uil-play')) {
// 		jQuery('#play-pause-'+id+'-'+type).removeClass('uil-play');
// 		jQuery('#play-pause-'+id+'-'+type).addClass('uil-pause');
		
// 		if(variableobject.hasOwnProperty(id)) {
// 			if(variableobject[id].hasOwnProperty(type)) {
// 				action = variableobject[id][type]['action'];
// 			}
// 		} else {
// 			variableobject[id] = {};
// 		}
// 		variableobject[id][type] = {
// 			currentvalue : currentValue,
// 			maxvalue : currentMaxValue,
// 			minvalue : currentMinValue,
// 			action : action,
// 			setinterval : setInterval(autoplay, 50,id,type)
// 		};
// 	} else {
// 		stop_it(id,type)
// 	}
// 	//var currentinterval = setInterval(autoplay, 50,id);
// }

// function autoplay(id,type) {

// 	var currentValue 		= parseInt(variableobject[id][type]['currentvalue']);
// 	var currentMinValue 	= parseInt(variableobject[id][type]['minvalue']);
// 	var currentMaxValue 	= parseInt(variableobject[id][type]['maxvalue']);
// 	var currentaction	 	= variableobject[id][type]['action'];
// 	var incrementValue 		= 0;
	
// 	if(currentaction == 'increment') {
// 		incrementValue = currentValue + 1;
// 		if(incrementValue >= currentMaxValue) {
// 			currentaction = 'decrement';
// 		}
// 	} else {
// 		incrementValue = currentValue - 1;
// 		if(incrementValue <=  currentMinValue) {
// 			currentaction = 'increment';
// 		}
// 	}
// 	variableobject[id][type]['action'] = currentaction;
// 	variableobject[id][type]['currentvalue'] = incrementValue;
// 	jQuery('#slider-'+id+'-'+type).val(incrementValue);
// 	update_style(id);
// }

function update_style(id) {
	var size = jQuery('#slider-'+id+'-size').val();
	var spacing = jQuery('#slider-'+id+'-spacing').val();
	var height = jQuery('#slider-'+id+'-height').val();
	var weight = jQuery('#slider-'+id+'-weight').val();
	var width = jQuery('#slider-'+id+'-width').val();
	var opticalsize = jQuery('#slider-'+id+'-optsize').val();
	var italic = jQuery('#slider-'+id+'-italic').val();
	var serif = jQuery('#slider-'+id+'-serif').val();
	var slant = jQuery('#slider-'+id+'-slant').val();
	
	var css = '';
	if(typeof weight !== 'undefined') {
		css += '"wght" '+weight+',';
	}

	if(typeof width !== 'undefined') {
		css += '"wdth" '+width+',';
	}

	if(typeof italic !== 'undefined') {
		css += '"ital" '+italic+',';
	}

	if(typeof opticalsize !== 'undefined') {
		css += '"opsz" '+opticalsize+',';
	}

	if(typeof serif !== 'undefined') {
		css += '"SRIF" '+serif+',';
	}

	if(typeof slant !== 'undefined') {
		css += '"slnt" '+slant+',';
	}


	//console.log(css);
	css = css.slice(',', -1);
	console.log(css);
	//var css = '"wght" '+weight+', "wdth" '+width+', "ital" '+italic+', "opsz" '+opticalsize+', "SRIF" '+serif+'';
	jQuery('#content-'+id).css('font-variation-settings',css);
	jQuery('#content-'+id).css('font-size',size+'px');
	jQuery('#content-'+id).css('letter-spacing',spacing+'px');
	jQuery('#content-'+id).css('line-height',height+'px');
	//jQuery('#content-'+id).css('font-family','NeueMetana-Thin,sans-serif');
	//font-family: NeueMetana-Thin,sans-serif;
}

jQuery(".variable_slider").on("input change", function() {
	var randId = jQuery(this).attr('data-id');
    update_style(randId);
	console.log("I am here");
});