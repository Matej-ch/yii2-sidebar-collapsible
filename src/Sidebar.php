<?php

namespace matejch\yii2sidebar;

use yii\base\Widget;
use yii\helpers\Html;

class Sidebar extends Widget
{
    /**
     * Text in collapse button
     *
     * @var string
     */
    public $collapseText = 'Collapse';

    /**
     * Top position from where sidebar starts
     * @var string
     */
    public $top = '0px';

    /**
     * Left position from where sidebar starts
     * @var string
     */
    public $left = '0px';

    public $widthOpen = '256px';

    public $widthCollapsed = '70px';

    /**
     * This name is used in localstorage to remember state of sidebar
     * @var string
     */
    public $sidebarCacheName = 'sidebar-collapse';

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

        return Html::tag('div', $html, ['class' => 'sidebar open','style' => "top:$this->top;left:$this->left", 'data' => ['sidebar' => $this->sidebarCacheName]]);
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        $view->registerCss(".sidebar.open{width:$this->widthOpen;} .sidebar.collapsed{width:$this->widthCollapsed;} [data-sidebar-collapsible]{padding-left:$this->widthOpen;}");
        SidebarAsset::register($view);
    }

    public function renderBottom(): string
    {
        return '<div class="collapse-bottom-container"><div class="collapse-btn-container">
            <a class="js-collapse-sidebar" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="js-collapse-icon" style="pointer-events: none;transform-origin: 50% 50%;transform: rotate(-90deg);" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#5b7fa4" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
  <circle cx="12" cy="12" r="9"></circle>
  <line x1="12" y1="8" x2="8" y2="12"></line>
  <line x1="12" y1="8" x2="12" y2="16"></line>
  <line x1="16" y1="12" x2="12" y2="8"></line>
</svg>
    <span data-sidebar-hide="1">'.$this->collapseText.'</span></a></div></div>';
    }
}