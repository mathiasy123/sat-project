<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductGalleryRequest;

// Models
use App\Models\ProductGallery;
use App\Models\Product;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = ProductGallery::with('product')->orderBy('created_at', 'desc')->get();

        return view('pages.admins.product-galleries.index', [
            'title' => 'Gambar Produk',
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admins.product-galleries.create', [
            'title' => 'Gambar Produk',
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $productGalleryRequests = $request->validated();

        $product = Product::find($productGalleryRequests['product_id']);

        $product = Product::where('id', $productGalleryRequests['product_id'])
                            ->with('category:id,name')
                            ->first();

        $categoryName = strtolower($product->category->name);
        $productName = strtolower($product->name);
        
        $filePath = 'images/produk/' . $categoryName . '/' . $productName;

        $productGalleryRequests['gallery_path'] = $request->file('gallery_path')->store($filePath, 'public');

        $productGalleryRequests['status'] = $product->galleries()->count() < 3 ? 1 : 0;

        ProductGallery::create($productGalleryRequests);

        return redirect()
                    ->route('admins.product-galleries.index')
                    ->with('alert-store-success', 'Gambar produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productGallery = ProductGallery::find($id);

        if($productGallery) {
            $productGallery->delete();

            return redirect()
                    ->back()
                    ->with('alert-delete-success', 'Gambar produk berhasil dihapus.');
        }

        return redirect()
                ->back()
                ->with('alert-not-found', 'Gambar produk ini tidak ditemukan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $activeProductGallery = ProductGallery::where('product_id', $request->product_id)
                                                ->where('status', 1)
                                                ->count();

        if($request->active == 1) {
            if($activeProductGallery < 3) {
                $productGallery = ProductGallery::find($id);
    
                $productGallery->status = $request->status == 0 ? 1 : 0;
                $productGallery->save();
        
                return redirect()
                        ->back()
                        ->with('alert-update-success', 'Status gambar produk berhasil diubah.');
            }

            return redirect()
                    ->back()
                    ->with('alert-update-failed', 'Status gambar produk gagal diubah, satu produk gambar maksimal hanya 3 gambar yang aktif, harap non-aktifkan salah satu gambar yang aktif yang dimiliki oleh produk tersebut');
        } else {
            $productGallery = ProductGallery::find($id);
    
            $productGallery->status = $request->status == 0 ? 1 : 0;
            $productGallery->save();
    
            return redirect()
                    ->back()
                    ->with('alert-update-success', 'Status gambar produk berhasil diubah.');
        }
    }
}
