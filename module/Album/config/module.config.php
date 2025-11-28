<?php
namespace Album;

use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Album\Model\AlbumTableFactory;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Album\Controller\AlbumController;

return [
    "controllers" => [
        "factories" => [
            Controller\AlbumController::class => ReflectionBasedAbstractFactory::class
        ],
    ],

    'router' => [
        'routes' => [

            'home' => [
                'type' => \Laminas\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'album' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    "view_manager" => [
        "template_path_stack" => [
            "album" => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            Model\AlbumTable::class => AlbumTableFactory::class,
        ],

    ],
];
