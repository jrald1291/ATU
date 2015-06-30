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
        $('.atu-membership-form').on('submit', function(e) {
            e.preventDefault();
            var $form = $(this);
            var params = $(this).serialize() + '&action=post-membership'
            Data.post(ATU.ajaxurl, params).done(function(results) {
                results = $.parseJSON(results);
                $('.atu-post-message').remove();

                if (results.message instanceof Array) {
                    for ( var i in results.message ) {
                        $form.append('<p class="atu-post-message message-' + results.status + '">' + results.message[i] + '</p>');
                    }
                } else{
                    $form.append('<p class="atu-post-message message-' + results.status + '">' + results.message + '</p>');
                }

                if (results.status == 'success') $form.find('input[type=email]').val('');
            });


            return false;
        });


    });
}(jQuery, document, window));