<?php

namespace App\Http\Controllers\Api;

use App\API\ApiError;
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

        $data = ['data' => $this->product->paginate(10)];
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

        try{

            $dataInfo = $request->all();
            $this->product->create($dataInfo);

            $return = ['data' => ['msg' => 'Produto criado com sucesso!']];

            return response()->json($return, 201);

        }   catch(\Exception $e){

            if(config('app.debug')){

               return response()->json(ApiError::errorMessage($e->getMessage(), 1010));

            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação', 1010));



        }


    }
    public function update(Request $request, $id){

        try{

            $productData = $request->all();
            $product = $this->product->find($id);
            $product->update($productData);

            $return = ['data' => ['msg' => 'Produto criado com sucesso!']];

            return response()->json($return, 201);

        }   catch(\Exception $e){

            if(config('app.debug')){

               return response()->json(ApiError::errorMessage($e->getMessage(), 1010));

            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação', 1010));

        }

    }
    public function delete(Product $id){

        try{

            $id->delete();

            return response()->json(['data' => ['msg' => 'Produto '. $id->id .' deletado com sucesso!']], 200);

        }   catch(\Exception $e){

            if(config('app.debug')){

               return response()->json(ApiError::errorMessage($e->getMessage(), 1010));

            }

            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação', 1010));

        }

    }
}
