<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\User_app;
use Validator;

class User_appController extends \App\Http\Controllers\Controller
{
   
    public $successStatus = 200;
    private $user_app;

    public function __construct(\App\User_app $user_app){
       $this->user_app = $user_app;
    }


    public function all_users(){

        $data = ['data'=>$this->user_app->all()];
        return response()->json($data);
    }



    public function show(\App\User_app $id){
        $data =['data'=>$id];
        return response()->json($data);
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
            $data = User_app::create($request->all());
            $success['name'] = $data->name;

        return response()->json(['success' => $success],$this->successStatus);
    }


}

?>