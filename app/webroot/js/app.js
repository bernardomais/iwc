GLOBAL = {
    datatable: null
}, APP = {
    // Preload
    preload: function () {
        $.html5Loader({
            filesToLoad: 'app/webroot/js/files.json',
            onBeforeLoad: function () {
                $('body').prepend('<div class="loading"><div class="alert alert-warning" role="alert"><strong>Carregando...</strong></div></div>');
            },
            onComplete: function () {
                setInterval(function () {
                    $('.loading').remove();
                    $('.page').fadeIn('normal');
                }, 1000);
                APP.init();
            }
        });
    },
    // Data Table
    dataTable: function (table) {
        GLOBAL.datatable = $(table).DataTable({
            'language': {
                'url': baseUrl + 'js/internationalisation/datatable.json'
            },
            columnDefs: [{
                    orderable: false,
                    'targets': [-1, 'table-header-checkbox']
                }],
            info: false,
            searching: false,
            paging: false,
            responsive: false
        });
        $('.table-header-checkbox input[type=checkbox]').click(function () {
            $(this).parents('table').find('tbody input:checkbox').not(this).prop('checked', this.checked);
        });
    },
    // Date time popup
    datetime: function () {
        $.fn.datepicker.dates['pt-BR'] = {
            days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
            daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa", "Do"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            clear: "Limpar"
        };
        $('.input-date').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            orientation: "auto"
        });
        $(document.body).on('change', '.input-date', function () {
            $('.datepicker').hide();
        });
    },
    // Select
    select: function () {
        if ($('select.select').length > 0) {
            $('select.select').select2({
                placeholder: 'Selecione se precisar',
                formatNoMatches: function () {
                    return 'Nenhum resultado';
                }
            });
        }

    },
    scrollDropdown: function () {

        (function ($) {
            $.fn.offsetRelative = function (top) {
                var $this = $(this);
                var $parent = $this.offsetParent();
                var offset = $this.position();

                // add scroll
                offset.top += $this.scrollTop() + $parent.scrollTop();
                offset.left += $this.scrollLeft() + $parent.scrollLeft();
                if (!top) {
                    // Didn't pass a 'top' element
                    return offset;
                } else if ($parent.get(0).tagName == "BODY") {
                    // Reached top of document
                    return offset;
                } else if ($(top, $parent).length) {
                    // Parent element contains the 'top' element we want the offset to be relative to
                    return offset;
                } else if ($parent[0] == $(this).closest(top)[0]) {
                    // Reached the 'top' element we want the offset to be relative to
                    return offset;
                } else {
                    // Get parent's relative offset
                    var parent_offset = $parent.offsetRelative(top);
                    offset.top += parent_offset.top;
                    offset.left += parent_offset.left;
                    return offset;
                }
            };
            $.fn.positionRelative = function (top) {
                return $(this).offsetRelative(top);
            };
        }(jQuery));

        $('.dropdown').on('show.bs.dropdown', function () {
            child = $(this);
            childMenu = $(this).find('.dropdown-menu');
            parent = $(this).parents('.scrollable-shadow').length > 0 ? $(this).parents('.scrollable-shadow') : $('body');
            parentSelector = $(this).parents('.scrollable-shadow').length > 0 ? '.scrollable-shadow' : 'body';
            scroll = parent;
            menuHeight = childMenu.height();
            childPosition = child.offsetRelative(parentSelector).top;
            scrollHeight = scroll.height();
            scrollTop = scroll[0].scrollTop;

            if (childPosition > scrollHeight) {
                scroll.stop().animate({
                    scrollTop: scrollTop + menuHeight + 50
                }, 500);
            }
        });
    },
    // Masks
    masks: function () {
        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
                spOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };
        $('.input-tel').mask(SPMaskBehavior, spOptions);
        $(".input-cpf").mask("999.999.999-99");
        $(".input-date, .input-date-only").mask("99/99/9999");
        $(".input-time").mask("99:99");
    },
    //Search filters
    searchFilters: function (selector) {
        $(document).on('change click', selector, function () {
            var radioOpt = $(this).attr('value');
            switch (radioOpt) {
                case 'Student':
                    {
                        $('#searchAccordion .panel').not('.student-filters').fadeOut('fast').addClass('hide');
                        $('#searchAccordion .panel.student-filters').not(':visible').removeClass('hide').fadeIn('fast');
                    }
                    break;
                case 'Profile' :
                    {
                        $('#searchAccordion .panel').not('.prospect-filters').fadeOut('fast').addClass('hide');
                        $('#searchAccordion .panel.prospect-filters').not(':visible').removeClass('hide').fadeIn('fast');
                    }
                    break;
                case 'Employee' :
                    {
                        $('#searchAccordion .panel').not('.employee-filters').fadeOut('fast').addClass('hide');
                        $('#searchAccordion .panel.employee-filters').not(':visible').removeClass('hide').fadeIn('fast');
                    }
                    break;
            }
        });
    },
    // Close dropdowns
    closeAppends: function (trigger, box) {
        $(document).click(function (e) {
            var target = e.target,
                    container = $('.dropdown-menu');
            if (!$(target).is(trigger) && container.has(e.target).length === 0) {
                if (trigger === 'ul.typeahead') {
                    $(box).addClass('hidden');
                } else {
                    $(box).hide();
                }
            }
            $('.btn-group:not(.bootstrap-select)').on('show.bs.dropdown', function () {
                $('.dropdown-menu-layout').hide();
            });
        });
    },
    // Filter
    inputSearch: function (trigger) {
        $(trigger).click(function () {
            $(".dropdown-menu-layout").toggle();
        });
        APP.closeAppends(trigger, ".dropdown-menu-layout");
        APP.searchFilters('.search-type');
        $('.search-type:checked').trigger('change');
    },
    // Validation forms
    validation: function () {
        $("input, select, textarea").not("[type=submit]").jqBootstrapValidation({
            semanticallyStrict: true,
            sniffHtml: false
        });
    },
    // Editable infos
    editable: function () {
        if ($('.form-editable').length > 0) {
            $('.form-editable').editable();
        }

    },
    // Typeahead
    typeahead: function (selector, url) {
        var items = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: baseUrl + url,
                filter: function (list) {
                    return $.map(list, function (item) {
                        return {
                            value: item
                        }
                    });
                }
            }
        });
        items.initialize();
        $(selector).typeahead(null, {
            name: 'items',
            displayKey: 'value',
            source: items.ttAdapter(),
            templates: {
                suggestion: Handlebars.compile('<a role="menuitem" tabindex="-1" href="#">{{value}}</a>')
            }
        });
    },
    // Typeahead search
    typeaheadSearch: function () {
        var profiles = new Bloodhound({
            datumTokenizer: function (d) {
                return Bloodhound.tokenizers.whitespace(d.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: baseUrl + 'profiles/autocomplete/%QUERY',
                filter: function (response) {
                    return $.map(response, function (profile) {
                        return {
                            value: profile.name,
                            profile_id: profile.profile_id,
                            picture: profile.picture,
                            student_registration: profile.student_registration,
                            employee_registration: profile.employee_registration,
                            url: profile.url
                        }
                    });
                }
            }
        });
        profiles.initialize();
        Handlebars.registerHelper('if', function (conditional, options) {
            if (conditional) {
                return options.fn(this);
            } else {
                return options.inverse(this);
            }
        });
        $('.input-search').typeahead(null, {
            displayKey: 'value',
            source: profiles.ttAdapter(),
            templates: {
                empty: [
                    //'<ul class="dropdown-menu" style="display: block" role="menu"><li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Nenhum resultado encontrado</a></li><li role="presentation" class="divider"></li><li role="presentation"><a role="menuitem" tabindex="-1" href="' + baseUrl + 'profiles/register">Ir para <strong>Prospect / Matrícula</strong></a></li></ul>'
                    '<ul class="dropdown-menu" style="display: block" role="menu"><li role="presentation" class="divider"></li><li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Nenhum resultado encontrado</a></li></ul>'
                ],
                suggestion: Handlebars.compile('<a role="menuitem" tabindex="-1" href="{{url}}" class="typeahead-search"><div class="typeahead-body"><span class="typeahead-name"><strong>{{value}}</strong></span><span class="typeahead-tips">{{#if student_registration}}Matrícula: {{student_registration}}{{else}}Prospect{{/if}}</span></div></a>')
            }
        });
    },
    // AddMultiFields 
    addMultiFields: {
        init: function (wrapperSelector, addButtonSelector, fieldType) {
            var max_fields = 4,
                    wrapper = $(wrapperSelector),
                    add_button = $(addButtonSelector),
                    x = 1;
            if (fieldType === 'undefined') {
                fieldType = '';
            }
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    html = APP.addMultiFields.elementTemplate('phone');
                    $(wrapper).append(html).children(':last').hide().fadeIn();
                    APP.masks();
                }
            });
            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                me = $(this), myContainer = me.parents('.input-group'), myIdElement = myContainer.find('.my-id');
                if (myIdElement.length > 0) {
                    myContainer.fadeOut('fast', function () {
                        myContainer.find('.input-tel').attr('value', '');
                    });
                } else {
                    myContainer.fadeOut('fast', function () {
                        myContainer.remove();
                    });
                }
                x--;
            });
        },
        elementTemplate: function (fieldType) {
            output = '';
            switch (fieldType) {
                case 'phone':
                    {
                        if ($('#phone-elements-next-index').length > 0) {
                            index = $('#phone-elements-next-index').val();
                            $('#phone-elements-next-index').val(index + 1);
                        } else {
                            index = 0;
                        }
                        input = '<input name="data[Phone][' + index + '][number]" class="form-control input-tel" type="tel">';
                        rmvBtn = '<span class="input-group-btn"><button class="btn btn-link remove_field" type="button"><span class="glyphicon glyphicon-remove"></span><span class="sr-only">Remover</span></button></span>';
                        output = '<div class="input-group">' + input + rmvBtn + '</div>';
                    }
                    break;
                default:
                    {
                        output = '<p><strong>Aviso </strong>: Você não definiu o template desse campo ou não passou os parametros corretamente para esta função</p>';
                    }
                    break;
            }
            return output;
        }
    },
    // Tooltips
    tooltip: function () {
        $('[data-toggle="tooltip"]').tooltip();
    },
    // Chart
    charts: function (selector, title, type, ajaxUrl) {
        var id = '#' + selector;
        if ($(id).length > 0) {
            google.load("visualization", "1", {
                packages: ["corechart"],
                callback: function () {
                }
            });

            google.setOnLoadCallback(drawChart);
            function drawChart() {
                if (ajaxUrl) {
                    $.get(ajaxUrl, function (result) {
                        var output = $.parseJSON(result);

                        var contents = google.visualization.arrayToDataTable(output.data);

                        var options = {
                            title: title
                        };
                        switch (type) {
                            case 'line':
                                var chart = new google.visualization.LineChart(document.getElementById(selector));
                                break;
                            case 'pie':
                                var chart = new google.visualization.PieChart(document.getElementById(selector));
                                break;
                            case 'column':
                                var chart = new google.visualization.ColumnChart(document.getElementById(selector));
                                break;
                        }
                        chart.draw(contents, options);
                    });
                }
            }
        }

    },
    // Ckeditor
    editor: function () {
        if ($('#edit_model_document').length > 0) {
            CKEDITOR.replace('edit_model_document', {
                language: 'pt-br'
            });
        }

    },
    // Dropdown forms
    dropdownForm: function () {
        $('.dropdown-form').click(function (e) {
            e.stopPropagation();
        });
    },
    // Calendar
    calendar: function () {
        var modal;
        $('.calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            lang: 'pt-br',
            editable: true,
            eventLimit: true,
            selectable: true,
            selectHelper: true,
            select: function (start, end) {
                var title = prompt('Título do Evento:');
                var eventData;
                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end,
                        className: 'label label-info'
                    };
                    $('.calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('.calendar').fullCalendar('unselect');
            },
            events: [
                {
                    title: 'teste',
                    start: $.fullCalendar.moment('2014-11-28'),
                    className: 'label label-info'
                }
            ]
        });
    },
    //Evaluation scheme graphic
    evaluationGraphic: function (selector, elementId, hiddenSchemeId) {
        element = $(selector);
        if (element.length > 0) {
            var schemeId = $(hiddenSchemeId).attr('value'),
                    ajax_url = baseUrl + '/evaluation_schemes/graphic/' + schemeId,
                    data = null;

            $.get(ajax_url, function (result) {
                var contents = $.parseJSON(result);

                var data = {
                    nodes: contents.nodes,
                    edges: contents.edges
                };

                // create a network
                var container = document.getElementById(elementId);

                var options = {
                    stabilize: false,
                    physics: {
                        barnesHut: {
                            enabled: true,
                            gravitationalConstant: -2000,
                            centralGravity: 0.1,
                            springLength: 200,
                            springConstant: 0.01,
                            damping: 0.09
                        }
                    }
                };
                network = new vis.Network(container, data, options);

            }).fail(function () {
                alert("error");
            });
        }
    },
    elements: {
        cancelChanges: function (selector) {
            $(document.body).on('click', selector, function (e) {
                e.preventDefault();
                location.href = location.href.replace(/[\?#].*|$/, "?changes-cancelled=1");
            });
        },
        destroyer: function () {
            $('body').on('click', 'a[id*=destroy-]', function (e) {
                e.preventDefault();
                var element = $(this),
                        split = element.attr('id').split('-'),
                        target = split[1],
                        hiddenElement = '#hidden-fields-' + split[2];
                $(this).parents(target).fadeOut(300, function () {
                    var rm = $(this).find('.remove-item');
                    if (rm.length > 0) {
                        rm.attr('value', 1);
                    } else {
                        if (element.parents('table').length > 0) {
                            GLOBAL.datatable.row(element.parents('tr')).remove().draw();
                        } else {
                            $(this).remove();
                        }
                    }
                });
                if ($(hiddenElement).length > 0) {
                    $(hiddenElement).remove();
                }
            });
        },
        selectAll: function (selector) {
            $(document.body).on('click', selector, function (e) {
                element = $(this);
                if (element.length > 0) {
                    pid = element.attr('data-target-pid');
                    targets = element.closest('table').find('tbody .period-id-' + pid);
                    if (element.is(':checked')) {
                        targets.attr('checked', true);
                    } else {
                        targets.attr('checked', false);
                    }
                }
            });
        },
        toggleWithFade: function (trigger, container, source, target) {
            $(document.body).on('click', trigger, function (e) {
                e.preventDefault();
                $(this).parents(container).find(source).fadeToggle('fast');
                $(this).parents(container).find(target).fadeToggle('fast');
            });
        },
        calculateMoney: function (elementsToCalc, diff, output) {
            var selectors = [elementsToCalc, diff, output].join(', ');
            $(document.body).on('change keyup', selectors, function (event) {
                var whoCalled = $(this),
                        diffVal = Number($(diff).attr('value')),
                        calc = 0;
                $(elementsToCalc).each(function (index, element) {
                    if ($(this).hasClass('money-subtraction')) {
                        calc -= Number($(this).attr('value'));
                    } else {
                        calc += Number($(this).attr('value'));
                    }
                });
                if (whoCalled.hasClass('money-calculate-result')) {
                    $('.money-parcial-value').attr('value', '');
                    var outputVal = Number($(this).attr('value'));
                    if (outputVal <= 0) {
                        result = -calc;
                    } else {
                        result = outputVal - calc;
                        if (result <= 0) {
                            $('.money-parcial-value').fadeOut('fast', function () {
                                $(this).attr('value', -result.toFixed(2)).fadeIn('fast');
                            });
                        }
                    }
                    $(diff).fadeOut('fast', function () {
                        $(this).attr('value', result.toFixed(2)).fadeIn('fast');
                    });
                } else {
                    result = calc + diffVal;
                    $(output).fadeOut('fast', function () {
                        $(this).attr('value', result.toFixed(2)).fadeIn('fast');
                    });
                }
            });
        },
        paymentInfo: function (select) {
            $(document.body).on('change', select, function () {
                var machineNames = $('#machine-names');
                if (machineNames.length > 0) {
                    var vals = $.parseJSON(machineNames.attr('value')),
                            selected = $(this).find(":selected").val(),
                            toShow = vals[selected],
                            elementToShow = '.payment-' + toShow;

                    $('.payment-info').hide();
                    $(elementToShow).removeClass('hide').fadeIn('fast');
                }
            });
        },
        paymentMakeUp: function (totalValueSelector, regularButton, makeUpButton, partialPaymentSelector) {
            $(document.body).on('change keyup', totalValueSelector, function () {
                val = $(this).attr('value');
                if (val <= 0) {
                    if ($(regularButton).is(':visible')) {
                        $(regularButton).fadeOut('fast', function () {
                            $(this).addClass('hidden');
                        });
                    }
                    if ($(makeUpButton).not(':visible')) {
                        $(makeUpButton).fadeIn('fast', function () {
                            $(this).removeClass('hidden');
                        });
                    }

                    if ($(partialPaymentSelector).is(':enabled')) {
                        $(partialPaymentSelector).attr('disabled', true);
                    }
                } else {
                    if ($(regularButton).not(':visible')) {
                        $(regularButton).fadeIn('fast', function () {
                            $(this).removeClass('hidden');
                        });
                    }

                    if ($(makeUpButton).is(':visible')) {
                        $(makeUpButton).fadeOut('fast', function () {
                            $(this).addClass('hidden');
                        });
                    }

                    if ($(partialPaymentSelector).is(':disabled')) {
                        $(partialPaymentSelector).attr('disabled', false);
                    }
                }
            });
        }
    },
    popover: function () {
        var isVisible = false,
                selector = $('.btn-info-quickly'),
                hideAllPopovers = function () {
                    selector.each(function () {
                        $(this).popover('hide');
                    });
                };
        selector.popover({
            html: true,
            trigger: 'manual'
        }).on('click', function (e) {
            e.preventDefault();
            if (isVisible) {
                hideAllPopovers();
            }
            $(this).popover('show');
            $('.popover').off('click').on('click', function (e) {
                e.stopPropagation();
            });
            isVisible = true;
            e.stopPropagation();
        });
        $(document).on('click', function (e) {
            hideAllPopovers();
            isVisible = false;
        });
    },
    notification: function () {
        $('div[data-notification-type]').each(function () {
            var text = $(this).text(),
                    type = $(this).attr('data-notification-type');
            $.bootstrapGrowl(text, {
                type: type,
                offset: {
                    from: "top",
                    amount: 20
                },
                align: "center",
                delay: 7000,
                allow_dismiss: true,
                stackup_spacing: 10
            });
        });
    },
    pagination: function () {
        var pages = [];
        var loaded = [];
        var current = 0;
        $('.pagination a').each(function (index) {
            pages[index] = $(this).attr('href');
            loaded[$(this).attr('href')] = 0;
        });
        $(window).scroll(function (e) {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                loaded[pages[current + 1]] = loaded[pages[current + 1]] + 1;
                if (loaded[pages[current + 1]] <= 1)
                    loadMoreContent(current + 1);
            }
        });

        function loadMoreContent(position) {
            if (position < pages.length) {
                $('.pagination-backdrop').fadeIn('slow', function () {
                    $.get(pages[position], function (data) {
                        $('.pagination-backdrop').fadeOut('slow', function () {
                            $('.infinite').append(data).fadeIn(999);
                            current = position;
                        });
                    });
                });
            }
        }
    },
    util: {
        partOfString: function (rawString, afterDelimiter, beforeDelimiter) {
            var str = rawString;
            return str.substring(str.lastIndexOf(afterDelimiter) + 1, str.lastIndexOf(beforeDelimiter));
        },
        ajaxProgress: {
            build: function () {
                if ($('.progress-youtube').length === 0) {
                    $('body').append($('<div class="progress-overlay"><div class="progress-youtube"><dt/><dd/></div></div>'));
                    $('.progress-youtube').width((50 + Math.random() * 30) + "%");
                }
            },
            destroy: function () {
                $('.progress-youtube').width('101%').delay(200).fadeOut(400, function () {
                    $('.progress-overlay').remove();
                });
            },
            init: function () {
                $(document).ajaxStart(function () {
                    APP.util.ajaxProgress.build();
                });
                $(document).ajaxComplete(function () {
                    APP.util.ajaxProgress.destroy();
                });
            }
        },
        getUrl: function (url) {
            console.log(url);
            return url.split("?")[0].split("#")[0];
        },
        init: function () {
            APP.util.ajaxProgress.init();
        }
    },
    form: {
        conditional: function (selector, target, parent, parent_position, ajax_url) {
            var valSelected = null;
            $(document.body).on('change', selector, function () {
                if ($(this).is('input[type=checkbox]')) {
                    valSelected = $(this).is(':checked');
                } else {
                    valSelected = isNaN(target) ? $(this).find(":selected").val() : parseInt($(this).find(":selected").val());
                }
                if (target === valSelected) {
                    if (typeof (ajax_url) === 'undefined') {
                        $(parent).fadeIn('fast', function () {
                            $(this).removeClass('hidden');
                        });
                    } else {
                        var field_request = $.get(ajax_url, function (data) {
                            $(data).insertAfter($(selector).parents(parent)).hide().fadeIn('fast');
                            APP.select();
                        }).fail(function () {
                            alert("error");
                        });
                    }
                } else {
                    if (typeof (ajax_url) === 'undefined') {
                        if (!$(parent).hasClass('hidden')) {
                            $(parent).fadeOut('fast', function () {
                                $(this).addClass('hidden');
                            });
                        }
                    } else {
                        if ($(parent).next('.form-item-ajax')) {
                            $(parent).next('.form-item-ajax').fadeOut('fast', function () {
                                $(this).remove();
                            });
                        }
                    }
                }
            });
        },
        triggerChange: function () {
            selectors = ['#evaluation-scheme-criteria',
                '#evaluation-stage-criteria', '#allow-disciplines-failure', 'm#ax-disciplines-failure',
                '#transfer-cash-keeper-val', '#is-card', '#allow-partial-payment',
                '#payment-methods', '.control-address-visibility:checked'];

            $.each(selectors, function (index, selector) {
                if ($(selector).length > 0) {
                    $(selector).trigger('change');
                }
            });
        },
        selectTriggerSubmit: function (selector) {
            $(document.body).on('change', selector, function () {
                $(selector).parents('form').submit();
            });
        },
        dynamicSelect: function (parent, dependent, ajax_url) {
            var valSelected = null;
            $(parent).on('change', function () {
                valSelected = parseInt($(this).find(":selected").val());
                url = ajax_url + '/' + valSelected;
                var field_request = $.get(url, function (data) {
                    $(dependent).html(data);
                    APP.select();
                }).fail(function () {
                    alert("error");
                });
            });
        },
        submitHidden: function (form) {
            $(form).unbind('submit');
            $(form).submit(function (e) {

                e.preventDefault();
                e.stopPropagation();
                var fields = $(this).serializeArray();
                var data = {};
                $.each(fields, function (i, field) {
                    data[field.name] = field.value;
                });
                $(this).parents('.modal').fadeOut('fast', function () {
                    APP.form.set(data, $(this).find('#submit-target').val());
                    $(this).modal('hide');
                });
                return false;
            });
        },
        addHidden: function (selector, modalTarget) {
            $(document.body).on('click', selector, function (e) {
                e.preventDefault();
                e.stopPropagation();
                var me = $(this),
                        modalRef = me.attr('href'),
                        modalElement = $(modalTarget),
                        inputs = me.parents('tr').children('.input');
                inputs.each(function () {
                    var name = $(this).attr('name').replace(/\[[\d\.]\]+/g, '');
                    $('input[name="' + name + '"]').attr('value', $(this).attr('value'));
                });
                modalElement.modal('show');
                return false;
            });
        },
        set: function (data, target) {
            switch (target) {
                case 'course-disciplines':
                    {
                        var discipline = data['data[CoursesDiscipline][discipline_id]'].split("|"),
                                disciplineId = discipline[0],
                                disciplineName = discipline[1],
                                hoursSchedule = data['data[CoursesDiscipline][hours_schedule]'],
                                index = $('#discipline-index').val(),
                                html = null;
                        if (disciplineId !== '') {
                            hidden = '<div id="hidden-fields-' + index + '"><input type="hidden" name="data[CoursesDiscipline][' + index + '][discipline_id]" value="' + disciplineId + '" />';
                            if (hoursSchedule > 0) {
                                hidden += '<input type="hidden" name="data[CoursesDiscipline][' + index + '][hours_schedule]" value="' + hoursSchedule + '" />';
                            } else {
                                hoursSchedule = '';
                            }
                            GLOBAL.datatable.row.add([disciplineName, hoursSchedule, '<td><a class="btn btn-default pull-right" id="destroy-tr-' + index + '" href="#" title="Excluir item">Excluir</a></td></tr>']).draw();
                            $('#discipline-index').val(++index);
                            $('#course-form').append(hidden);
                        }
                    }
                    break;
                case 'student-financial-records':
                    {
                        var paymentPlanId = data['data[FinancialRecord][payment_plan_id]'],
                                paymentPlanDiscount = data['data[Discount][percentage]'],
                                paymentPlanName = data['data[PaymentPlan][name]'],
                                operationTerm = data['data[Installment][operation_term]'],
                                operationTermDay = data['data[Installment][operation_term_day]'],
                                index = $('#financial-record-index').val();
                        if (paymentPlanId !== '' && operationTerm !== '' && operationTermDay !== '') {
                            hidden = '<input type="hidden" name="data[Financial][' + index + '][payment_plan_id]" value="' + paymentPlanId + '" />';
                            hidden += '<input type="hidden" name="data[Financial][' + index + '][discount]" value="' + paymentPlanDiscount + '" />';
                            hidden += '<input type="hidden" name="data[Financial][' + index + '][operation_term]" value="' + operationTerm + '" />';
                            hidden += '<input type="hidden" name="data[Financial][' + index + '][operation_term_day]" value="' + operationTermDay + '" />';
                            data = '<td>' + hidden + paymentPlanName + '</td>';
                            action = '<td><div class="btn-group"><a class="btn btn-default" id="destroy-tr-' + index + '" href="#">Excluir</a></div></td></tr>';
                            GLOBAL.datatable.row.add([data, action]).draw();
                            $('#financial-record-index').val(++index);
                        }
                    }
                    break;
                default:
                    console.log(target);
                    break;
            }
        },
        preventLosingChanges: function (form) {
            var selector = $(form),
                    nav = $('.nav-tabs');

            if (selector.length > 0 && nav.length > 0 && !nav.hasClass('disabled')) {
                $(document).on('keyup change', 'input, select, textarea, .select2-input', function () {

                    nav.addClass('disabled');
                    var attrs = {
                        'href': '#',
                        'data-toggle': 'modal',
                        'data-target': '#prevent-losing-changes-modal'
                    };
                    $('.form-back').attr(attrs);
                    nav.find('a').each(function () {
                        $(this).attr(attrs);
                    });
                });
            }
        },
        selectFillHidden: function (select, hidden) {
            $(document.body).on('change', select, function () {
                text = $(this).find(":selected").text();
                if (text) {
                    $(hidden).attr('value', text);
                } else {
                    $(hidden).attr('value', '');
                }
            });
        },
        toggleVisibleAndRequired: function (elementToggle, showValue, hideValue, requiredContainer, requiredSelector, ignoreVisibility) {
            $(elementToggle).on('change', function () {
                var element = $(this);

                if (typeof (ignoreVisibility) === 'undefined') {
                    ignoreVisibility = false;
                }

                if (element.is('input[type=checkbox]')) {
                    elementVal = element.is(':checked');
                } else {
                    elementVal = element.val();
                }
                var target = requiredContainer + ' ' + requiredSelector;
                switch (elementVal) {
                    case showValue:
                        {
                            if (ignoreVisibility) {
                                $(target).attr("required", true);
                            } else {
                                $(requiredContainer).fadeIn("fast", function () {
                                    $(requiredContainer).removeClass("hide");
                                    $(target).attr("required", true);
                                });
                            }
                        }
                        break;
                    case hideValue:
                        {
                            if (ignoreVisibility) {
                                $(target).attr("required", false);
                            } else {
                                $(requiredContainer).fadeOut("fast", function () {
                                     $(requiredContainer).addClass("hide");
                                    $(target).attr("required", false);
                                });
                            }

                        }
                        break;
                }
            });
        },
        selectAndLink: function (select, link) {
            var valSelected = null;
            $(select).on('change', function () {
                valSelected = parseInt($(this).find(":selected").val());
                $(link).fadeOut('fast', function () {
                    if (valSelected) {
                        $(link).removeClass('disabled');
                        baseHref = $(link).attr('data-base-ref');
                        $(link).attr('href', baseHref + '/' + valSelected);
                    } else {
                        if (!$(link).hasClass('disabled')) {
                            $(link).addClass('disabled');
                            $(link).attr('href', '#');
                        }
                    }
                    $(this).fadeIn('fast');
                });
            });
        },
        address: {
            get: function (button, input) {
                var element = $(button);
                element.click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    zipCode = $(input).val();
                    if (zipCode) {
                        url = 'http://www.bigdata.132labs.com/api/addresses/' + zipCode;
                        APP.util.ajaxProgress.build();
                        $.get(url, function (result) {
                            if (result.data) {
                                APP.form.address.set(result.data);
                            }
                        }, 'jsonp').done(function () {
                            APP.util.ajaxProgress.destroy();
                        });
                    }
                });
            },
            set: function (data) {
                var selectors = {
                    "#address-street": data.Address.name,
                    "#address-district": data.District.name,
                    "#address-city": data.Locality.name,
                    "#address-state": data.State.acronym
                };
                $.each(selectors, function (selector, data) {
                    if ($(selector).length > 0) {
                        $(selector).attr('value', data);
                    }
                });
            },
            init: function (button, input) {
                APP.form.address.get(button, input);
                var trigger = $(button),
                        target = $(input);
                if (trigger.length > 0 && target.length > 0) {
                    //trigger.click();
                }
            }
        },
        dynamitags: {
            init: function (container) {
                var selectors = ['#periodDynamitags', '#stageDynamitags', '#criteriaDynamitags'];
                $.each(selectors, function (index, selector) {
                    if ($(container).find(selector).length > 0) {
                        switch (selector) {
                            case '#periodDynamitags':
                                {
                                    tokensRepo = $('#tokens-repo');
                                    if (tokensRepo.length > 0) {
                                        var vals = tokensRepo.val(),
                                                tokens = $.parseJSON(vals);
                                        if (tokens) {
                                            $(selector).unbind().dynamiTags({
                                                terms: tokens,
                                                selectField: '.selectbox',
                                                selectTerm: '.selectTerm',
                                                selectOperator: '.selectOper',
                                                numberField: '#dt_number',
                                                numberInsert: '#dt_ins',
                                                expression: '.dt_exprArea',
                                                output: '#dt_order'
                                            });
                                        } else {
                                            alert('cilada, bino');
                                        }
                                    }
                                }
                                break;
                            case '#stageDynamitags':
                                {
                                    {
                                        tokensRepo = $('#stage-tokens-repo');
                                        if (tokensRepo.length > 0) {
                                            var vals = tokensRepo.val(),
                                                    tokens = $.parseJSON(vals);
                                            if (tokens) {
                                                $(selector).unbind().dynamiTags({
                                                    terms: tokens,
                                                    selectField: '.stage_selectbox',
                                                    selectTerm: '.stage_selectTerm',
                                                    selectOperator: '.stage_selectOper',
                                                    numberField: '#stage_dt_number',
                                                    numberInsert: '#stage_dt_ins',
                                                    expression: '.stage_dt_exprArea',
                                                    output: '#stage_dt_order'
                                                });
                                            } else {
                                                alert('cilada, bino');
                                            }
                                        }
                                    }
                                }
                                break;
                            case '#criteriaDynamitags':
                                {
                                    {
                                        tokensRepo = $('#criteria-tokens-repo');
                                        if (tokensRepo.length > 0) {
                                            var vals = tokensRepo.val(),
                                                    tokens = $.parseJSON(vals);
                                            if (tokens) {
                                                $(selector).unbind().dynamiTags({
                                                    terms: tokens,
                                                    selectField: '.criteria_selectbox',
                                                    selectTerm: '.criteria_selectTerm',
                                                    selectOperator: '.criteria_selectOper',
                                                    numberField: '#criteria_dt_number',
                                                    numberInsert: '#criteria_dt_ins',
                                                    expression: '.criteria_dt_exprArea',
                                                    output: '#criteria_dt_order'
                                                });
                                            } else {
                                                alert('cilada, bino');
                                            }
                                        }
                                    }
                                }
                                break;
                        }
                    }
                });
            }
        },
        financialItems: function (trigger, targets) {
            $(document.body).on('click', trigger, function (e) {
                e.preventDefault();
                e.stopPropagation();
                url = $(trigger).attr('href');

                var selected = $(targets + ':checked');
                if (selected.length > 0) {
                    var ids = [];
                    $.each(selected, function (index, element) {
                        ids[index] = $(element).attr('value');
                    });
                    params = $.param({fid: ids});
                    destination = url + '&' + params;
                    window.location.replace(destination);
                } else {
                    alert('Selecione um ou mais títulos');
                }

            });
        },
        init: function () {
            APP.modal.bind();
            APP.form.preventLosingChanges('.prevent-lc');
        }
    },
    modal: {
        trigger: function (selector) {
            var vSelector = $(selector);
            if (vSelector.length > 0) {
                vSelector.modal('show');
            }
        },
        bind: function () {
            $(document.body).on('loaded.bs.modal', '.modal', function (e) {
                currentModal = $(this);
                if (e.handled !== true) {
                    APP.datetime();
                    APP.select();
                    APP.editable();
                    //APP.validation();
                    APP.popover();
                    APP.masks();
                    APP.addMultiFields.init(".input_fields_wrap", ".add_field_button", "phone");
                    APP.form.submitHidden('#submit-hidden');
                    APP.form.conditional('#evaluation-scheme-criteria', 'custom', '#evaluation-formula');
                    APP.form.conditional('#evaluation-stage-criteria', 'custom', '#evaluation-formula');
                    APP.form.conditional('#allow-disciplines-failure', true, '#max-disciplines-failure');
                    APP.form.conditional('#transfer-cash-keeper-val', true, '#cash-keeper-value');
                    APP.form.conditional('#is-card', true, '#card-options');
                    APP.form.conditional('#allow-partial-payment', true, '.partial-payment');
                    APP.form.conditional('#schedule-next-interaction', true, '#next-interaction');
                    APP.tooltip();
                    APP.form.address.init('#address-load', '#zip-code');
                    APP.form.dynamitags.init(currentModal);
                    APP.elements.paymentInfo('#payment-methods');
                    APP.elements.paymentMakeUp('#completed-value', '#regular-payment', '#make-up-payment', '#allow-partial-payment');
                    APP.form.addHidden('.add-hidden', '#modal-periods-add-hidden');
                    APP.form.toggleVisibleAndRequired('.control-address-visibility', 'new', 'same_as_dependent', '#visibility-container', '.toggle-required');
                    APP.form.toggleVisibleAndRequired('#responsible-is-financial', true, false, '#ids-container', '.toggle-required', true);
                    APP.form.toggleVisibleAndRequired('#date-filter', 'date_interval', 'academic_period', '.period-container', '.toggle-required');
                    APP.form.toggleVisibleAndRequired('#date-filter', 'academic_period', 'date_interval', '.academic-period-container', '.toggle-required');
                    APP.form.triggerChange();
                    e.handled = true;
                }
            });
            $('body').on('hidden.bs.modal', '.modal.clear-after', function () {
                $(this).removeData('bs.modal');
            });
        },
        init: function () {
            APP.modal.trigger('.modal-trigger');
            APP.modal.bind();
        }
    },
    init: function () {
        this.util.init();
        this.dataTable('.datatable');
        this.popover();
        this.editable();
        this.notification();
        this.datetime();
        this.select();
        this.addMultiFields.init(".input_fields_wrap", ".add_field_button", "phone");
        this.masks();
        this.typeahead('.input-typeahead-from_institution', 'institutions/ajax_list/1');
        this.typeahead('.input-typeahead-comunication', 'communication_vehicles/ajax_list');
        this.typeaheadSearch();
        this.tooltip();
        this.dropdownForm();
        this.calendar();
        //
        this.evaluationGraphic('#evaluation-scheme-graphic-representation', 'evaluation-scheme-graphic-representation', '#evaluation-scheme-id');
        this.inputSearch('.btn-append-layout');
        this.form.conditional('#CashKeeperCashKeeperTypeId', 2, '.form-group', 4, baseUrl + 'employees/ajax_employees_list');
        this.form.conditional('#evaluation-scheme-criteria', 'custom', '#evaluation-formula');
        this.form.conditional('#evaluation-stage-criteria', 'custom', '#evaluation-formula');
        this.form.conditional('#allow-disciplines-failure', true, '#max-disciplines-failure');
        this.form.conditional('#transfer-cash-keeper-val', true, '#cash-keeper-value');
        this.form.conditional('#is-card', true, '#card-options');
        this.modal.init();
        this.form.init();
        this.form.address.init('#address-load', '#zip-code');
        this.form.dynamitags.init('body');
        this.elements.destroyer();
        this.elements.cancelChanges('.cancel-changes');
        this.elements.selectAll('.select-period-id');
        this.elements.toggleWithFade('.delete-button', '.actions-container', '.item-actions', '.delete-confirm');
        this.elements.calculateMoney('.money-calculate', '.money-calculate-diff', '.money-calculate-result');
        this.elements.paymentInfo('#payment-methods');
        this.elements.paymentMakeUp('#completed-value', '#regular-payment', '#make-up-payment', '#allow-partial-payment');
        this.form.addHidden('.add-hidden', '#modal-periods');
        this.form.toggleVisibleAndRequired('.control-address-visibility', 'new', 'same_as_dependent', '#visibility-container', '.toggle-required');
        this.form.toggleVisibleAndRequired('#responsible-is-financial', true, false, '#ids-container', '.toggle-required', true);
        this.form.toggleVisibleAndRequired('.date-filter', 'date_interval', 'academic_period', '.period-container', '.toggle-required');
        this.form.toggleVisibleAndRequired('.date-filter', 'academic_period', 'date_interval', '.academic-period-container', '.toggle-required');
        this.form.selectAndLink('#classroom-dropdown', '#add-financial');
        this.form.selectFillHidden('#payment-plan-select', '#payment-plan-name');
        this.form.triggerChange();
        this.form.selectTriggerSubmit('#classrooms-period-select');
        this.editor();
        this.charts('chart-line-billing', null, 'line', baseUrl + 'financial_records/report_ajax_billings');
        this.charts('chart-pie-students', null, 'pie', baseUrl + 'students/report_ajax_total_by_course');
        this.charts('chart-column-occurrences', null, 'column', baseUrl + 'students/report_ajax_occurrences_by_classroom');
        this.form.financialItems('.financial-actions', '.financial-record-item');
        this.scrollDropdown();
    }
};
$(function () {
    APP.init();
});
