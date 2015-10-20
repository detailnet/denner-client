# lw-inside-client

[![Build Status](https://travis-ci.org/detailnet/lw-inside-client.svg?branch=master)](https://travis-ci.org/detailnet/lw-inside-client)
[![Coverage Status](https://img.shields.io/coveralls/detailnet/lw-inside-client.svg)](https://coveralls.io/r/detailnet/lw-inside-client)
[![Latest Stable Version](https://poser.pugx.org/detailnet/lw-inside-client/v/stable.svg)](https://packagist.org/packages/detailnet/lw-inside-client)
[![Latest Unstable Version](https://poser.pugx.org/detailnet/lw-inside-client/v/unstable.svg)](https://packagist.org/packages/detailnet/lw-inside-client)

API Client for Louis Widmer Inside. https://lw-inside.detailnet.ch/

## Installation
Install the library through [Composer](http://getcomposer.org/) using the following steps:

  1. `cd my/project/directory`
  
  2. Create a `composer.json` file with following contents (or update your existing file accordingly):

     ```json
     {
         "require": {
             "detailnet/lw-inside-client": "1.x-dev"
         }
     }
     ```
  3. Install Composer via `curl -s http://getcomposer.org/installer | php` (on Windows, download
     the [installer](http://getcomposer.org/installer) and execute it with PHP)
     
  4. Run `php composer.phar self-update`
     
  5. Run `php composer.phar install`

## Usage

See the following example for how to use the library:

```php
// App-ID and App-Key are required to authenticate the client
$config = array(
    'app_id' => 'your-app-id',
    'app_key' => 'your-app-key',
);

// Create the client
$client = InsideClient::factory($config);

// Send a request
$params = array('query' => 'auge');
$response = $client->listAssets($params);
```

More examples can be found in the [examples](examples) directory.
