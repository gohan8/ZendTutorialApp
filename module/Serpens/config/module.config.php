<?php
namespace Serpens;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\SerpensController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'serpens' => __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'serpens' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/serpens[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'action' => 'index',
                        'controller' => Controller\SerpensController::class
                    ]
                ]
            ]
        ]
    ]
];

?>
