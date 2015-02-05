(function ($) {
    $.fn.dynamiTags = function (options) {
        //Seta valores padrão, caso o usuário não insira uma lista personalizada
        var defaults = {
            'operators': ['+', '-', '*', '/', '(', ')'],
            'terms': [
                {
                    'label': 'Trabalho',
                    'value': 'trabalho',
                    'repeat': 1
                },
                {
                    'label': 'Teste',
                    'value': 'teste',
                    'repeat': 1
                },
                {
                    'label': 'Prova',
                    'value': 'prova',
                    'repeat': 1
                },
                {
                    'label': '1º bimestre',
                    'value': '1º bimestre',
                    'repeat': 0
                }
            ],
            'selectField': '.selectbox',
            'selectTerm': '.selectTerm',
            'selectOperator': '.selectOper',
            'numberField': '#dt_number',
            'numberInsert': '#dt_ins',
            'expression': '.dt_exprArea',
            'output': '.dt_order'

        },
        settings = $.extend({}, defaults, options);




        return this.each(function () {
            // Funções para formação das tags e verificação de índices
            function formaTags(list, container, hasValue)
            {
                var i = 0,
                        value = "",
                        label = "",
                        repeat = "";

                for (i = 0; i < list.length; i++)
                {
                    if (hasValue === true)
                    {
                        value = list[i].value;
                        label = list[i].label;
                        repeat = list[i].repeat;
                        $(container).append('<option value="' + value + '" data-repeat="' + repeat + '">' + label + '</option>');
                    }
                    else
                    {
                        label = value = list[i];
                        $(container).append('<option value="' + value + '">' + label + '</option>');
                    }

                }
            }

            function checkIndex(cont, token, list) {
                var rawTag = '{' + token + ':' + cont + '}',
                        indexOf = $.inArray(rawTag, list),
                        signals = $.inArray(token, settings.operators);


                if (indexOf < 0) {
                    if (signals < 0)
                        return rawTag;
                    else
                        return token;
                } else {
                    return checkIndex(++cont, token, list);
                }


            }
            // -------------------------------------------------------------------------------- //

            var container = $(this),
                    operators = settings.operators,
                    terms = settings.terms,
                    selectOperator = settings.selectOperator,
                    selectTerms = settings.selectTerm,
                    output = settings.output,
                    select = $(settings.selectField),
                    exprArea = $(settings.expression),
                    btIns = settings.numberInsert,
                    displayNum = $(settings.numberField),
                    cont = 1,
                    tag = "",
                    listChildren = "",
                    list = [],
                    fnSubmit = function () {
                        list = [],
                                listChildren = exprArea.children('li');

                        if (listChildren.length > 0) {
                            listChildren.each(function () {
                                list.push(jQuery(this).children('.name').html());
                                $(output).val(list);
                            });
                        } else {
                            $(output).val('');
                        }
                    };



            formaTags(operators, selectOperator, false);
            formaTags(terms, selectTerms, true);
            
            select.unbind().select2();
            // Até aqui, OK. Estamos listando os termos e operadores do plugin

            select.on('change', function () {
                var valor = $(this).val(),
                        repeat = $(this).children(":selected").attr('data-repeat'),
                        selectTermElement = $(settings.selectTerm),
                        isSelectTermElement = $(this)[0] === selectTermElement[0];
                if (valor === 'Selecione...')
                    alert("Selecione uma opção!");
                else {
                    if (isSelectTermElement && repeat < 1) {
                        tag = valor;
                    }
                    else {
                        tag = checkIndex(cont, valor, list);
                    }
                    exprArea.append('<li title="' + tag + '" class="dt_dynamic ui-sortable-handle label label-info"><span class="name">' + tag + '</span> <a class="bt_close">&times;</a></li>');
                    fnSubmit();
                }
            }
            );

            //Povoando o exprArea para edição..
            if ($(output).val() !== "")
            {
                // Mas preenche a área somente se ela estiver vazia (evita o bug 
                // de preenchimento repetido, caso o construtor do plugin seja 
                // invocado mais de uma vez)
                if (exprArea.children('li').length <= 0) {
                    var data = $(output).val();
                    var res = data.split(",");
                    for (var i = 0; i < res.length; i++)
                    {
                        list.push(res[i]);
                        exprArea.append('<li title="' + res[i] + '" class="dt_dynamic ui-sortable-handle label label-info"><span class="name">' + res[i] + '</span> <a class="bt_close">&times;</a></li>');
                    }
                }
            }


            /* sortables */
            exprArea.sortable({
                opacity: 0.7,
                update: function () {
                    fnSubmit();
                }
            });

            exprArea.disableSelection();
            /* ajax form submission */



            //Verificar se o campo numérico está vazio
            displayNum.keyup(function () {
                var valor = $(this).val().replace(/ 0*[1-9]\d*/, '');
                $(this).val(valor);
            });

            //Inserir número após o clique do INSERIR
            $(btIns).click(function () {
                var value = displayNum.val();
                if (value === "")
                    alert("O campo numérico está em branco!");
                else
                {
                    exprArea.append('<li title="' + value + '" class="dt_dynamic ui-sortable-handle label label-info"><span class="name">' + value + '</span> <a class="bt_close">&times;</a></li>');
                    fnSubmit();
                    displayNum.val('');
                }
            });

            exprArea.children('li')
            $(container).on('click', '.bt_close', function () {
                var thisTag = $(this).parent('li');
                var forArray = thisTag.children('.name').html();
                var index = list.indexOf(forArray);

                if (index > -1) {
                    list.splice(index, 1);
                }
                thisTag.remove();
                fnSubmit();
            });


        });
    };
})(jQuery);