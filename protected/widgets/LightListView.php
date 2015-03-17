<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.03.2015
 * Time: 18:46
 */
Yii::import('zii.widgets.CListView');
class LightListView extends CListView {

    public function run() {
        $this->registerClientScript();

        //echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";

        $this->renderContent();
        $this->renderKeys();

        //echo CHtml::closeTag($this->tagName);
    }

    public function renderItems() {
        $data=$this->dataProvider->getData();
        if(($n=count($data))>0)        {
            $owner=$this->getOwner();
            $viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach($data as $i=>$item) {
                $data=$this->viewData;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;
                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1)
                    echo $this->separator;
            }
        } else {
            $this->renderEmptyText();
        }
    }

}