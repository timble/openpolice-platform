if(!Fora) var Fora = {};

Fora.Vote = new Class({
    Implements: Options,

    initialize: function(options){
        var holder = document.id('fora-topic-default');

        options.elements = {
            vote: holder.getElement('a.vote'),
            undo: holder.getElement('a.undo'),
            error: holder.getElement('div.error')
        }

        this.setOptions(options);

        this.options.elements.vote.addEvent('click', function(event){
            event.stop().target.getParent().setStyle('display', 'none');

            this.options.data.action = 'add';
            this.submit(this.options.data);
        }.bind(this));

        this.options.elements.undo.addEvent('click', function(event){
            event.stop().target.getParent().setStyle('display', 'none');

            this.options.data.action = 'delete';
            this.submit(this.options.data);
        }.bind(this));
    },

    submit: function(data){
        var request = new Request({
            method: 'post',
            url: this.options.url,
            data: data,
            onSuccess: function(){
                this.options.elements[data.action == 'add' ? 'undo' : 'vote'].getParent().setStyle('display', 'block');
            }.bind(this),
            onFailure: function(){
                this.options.elements.error.set('html', 'Failed to ' + data.action + ' vote.')
            }.bind(this)
        }).send();
    }
});