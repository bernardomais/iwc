<?php $roles = !empty($this->request->query['Search']['Responsible']['role']) ? $this->request->query['Search']['Responsible']['role'] : array(); ?>
<?php $genders = !empty($this->request->query['Search']['Profile']['gender']) ? $this->request->query['Search']['Profile']['gender'] : array(); ?>
<?php $studentStatuses = !empty($this->request->query['Search']['ClassroomsStudent']['status']) ? $this->request->query['Search']['ClassroomsStudent']['status'] : array(); ?>
<?php $responsibleGenders = !empty($this->request->query['Search']['Responsible']['gender']) ? $this->request->query['Search']['Responsible']['gender'] : array(); ?>
<?php $searchClassroomIdSelected = !empty($this->request->query['Search']['Classroom']['id']) ? $this->request->query['Search']['Classroom']['id'] : NULL; ?>
<?php $searchCourseIdSelected = !empty($this->request->query['Search']['Course']['id']) ? $this->request->query['Search']['Course']['id'] : NULL; ?>
<?php $checkedSearchType = !empty($this->request->query['Search']['type']) ? $this->request->query['Search']['type'] : NULL; ?>


<?php print $this->Form->create('Search', array('id' => 'search-form-' . $id_rand, 'inputDefaults' => array('div' => false, 'id' => null, 'label' => false), 'url' => array('controller' => 'projects', 'action' => 'search'))); ?>
<div class="app-bar-search">
    <div class="dropdown-layout">
        <?php print $this->Form->input('Search.Projects.name', array('class' => 'form-control input-search', 'placeHolder' => 'Nome do projeto...', 'label' => false, 'autocomplete' => "off")); ?>
        <!--
        <div class="dropdown-menu dropdown-menu-layout" role="menu">  
            <fieldset>
                <legend class="sr-only">Tipo da busca</legend>
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="form-group">
                            <label for="type-<?php print $id_rand; ?>">Buscar por</label>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="form-group">
                            <label class="radio-inline">
                                <input type="radio" name="data[Search][type]" <?php print empty($checkedSearchType) ? 'checked' : ($checkedSearchType == 'Student') ? 'checked' : null  ?> id="type-<?php print $id_rand; ?>-1" class="search-type" value="Student"> alunos
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="data[Search][type]" <?php print !empty($checkedSearchType) && ($checkedSearchType == 'Profile') ? 'checked' : null  ?> id="type-<?php print $id_rand; ?>-2" class="search-type" value="Profile"> prospects
                            </label>
                            <label class="radio-inline hide">
                                <input type="radio" name="data[Search][type]" <?php print !empty($checkedSearchType) && ($checkedSearchType == 'Employee') ? 'checked' : null  ?> id="type-<?php print $id_rand; ?>-3" class="search-type" value="Employee"> colaboradores
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="panel-group" id="searchAccordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default student-filters employee-filters">
                    <div class="panel-heading" role="tab" id="searchHeadingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseOne" href="#searchCollapseOne" aria-expanded="true" aria-controls="searchCollapseOne">
                                Informações gerais
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="searchHeadingOne">
                        <div class="panel-body">
                            <div class="form-group">
                                <p><strong>Do sexo...</strong></p>
                                <div class="radio-inline">
                                    <label>
                                        <input name="data[Search][Profile][gender][]" value="M" type="checkbox" <?php print (!empty($genders) && in_array('M', $genders)) ? 'checked' : null  ?>> masculino
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input name="data[Search][Profile][gender][]" value="F" type="checkbox" <?php print (!empty($genders) && in_array('F', $genders)) ? 'checked' : null  ?>> feminino
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nascidos no período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Profile.start_birth_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Profile.end_birth_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php print $this->Form->input('Search.Profile.Address.district', array('type' => 'text', 'label' => 'Que moram no bairro...', 'class' => 'form-control')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default student-filters">
                    <div class="panel-heading" role="tab" id="searchHeadingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseTwo" href="#searchCollapseTwo" aria-expanded="false" aria-controls="searchCollapseTwo">
                                Informações do responsável
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="searchHeadingTwo">
                        <div class="panel-body">
                            <fieldset>
                                <legend class="sr-only">Dados do responsável</legend>
                                <div class="form-group">
                                    <?php print $this->Form->input('Search.Responsible.name', array('type' => 'text', 'label' => 'Que tenham um responsável chamado...', 'class' => 'form-control')); ?>
                                </div>
                                <div class="form-group">
                                    <p><strong>Que tenham um responsável desempenha o papel...</strong></p>
                                    <div class="checkbox-inline">
                                        <label>
                                            <input name="data[Search][Responsible][role][]" value="financial" type="checkbox" <?php print (!empty($roles) && in_array('financial', $roles)) ? 'checked' : null  ?>> financeiro
                                        </label>
                                    </div>
                                    <div class="checkbox-inline">
                                        <label>
                                            <input name="data[Search][Responsible][role][]" value="pedagogic" type="checkbox" <?php print (!empty($roles) && in_array('pedagogic', $roles)) ? 'checked' : null  ?>> pedagógico
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p><strong>Que tenham um responsável do sexo...</strong></p>
                                    <div class="radio-inline">
                                        <label>
                                            <input name="data[Search][Responsible][gender][]" value="M" type="checkbox" <?php print (!empty($responsibleGenders) && in_array('M', $responsibleGenders)) ? 'checked' : null  ?>> masculino
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input name="data[Search][Responsible][gender][]" value="F" type="checkbox" <?php print (!empty($responsibleGenders) && in_array('F', $responsibleGenders)) ? 'checked' : null  ?>> feminino
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default student-filters">
                    <div class="panel-heading" role="tab" id="searchHeadingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseThree" href="#searchCollapseThree" aria-expanded="false" aria-controls="searchCollapseThree">
                                Informações acadêmicas
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="searchHeadingThree">
                        <div class="panel-body">
                            <div class="form-group">
                                <?php print $this->Form->input('Search.Student.registration', array('type' => 'text', 'label' => 'Número de matrícula...', 'class' => 'form-control')); ?>
                            </div>
                            <div class="form-group">
                                <p><strong>Tipo de matrícula</strong></p>
                                <div class="checkbox-inline">
                                    <label>
                                        <input name="data[Search][ClassroomsStudent][type][]" value="new" type="checkbox" <?php print (!empty($registrationType) && in_array('new', $registrationType)) ? 'checked' : null  ?>> novo aluno
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input name="data[Search][ClassroomsStudent][type][]" value="renew" type="checkbox" <?php print (!empty($registrationType) && in_array('renew', $registrationType)) ? 'checked' : null  ?>> re-matriculado
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Matriculados no período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Student.start_registration_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Student.end_registration_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                            <?php if (!empty($searchCourses)): ?>
                                <div class="form-group">
                                    <label for="course-<?php print $id_rand; ?>">Matriculados no curso...</label>
                                    <select id="course-<?php print $id_rand; ?>" class="form-control select" name="data[Search][Course][id]" data-placeholder="Selecione">
                                        <option value="0">...não importa. Ignore esse critério</option>
                                        <?php foreach ($searchCourses as $searchCourseId => $searchCourse): ?>
                                            <option value="<?php print $searchCourseId ?>"<?php print(!empty($searchCourseIdSelected) && $searchCourseIdSelected == $searchCourseId) ? ' selected' : null ; ?>><?php print $searchCourse ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($searchClassrooms)): ?>
                                <div class="form-group">
                                    <label for="classroom-<?php print $id_rand; ?>">Matriculados na turma...</label>
                                    <select id="classroom-<?php print $id_rand; ?>" class="form-control select" name="data[Search][Classroom][id]" data-placeholder="Selecione">
                                        <option value="0">...não importa. Ignore esse critério</option>
                                        <?php foreach ($searchClassrooms as $periodsLabel => $searchPeriods): ?>
                                            <optgroup label="<?php print $periodsLabel; ?>">
                                                <?php foreach ($searchPeriods as $searchClassroomId => $searchClassroom): ?>
                                                    <option value="<?php print $searchClassroomId ?>"<?php print(!empty($searchClassroomIdSelected) && $searchClassroomIdSelected == $searchClassroomId) ? ' selected' : null ; ?>><?php print $searchClassroom ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <p><strong>Mostrar todos os...</strong></p>
                                <div class="checkbox-inline">
                                    <label>
                                        <input name="data[Search][ClassroomsStudent][status][]" value="1" type="checkbox" <?php print (!empty($studentStatuses) && in_array('1', $studentStatuses)) ? 'checked' : null  ?>> ativos
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input name="data[Search][ClassroomsStudent][status][]" value="2" type="checkbox" <?php print (!empty($studentStatuses) && in_array('2', $studentStatuses)) ? 'checked' : null  ?>> inativos / trancados
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input name="data[Search][ClassroomsStudent][status][]" value="5" type="checkbox" <?php print (!empty($studentStatuses) && in_array('5', $studentStatuses)) ? 'checked' : null  ?>> concluídos *
                                    </label>
                                </div>

                            </div>
                            <small>* Para pesquisar ex-alunos, marque esta opcão. Alunos que já estiveram em alguma turma, mas não foram re-matriculados, automaticamente tornam-se ex-alunos.</small>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default student-filters">
                    <div class="panel-heading" role="tab" id="searchHeadingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseFour" href="#searchCollapseFour" aria-expanded="false" aria-controls="searchCollapseFour">
                                Informações financeiras
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="searchHeadingFour">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Com títulos não pagos (inadimplentes) no período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Student.start_financial_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Student.end_financial_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default student-filters">
                    <div class="panel-heading" role="tab" id="searchHeadingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseFive" href="#searchCollapseFive" aria-expanded="false" aria-controls="searchCollapseFive">
                                Informações pedagógicas
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="searchHeadingFive">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Com interações realizadas (CRM/Relacionamento) no período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Student.start_interaction_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Student.end_interaction_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Com ocorrências registradas no período período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Student.start_occurrence_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Student.end_occurrence_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default prospect-filters hide">
                    <div class="panel-heading" role="tab" id="searchHeadingSix">
                        <h4 class="panel-title">
                            <a class="collapsed in" data-toggle="collapse" data-parent="#searchAccordion" data-target="#searchCollapseSix" href="#searchCollapseSix" aria-expanded="false" aria-controls="searchHeadingSix">
                                Informações gerais
                            </a>
                        </h4>
                    </div>
                    <div id="searchCollapseSix" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="searchHeadingSix">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Cadastrados no período período de...</label>
                                <div class="input-group">
                                    <?php print $this->BootstrapForm->input('Search.Profile.start_prospect_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data inicial')) ?>
                                    <span class="input-group-addon">à</span>
                                    <?php print $this->BootstrapForm->input('Search.Profile.end_prospect_date', array('type' => 'text', 'label' => false, 'class' => 'input-date-only form-control', 'placeholder' => 'data limite')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Refinar busca</button>
        </div>
        -->
    </div>
    <div class="input-group-btn append-actions">
        <button class="btn btn-append-layout" type="button">
            <span class="caret down"></span>
            <span class="sr-only">Filtros de busca</span>
        </button>
        <button class="btn btn-primary btn-search" type="submit">
            <span class="glyphicon glyphicon-search"></span>
            <span class="sr-only">Buscar</span>
        </button>
    </div>
</div>
<?php
print $this->Form->end();
