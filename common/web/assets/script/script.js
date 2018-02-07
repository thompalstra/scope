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

    if( ( this.attr('sc-ignore-shift') && e.shiftKey ) || ( this.attr('sc-ignore-ctrl') && e.ctrlKey ) ){
        return;
    }
    if( target == 'self'  || target == null ){
        this.dispatch(eventType);
    } else {
        document.findOne(target).dispatch(eventType);
    }
})
document.find('.table tr').listen('click', function(e){
    if( e.ctrlKey ){
        e.preventDefault();
        var checkbox = this.findOne('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
    } else if( e.shiftKey ){
        var currentRow = this.closest('tr');
        var selected = this.closest('.table').find('input[type="checkbox"]:checked');
        if( selected.length == 0 ){
            currentRow.findOne('input[type="checkbox"]').checked = true;
        } else {
            var firstRow = this.closest('.table').findOne('input[type="checkbox"]:checked').closest('tr');
            var rows = this.closest('.table').find('tbody tr');

            var fromIndex = firstRow.index();
            var toIndex = currentRow.index();

            console.log( rows );

            var index = ( fromIndex < toIndex ) ? fromIndex + 1 : toIndex ;
            var endIndex = ( fromIndex < toIndex ) ? toIndex : fromIndex - 1;

            while(index <= endIndex){
                rows[index].findOne('input[type="checkbox"]').checked = !rows[index].findOne('input[type="checkbox"]').checked;
                index++;
            }
        }
    }
});
document.find('.table td input[type="checkbox"]').listen('change', function(e){
    e.preventDefault();
});
