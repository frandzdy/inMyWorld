/**
 * Created by fsanon on 28/03/2017.
 */
is_processing = false;
last_page = false;
page = 1;
    function addMoreElements() {
        alert('lunch');
        is_processing = true;
        $.ajax({
            type: "GET",
            //FOS Routing
            url: Routing.generate('oc_platform_scroll', {page: page}),
            success: function(data) {
                if (data) {
                    $('#filactu').append(data.view);
                    page = page + 1;
                    //The server can answer saying it's the last page so that the browser doesn't make anymore calls
                    last_page = data.last_page;
                } else {
                    last_page = true;
                }
                is_processing = false;
            },
            error: function(data) {
                is_processing = false;
            }
        });
    }

    $(window).scroll(function() {
        var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
        //Modify this parameter to establish how far down do you want to make the ajax call
        // var scrolltrigger = 0.80;
        var scrolltrigger = 0.90;
        if ((wintop / (docheight - winheight)) > scrolltrigger) {
            //I added the is_processing variable to keep the ajax asynchronous but avoiding making the same call multiple times
            if (last_page === false && is_processing === false) {
                addMoreElements();
            }
        }
    });
