/*
 * Code to format results.
 */

function resultLoaded() {
    $('td.org-expander input').button().change(function() {
        $(this).parents('tr').next('tr.orglist').toggle(
            $(this).is(':checked')
        );

        $(this).button('option', 'icons', {
            primary: $(this).is(':checked') ?
                'ui-icon-minus' : 'ui-icon-plus'
        });
    }).change();
	
    $('th.data').click(function() {
        var form = $('#query_form')[0].elements;
        form['sortBy'].value = $(this).attr('name');
        form['descending'].value = $(this).hasClass('ascending') ? '1' : '0';

        submitQuery(false);
    });
}

function resultPage(pagenr) {
    $('#query_form')[0].elements['pagenr'].value = pagenr;
    submitQuery(false);
}

$(resultLoaded);
