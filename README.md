# LKT HTTP Response

## Installation

```shell
composer require lkt/http-response
```

## Usage

Instantiate a new response instance with the generic constructor:

```php
use Lkt\Http\Response;

Response::status(200, ['some' => 'data']);
```

Or you can instantiate it with all the more specific constructors:

```php
use Lkt\Http\Response;

Response::ok(['some' => 'data']); // Same as: Response::status(200, ['some' => 'data']);
```

## Constructor list

| Method                | Status code |
|-----------------------|-------------|
| ::ok                  | 200         |
| ::created             | 201         |
| ::accepted            | 202         |
| ::noContent           | 204         |
| ::multipleChoices     | 300         |
| ::movedPermanently    | 301         |
| ::found               | 302         |
| ::seeOther            | 303         |
| ::notModified         | 304         |
| ::badRequest          | 400         |
| ::unauthorized        | 401         |
| ::forbidden           | 403         |
| ::notFound            | 404         |
| ::methodNotAllowed    | 405         |
| ::internalServerError | 500         |
| ::notImplemented      | 501         |
| ::badGateway          | 502         |
| ::serviceUnavailable  | 503         |

## Sending status header

The `Response` instance can send any http header with the status code message, only for those inside constructor list.

```php
use Lkt\Http\Response;

$response = Response::ok(['hey' => 'how are you?']);
$response->sendStatusHeader(); 
```