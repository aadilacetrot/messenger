# Messenger
MSG91 API wrapper

## Installation

Add following lines of code in composer.json
<br>
<pre>
<code>
// composer.json

"repositories" : [
        {
            "type": "package",
            "package": {
                "name": "aadil96/messenger",
                "version": "dev-main",
                "source": {
                    "url": "https://github.com/aadil96/messenger.git",
                    "type": "git",
                    "reference": "main"
                },
                "autoload": {
                    "classmap": [""]
                }
            }
        }
    ],
</code>
</pre>

Require package
<br>
<pre>
<code>
// composer.json

"require": {
      ...
        "aadil96/messenger": "dev-main"
    },
</code>
</pre>

Run composer update
<br>
<pre>
<code>$ composer update</code>
</pre>

Register the service provider and set alias
<br>
<pre>
<code>
// config/app.php

'providers' => [
    ...
    Messenger\Providers\WrapperServiceProvider::class,
];

'aliases' => [
    ...
    'Messenger' => Messenger\Wrapper::class,
];
</code>
</pre>

Publish config and template files
<br>
<pre>
<code>$ php artisan vendor:publish --tag=messenger-all</code>
</pre>

Set auth key and sender id
<br>
<pre>
<code>
// .env

MSG91_API_KEY=
MSG91_SENDER_ID=
</code>
</pre>

Use SubscriptionNotifiable trait
<br>
<pre>
<code>
// App\Models\User

namespace App\Models;

use Messenger\Traits\SubscriptionNotifiable;

class User extends Authenticatable
{
    use SubscriptionNotifiable;
}
</code>
</pre>

That's it for installation!

## Usage
coming soon...
