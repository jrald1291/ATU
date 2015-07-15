(function($, document, window) {
    'use strict';

    var D = $(document),
        W = $(window);

    var Data = {
        post: function(url, data) {
            return $.post(url, data);
        },
        get: function(url, data) {
            return $.get(url, data);
        }

    };

    D.ready(function() {
            var val = $('select#filterType').val();
            var $postcode = $('#venueSearchForm select[name=post_code]');
            var $region = $('#venueSearchForm select[name=region]');
        if ( val == 'post_code' ) {
                $postcode.removeClass('hidden').removeAttr('disabled');
                $postcode.parent('.form-group').parent('.col-md-2').removeClass('hidden');
                $region.attr('disabled', true);
                $region.parent('.form-group').parent('.col-md-2').addClass('hidden');
            } else if(val == 'region') {
                $region.removeClass('hidden').removeAttr('disabled');
                $region.parent('.form-group').parent('.col-md-2').removeClass('hidden');
                $postcode.attr('disabled', true);
                $postcode.parent('.form-group').parent('.col-md-2').addClass('hidden');
            } else {
                $region.addClass('hidden').attr('disabled', true);
                $postcode.addClass('hidden').attr('disabled', true);
            }

        $('body').on('change', 'select#filterType', function() {
             val = $(this).val();
             $postcode = $('select[name=post_code]');
             $region = $('select[name=region]');
            if ( val == 'post_code' ) {
                $postcode.removeClass('hidden').removeAttr('disabled');
                $postcode.parent('.form-group').parent('.col-md-2').removeClass('hidden');
                $region.attr('disabled', true);
                $region.parent('.form-group').parent('.col-md-2').addClass('hidden');
            } else if(val == 'region') {
                $region.removeClass('hidden').removeAttr('disabled');
                $region.parent('.form-group').parent('.col-md-2').removeClass('hidden');
                $postcode.attr('disabled', true);
                $postcode.parent('.form-group').parent('.col-md-2').addClass('hidden');
            } else {
                $region.addClass('hidden').attr('disabled', true);
                $postcode.addClass('hidden').attr('disabled', true);
            }
        });


    });
}(jQuery, document, window));