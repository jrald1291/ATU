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
        var B = $('body');

        B.on('click', '#generate-reg-link', function(e) {
            e.preventDefault();

            Data.post(ATU.ajaxUrl, {action: 'generate-reg-link'}).done(function(results) {

                results = JSON.parse(results);

                console.log(results);

                if (results.status == 'success') {
                    $('.reg-code').html(results.message).removeClass('hidden');
                } else {
                    $('<div id="message" class="error fade"><p><strong>' + results.message + '</strong></p></div>').insertAfter('h2.nav-tab-wrapper');
                }
                console.log(results);
            });
        });



        $('select').select2();

    });


}(jQuery, document, window));