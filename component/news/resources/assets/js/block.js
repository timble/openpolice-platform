if(!News) var News = {};

News.Block = new Class({
    element : null,

    initialize: function(options) {
        this.element = document.id(options.container);
        this.url = options.url;
        this.id = options.id;
        this.token = options.token;
        this.nextBlock = options.nextBlock;

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
        var request = new Request({
            method: 'post',
            url: this.url,
            data: {
                action: action,
                id: this.id,
                content: this.element.getElementById('blocks').innerHTML,
                _token: this.token
            }
        }).send();
    },

    _actionNew: function(action, block, type)
    {
        // Add elements to DOM
        $jQuery( "#blocks" ).append(this.block(type));

        // Refresh all CKEDITOR instances
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].destroy();
        }
        CKEDITOR.inlineAll();
    },

    block: function(type)
    {
        var html = '' +
            '<div id="block-'+ this.nextBlock + '"class="block group">' +
                '<div class="block__content">' +
                    this[type]() +
                '</div>' +
                '<div class="block__toolbar">' +
                    '<a class="handle">&#8597;</a>' +
                    '<a class="delete" href="#" onclick="$jQuery(this).parent().parent().remove()">&#x2716;</a>' +
                '</div>' +
            '</div>';

        return html;
    },

    paragraph: function()
    {
        var html = '' +
                '<h2 contenteditable="true">heading</h2>' +
                '<div contenteditable="true"><p>Placeholder</p></div> ';
        return html;
    },

    paragraphImage: function()
    {
        var html = '' +
                '<h2 contenteditable="true">heading</h2>' +
                '<div contenteditable="true"><p>Placeholder</p></div> ' +
                '<div id="image'+ this.nextBlock + '" class="image" ondrop="drop(event)" ondragover="allowDrop(event)"></div> ';

        return html;
    }
});