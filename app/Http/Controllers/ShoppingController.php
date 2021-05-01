<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TransactionRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;

// Models
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Customer;

class ShoppingController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        $products = Product::with('category')->orderBy('created_at', 'desc');
        
        if($request->keyword) {
            $products = $products->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if($request->category_id) {
            $products = $products->orWhere('category_id', $request->category_id);
        }

        $products = $products->get();

        return view('pages.customers.shopping.index', [
            'title' => 'Belanja',
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function transactions() {
        $transactions = Transaction::where('customer_id', auth('customer')->user()->id)
                                        ->orderBy('created_at', 'desc')
                                        ->with('order.product')
                                        ->get();

        return view('pages.customers.shopping.transaction', [
            'title' => 'Transaksi',
            'transactions' => $transactions
        ]);
    }

    public function profile() {
        return view('pages.customers.shopping.profile', ['title' => 'Profil']); 
    }

    public function updateProfile(ProfileRequest $request, $id) {
        $validatedRequest = $request->validated();

        $customerProfile = Customer::find($id);
        $customerProfile->name = $validatedRequest['name'];
        $customerProfile->phone = $validatedRequest['phone'];
        $customerProfile->address = $validatedRequest['address'];
        $customerProfile->email = $validatedRequest['email'];
        
        if($request->has('gallery')) {
            $filePath = 'images/pelanggan';

            $validatedRequest['gallery'] = $request->file('gallery')->store($filePath, 'public');

            $customerProfile->gallery = $validatedRequest['gallery'];
        }

        $customerProfile->save();

        return redirect()
                ->back()
                ->with('alert-update-profile-success', 'Profil Anda berhasil diubah, silahkan periksa kembali.');
    }

    public function changePassword() {
        return view('pages.customers.shopping.change-password', ['title' => 'Ganti Password']);
    }

    public function updatePassword(UpdatePasswordRequest $request, $id) {
        $validatedRequest = $request->validated();

        $customerProfile = Customer::find($id);
        $customerProfile->password = $validatedRequest['password'];

        $customerProfile->save();

        return redirect()
                ->route('customers.shopping.profile')
                ->with('alert-update-password-success', 'Password Anda berhasil diubah.');
    }

    public function order($id) {
        $product = Product::where('id', $id)->with('category')->first();

        $provinces = $this->showProvinces();

        return view('pages.customers.shopping.order', [
            'title' => 'Pemesanan',
            'product' => $product,
            'provinces' => $provinces
        ]); 
    }

    public function showProduct($id) {
        $product = Product::where('id', $id)->with(['galleries', 'category'])->first();

        return view('pages.customers.shopping.show-product', [
            'title' => 'Detail Produk',
            'product' => $product
        ]);
    }
    
    public function showTransaction($id) {
        $transaction = Transaction::where('id', $id)->with(['order.product', 'order.buyer'])->first();

        $totalTransaction = $transaction->courier_cost + $transaction->total;

        return view('pages.customers.shopping.show-transaction', [
            'title' => 'Detail Transaksi',
            'transaction' => $transaction,
            'total' => $totalTransaction
        ]);
    }

    public function paymentTransaction(TransactionRequest $request, $id) {
        $paymentRequests = $request->validated();

        $buyerName = strtolower($paymentRequests['buyer_name']);
        
        $filePath = 'images/pembayaran/' . $buyerName;

        $paymentRequests['payment_receipt'] = $request->file('payment_receipt')->storeAs($filePath, date('Ymdhhmmss', time()), 'public');

        $transaction = Transaction::find($id);
        $transaction->payment_receipt = $paymentRequests['payment_receipt'];
        $transaction->status = 3;
        $transaction->save();

        return redirect()
                ->route('customers.shopping.transaction')
                ->with('alert-payment-success', 'Pembayaran Anda sudah berhasil dilakukan, harap menunggu proses pengiriman produk ke alamat Anda.');
    }

    public function setSucceedTransaction($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 1;
        $transaction->save();

        return redirect()
                ->route('customers.shopping.transaction')
                ->with('alert-update-transaction-status', 'Transaksi ini telah berhasil diselesaikan.');
    }

    public function setFailedTransaction($id) {
        $transaction = Transaction::find($id);
        $transaction->status = 0;
        $transaction->save();

        return redirect()
                ->back()
                ->with('alert-transaction-cancel-success', 'Pesanan dan transaksi Anda berhasil dibatalkan.');
    }

    public function showProvinces() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "key: 189630ad03d864143d72ba720516d53e"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $shipping_data = $response['rajaongkir']['results'];
            return $shipping_data;
        }
    }

    public function showCities($id) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "key: 189630ad03d864143d72ba720516d53e"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            $shipping_data = $response['rajaongkir']['results'];
            return json_encode($shipping_data);
        }
    }

    public function showCourierCost($origin, $destination, $weight, $courier) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: 189630ad03d864143d72ba720516d53e"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response=json_decode($response,true);
            $shipping_data = $response['rajaongkir']['results'];
            return json_encode($shipping_data);
        }
    }
}
