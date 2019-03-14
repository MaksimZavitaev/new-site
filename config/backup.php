<?php

return [
    /*
     * Источники, которые будут помещены в архив
     */
    'source' => [
        'databases' => [
            'mysql',
        ],
    ],
    /*
     * Места назначения, в которые будет помещен архив
     */
    'destination' => [
        'disks' => [
            'local',
        ],
    ],
    /*
     * Путь к временной папке
     */
    'temporaryDirectory' => storage_path('app/temp/'),
];
