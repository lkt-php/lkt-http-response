<?php

namespace Lkt\Templates\Tests;

use Lkt\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @return void
     */
    public function testResponseEngine()
    {
        $response = Response::ok(['hello' => 'world']);

        $this->assertEquals(200, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::created(['hello' => 'world']);

        $this->assertEquals(201, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::accepted(['hello' => 'world']);

        $this->assertEquals(202, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::noContent(['hello' => 'world']);

        $this->assertEquals(204, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::multipleChoices(['hello' => 'world']);

        $this->assertEquals(300, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::movedPermanently(['hello' => 'world']);

        $this->assertEquals(301, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::found(['hello' => 'world']);

        $this->assertEquals(302, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::seeOther(['hello' => 'world']);

        $this->assertEquals(303, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::notModified(['hello' => 'world']);

        $this->assertEquals(304, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::badRequest(['hello' => 'world']);

        $this->assertEquals(400, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::unauthorized(['hello' => 'world']);

        $this->assertEquals(401, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::forbidden(['hello' => 'world']);

        $this->assertEquals(403, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::notFound(['hello' => 'world']);

        $this->assertEquals(404, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::methodNotAllowed(['hello' => 'world']);

        $this->assertEquals(405, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::internalServerError(['hello' => 'world']);

        $this->assertEquals(500, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::notImplemented(['hello' => 'world']);

        $this->assertEquals(501, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::badGateway(['hello' => 'world']);

        $this->assertEquals(502, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());


        $response = Response::serviceUnavailable(['hello' => 'world']);

        $this->assertEquals(503, $response->getCode());
        $this->assertEquals(['hello' => 'world'], $response->getResponseData());
    }
}