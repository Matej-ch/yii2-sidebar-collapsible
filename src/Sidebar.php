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
            <a class="js-collapse-sidebar text-slate-400 hover:text-slate-50 focus:text-slate-50"
               style="display: flex;align-items: baseline;gap: 0.5rem;position: relative;cursor: pointer;font-size: 1rem;height: 22px;flex-shrink: 0;transition: color 0.15s linear 0s;text-decoration: none" href="#">
                <i class="fas fa-chevron-circle-left text-xl js-collapse-icon"></i> <span
                    data-sidebar-hide="1">Collapse</span></a></div></div>';
    }
}