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

// Set content type to JSON:
$response->setContentTypeJSON();

// Or to text/html
$response->setContentTypeTextHTML();

// Also, you can set the expiration and max age:
$response->setHeaderCacheControlMaxAge(84600);
$response->setHeaderExpires(84600);

// Or use the shortcuts:
$response->setHeaderExpiresToOneDay();
$response->setHeaderExpiresToOneWeek();
$response->setHeaderExpiresToOneMonth();
$response->setHeaderExpiresToOneYear();

$response->setHeaderCacheControlMaxAgeToOneDay();
$response->setHeaderCacheControlMaxAgeToOneWeek();
$response->setHeaderCacheControlMaxAgeToOneMonth();
$response->setHeaderCacheControlMaxAgeToOneYear();

// Send the response headers
$response->sendHeaders(); 
```

## Response format

When using a text/html response, the array with the response data must have the html in a `html` key.

```php
use Lkt\Http\Response;
$response = Response::ok(['html' => 'may the force be with you']);
$response->setContentTypeTextHTML();

// Output 'html' content
$response->sendTextHTMLContent();
```

For that reason, in order to work with a simpler code, there are shortcuts for 20X responses:
```php
use Lkt\Http\Response;
// Same as the previous example constructor
$response = Response::okTextHTML('may the force be with you');

// Output 'html' content
$response->sendTextHTMLContent();
```