<?php

namespace Tests\Unit;

use Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use App\Http\Controllers\DecoderController;


class DecodeTest extends TestCase
{
    public function testDecodeReturnsData()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['some' => 'data'])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $decoder = new DecoderController($client);
        $response = $decoder->decode('4F2YU09161KM33122');
        $this->assertEquals(
            [
                "success" => true,
                "vin" => "4F2YU09161KM33122",
                "specification" => [
                  "vin" => "4F2YU09161KM33122",
                  "year" => "2001",
                  "make" => "Mazda",
                  "model" => "Tribute ES / LX",
                  "trim_level" => "LX-V6",
                  "engine" => "3.0L V6 MPI",
                  "style" => "SUV 4D",
                  "made_in" => "United States",
                  "steering_type" => "R&P",
                  "anti_brake_system" => "Non-Abs | 4-Wheel ABS",
                  "tank_size" => null,
                  "overall_height" => "69.90 inches",
                  "overall_length" => "173.00 inches",
                  "overall_width" => "71.90 inches",
                  "standard_seating" => "5",
                  "optional_seating" => null,
                  "highway_mileage" => "24 miles/gallon",
                  "city_mileage" => "18 miles/gallon",
                ]
                

            ], $response);
    }

}
