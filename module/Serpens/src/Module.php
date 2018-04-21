<?php

namespace Serpens;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\PostTable::class => function($serviceManager) {
                    $tableGateway = $serviceManager->get(Model\PostTableGateway::class);
                    return new Model\PostTable($tableGateway);
                },
                Model\PostTableGateway::class => function($serviceManager) {
                    $dbAdapter = $serviceManager->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Post());
                    return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);
                }
            ]
        ];
    }
    
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\SepensController::Class => function ($serviceManager)
                {
                    return new SerpensController(
                    $serviceManager->get(Model\PostTable::class));
                }
            ]
        ];
    }
}

?>