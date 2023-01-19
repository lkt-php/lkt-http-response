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
$response->setCacheControlMaxAgeHeaderToOneYear(84600);
$response->setExpiresHeader(84600);

// Or use the shortcuts:
$response->setExpiresHeaderToOneDay();
$response->setExpiresHeaderToOneWeek();
$response->setExpiresHeaderToOneMonth();
$response->setExpiresHeaderToOneYear();

$response->setCacheControlMaxAgeHeaderToOneDay();
$response->setCacheControlMaxAgeHeaderToOneWeek();
$response->setCacheControlMaxAgeHeaderToOneMonth();
$response->setCacheControlMaxAgeHeaderToOneYear();

// Send the response headers
$response->sendHeaders(); 
```

## Response format

When using a text/html response, simply pass the string as an argument. By default, this will turn the response content type to `text/html`.

```php
use Lkt\Http\Response;
$response = Response::ok('may the force be with you');

// Output content
$response->sendContent();
```

## Sending files

You can send a file in a similar way, only remember to refresh the MIME type

```php
use Lkt\Http\Response;

// Get a string with the content of the file
$content = file_get_contents($pathToImage);

// Create a response
$response = Response::ok($content);

// Set the MIME type for the file
// Automatically detect the mime type from file extension
// Notice: If the extension wasn't detected, the response will turn into an octet-stream
$response->setContentTypeByFileExtension('jpg'); // It can be pdf, png, doc, docx, csv, ...

// Set the last modified header
$lastModified = filemtime($pathToImage);
$response->setLastModifiedHeader($lastModified);

// Turn it to download
$response->setContentDispositionAttachment('image.jpg');

// Output 'img' content
$response->sendContent();
```