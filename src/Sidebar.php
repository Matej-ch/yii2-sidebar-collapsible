<?php

namespace matejch\yii2sidebar;

use yii\base\Widget;
use yii\helpers\Html;

class Sidebar extends Widget
{
    public function init()
    {
        parent::init();

        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        parent::run();

        $this->registerClientScript();

        $content = ob_get_clean();

        $html = '<div class="collapse-top-container"><div class="collapse-top-inner">';

        $html .= $content;

        $html .= '</div></div>';

        $html .= $this->renderBottom();

        return Html::tag('div', $html, ['class' => 'sidebar open', 'data' => ['sidebar' => 'complaint-sidebar']]);
    }

    public function registerClientScript()
    {
        $view = $this->getView();

        SidebarAsset::register($view);
    }

    public function renderBottom(): string
    {
        return '<div class="collapse-bottom-container"><div class="collapse-btn-container">
            <a class="js-collapse-sidebar" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="js-collapse-icon" style="transform: rotate(90deg)" width="28" height="28" viewBox="0 0 28 28" stroke-width="1.5" stroke="#5b7fa4" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" />
  <line x1="8" y1="12" x2="12" y2="16" /><line x1="12" y1="8" x2="12" y2="16" /><line x1="16" y1="12" x2="12" y2="16" /></svg>
    <span data-sidebar-hide="1">Collapse</span></a></div></div>';
    }
}