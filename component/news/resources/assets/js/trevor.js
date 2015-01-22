if(!News) var News = {};

News.Trevor = new Class({
    element : null,

    initialize: function(options) {
        this.element = document.id(options.container);
        this.url = options.url;
        this.id = options.id;
        this.token = options.token;

        if(!this.element) {
            return;
        }

        var that = this;
        this.element.getElements('a[data-action]').each(function(a) {
            if(a.get('data-action'))
            {
                a.addEvent('click', function(e) {
                    e.stop();
                    that.execute(this.get('data-action'), this.get('data-block'), this.get('data-type'));
                });
            }
        });
    },

    execute: function(action, block, type)
    {
        var method = '_action' + action.capitalize();

        if($type(this[method]) == 'function')
        {
            this.action = action;

            this[method].call(this, action, block, type);
        }
    },

    _actionSave: function(action, block, type)
    {
        $jQuery(this.element).submit(function (event) {
            event.preventDefault();
        }).submit();

        var request = new Request({
            method: 'post',
            url: this.url,
            data: {
                action: action,
                id: this.id,
                content: JSON.stringify(SirTrevor.getInstance().store.retrieve()),
                _token: this.token
            }
        }).send();
    }
});