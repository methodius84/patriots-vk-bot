<?php

return [
    'main_menu' => [
        'one_time' => false,
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
                        'payload' => json_encode(['command' => 'info']),
                        'label' => 'Информация о клубе'
                    ],
                    'color' => 'primary'
                ]
            ],
            [
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'partnership']),
                        'label' => 'Партнерство'
                    ],
                    'color' => 'primary',
                ]
            ]
        ]
    ],
    'info' => [
        'one_time' => false,
        'inline' => false,
        'buttons' => [
            [
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'club_info']),
                        'label' => 'О клубе'
                    ],
                    'color' => 'secondary',
                ],
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'contacts']),
                        'label' => 'Контакты',
                    ],
                    'color' => 'primary'
                ]
            ],
            [
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'current_tournaments']),
                        'label' => 'Турниры'
                    ],
                    'color' => 'secondary',
                ],
            ],
            [
                [
                    'action' => [
                        'type' => 'callback',
                        'label' => 'Назад',
                        'payload' => json_encode(['command' => 'backwards', 'menu_state' => 'info'])
                    ],
                    'color' => 'secondary',
                ]
            ],
        ]
    ],
    'partnership' => [
        'one_time' => true,
        'inline' => false,
        'buttons' => [
            [
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'sponsorship', 'menu_state' => 'info']),
                        'label' => 'Спонсорство',
                    ],
                    'color' => 'primary',
                ],
                [
                    'action' => [
                        'type' => 'text',
                        'payload' => json_encode(['command' => 'barter', 'menu_state' => 'info']),
                        'label' => 'Бартер',
                    ],
                    'color' => 'primary',
                ],
            ],
            [
                [
                    'action' => [
                        'type' => 'callback',
                        'label' => 'Назад',
                        'payload' => json_encode(['command' => 'backwards', 'menu_state' => 'info'])
                    ],
                    'color' => 'secondary',
                ]
            ],
        ],
    ],
];
