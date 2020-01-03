<?php

    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */

    /* @var $model \frontend\models\SearchForm */

    use kartik\select2\Select2;
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = Yii::t('app', 'Search');
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-search">
  <section class="hero" style="background-image: url(<?= Yii::$app->urlManager->baseUrl.'/build/images/hero-bg.jpg'; ?>)">
    <div class="form-wrapper">
      <p class="form-title">
          <?= Yii::t('app', 'If it’s organic, custom, or unique, it’s on Global Farm.') ?>
      </p>

      <div class="container">
        <div class="form-group form-group--horizontal">
            <?php $form = ActiveForm::begin([
                'action' => '/',
                'options' => ['id' => 'search-form', 'class' => 'search-form'],
                'fieldConfig' => [
                    'options' => [
                        'class' => 'form-item',
                    ],
                ],
            ]); ?>

            <?= $form->field($model, 'category', [

            ])
                ->dropDownList([
                    0 => Yii::t('app', '0'),
                    1 => Yii::t('app', '1'),
                    2 => Yii::t('app', '2'),
                    3 => Yii::t('app', '3')
                ],
                    ['prompt' => Yii::t('app', 'Categories')])
                ->label(false); ?>

            <?= $form->field($model, 'search')
                ->textInput([
                    'placeholder' => Yii::t('app', 'I’m looking for…')
                ])
                ->label(false); ?>

            <?= $form->field($model, 'location')
                ->widget(Select2::classname(), [
                    'data' => [Yii::t('app', 'asd'), Yii::t('app', 'dsa'), Yii::t('app', 'sad')],
                    'language' => 'en',
                    'options' => ['placeholder' => Yii::t('app', 'Location…')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
                ->label(false); ?>

            <?= Html::submitButton(Yii::t('app', 'Search'), [
                'class' => 'btn btn-success',
                'name' => 'search-button'
            ]); ?>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </section>
</div>
