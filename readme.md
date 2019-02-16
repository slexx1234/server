# Get server info, CPU usage, RAM usage, OS info etc.

## Installation

```
composer require slexx/server
```

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Slexx\Server;

var_dump(Server::CPUUsage());
```

## Methods

### \Slexx\Server::CPUUsage

```php
var_dump(\Slexx\Server::CPUUsage());
// [
//     'cpu' => 13202110,
//     'cpu0' => 3299864,
//     'cpu1' => 3306752,
//     'cpu2' => 3290429,
//     'cpu3' => 3305059
// ]
```

### \Slexx\Server::MemoryInfo

```php
var_dump(\Slexx\Server::MemoryInfo());
// [
//     'ram' => [
//         'all' => 5667616,
//         'used' => 4225624,
//         'free' => 268476
//     ],
//     'swap' => [
//         'all' => 2097148,
//         'used' => 897792,
//         'free' => 1199356
//     ]
// ]
```

### \Slexx\Server::PHPVersion

```php
var_dump(\Slexx\Server::PHPVersion());
// 7.2.14-1+ubuntu18.04.1+deb.sury.org+1
```

### \Slexx\Server::OSInfo

```php
var_dump(\Slexx\Server::OSInfo());
// [
//     'name' => 'Linux Mint',
//     'version' => '19.1 (Tessa)',
//     'id' => 'linuxmint',
//     'id_like' => 'ubuntu',
//     'pretty_name' => 'Linux Mint 19.1',
//     'version_id' => '19.1',
//     'home_url' => 'https://www.linuxmint.com/',
//     'support_url' => 'https://forums.ubuntu.com/',
//     'bug_report_url' => 'http://linuxmint-troubleshooting-guide.readthedocs.io/en/latest/',
//     'privacy_policy_url' => 'https://www.linuxmint.com/',
//     'version_codename' => 'tessa',
//     'ubuntu_codename' => 'bionic'
// ]
```

### \Slexx\Server::ProcessorModel

```php
var_dump(\Slexx\Server::ProcessorModel());
// 'AMD A10-9620P RADEON R5, 10 COMPUTE CORES 4C+6G'
```

