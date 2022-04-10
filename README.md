Collapsible sidebar widget
====================
Sidebar widget you can add to your page with your own custom content

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist matejch/yii2-sidebar-collapsible "^1.0"
```

or add

```
"matejch/yii2-sidebar-collapsible": "^1.0"
```

to the require section of your `composer.json` file.

Setup
-----

#### Elements with **[data-sidebar-hide]** will be hidden when sidebar is collapsed

Example
```html
<a><i class="fa fa-eye"></i> <span data-sidebar-hide='1'>This text is shown only when sidebar is not collapsed</span></a>
``` 

#### Elements with **[data-sidebar-collapsible]** will update their left padding when is sidebar size has changed
Example
```html
<div style="padding-left: 256px;" data-sidebar-collapsible="1"></div>
```

### Sidebar example with custom content
```php 
<?php Sidebar::begin([

'collapseText' => 'Collapse' // optional text in button, defaults to Collapse
'top' => '75px' // Fixed top, where sidebar begins, defaults to 0px
'left' => '0px' // Fixed left, where sidebar begins on letf side, defaults to 0px
//'sidebarCacheName' => 'test' // Name for saving state in localstorage
]) ?>

<div>
<?= Html::a('<i class="fas fa-trash"></i> <span data-sidebar-hide="1">text will hide on collapse</span>', #', ['class' => "btn btn-danger"]) ?>
</div>

<div>
<?= Html::a('<i class="fas fa-edit"></i> <span data-sidebar-hide="1">text will hide on collapse</span>', #', ['class' => "btn btn-primary"]) ?>
</div>

<div>
<?= Html::a('<i class="fas fa-eye"></i> <span data-sidebar-hide="1">text will hide on collapse</span>', #', ['class' => "btn btn-success"]) ?>
</div>

<div>
<?= Html::a('<i class="fas fa-check"></i> <span data-sidebar-hide="1">text will hide on collapse</span>', #', ['class' => "btn btn-warning"]) ?>
</div>

<?php Sidebar::end() ?>

```