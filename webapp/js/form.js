/*
 * Code to make UI for query form.
 */

function helppopup(attr) {
    window.open('help.html#' + attr, 'help',
                'resizable,height=500,width=600,scrollbars=yes');
}

function scrollTo(target, delay) {
    var offset = target.offset();
    var target_top = offset.top;
    $('html, body').animate({scrollTop: target_top}, delay);
}

function submitQuery(scroll) {
    var throbber = '<img class="throbber" src="img/throbber.gif">';
    $.blockUI.defaults.overlayCSS.opacity = 0.0;

    $('#result').css('min-height', $(window).height() + 'px');
    $('html').addClass('loading');

    /*
    if ($('#result_table').length > 0)
	$('#result_table').block({message: throbber});
    else
	$('#result').block({message: throbber});
    */

    $.post('result.php', $('#query_form').serialize(), function (data) {
	$('#result_table').unblock();
	$('#result').html(data);
        if (scroll) scrollTo($('#result'), 800);
	resultLoaded(); // defined in result.js
        $('html').removeClass('loading');
    });

}

function initForm() {
    /*
     * Highlight boolean, enum and the location attribute.
     */
    $('.boolean_attr, .enum_attr, .lan_attr').each(function () {
        var row = $(this);
        var buttons = row.find('td.attr_controller input');

        buttons.change(function() {
            row.toggleClass('highlight', buttons.is(':checked'));
        }).first().change();
    });

    /*
     * Highlight string attributes.
     */
    $('.textfield').change(function() {
        $(this).parents('tr.attr').toggleClass(
            'highlight', $(this).val().length != 0
        );
    }).change();

    /*
     * Autocomplete of kommuner and spelplatser.
     * Support multiple choice.
     */

    function split(val) {
        return val.split(/;\s*/);
    }

    $('#input-kommunId, #input-spelplats').bind("keydown", function(event) {
        // don't navigate away from the field on tab when selecting an item
        if (event.keyCode === $.ui.keyCode.TAB
            && $(this).data("autocomplete").menu.active) {
            event.preventDefault();
        }
    }).autocomplete({
        minLength: 0,
        // prevent value inserted on focus
        focus: function() {return false;},
        select: function(event, ui) {
            var terms = split(this.value);
            terms.pop();
            terms.push(ui.item.value);
            terms.push("");
            this.value = terms.join("; ");
            return false;
        }
    });

    // att slice:a arrayen gör autocompleat betydligt snabbare
    var autocompleteMaxLength = 20;

    // Only filter on initial characters and limit result length
    function filterInitial(source, request, needsSort) {
        var term = split(request.term).pop().toLowerCase();

        var result = term.length == 0 ? source : $.grep(source, function(e) {
            return e.substr(0, term.length).toLowerCase() == term;
        });

        // this might modify the source array but we don't care
        if (needsSort) result.sort();

        if (result.length > autocompleteMaxLength) {
            result = result.slice(0, autocompleteMaxLength);
            result.push('...');
        }
        return result;
    }

    $('#input-kommunId').autocomplete(
        'option', 'source',
        function(request, response) {
            var kommuner = [];

            var lanElems = $('#param-lanId td.attr_controller :checked');
            if (lanElems.length == 0)
                lanElems = $('#param-lanId td.attr_controller :checkbox');

            lanElems.each(function() {
                kommuner = kommuner.concat(kommunerILan[this.value]);
            });

            response(filterInitial(kommuner, request, true));
        }
    );

    $('#input-spelplats').autocomplete(
        'option', 'source',
        function(request, response) {
            response(filterInitial(spelplatser, request, false));
        }
    );

    /*
     * Numeric attributes (sliders).
     */
    $('.numeric_attr').each(function () {
        var row = $(this);
        var minfield = $(this).find('.min_field');
        var maxfield = $(this).find('.max_field');
        var slider_el = $(this).find('.slider');
        var limit = parseInt(maxfield.attr('data-limit'));

        var step = Math.round(limit/20);
        if (step == 0) step = 1;

        slider_el.slider({
            range: true,
            min: 0,
            max: limit,
            step: step,
            slide: function (event, ui) {
                minfield.val(ui.values[0]).change();
                maxfield.val(ui.values[1]).change();
            }
        });

        minfield.change(function () {
            var val = parseInt($(this).val());
            var new_val = val;
            var maxval = parseInt(maxfield.val());

            if (isNaN(val) || val < 0)
                new_val = 0;
            else if (val > maxval)
                new_val = maxval;

            if (new_val != val) $(this).val(new_val);
            slider_el.slider('values', 0, new_val);
        });

        maxfield.change(function () {
            var val = parseInt($(this).val());
            var new_val = val;
            var minval = parseInt(minfield.val());

            if (isNaN(val) || val > limit)
                new_val = limit;
            else if (val < minval)
                new_val = minval;

            if (new_val != val) $(this).val(new_val);
            slider_el.slider('values', 1, new_val);
        });

        minfield.add(maxfield).change(function () {
            row.toggleClass('highlight', parseInt(minfield.val()) != 0 ||
                            parseInt(maxfield.val()) != limit);
        }).change();
    });

    /*
     * Boolean attributes
     */
    $('.boolean_true').button({icons: {primary: 'ui-icon-check'}});
    $('.boolean_false').button({icons: {primary: 'ui-icon-closethick'}});

    /*
     * Enum attributes
     */
    $('.enum_attr td.attr_controller input').button();
    
    /*
     * Lan attribute
     */
    $('.lan_attr td.attr_controller input').button();

    // Buttons
    $('.button, :button, input[type="submit"]').button();

    // Hide/show misc params
    $('div.param-group-button input').button({
        icons: {primary: 'ui-icon-triangle-1-s'}
    }).each(function() {
        if ($.cookie(this.id) == '1') this.checked = true;
    }).change(function() {
        $(this).parent().next('.param-group').toggle(this.checked);
        $.cookie(this.id, this.checked ? '1' : '0', {expires: 365});
    }).change();

    /*
     * AJAX
     */
    var throbber = '<img class="throbber" src="img/throbber.gif">';
    $.blockUI.defaults.overlayCSS.opacity = 0.0;

    $('#search_button').click(function() {
        submitQuery(true);
        return false;
    });

    $('#excel').click(function() {
        $.blockUI({message: throbber
                   + '<br>Excel-fil laddas, kan ta en stund.'});
        $.cookie('fileDownloaded', null);

        function checkDownloaded() {
            if ($.cookie('fileDownloaded') == '1') {
                $.unblockUI();
                $.cookie('fileDownloaded', null);
            } else {
                window.setTimeout(checkDownloaded, 500);
            }
        }
        checkDownloaded();

        $('#query_form').attr('action', 'excel.php');
    });

    $('#save-button').click(function() {
        $('#save_query_window').dialog("open");
        return false;
    });

    $('#copy-button').click(function() {
        $('#copy_query_window').dialog("open");
        return false;
    });

    $('#update-button').click(function() {
        $('#query_form').attr('action', 'save.php').submit();
        return false;
    });

    $('#delete-button').click(function() {
        $('#delete-selection-form')[0].elements['sid'].value
            = $('#query_form')[0].elements['sid'].value;
        $('#delete-selection-dialog').dialog('open');
        return false;
    });
}

$(initForm);
