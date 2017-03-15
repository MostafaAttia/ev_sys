<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => public_path().'/user_content',
        ],

        's3' => [
            'driver' => 's3',
            'key'    => 'AKIAISSBYORQEZ7VMJEA',
            'secret' => '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',
            'region' => 'us-east-1',
            'bucket' => 'cdn.vt17.dev',
        ],

        'rackspace' => [
            'driver'    => 'rackspace',
            'username'  => 'NitKLnpK3VOnyEQytNwdLQa6h/G4axnyma9p4aY+',
            'key'       => 'your-key',
            'container' => 'your-container',
            'endpoint'  => 'https://identity.api.rackspacecloud.com/v2.0/',
            'region'    => 'IAD',
        ],

    ],

];
