<?php

namespace Julius\CurrencyConvert\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function convert(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
        ]);

        $currency = $request->currency;
        $amount = $request->amount;

        $fetchRate = $this->fetchRate($currency);

        if ($fetchRate["error"] ?? null) {
            return response($fetchRate, 422);
        }

        $rate = $fetchRate["rate"];

        return response([
            "rate" => $rate,
            "currency" => $currency,
            "total" => $amount * $rate
        ]);
    }

    public function fetchRate($currency)
    {
        try {
            $xml = simplexml_load_file("https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
            $result = json_decode(json_encode($xml), true);
            $values = $result['Cube']['Cube']['Cube'];

            foreach ($values as $value) {
                $attrib = $value["@attributes"];
                if ($attrib["currency"] == $currency) {
                    return [
                        "rate" => $attrib["rate"]
                    ];
                }
            }
        } catch (\ErrorException $e) {
            return [
                "error" => $e->getMessage()
            ];
        }

        return [
            "error" => "Currency not found"
        ];
    }
}
