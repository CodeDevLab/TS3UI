<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Server\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class VirtualServerControllerFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $oSM = $serviceLocator->getServiceLocator();
        $oVirtualServerService = $oSM->get("Server\Service\VirtualServer");
        $oController = new VirtualServerController();
        $oController->setVirtualServerService($oVirtualServerService);
        return $oController;
    }

}
