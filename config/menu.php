<?php

return [
    'main_menu' => [
        'one_time' => true,
        'inline' => false,
        'buttons' => [
            [
                [
                    'action' => [
                        'type' => 'open_link',
                        'link' => 'https://forms.gle/QwtaDYnpTFbdxs1V6',
                        'payload' => json_encode(['command' => 'application']),
                        'label' => 'Оставить заявку'
                    ]
                ],
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'about']),
                        'label' => 'О клубе'
                    ],
                    'color' => 'positive'
                ]
            ]
        ]
    ],
];
