<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->with(['order.product', 'order.buyer'])->get();

        return view('pages.admins.transaction.index', [
            'title' => 'Transaksi',
            'transactions' => $transactions
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::where('id', $id)->with(['order.product', 'order.buyer'])->first();

        $totalTransaction = $transaction->courier_cost + $transaction->total;

        return view('pages.admins.transaction.show', [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction,
            'total' => $totalTransaction
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
    public function update(Request $request, $id)
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
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect()
                ->back()
                ->with('alert-delete-success', 'Transaksi ini telah berhasil dihapus.');
    }

    public function setFailedTransaction($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 0;
        $transaction->save();

        return redirect()
                ->route('admins.transactions.index')
                ->with('alert-update-transaction-status', 'Transaksi ini telah berhasil diubah statusnya.');
    }

    public function setShippedTransaction($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 4;
        $transaction->save();

        return redirect()
                ->route('admins.transactions.index')
                ->with('alert-update-transaction-status', 'Transaksi ini telah berhasil diubah statusnya.');
    }
}
