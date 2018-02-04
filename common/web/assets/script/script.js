console.log('Successfully initialize common script.js');

document.listen('toggle', '*', function(e){
    if( this.attr('hide') == null ){
        this.attr('show', null);
        this.attr('hide', '');
    } else {
        this.attr('hide', null);
        this.attr('show', '');
    }
})

document.listen('navigate', '*', function(e){
    e.preventDefault();
    var url = this.attr('sc-url');
    location.href = url;
})

document.listen('click', '[sc-on="click"]', function(e){
    var target = this.attr('sc-for');
    var eventType = this.attr('sc-event');
    if( target == 'self'  || target == null ){
        this.dispatch(eventType);
    } else {
        document.findOne(target).dispatch(eventType);
    }

})
