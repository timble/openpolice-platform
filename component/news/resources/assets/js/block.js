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
        var editor = CKEDITOR.instances['text'];

        if(!block) {
            block = this.nextBlock;
        }

        var request = new Request({
            method: 'post',
            url: this.url,
            data: {
                action: action,
                id: this.id,
                block: block,
                content: editor.getData(),
                heading: this.element.getElementById('heading').value,
                _token: this.token
            }
        }).send();

        // Update the block elements
        this.element.getElement('#block-' + block + ' .heading').innerHTML = this.element.getElementById('heading').value;
        this.element.getElement('#block-' + block + ' .text').innerHTML = editor.getData();

        // Hide the editor
        this.element.getElementById('editor').addClass('is-hidden');

        // Clear the editor
        editor.setData('');
    },

    _actionLoad: function(action, block)
    {
        // Push data into the editor
        this.element.getElementById('heading').value = this.element.getElement('#block-' + block + ' .heading').innerHTML;
        CKEDITOR.instances['text'].setData(this.element.getElement('#block-' + block + ' .text').innerHTML);

        // Assign the block key
        this.element.getElementById('save').setAttribute('data-block', block);

        // Show the editor
        this.element.getElementById('editor').removeClass('is-hidden');
    },

    _actionNew: function(action, block)
    {
        // Show the editor
        this.element.getElementById('editor').removeClass('is-hidden');

        // Empty elements
        this.element.getElementById('heading').value = '';
        CKEDITOR.instances['text'].setData('');

        // Create outer block element
        var block = document.createElement('div');
        block.id = 'block-' + this.nextBlock;
        block.className = 'block';

        // Create inner heading element
        var heading = document.createElement('h2');
        heading.className = 'heading';
        block.adopt(heading);

        // Create inner text element
        var text = document.createElement('div');
        text.className = 'text';
        block.adopt(text);

        // Add elements to DOM
        this.element.getElementById('blocks').adopt(block);

        // Save new block
        this.element.getElementById('save').setAttribute('data-block', this.nextBlock);
    }
});