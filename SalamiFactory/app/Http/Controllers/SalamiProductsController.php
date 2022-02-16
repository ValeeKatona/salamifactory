<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalamiProduct;
use Validator;

class SalamiProductsController extends BaseController
{
    public function index()
    {
        $salamiproducts = SalamiProduct::all();
        return $this->sendResponse($salamiproducts, "Successfully fetched.");
    }
    public function show($id)
    {
        $salamiproduct = SalamiProduct::find($id);
        return $this->sendResponse($salamiproduct, "Successfully fetched.");
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_type' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError("Error validation", $validator->errors(), 403);
        }
        $salamiproduct = SalamiProduct::create($request->all());
        return $this->sendResponse($salamiproduct, 'Successfully created.');
    }
    public function update(Request $request, $id)
    {
        try {
            $salamiproduct = SalamiProduct::find($id);
            $salamiproduct->update($request->all());
            return $this->sendResponse($salamiproduct, 'Successfully updated.');
        } catch (\Throwable $th) {
            return $this->sendError("Error in updating", $th, 403);
        }
    }
    public function delete($id)
    {
        $salamiproduct = SalamiProduct::destroy($id);
        return $this->sendResponse($salamiproduct, "Successfully deleted.");
    }
    public function search($type)
    {
        $salamiproduct = SalamiProduct::where("product_type", "like", "%" . $type . "%")->get();
        return $this->sendResponse($salamiproduct, "Searched type(s) successfully fetched.");
    }
}
