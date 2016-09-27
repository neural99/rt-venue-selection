$(function() {
    // Save queries
    $('#save_query_window').dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        height: 200,
        buttons: {
            Spara: function() {
                var name = $('#save_query_form')[0].elements['query_name'];
                $('#query_form')[0].elements['name'].value = name.value;
                $('#query_form').attr('action', 'save.php').submit();
            },
            Avbryt: function() { $(this).dialog("close"); }
        }
    });

    $('#copy_query_window').dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        height: 200,
        buttons: {
            Kopiera: function() {
                var name = $('#copy_query_form')[0].elements['query_name'];
                $('#query_form')[0].elements['name'].value = name.value;
                $('#query_form')[0].elements['save_new'].value = '1';
                $('#query_form')[0].elements['finished'].checked = false;
                $('#query_form').attr('action', 'save.php').submit();
            },
            Avbryt: function() { $(this).dialog("close"); }
        }
    });

    $('#delete-selection-dialog').dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        height: 200,
        buttons: {
            "Ta bort": function() { $('#delete-selection-form').submit(); },
            Avbryt: function() { $(this).dialog("close"); }
        }
    });


    $('#save_query_form').submit(function() {
        var buttons = $("#save_query_window").dialog( "option", "buttons");
        var f = buttons['Spara'];
        f.call();
        return false;
    });
    
    $('#copy_query_form').submit(function() {
        var buttons = $("#copy_query_window").dialog( "option", "buttons");
        var f = buttons['Kopiera'];
        f.call();
        return false;
    });

    function f_scrollTop() {
        return f_filterResults (
            window.pageYOffset ? window.pageYOffset : 0,
            document.documentElement ? document.documentElement.scrollTop : 0,
            document.body ? document.body.scrollTop : 0
        );
    }
    function f_filterResults(n_win, n_docel, n_body) {
        var n_result = n_win ? n_win : 0;
        if (n_docel && (!n_result || (n_result > n_docel)))
            n_result = n_docel;
        return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
    }

    function setPositionFixed(saved_queries_pos) {
        $('#saved_queries').dialog({dialogClass: "flora"});
        $('.flora.ui-dialog').css({position:"fixed"});
        
        var x = saved_queries_pos[0];
        var y = saved_queries_pos[1];
        var v = f_scrollTop();
        y += v;

        $('#saved_queries').dialog( "option", "position", [x, y]);
        
    }
    
    var saved_queries_pos;



    $('#saved_queries').dialog({
        autoOpen: false,
        modal: false,
        width: 500,
        height: 300,
        position: [$(window).width() - 500,
                   $("#bottom-bar").offset().top - 310],
        close: function() {
            $('#minimize_button').show();
        },
        create: function () {
            saved_queries_pos = $('#saved_queries').dialog( "option", "position" );
        },
        dragStop: function() {
            saved_queries_pos = $('#saved_queries').dialog( "option", "position" );
        },
        resizeStart: function() { 
        },
        resize: function() {
            setPositionFixed(saved_queries_pos);
        }
    });

    setPositionFixed(saved_queries_pos);

    $('#minimize_button').button().click(function() { 
        $('#minimize_button').hide();
        $('#saved_queries').dialog("open");
        setPositionFixed();
    });
        
    var throbber = '<img class="throbber" src="img/throbber.gif">';
    $.blockUI.defaults.overlayCSS.opacity = 0.0;

    // AJAX
    var xhr = null;
    $('a.selection').click(function() {
        if (xhr) {
            xhr.abort();
            xhr = null;
        }
        var link = $(this);
        var id = link.attr('data-sid');
        $('#query_form_wrapper').block({message: throbber});
            
        xhr = $.get('form.php', {sid: id}, function(data) {
            $('#query_form_wrapper').html(data).unblock();
            initForm();

            // Highlight selection table row
            $('.saved_table tr.selected').removeClass('selected');
            link.parents('tr').first().addClass('selected');

            // Auto search
            submitQuery(false);

            xhr = null;
        });

        return false;
    });
});
