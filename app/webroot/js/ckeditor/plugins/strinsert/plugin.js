/**
 * @license Copyright © 2013 Stuart Sillitoe <stuart@vericode.co.uk>
 * This work is mine, and yours. You can modify it as you wish.
 *
 * Stuart Sillitoe
 * stuartsillitoe.co.uk
 *
 */

CKEDITOR.plugins.add('strinsert',
        {
            requires: ['richcombo'],
            init: function (editor)
            {
                //  array of strings to choose from that'll be inserted into the editor
                var insitution = [], profile = [], employee = [], student = [], classroomStudent = [], defaultTokens = [];
                insitution.push(['@logo_instituicao@', 'Logomarca', 'Logomarca da instituição de ensino']);
                insitution.push(['@nome_instituicao@', 'Nome', 'Nome da instituição de ensino']);
                insitution.push(['@endereco_instituicao@', 'Endereço', 'Endereço da instituição de ensino']);
                insitution.push(['@cnpj_instituicao@', 'CNPJ', 'CNPJ da instituição de ensino']);
                insitution.push(['@im_instituicao@', 'Isncrição municipal', 'Isncrição municipal  da instituição de ensino']);
                insitution.push(['@telefone_insituicao@', 'Telefone(s)', 'Telefone da instituição de ensino']);
                insitution.push(['@site_instituicao@', 'Site', 'Site da instituição de ensino']);

                profile.push(['@nome_cliente@', 'Nome', 'Nome do cliente']);
                profile.push(['@nascimento_cliente@', 'Nascimento', 'Nascimento do cliente']);
                profile.push(['@endereco_cliente@', 'Endereço', 'Endereço do cliente']);
                profile.push(['@cep_cliente@', 'CEP', 'CEP do cliente']);
                profile.push(['@cidade_cliente@', 'Cidade', 'Cidade do cliente']);
                profile.push(['@estado_cliente@', 'Estado', 'Estado do cliente']);
                profile.push(['@telefone_cliente@', 'Telefone', 'Telefone do cliente']);

                student.push(['@matricula_aluno@', 'Matrícula', 'Matricula do aluno']);
                student.push(['@filiacao_aluno@', 'Filiação', 'Nome dos pais do aluno']);
                student.push(['@responsavel_financeiro_aluno@', 'Responsável financeiro', 'Responsável financeiro do aluno']);
                student.push(['@responsavel_pedagogico_aluno@', 'Responsável pedagógico', 'Responsável pedagógico do aluno']);

                employee.push(['@matricula_colaborador@', 'Matrícula', 'Matricula do colaborador']);

                classroomStudent.push(['@nome_turma@', 'Nome da turma', 'Nome da turma']);
                classroomStudent.push(['@curso_turma@', 'Curso', 'Curso']);
                classroomStudent.push(['@turno_turma@', 'Turno', 'Turno']);
                classroomStudent.push(['@descontos_aluno_turma@', 'Descontos', 'Descontos do aluno']);
                classroomStudent.push(['@investimento_turma@', 'Investimento', 'Valor do investimento']);

                defaultTokens.push(['@data_atual@', 'Data de hoje', 'Data de hoje']);
                defaultTokens.push(['@data_atual_extenso@', 'Data por extenso', 'Data por extenso']);

                // add the menu to the editor
                editor.ui.addRichCombo('strinsert',
                        {
                            label: 'Variáveis',
                            title: 'Variáveis',
                            voiceLabel: 'Variáveis',
                            className: 'cke_format',
                            multiSelect: false,
                            panel:
                                    {
                                        css: [editor.config.contentsCss, CKEDITOR.skin.getPath('editor')],
                                        voiceLabel: editor.lang.panelVoiceLabel
                                    },
                            init: function ()
                            {
                                this.startGroup("Geral");
                                for (var i in defaultTokens)
                                {
                                    this.add(defaultTokens[i][0], defaultTokens[i][1], defaultTokens[i][2]);
                                }
                                
                                this.startGroup("Instituição de Ensino");
                                for (var i in insitution)
                                {
                                    this.add(insitution[i][0], insitution[i][1], insitution[i][2]);
                                }

                                this.startGroup("Cliente");
                                for (var i in profile)
                                {
                                    this.add(profile[i][0], profile[i][1], profile[i][2]);
                                }


                                this.startGroup("Aluno");
                                for (var i in student)
                                {
                                    this.add(student[i][0], student[i][1], student[i][2]);
                                }

                                this.startGroup("Aluno x Turma");
                                for (var i in classroomStudent)
                                {
                                    this.add(classroomStudent[i][0], classroomStudent[i][1], classroomStudent[i][2]);
                                }


                                this.startGroup("Colaborador");
                                for (var i in employee)
                                {
                                    this.add(employee[i][0], employee[i][1], employee[i][2]);
                                }

                            },
                            onClick: function (value)
                            {
                                editor.focus();
                                editor.fire('saveSnapshot');
                                editor.insertHtml(value);
                                editor.fire('saveSnapshot');
                            }
                        });
            }
        });