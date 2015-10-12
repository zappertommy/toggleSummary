<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class TogglePanel {
    
    protected $element_id;
    protected $header = '';
    protected $side_desc = '';
    protected $side;
    protected $expand_state;
    
    public function __construct($element_id, $side, $expand_state = true) {
        $this->setElementId($element_id);
        $this->setSide($side);
        $this->setExpandState($expand_state);
    }
    
    /**
     * render
     * 
     * @param html $content
     * @return html
     */
    public function render($content) {
        $this->includeStylesheet();
        $this->includeJavascript();
        ob_start();
        ?>
            <div id="<?php echo $this->getElementId(); ?>" class="toggle-panel <?php echo $this->isExpandState() ? '' : 'hide'; ?>"
                data-expand="<?php echo $this->isExpandState() ? 'true' : 'false'; ?>"
                data-side="<?php echo $this->getSide(); ?>">
                <div class="toggle-panel-action">
                    <span class="glyphicon glyphicon-chevron-<?php echo $this->getSide(); ?>"></span>
                </div>
                <div data-section="main-content" class="<?php echo $this->isExpandState() ? '' : 'hide'; ?>">
                    <div class="details-header bg-heading">
                        <span><strong><?php echo $this->getHeader(); ?></strong></span>
                    </div>
                    <div class="toggle-panel-content">
                        <?php echo $content; ?>
                    </div>
                </div>
                <div class="side-desc bg-heading <?php echo $this->isExpandState() ? 'hide' : ''; ?>" data-section="summary">
                    <div class="inner-box">
                        <span class="desc"><strong><?php echo $this->getSideDesc(); ?></strong></span>
                    </div>
                </div>
            </div>
        <?php
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
     * setHeader
     * 
     * @param string $val
     */
    public function setHeader($val) {
        $this->header = $val;
    }
    
    /**
     * getHeader
     * 
     * @return string
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * setSideDesc
     * 
     * @param string $val
     */
    public function setSideDesc($val) {
        $this->side_desc = $val;
    }
    
    /**
     * getSideDesc
     * 
     * @return string
     */
    public function getSideDesc() {
        return $this->side_desc;
    }

    /**
     * includeJavascript
     */
    protected function includeJavascript() {
        requireJavaScriptOnce(HELPERS_PATH_CLIENT.'TogglePanel/TogglePanel.js');
    }
    
    /**
     * includeStylesheet
     */
    protected function includeStylesheet() {
        requireCSSOnce(HELPERS_PATH_CLIENT.'TogglePanel/TogglePanel.css');
    }

    /**
     * setElementId
     * 
     * @param integer $val
     */
    protected function setElementId($val) {
        $this->element_id = $val;
    }
    
    /**
     * getElementId
     * 
     * @return integer
     */
    protected function getElementId() {
        return $this->element_id;
    }
    
    /**
     * setSide
     * 
     * @param string $val
     */
    protected function setSide($val) {
        $this->side = $val;
    }
    
    /**
     * getSide
     * 
     * @return string
     */
    protected function getSide() {
        return $this->side;
    }
    
    /**
     * setExpandState
     * 
     * @param boolean $val
     */
    protected function setExpandState($val) {
        $this->expand_state = ($val === true) ? true : false;
    }
    
    /**
     * isExpandState
     * 
     * @return boolean
     */
    protected function isExpandState() {
        return $this->expand_state;
    }
}