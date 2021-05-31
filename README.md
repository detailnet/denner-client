# denner-client

[![Actions Status](https://github.com/detailnet/denner-client/workflows/Tests/badge.svg)](https://github.com/detailnet/denner-client/actions)

API Client for Denner Portal 2.0 Web Services

## Installation
Install the library through [Composer](http://getcomposer.org/) using the following steps:

  1. `cd my/project/directory`
  
  2. Create a `composer.json` file with following contents (or update your existing file accordingly):

     ```json
     {
         "require": {
             "detailnet/denner-client": "^4.1"
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
$config = [
    'app_id' => 'your-app-id',
    'app_key' => 'your-app-key',
];

// Create the client (e.g. the client for Denner Articles Service)
$client = ArticlesClient::factory($config);

// Send a request
$params = ['week' => '50'];
$response = $client->listAdvertisedArticles($params);
```

More examples can be found in the [examples](examples) directory.
