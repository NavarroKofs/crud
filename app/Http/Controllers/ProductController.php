<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use \Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            if(!is_numeric($request->price) || ($request->price <= 0)){
                $error = 'Always throw this error';
                throw new Exception($error);
            }
            // Create a new product
            $product = Product::create($request->all());
            // Return a response with a product json
            // representation and a 201 status code   
            return response()->json($product,201);
        } catch(Exception $exception) {
            $type = explode("\\", get_class($exception));
            $type = $type[count($type)-1];
            return response()->json([
                "errors"=> ["code"=> "ERROR-1",
                "title"=>  "Unprocessable Entity",
                "type" => $type
                ]]  , 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $producto = Product::findOrFail($id);
            return response()->json($producto,200);
        } catch (ModelNotFoundException $exception) {
            $type = explode("\\", get_class($exception));
            $type = $type[count($type)-1];
            return response()->json([
                "errors"=> ["code"=> "ERROR-2",
                "title"=>  "Not Found",
                "type" => $type
                ]]  , 404);
        }
    }

        /**
     * Display all resources.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showAll(Product $product)
    {
        return response()->json($product->all(),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $update = Product::findOrFail($id);
            if(!is_numeric($request->price) || ($request->price <= 0)){
                $error = 'Always throw this error';
                throw new Exception($error);
            }
            $update->name = $request->name;
            $update->price = $request->price;
            $update->save();
            return response()->json($update,200);
        } catch(Exception $exception){
            $type = explode("\\", get_class($exception));
            $type = $type[count($type)-1];
            return response()->json([
                "errors"=> ["code"=> "ERROR-1",
                "title"=>  "Unprocessable Entity",
                "type" => $type
                ]]  , 422);
        } catch (ModelNotFoundException $exception) {
            $type = explode("\\", get_class($exception));
            $type = $type[count($type)-1];
            return response()->json([
                "errors"=> ["code"=> "ERROR-2",
                "title"=>  "Not Found",
                "type" => $type
                ]]  , 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $request = Product::findOrFail($id);
            $delete = Product::destroy($id);
            return response()->json("Se ha eliminado exitosamente", 200);
        } catch (Exception $exception) {
            $type = explode("\\", get_class($exception));
            $type = $type[count($type)-1];
            return response()->json([
                "errors"=> ["code"=> "ERROR-2",
                "title"=>  "Not Found",
                "type" => $type
                ]]  , 404);
        }
    }
}
