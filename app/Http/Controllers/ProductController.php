<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    function post(Request $request){
        // return $request;
        // die;

        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->active = $request->active;
        $product->description = $request->description;

        $product->save();

        return response()->json(
            [
                "message" => "sukses bro",
                "simpan" => $product
            ]
            );
    }

    function get(){
        $product = Product::all();

        return response()->json(
            [   
                "product" => $product
            ]
            );
    }

    function getById($id){
        // return "hello";die;
        $product = Product::where('id', $id)->get()->first();
        if($product){
            return response()->json(
                [
                    "product" => $product
                ]
            );
        }
        else{
            return response()->json(
                [
                    "product" => "tidak ditemukan id ". $id
                ]
            );
        }

    }

    function put($id, Request $request){
        $product = Product::where('id', $id)->first();

        if($product){
                $product->name=$request->name ? $request->name:$product->name;
                $product->price=$request->price ? $request->price :  $product->price;
                $product->quantity=$request->quantity ? $request->quantity :  $product->quantity;
                $product->active=$request->active ? $request->active : $product->active;
                $product->description=$request->description ? $request->description : $product->description;

                $product->save();

                return response()->json(
                    [
                        "product" => $product
                    ]
                );
        }
            return response()->json(
                [
                    "product" => "not found"
                ]
            );


        
    }

    function delete($id){
        $product = Product::where('id', $id)->first();

        if($product){
            $product->delete();
            return response()->json(
                [
                "product" => "terhapus"
                ]
            );
        }
        return response()->json(
            [
            "product" => "gagal menemukan"
            ]
        );

    }
}
