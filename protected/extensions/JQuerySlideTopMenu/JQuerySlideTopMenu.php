<?php
/**
 * Description of JQuerySlideTopMenu
 *
 * @author oleksiy
 */
class JQuerySlideTopMenu extends CWidget {

    private $cssFile = 'jqueryslidemenu.css';
    private $jsFile = 'jqueryslidemenu.js';
    private $downImg = 'down.gif';
    private $rightImg = 'right.gif';
    
    private $cssIE7hack = '<!--[if lte IE 7]>
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
<![endif]-->
';

    public $items = array();
    public $id = '';

    public function init()
    {
        if(empty($this->id)){
            $this->id = 'ltjqsm'.rand(1, 1000);
        }
        $this->cssFile=Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.$this->cssFile);
        $this->jsFile=Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.$this->jsFile);
        $this->downImg=Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.$this->downImg);
        $this->rightImg=Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.$this->rightImg);
        $this->registerClientScript();
        parent::init();
    }

    protected function registerClientScript()
    {
        $cs=Yii::app()->clientScript;
        
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile($this->cssFile);
        // not sure if it is needed
        //$cs->registerCss('jqueryslidemenu.ie7fix', $this->cssIE7hack);
        $cs->registerScriptFile($this->jsFile);
        // images used in menu folder (down and right arrows)
        $cs->registerScript('jqueryslidemenu.images',
            'var arrowimages={down:[\'downarrowclass\', \''.$this->downImg.'\', 23], right:[\'rightarrowclass\', \''.$this->rightImg.'\']}',
            CClientScript::POS_HEAD);
    }

    private function setupItems($items)
    {
        $ritems = array();

        $controller=$this->controller;
        $action = $controller->action;
        
        foreach($items as $item)
		{
			if(isset($item['visible']) && !$item['visible'])
				continue;
			$item2=array();
			$item2['label']=$item['label'];
			if(is_array($item['url']))
				$item2['url']=$controller->createUrl($item['url'][0]);
			else
				$item2['url']=$item['url'];
			$pattern=isset($item['pattern'])?$item['pattern']:$item['url'];
			$item2['active']=$this->isActive($pattern,$controller->id,$action->id);
            if(is_array($item['subs'])){
                $item2['subs'] = $this->setupItems($item['subs']);
            }
			$ritems[]=$item2;
		}

        return $ritems;
    }

    public function run()
    {
        $items = $this->setupItems($this->items);
        Yii::app()->clientScript->registerScript('jqueryslidemenu.'.$this->id, 'jqueryslidemenu.buildmenu(\''.$this->id.'\', arrowimages)', 
                CClientScript::POS_HEAD);

		$this->render('view',array('id' => $this->id, 'items'=>$items));
    }

    protected function isActive($pattern,$controllerID,$actionID)
	{
		if(!is_array($pattern) || !isset($pattern[0]))
			return false;

		if(strpos($pattern[0],'/')!==false)
			$matched=$pattern[0]===$controllerID.'/'.$actionID;
		else
			$matched=$pattern[0]===$controllerID;

		if($matched && count($pattern)>1)
		{
			foreach(array_splice($pattern,1) as $name=>$value)
			{
				if(!isset($_GET[$name]) || $_GET[$name]!=$value)
					return false;
			}
			return true;
		}
		else
			return $matched;
	}

}
?>
