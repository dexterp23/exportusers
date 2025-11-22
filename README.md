# Export Users
This library export users to CSV file and send it to email.
It is made for typical Mezzio project structure and any deviation from the usual
project structure can lead to problems in the work of this library.

## composer.json

In composer.json file, add section below:
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/dexterp23/exportusers"
        }
    ],
    "require": {
        "dexterp23/exportusers": "dev-main"
    }
```

## Configuration

```
    'smtpSettings' => [
        'server' => [
            'host' => '',
            'port' => '',
        ],
        'auth' => [
            'username' => '',
            'password' => ''
        ]
    ],
    'mail' => [
        'from' => '',
        'to' => '',
    ],
```
## Basic Usage
```
use Dexlib\ExportUsers\Service\Export\ExportUsersService;

$container = require_once __DIR__ . '/../config/container.php';
$exportUsersService = $container->get(ExportUsersService::class);

$data[] = [
    'username' => '',
    'first_name' => '',
    'last_name' => '',
    ...
];
$exportUsersService->setData($data)->start();
```



