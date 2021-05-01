<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;

// Models
use App\Models\Order;
use App\Models\Buyer;
use App\Models\Transaction;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['product', 'buyer'])->get();

        return view('pages.admins.order.index', [
            'title' => 'Pesanan',
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $requests = $request->validated();

        $requests['transaction']['total'] = $requests['price'] * $requests['order']['quantity']; 

        $buyerID = $this->storeBuyer($requests);

        $orderID = $this->storeOrder($buyerID, $requests);

        $this->storeTransaction($orderID, $requests);

        return redirect()
                ->back()
                ->with('alert-store-success', "Silahkan Anda periksa menu 'Riwayat Transaksi' untuk melakukan pembayaran.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $order = Order::where('id', $id)->with(['product', 'buyer'])->first();

        return view('pages.admins.order.show', [
            'title' => 'Detail Pesanan',
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if($order->transaction()->count()) {
            return redirect()
                ->back()
                ->with('alert-delete-restrict', 'Pesanan ini masih memiliki transaksi, harap hapus transaksi yang dimiliki oleh pesanan ini.');
        }

        $order->delete();

        return redirect()
                ->back()
                ->with('alert-delete-success', 'Pesanan ini telah berhasil dihapus.');
    }

    public function storeBuyer($buyerRequests) {
        $buyerRequests = $buyerRequests['buyer'];
        $storedBuyer = Buyer::create($buyerRequests);

        return $storedBuyer->id;
    }

    public function storeOrder($buyerID, $orderRequests) {
        $orderRequests = $orderRequests['order'];
        $orderRequests['buyer_id'] = $buyerID;
        
        $orderRequests = $this->generateOrderCode($orderRequests);

        $storedOrder = Order::create($orderRequests);

        return $storedOrder->id;
    }

    public function storeTransaction($orderID, $transactionRequests) {
        $transactionRequests = $transactionRequests['transaction'];

        $transactionRequests = $this->generateTransactionCode($transactionRequests);
        $transactionRequests['status'] = 2;
        $transactionRequests['order_id'] = $orderID; 
        $transactionRequests['customer_id'] = auth('customer')->user()->id;

        Transaction::create($transactionRequests);
    }

    public function generateOrderCode($orderRequests) {
        $recentOrderCode = Order::orderBy('created_at', 'desc')->first();
	
		$lastIncrementDigits = $recentOrderCode ? substr($recentOrderCode->code, -4) : 0;
		
		$orderRequests['code'] = 'PSN' . str_pad($lastIncrementDigits + 1, 4, 0, STR_PAD_LEFT);

        return $orderRequests;
    }

    public function generateTransactionCode($transactionRequests) {
        $recentTransactionCode = Transaction::orderBy('created_at', 'desc')->first();
	
		$lastIncrementDigits = $recentTransactionCode ? substr($recentTransactionCode->code, -4) : 0;
		
		$transactionRequests['code'] = 'TRX' . str_pad($lastIncrementDigits + 1, 4, 0, STR_PAD_LEFT);

        return $transactionRequests;
    }
}
