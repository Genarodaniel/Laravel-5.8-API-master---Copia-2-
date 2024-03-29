<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\User_app;
use Validator;
use App\API\ApiError;

class User_appController extends \App\Http\Controllers\Controller
{
   
    public $successStatus = 200;
    private $user_app;

    public function __construct(\App\User_app $user_app){
       $this->user_app = $user_app;
    }


    public function all_users(){

       try{ $data = ['data'=>$this->user_app->all()];
        return response()->json($data);
       }


        catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1010));

            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação',1010));
        }
    }



    public function show(\App\User_app $id){
       
       try{
        $data =['data'=>$id];
        return response()->json($data);
       }
     
        catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1010));

            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação',1010));
        }
    }

    public function ok(){
        return ['status'=> true];
    }

   /* public function store(Request $request){
        $residentData = $request->all();
        $this->resident->create($residentData);
        
    }*/

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email'=> 'required|email',
                'user_type'=> 'required',
                'password'=>'required'
        
            ]);
                if($validator->fails()){
                    return response()->json(['error' => $validator->errors()],401);
                }
                $input =$request->all();
                $input['password'] = bcrypt($input['password']);
                $encrypt_pass= bcrypt($input['password']);
                $request['password']=$encrypt_pass;
                $data = User_app::create($request->all());
                $success['name'] = $data->name;
    
            return response()->json(['success' => $success],$this->successStatus);

        }
        catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(),1010));

            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação',1010));
        }
      
       
    }


}

?>