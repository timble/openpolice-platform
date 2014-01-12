if(!Fora) var Fora = {};

Fora.Subscribe = new Class({
    Implements: Options,

    initialize: function(options) {
        options.button = document.id(options.holder).getElement('button.subscribe');
        this.setOptions(options);

        this.options.button.addEvent('click', function(event) {
            event.stop();

            this.submit();
        }.bind(this));
    },

    submit: function() {

        var button = this.options.button;
        var request = new Request({
            method: button.get('data-action'),
            url: this.options.url,
            data: {
                action: button.get('data-action'),
                row: button.get('data-row'),
                type: button.get('data-type'),
                _token: this.options.data._token
            },

            onSuccess: function() {
                this.complete();
            }.bind(this),

            onFailure: function() {
                this.failure();
            }.bind(this)
        }).send();

        this.toggleSpinner();
    },

    complete: function() {
        var button = this.options.button;

        button.set('data-action',button.get('data-action') == 'delete' ? 'post' : 'delete');
        button.toggleClass('btn-unsubscribed').toggleClass('btn-subscribed');

        this.toggleSpinner();
    },

    failure: function()
    {
        var button = this.options.button;

        this.toggleSpinner();

        button.addClass('subscription-failure');

        button.getElement('i')
            .addClass('icon-exclamation-sign')
            .removeClass('icon-star');

        alert('Failed to subscribe. Please try again or contact support.');
    },

    toggleSpinner: function()
    {
        var button = this.options.button;

        button.set('disabled', !button.get('disabled'));

        button.getElement('i').toggleClass('icon-star')
            .toggleClass('icon-spin')
            .toggleClass('icon-spinner');
    }
});