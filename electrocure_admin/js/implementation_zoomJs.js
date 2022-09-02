jQuery(document).ready(function ($) {

    var img1Src = jQuery('#mtr1img').attr('src');
    var img2Src = jQuery('#mtr2img').attr('src');
    var img3Src = jQuery('#mtr3img').attr('src');
    var img4Src = jQuery('#mtr4img').attr('src');

    $('#mtr1img').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
        descArea: '#description', // description selector (optional - but required if descriptions are used) - new
        speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
        descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
        imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
        magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
        zoomrange: [3, 20],
        magnifiersize: [250, 250],
        magnifierpos: 'right',
        cursorshadecolor: '#fdffd5',
        cursorshade: true //<-- No comma after last option!
    });

    $('#mtr2img').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
        descArea: '#description', // description selector (optional - but required if descriptions are used) - new
        speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
        descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
        imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
        magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
        zoomrange: [3, 20],
        magnifiersize: [250, 250],
        magnifierpos: 'right',
        cursorshadecolor: '#fdffd5',
        cursorshade: true //<-- No comma after last option!
    });

    $('#mtr3img').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
        descArea: '#description', // description selector (optional - but required if descriptions are used) - new
        speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
        descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
        imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
        magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
        zoomrange: [3, 20],
        magnifiersize: [250, 250],
        magnifierpos: 'right',
        cursorshadecolor: '#fdffd5',
        cursorshade: true //<-- No comma after last option!
    });

    $('#mtr4img').addimagezoom({ // multi-zoom: options same as for previous Featured Image Zoomer's addimagezoom unless noted as '- new'
        descArea: '#description', // description selector (optional - but required if descriptions are used) - new
        speed: 1500, // duration of fade in for new zoomable images (in milliseconds, optional) - new
        descpos: true, // if set to true - description position follows image position at a set distance, defaults to false (optional) - new
        imagevertcenter: true, // zoomable image centers vertically in its container (optional) - new
        magvertcenter: true, // magnified area centers vertically in relation to the zoomable image (optional) - new
        zoomrange: [3, 20],
        magnifiersize: [250, 250],
        magnifierpos: 'right',
        cursorshadecolor: '#fdffd5',
        cursorshade: true //<-- No comma after last option!
    });

})