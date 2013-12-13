<?php

class BootstrapClientScript extends CClientScript
{
    /**
     * @param string $name
     * @return CClientScript
     */
    public function registerCoreScript($name)
    {
        $this->beforeRegisterCoreScript($name);
        $result = parent::registerCoreScript($name);
        $this->afterRegisterCoreScript($name);
        return $result;
    }

    /**
     * @param string $url
     * @param null $position
     * @param array $htmlOptions
     * @return CClientScript
     */
    public function registerScriptFile($url, $position=null, array $htmlOptions=array())
    {
        $this->beforeRegisterScriptFile($url, $position);
        $result = parent::registerScriptFile($url, $position, $htmlOptions);
        $this->afterRegisterScriptFile($url, $position);
        return $result;
    }

    /**
     * @param string $name
     */
    protected function beforeRegisterCoreScript($name)
    {
        if ($this->hasEventHandler('onBeforeRegisterCoreScript')) {
            $this->onBeforeRegisterCoreScript(
                new CEvent($this, array(
                    'type' => 'core',
                    'name' => $name,
                ))
            );
        }
    }

    /**
     * @param string $name
     */
    protected function afterRegisterCoreScript($name)
    {
        if ($this->hasEventHandler('onAfterRegisterCoreScript')) {
            $this->onAfterRegisterCoreScript(
                new CEvent($this, array(
                    'type' => 'core',
                    'name' => $name,
                ))
            );
        }
    }

    /**
     * @param string $name
     * @param string $position
     */
    protected function beforeRegisterScriptFile($name, $position)
    {
        if ($this->hasEventHandler('onBeforeRegisterScriptFile')) {
            $this->onBeforeRegisterScriptFile(
                new CEvent($this, array(
                    'type' => 'file',
                    'name' => $name,
                    'position' => $position,
                ))
            );
        }
    }

    /**
     * @param string $name
     * @param string $position
     */
    protected function afterRegisterScriptFile($name, $position)
    {
        if ($this->hasEventHandler('onAfterRegisterScriptFile')) {
            $this->onAfterRegisterScriptFile(
                new CEvent($this, array(
                    'type' => 'file',
                    'name' => $name,
                    'position' => $position,
                ))
            );
        }
    }

    /**
     * @param CEvent $event
     */
    public function onBeforeRegisterCoreScript($event)
    {
        $this->raiseEvent('onBeforeRegisterCoreScript', $event);
    }

    /**
     * @param CEvent $event
     */
    public function onAfterRegisterCoreScript($event)
    {
        $this->raiseEvent('onAfterRegisterCoreScript', $event);
    }

    /**
     * @param CEvent $event
     */
    public function onBeforeRegisterScriptFile($event)
    {
        $this->raiseEvent('onBeforeRegisterScriptFile', $event);
    }

    /**
     * @param CEvent $event
     */
    public function onAfterRegisterScriptFile($event)
    {
        $this->raiseEvent('onAfterRegisterScriptFile', $event);
    }
} 