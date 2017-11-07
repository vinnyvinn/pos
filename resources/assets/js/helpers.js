$('a[href="' + window.location.href.replace(/\/$/, "") + '"]').addClass('active');

(function() {
    var laravel = {
        initialize: function () {
            this.methodLinks = $('a[data-method]').not('.completion');
            this.registerEvents();
        },

        registerEvents: function () {
            this.methodLinks.on('click', this.handleMethod);
        },

        handleMethod: function (e) {
            var link = $(this);
            var httpMethod = link.data('method').toUpperCase();

            if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                return;
            }

            laravel.createAlert(link);

            e.preventDefault();
        },

        submitForm: function (e) {
            e.preventDefault();
            var form = laravel.createForm($(this));
            form.submit();
        },

        createAlert: function (link) {
            var notice = $('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p>This action is not reversible. Delete?</p><p class="confirm-buttons"><a href="' + link.attr("href") + '" class="btn btn-danger completion" data-method="delete" rel="nofollow" data-token="' + link.data("token") +'">Delete</a><button type="button" data-dismiss="alert" aria-label="Close" class="btn btn-default">Cancel</button></p></div>');
            notice.find('a[data-method].completion').on('click', this.submitForm);

            $('#alertConfirm').fadeOut(1).append(notice).fadeIn(100);
        },

        createForm: function (link) {
            var form =
                $('<form>', {
                    'method': 'POST',
                    'action': link.attr('href')
                });

            var token =
                $('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': link.data('token')
                });

            var hiddenInput =
                $('<input>', {
                    'name': '_method',
                    'type': 'hidden',
                    'value': link.data('method')
                });

            return form.append(token, hiddenInput)
                .appendTo('body');
        }
    };

    laravel.initialize();
})();

$('.button-menu-mobile.open-left').on('click', () => {
    "use strict";
    if ($('body').hasClass('fixed-left')) {
        localStorage.setItem('closed', 1);
        return;
    }
    localStorage.setItem('closed', 0);
});

if (localStorage.getItem('closed') == 1) {
    $('body').attr('class', 'widescreen fixed-left-void');
    $('#wrapper').attr('class', 'forced enlarged');
}