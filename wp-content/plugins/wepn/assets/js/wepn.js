
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




        B.on('change keyup', 'form#vendorSearchForm :input, form#venueSearchForm :input,form#sort_post :input', function(e) {
            e.preventDefault();


            $('#loader-overlay').remove();

            $(".page-content").append( '<div id="loader-overlay"><span class="loading"></span></div>' );


            var url = $(this).closest('form').attr('action');

            var params = $(this).closest('form').serialize();

            $.get(url, params,function(data){
                if(data.length>0){
                    $(".page-content").html( $(data).find('.page-content').html() );
                }
            });

        });



        B.on('change', '#registrationForm #role', function(e) {
            var role = $(this).val(),
                terms = [],
                $cat = $('#registrationForm #category'),
                $otherCat = $('#registrationForm #categories');


            $cat.html('');
            $otherCat.html('');

            if (role == 'venue') {
                terms = ATU.venue_terms
            } else {
                terms = ATU.vendor_terms;
            }

            for(var term in terms) {
                var $option = $('<option />').val(term).text(terms[term]);
                var $option2 = $('<option />').val(term).text(terms[term]);
                $otherCat.append($option2);
                $cat.append($option);

            }



        });





    });
}(jQuery, document, window));