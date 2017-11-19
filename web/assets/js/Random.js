var Random = {};

Random.uri = null;
Random.time = 10000;
Random.text = '#phrase-text';
Random.link = '#phrase-link';
Random.image = '#phrase-image';
Random.loader = '#ajaxloader';
Random.ajax = false;

Random.getPhrase = function() {
    if (Random.ajax) {
        Random.ajax.abort();
    }

    jQuery(Random.loader).show();

    Random.ajax = jQuery.ajax({
        url: Random.uri,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (Object.keys(response).length > 0) {
                jQuery(Random.image).attr('src',response.icon_url);
                jQuery(Random.link).attr('href',response.url);
                jQuery(Random.text).html(response.value);
            }

            jQuery(Random.loader).hide();
        },
        error: function() {
            jQuery(Random.loader).hide();
        },
        complete: function() {
            jQuery(Random.loader).hide();
        }
    });
};

jQuery(document).ready(function(){
    window.setInterval(function(){
        Random.getPhrase()
    }, Random.time);
});
