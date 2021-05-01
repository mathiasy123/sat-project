<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $transactions = Transaction::count();

        $totalTransaction = Transaction::where('status', 1)->sum('total');

        $successTransaction = Transaction::where('status', 1)->count();
        $pendingTransaction = Transaction::where('status', 2)->count();
        $failedTransaction = Transaction::where('status', 0)->count();

        $lastTransactions = Transaction::where('status', 1)
                                                ->orderBy('created_at', 'desc')
                                                ->with(['order.product'])
                                                ->take(10)
                                                ->get();

        $portionSuccessTransaction = ($transactions > 0) ? ($successTransaction / $transactions) * 100 : 0;
        $portionPendingTransaction = ($transactions > 0) ? ($pendingTransaction / $transactions) * 100 : 0;
        $portionFailedTransaction = ($transactions > 0) ? ($failedTransaction / $transactions) * 100 : 0;

        if($request->start_date != null && $request->last_date != null) {
            $start_date = $request->start_date;
            $last_date = $request->last_date;

            $transactions = Transaction::whereBetween('created_at', [$start_date, $last_date])->count();

            $totalTransaction = Transaction::whereBetween('created_at', [$start_date, $last_date])
                                                ->where('status', 1)
                                                ->sum('total');

            $successTransaction = Transaction::whereBetween('created_at', [$start_date, $last_date])
                                                ->where('status', 1)
                                                ->count();
            $pendingTransaction = Transaction::whereBetween('created_at', [$start_date, $last_date])
                                                ->where('status', 2)
                                                ->count();
            $failedTransaction = Transaction::whereBetween('created_at', [$start_date, $last_date])
                                                ->where('status', 0)
                                                ->count();

            $lastTransactions = Transaction::whereBetween('created_at', [$start_date, $last_date])
                                                ->where('status', 1)
                                                ->orderBy('created_at', 'desc')
                                                ->with(['order.product'])
                                                ->take(10)
                                                ->get();

            $portionSuccessTransaction = ($transactions > 0) ? ($successTransaction / $transactions) * 100 : 0;
            $portionPendingTransaction = ($transactions > 0) ? ($pendingTransaction / $transactions) * 100 : 0;
            $portionFailedTransaction = ($transactions > 0) ? ($failedTransaction / $transactions) * 100 : 0;

        }

        return view('pages.admins.dashboard.index', [
            'title' => 'Dashboard',
            'totalTransaction' => $totalTransaction,
            'successTransaction' => $successTransaction,
            'pendingTransaction' => $pendingTransaction,
            'failedTransaction' => $failedTransaction,
            'lastTransactions' => $lastTransactions,
            'portionSuccessTransaction' => $portionSuccessTransaction,
            'portionPendingTransaction' => $portionPendingTransaction,
            'portionFailedTransaction' => $portionFailedTransaction,
        ]);
    }
}
