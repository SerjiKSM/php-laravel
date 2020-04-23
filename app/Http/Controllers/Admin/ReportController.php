<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Models\Product;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\OrderProductUpdateRequest;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $productService = App::make('App\Services\ProductService');

        $products = $productService->getOrderProducts();
        $chartData = $productService->chartData($products);

        if (empty($products->count()))
            return view('admin.report')->withMessage('No results found!');

        return view('admin.report', compact('products', 'chartData'));
    }

    public function search(SearchRequest $request)
    {
        $q = $request->input('search');
        $searchParam = $request->input('searchParam');

        $productService = App::make('App\Services\ProductService');

        if ($searchParam == "all"){
            return $productService->findOrderProductsByFields($q);
        }else{
            return $productService->findOrderProductsBySearchField($q, $searchParam);
        }
    }

    /**
     * Show the form for editing.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $productService = App::make('App\Services\ProductService');
        $product = $productService->findOrderProductById($id);
        $clients = $productService->findClients();
        return view('admin.edit', compact('product', 'clients'));
    }

    public function update(OrderProductUpdateRequest $request, int $id)
    {
        $productService = App::make('App\Services\ProductService');
        $product = $productService->findOrderProductById($id);

        $product->client_id = $request->input('client');
        $product->product = $request->input('product');
        $product->total = $request->input('total');

        if (strtotime($request->input('date')) < 0)
            return back()->with('error', 'Date has incorrect year!');

        $product->date = \Carbon\Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
        $product->save();

        return redirect()->route('admin.report')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Product::find($id)->delete();

        return redirect()->route('admin.report')
            ->with('success','Product deleted successfully!');
    }
}
