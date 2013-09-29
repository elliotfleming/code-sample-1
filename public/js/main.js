// /js/main.js


///////////////////////////////////////////////////////////////////////////////////////////////////
// Global Namespace //////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

// Global functions and such...



///////////////////////////////////////////////////////////////////////////////////////////////////
// jQuery ////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

(function($) {

    ///////////////////////////////////////////////////////////////////////////////////////////////
    // Plugins ///////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////

    // Toggle between two states
    $.fn.toggler = function( fn, fn2 ) {

        var args = arguments,
            guid = fn.guid || $.guid++,
            i = 0,
            toggler = function( event ) {

                var lastToggle = ( $._data( this, "lastToggle" + fn.guid ) || 0 ) % i;

                $._data( this, "lastToggle" + fn.guid, lastToggle + 1 );

                event.preventDefault();

                return args[lastToggle].apply( this, arguments ) || false;
            };

        toggler.guid = guid;

        while ( i < args.length ) {

            args[i++].guid = guid;
        }

        return this.click( toggler );
    };


    ///////////////////////////////////////////////////////////////////////////////////////////////
    // Ready function ////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////
    
    $(function() {

        // TOGGLER ////////////////////////////////////////////////////////////

        // Toggle the login/logout menu visibility
        $('.toggle').toggler(function() {
            // Activate
        }, function() {
            // Deactivate
        });



        // NOTIFICATIONS //////////////////////////////////////////////////////

        // Fade out notifications, but ensure error messages stay visable.
        if ($('.alert').length > 0) {
            console.log('Notification received');
            $('.alert-success').delay(6000).fadeTo(1000, 0.01).slideUp(500);
        }



        // AJAX HANDLERS //////////////////////////////////////////////////////

        // Handle AJAX logins
        $('.login-ajax').submit(function(event) {
            event.preventDefault();
            $(this).find('[type="submit"]').attr('disabled', 'disabled');
            var form_data = {},
                submit_url = $(this).attr('action'),
                form_inputs = $(this).find(':input');
            form_inputs.each(function() {
                form_data[this.name] = $(this).val();
            });
            $.ajax({
                url: submit_url,
                type: 'POST',
                data: form_data,
                beforeSend: function(request) {
                    return request.setRequestHeader("X-CSRF-Token", $("meta[name='token']").attr('content'));
                },
                success: function(data) {
                    if (data) {
                        console.log(data);
                        /*$('.alert.logged-out').html(data.notification).addClass('alert-success').slideDown(250).fadeTo(250, 1, function() {
                            $(this).delay(4000).fadeTo(1000, 0.01).slideUp(500);
                        });*/
                    }
                },
                error: function(xhr, error, status) {
                    //
                }
            });
        });

        // Handle AJAX logouts
        $('.logout-ajax').click(function(event) {
            event.preventDefault();
            $(this).find('[type="submit"]').attr('disabled', 'disabled');
            var submit_url = $(this).attr('action');
            $.ajax({
                url: submit_url,
                type: 'GET',
                success: function(data) {
                    if (data) {
                        console.log(data);
                        /*$('.alert.logged-out').html(data.notification).addClass('alert-success').slideDown(250).fadeTo(250, 1, function() {
                            $(this).delay(4000).fadeTo(1000, 0.01).slideUp(500);
                        });
                        $('.logged-in').hide();
                        $('.logged-out').show();*/
                    }
                },
                error: function(xhr, error, status) {
                    //
                }
            });
        });

    });

})(jQuery);