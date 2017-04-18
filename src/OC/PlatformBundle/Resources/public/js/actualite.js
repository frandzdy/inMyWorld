/**
 * Created by fsanon on 28/03/2017.
 */
var is_processing = false;
var last_page = false;
var page = 1;
    function addMoreElements() {
        is_processing = true;

    }

    $(window).scroll(function() {
        var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
        //Modify this parameter to establish how far down do you want to make the ajax call
        // var scrolltrigger = 0.80;
        var diff = (wintop / (docheight - winheight));

        var scrolltrigger = 0.99;
        if (diff > scrolltrigger) {
            //I added the is_processing variable to keep the ajax asynchronous but avoiding making the same call multiple times
            if (last_page === false || is_processing == false) {
                $.ajax({
                    type: "GET",
                    //FOS Routing
                    url: Routing.generate('oc_platform_scroll', {page: page}),
                    beforeSend: function () {
                        is_processing = true;
                    },
                    success: function(data) {
                        if (data) {
                            $('#filactu').append(data.view);
                            page = page + 1;
                            //The server can answer saying it's the last page so that the browser doesn't make anymore calls
                            last_page = false;
                        } else {
                            last_page = true;
                        }
                        // is_processing = false;
                    },
                    complete: function () {
                        is_processing = false;
                    },
                    error: function(data) {
                        is_processing = false;
                    }
                });
            }
        }
    });
