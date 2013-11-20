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
        var request = new Request({
            method: 'post',
            url: this.options.url,
            data: this.options.data,

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
        var data = this.options.data;

        data.action = (data.action == 'delete' ? 'post' : 'delete');
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
