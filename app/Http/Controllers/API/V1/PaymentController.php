<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/payments",
     *      operationId="getPaymentsList",
     *      tags={"Payments"},
     *      summary="List all payments",
     *      description="Return list of payments",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Page not found"
     *      )
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity"
     *      )
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      )
     * )
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Payment::paginate());
    }

    /**
     * Store a newly created payment resource in storage.
     *
     * @param  App\Http\Requests\v1\PaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(PaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        return response($payment);
    }

    /**
     * Display the specified payment resource.
     *
     * @param  payment:uuid  string
     * @return \Illuminate\Http\Response
     */
    public function show (Payment $payment)
    {
        return response($payment);
    }

    /**
     * Update the specified payment resource in storage.
     *
     * @param  App\Http\Requests\v1\PaymentRequest $request
     * @param  payment:uuid  string
     * @return \Illuminate\Http\Response
     */
    public function update (PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return response($payment);
    }

    /**
     * Remove the specified payment resource from storage.
     *
     * @param  payment:uuid  string
     * @return \Illuminate\Http\Response
     */
    public function delete (Payment $payment)
    {
        $payment->delete();
        return response(['success' => true]);
    }
}
