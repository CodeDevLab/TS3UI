<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace Server;

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\EventManager\EventInterface;
use Server\Listener\FormListener;

class Module implements
BootstrapListenerInterface,
AutoloaderProviderInterface,
ConfigProviderInterface,
DependencyIndicatorInterface
{
    
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__.'/config/module.config.php';
    }

    public function onBootstrap(EventInterface $e) {
        $manager  = $e->getApplication()->getServiceManager();
        $eventManager = $e->getTarget()->getEventManager();
        $oListener  = new FormListener();
        $oListener->setServiceLocator($manager);
        $eventManager->attach($oListener);
    }

    public function getModuleDependencies() {
        return array(
            'TSCore'
        );
    }

}
