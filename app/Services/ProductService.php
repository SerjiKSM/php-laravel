<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Product;
use App\Charts\OrderChart;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class ProductService
{
    public function getOrderProducts()
    {
        return Product::with('client')->paginate(5);
    }

    public function getOrderProductsWithoutPaginate()
    {
        return Product::with('client');
    }

    public function findOrderProductsByFields(string $q)
    {
        if (!empty($q)) {
            if ($this->isDate($q))
                $q = \Carbon\Carbon::parse($q)->format('Y-m-d');

            $products = Product::with('client')
                ->whereHas('client', function ($query) use ($q) {
                    $query->where('client', 'like', "%{$q}%");
                })
                ->orWhere('product', 'LIKE', '%' . $q . '%')
                ->orWhere('total', 'LIKE', '%' . $q . '%')
                ->orWhere('date', 'LIKE', '%' . $q . '%')
                ->paginate(5)
                ->setPath('');

            $products->appends(array('search' => Input::get('search')));
            $products->appends(array('searchParam' => Input::get('searchParam')));

            $chartData = $this->chartData($products);

            if (!empty($products->count()))
                return view('admin.report', compact('products', 'chartData'));
        }

        return view('admin.report')->withMessage('No result type search keyword!');
    }

    public function findClients()
    {
        return Client::all();
    }

    public function findOrderProductsBySearchField(string $q, string $searchParam)
    {
        $products = $this->getOrderProductsWithoutPaginate();

        if ($searchParam == "client") {
            $products = $products->whereHas('client', function ($query) use ($q) {
                $query->where('client', 'like', "%{$q}%");
            });
        }elseif ($searchParam == "product"){
            $products = $products->Where('product', 'LIKE', '%' . $q . '%');
        }elseif ($searchParam == "total"){
            $products = $products->Where('total', 'LIKE', '%' . $q . '%');
        }elseif ($searchParam == "date"){
            if ($this->isDate($q)) {
                $q = \Carbon\Carbon::parse($q)->format('Y-m-d');
            }
            $products = $products->Where('date', 'LIKE', '%' . $q . '%');
        }

        $products = $products->paginate(5)->setPath('');

        $products->appends(array('search' => Input::get('search')));
        $products->appends(array('searchParam' => Input::get('searchParam')));

        $chartData = $this->chartData($products);

        if (!empty($products->count()))
            return view('admin.report', compact('products', 'chartData'));

        return view('admin.report')->withMessage('No result type search keyword!');
    }

    public function findOrderProductById(int $id)
    {
        return Product::findOrFail($id);
    }
    public function chartData($products): OrderChart
    {
        $arrX = array();
        $arrY = array();
        foreach ($products as $item) {
            array_push($arrY, $item->total);
            array_push($arrX, Carbon::parse($item->date)->format('m/d/Y'));
        }

        $OrderChart = new OrderChart();
        $OrderChart->labels($arrX);
        $OrderChart->dataset('Orders', 'line', $arrY)
            ->color("rgb(255, 99, 132)")
            ->linetension(0.1);

        return $OrderChart;
    }

    public function isDate(string $q) : bool
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $q)
            || preg_match("/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/", $q))
        {
            return true;
        } else {
            return false;
        }
    }
}
