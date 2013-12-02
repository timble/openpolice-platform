if(!Fora) var Fora = {};

Fora.Response = new Class({
    Implements: Options,

    initialize: function(options) {
        options.button = document.id(options.holder).getElements('button.response');
        if( options.button.length)
        {
            options.button.each(function(button) {
                button.addEvent('click', function(e) {
                    e.stop();
                    this.submit(button);
                }.bind(this));
            }.bind(this));
        }
        this.setOptions(options);

    },

    submit: function(button) {

        var request = new Request({
            method: button.get('data-action'),
            url: this.options.url,
            data: {
                action: button.get('data-action'),
                id: button.get('data-topic'),
                comments_comment_id: button.get('data-id'),
                _token: this.options.data._token
            },

            onSuccess: function() {
                this.complete(button);
            }.bind(this),

            onFailure: function() {
                this.failure(button);
            }.bind(this)
        }).send();

        this.toggleSpinner(button);
    },

    complete: function(button) {
        var data = this.options.data;

        data.action = (data.action == 'delete' ? 'post' : 'delete');
        button.toggleClass('btn-unrespond').toggleClass('btn-respond');

        this.toggleSpinner(button);
    },

    failure: function(button)
    {

        this.toggleSpinner();

        button.addClass('respond-failure');

        button.getElement('i')
            .addClass('icon-exclamation-sign')
            .removeClass('icon-star');

        alert('Failed to select the awnser. Please try again or contact support.');
    },

    toggleSpinner: function(button)
    {

        button.set('disabled', !button.get('disabled'));

        button.getElement('i').toggleClass('icon-star')
            .toggleClass('icon-spin')
            .toggleClass('icon-spinner');
    }
});
