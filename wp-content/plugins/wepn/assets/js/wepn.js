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




        B.on('change keyup', 'form#vendorSearchForm :input, form#venueSearchForm :input', function(e) {
            e.preventDefault();


            $('#loader-overlay').remove();

            $(".page-content").append( '<div id="loader-overlay"><span class="loading"></span></div>' );


            var url = $(this).attr('action');

            var params = $(this).closest('form').serialize();

            $.get(url, params,function(data){
                if(data.length>0){


                    $(".page-content").html( $(data).find('.page-content').html() );
                }
            });

        });







    });
}(jQuery, document, window));