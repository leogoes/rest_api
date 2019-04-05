<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product){

        $this->product = $product;

    }

    public function index(){

        $data = ['data' => $this->product->paginate(5)];
        return  response()->json($data);

    }

    //Trazer a classe como parametro faz com que o id
    //trata o id como objeto e traz todas as informações
    //Type hint
    public function show(Product $id){

        $data = ['data' => $id];
        return  response()->json($data);

    }

    public function store(Request $request){

        $dataInfo = $request->all();
        $this->product->create($dataInfo);

    }
}
