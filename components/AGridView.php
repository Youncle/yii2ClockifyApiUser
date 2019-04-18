<?php

namespace app\components;

use Closure;
use Yii;
use yii\grid\Column;
use yii\grid\GridView;
use yii\helpers\Html;

class AGridView extends GridView
{

    public $theadOptions = [];

    public function renderTableHeader()
    {
        $cells = [];
        foreach ($this->columns as $column) {
            /* @var $column Column */
            $cells[] = $column->renderHeaderCell();
        }
        $content = Html::tag('tr', implode('', $cells), $this->headerRowOptions);
        if ($this->filterPosition === self::FILTER_POS_HEADER) {
            $content = $this->renderFilters() . $content;
        } elseif ($this->filterPosition === self::FILTER_POS_BODY) {
            $content .= $this->renderFilters();
        }

        return Html::tag('thead', $content, $this->theadOptions);
    }


}