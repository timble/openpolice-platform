if(!Support) var Support = {};

Support.Response = new Class({
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
            url: this.options.url+"&id="+button.get('data-ticket'),
            data: {
                action: button.get('data-action'),
                id: button.get('data-ticket'),
                comments_comment_id: button.get('data-comment'),
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
        this.toggleSpinner(button);
        button.getElement('i').toggleClass('icon-ok').toggleClass('icon-remove')
        if(button.get('data-action') == 'delete'){
            button.set('data-action','post');
            $$('div.anwser').setHTML("");
        }else{
            button.set('data-action','delete');
            $$('div.anwser').set('html',$$("div.comment_"+button.get('data-comment')).getHTML());
        }
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
