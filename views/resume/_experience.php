        <div class="mesto w100">
            <div class="row mb24">
                <div class="col-lg-2 col-md-3">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="devide-border"></div>
                </div>
            </div>
            <div class="row mb24">
                <div class="col-lg-2 col-md-3 dflex-acenter">
                    <div class="paragraph">Начало работы</div>
                </div>
                <div class="col-lg-3 col-md-4 col-11">
                    <div class="d-flex justify-content-between">
                        <div class="citizenship-select w100 mr16">
                            <?= $form->field($rabota, 'month1')->dropDownList(
                                [
                                    '1' => "Январь",
                                    '2' => "Февраль",
                                    '3' => "Март",
                                    '4' => "Апрель",
                                    '5' => "Май",
                                    '6' => "Июнь",
                                    '7' => "Июль",
                                    '8' => "Август",
                                    '9' => "Сентябрь",
                                    '10' => "Октябрь",
                                    '11' => "Ноябрь",
                                    '12' => "Декабрь"
                                ],

                                ['id' => 'experience-month1' . $index, 'prompt' => 'месяц..', 'class' => 'nselectlist-static', 'name' => 'Resume[experience][' . $index . '][month1]']
                            )
                                ->label(false); ?>


                        </div>
                        <div class="citizenship-select w100">
                            <?= $form->field($rabota, 'year1')->textInput([
                                'class' => 'dor-input w100',
                                'placeholder' => "2000",
                                'name' => 'Resume[experience][' . $index . '][year1]',
                                'id' => 'experience-year1' . $index,
                            ])->label(false) ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb8 date2-<?= $index ?>" index="<?= $index ?>">
                <div class="col-lg-2 col-md-3 dflex-acenter">
                    <div class="paragraph">Окончание работы</div>
                </div>
                <div class="col-lg-3 col-md-4 col-11">
                    <div class="d-flex justify-content-between">
                        <div class="citizenship-select w100 mr16">
                            <?= $form->field($rabota, 'month2')->dropDownList(
                                [
                                    '1' => "Январь",
                                    '2' => "Февраль",
                                    '3' => "Март",
                                    '4' => "Апрель",
                                    '5' => "Май",
                                    '6' => "Июнь",
                                    '7' => "Июль",
                                    '8' => "Август",
                                    '9' => "Сентябрь",
                                    '10' => "Октябрь",
                                    '11' => "Ноябрь",
                                    '12' => "Декабрь"
                                ],

                                ['id' => 'experience-month2' . $index, 'prompt' => 'месяц..', 'class' => 'nselectlist-static', 'name' => 'Resume[experience][' . $index . '][month2]']
                            )
                                ->label(false); ?>


                        </div>
                        <div class="citizenship-select w100">
                            <?= $form->field($rabota, 'year2')->textInput([
                                'class' => 'dor-input w100',
                                'placeholder' => "2000",
                                'name' => 'Resume[experience][' . $index . '][year2]',
                                'id' => 'experience-year2' . $index,
                            ])->label(false) ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb24">
                <div class="col-lg-2 col-md-3">
                </div>
                <div class="col-lg-3 col-md-4 col-11">
                    <div class="profile-info">
                        <div class="form-check d-flex">
                            <input name="Resume[experience][<?= $index ?>][present_check]" type="checkbox" index="<?= $index ?>" class="form-check-input" id="Date2-check-<?= $index ?>">
                            <label class="form-check-label" for="Date2-check-<?= $index ?>"></label>
                            <label for="Date2-check-<?= $index ?>" class="profile-info__check-text job-resolution-checkbox">По
                                настоящее
                                время</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb16">
                <div class="col-lg-2 col-md-3 dflex-acenter">
                    <div class="paragraph">Организация</div>
                </div>
                <div class="col-lg-3 col-md-4 col-11">
                    <?= $form->field($rabota, 'organization')->textInput([
                        'class' => 'dor-input w100',
                        'id' => 'experience-org' . $index,
                        'placeholder' => "Организация",
                        'name' => 'Resume[experience][' . $index . '][organization]'
                    ])->label(false) ?>
                </div>
            </div>
            <div class="row mb16">
                <div class="col-lg-2 col-md-3 dflex-acenter">
                    <div class="paragraph">Должность</div>
                </div>
                <div class="col-lg-3 col-md-4 col-11">
                    <?= $form->field($rabota, 'position')->textInput([
                        'class' => 'dor-input w100',
                        'id' => 'experience-pos' . $index,
                        'placeholder' => "Должность",
                        'name' => 'Resume[experience][' . $index . '][position]'
                    ])->label(false) ?>
                </div>
            </div>
            <div class="row mb64 mobile-mb32">
                <div class="col-lg-2 col-md-3">
                    <div class="paragraph">Обязанности, функции, достижения</div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <textarea name="Resume[experience][<?= $index ?>][duties]" class="dor-input w100 h96 mb8" placeholder="Расскажите о своих обязанностях, функциях и достижениях"><?= $rabota->duties ?></textarea>
                    <div class="mb24"><button type="button" class="delbutton btn btn-link">Удалить место работы</button>
                    </div>

                </div>
            </div>
        </div>