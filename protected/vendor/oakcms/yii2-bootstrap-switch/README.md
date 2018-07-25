Bootstrap Switch Widget for Yii2
================================
Renders a Bootstrap Toggle Switch plugin widget.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist oakcms/yii2-bootstrap-switch "*"
```

or add

```
"oakcms/yii2-bootstrap-switch": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, 'field')->widget(\oakcms\bootstrapswitch\Switcher::className()) ?>
```

Or

```php
<?= \oakcms\bootstrapswitch\Switcher::widget([
    'name' => 'Name',
    'checked' => true,
    'clientOptions' => [
        'size' => 'large',
        'onColor' => 'success',
        'offColor' => 'danger'
    ]
]); ?>
```
