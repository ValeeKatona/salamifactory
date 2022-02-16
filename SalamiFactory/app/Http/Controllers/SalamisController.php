<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salami;
use App\Models\SalamiProducts;
use Illuminate\Support\Facades\DB;
use Validator;

class SalamisController extends BaseController
{
    public function index()
    {
        $salamis = DB::table('salamiproducts')
        ->join('salamiproducts', 'product_id', '=', 'salamiproducts.id')
        ->select('name', 'price', 'product_type', 'date')
        ->get();
    return $this->sendResponse($products, "Products successfully fetched.");
    }
    public function show($id)
    {
    $salami = DB::table('salamiproducts')
        ->join('salamiproducts', 'product_id', '=', 'salamiproducts.id')
        ->select('name', 'price', 'product_type', 'date')
        ->where('salamis.id', '=', $id)
        ->get();
    return $this->sendResponse($product, "Product successfully fetched.");
    }
    public function create(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required',
        'product_type' => 'required',
        'date' => 'required',
    ]);
    if ($validator->fails()) {
        return $this->sendError("Error validation", $validator->errors(), 403);
    }
    $salami = Salami::create($request->all());
    return $this->sendResponse($salami, 'Product successfully created.');
    }
    public function update(Request $request, $id)
    {
    try {
        $salami = Salami::find($id);
        $salami->update($request->all());
        return $this->sendResponse($salami, 'Product successfully updated.');
    } catch (\Throwable $th) {
        return $this->sendError("Error in updating of product", $th, 403);
    }
    }
    public function delete($id)
    {
    $salami = Salami::destroy($id);
    return $this->sendResponse($salami, "Product successfully deleted.");
    }
    public function search($material)
    {
    $salamis = DB::table('salamiproducts')
        ->join('salamiproducts', 'product_id', '=', 'salamiproducts.id')
        ->select('name', 'price', 'product_type', 'date')
        ->where("product_type", "like", "%" . $type . "%")
        ->get();
    return $this->sendResponse($salamis, "Searched product(s) successfully fetched.");
    }
}
