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
                    that.execute(this.get('data-action'), this.get('data-block'));
                });
            }
        });
    },

    execute: function(action, block)
    {
        var method = '_action' + action.capitalize();

        if($type(this[method]) == 'function')
        {
            this.action = action;

            this[method].call(this, action, block);
        }
    },

    _actionSave: function(action, block)
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

    _actionNew: function(action, block)
    {
        // Create outer block element
        var block = document.createElement('div');
        block.id = 'block-' + this.nextBlock;
        block.className = 'block';

        // Create inner heading element
        var heading = document.createElement('h2');
        heading.className = 'heading';
        heading.createTextNode = 'heading';
        heading.setAttribute('contenteditable', 'true');
        heading.appendChild(document.createTextNode('Heading'));

        block.adopt(heading);

        // Create inner text element
        var text = document.createElement('div');
        text.className = 'text';
        text.html = 'text';
        text.setAttribute('contenteditable', 'true');

        paragraph = document.createElement('p');
        paragraph.appendChild(document.createTextNode('Placeholder'));
        text.appendChild(paragraph);

        block.adopt(text);

        // Add elements to DOM
        this.element.getElementById('blocks').adopt(block);

        // Add ckeditor to the newly created element
        CKEDITOR.inline(heading);
        CKEDITOR.inline(text);
    }
});