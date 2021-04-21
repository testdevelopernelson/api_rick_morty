<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Mail\ForgotPasswordMail;
use App\Mail\DevolutionShopMail;
use App\Mail\DevolutionCustomerMail;
use App\Models\State;
use App\Models\User;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class AccountController extends Controller {

      public function login(Request $request){
          if (auth()->check()) {
            return redirect()->route('home');
          }         
          return view('account.login');
      }

      public function register(Request $request){ 
        set_content(10);
        $departments = State::all();         
        return view('account.register', compact('departments'));
      }

      public function home(Request $request){
        $departments = State::all(); 
        $user = User::where('id', auth()->id())->with('address', 'orders')->first();   
        // dd(Product::where('producto', 'LIKE', '%hola%')->get())  ;
        return view('account.home', compact('user', 'departments'));
      }

      public function change_password(){
        return view('account.change_password');
      }

      public function forgot_password(){
        return view('account.forgot_password');
      }

      public function order_items($reference){
        $order = Order::whereReference($reference)->with('items')->firstOrFail();  
        // dd(Product::with('order_items')->first())      ;
        $devolutions = Devolution::all();
        $user = User::where('id', auth()->id())->first();
        foreach ($order->items as $key => $item) {
            $item->total = core()->currency($item->total);
        }
        return view('account.order_items', compact('user', 'order', 'devolutions'));
      }


     // llamadas ajax desde VUE

      public function create_account(){
          $data = request()->all();
          if ($user = User::where('email', $data['email'])->first()) {
              return response()->json(['status' => 'exists', 'message' => 'Este correo ya se encuentra registrado']);
          }else{
             $user = User::create($data);
             $user->assignRole('Customer');
             $user->save();
             $object = new CustomerAddress;
             $object->customer_id = $user->id;
             $object->address =  $data['address'];
             $object->state_id =  $data['state_id'];
             $object->city_id =  $data['city_id'];
             $object->name_address =  empty($data['name_address']) ? $data['name'] : $data['name_address'];
             $object->principal =  1;
             $object->save();
             event(new UserRegistered($user));
             return response()->json(['status' => 'save', 'message' => 'La cuenta se ha creado exitósamente']);
          }          
      }

      public function update_account(){
          $data = request()->all();
          $object = User::findOrFail($data['id']);
          $object->fill(request()->all());
          $object->save();  
          return response()->json(['status' => 'update', 'message' => 'La información se actualizó exitósamente']);       
      }

      public function create_address(){
          $data = request()->all();
          $object = new CustomerAddress;
          $object->customer_id = $data['customer_id'];
          $object->address =  $data['address'];
          $object->state_id =  $data['state_id'];
          $object->city_id =  $data['city_id'];
          $object->name_address =  $data['name_address'];
          if($data['principal']){            
            CustomerAddress::where('customer_id', auth()->id())->update(['principal' => 0]);
            $object->principal =  $data['principal'];
          }
          $object->save();
          if ($data['change_address_cart']) {
            $dataAddress = [
              'name_address' => $object->name_address,
              'address' => $object->address,
              'complement' => $object->complement,
              'state_id' => $object->state_id,
              'state' => $object->state->name,
              'city_id' => $object->city_id,
              'city' => $object->city->name,
              'name_person' => $object->name_person,
            ];
            Cart::setAddress($dataAddress);
          }
          $user = User::where('id', auth()->id())->with('address')->first();
          return response()->json(['status' => 'save', 'message' => 'La dirección se ha creado exitósamente', 'user' => $user]);          
      }
     
      public function update_address(){
          $data = request()->all();
          $object = CustomerAddress::findOrFail($data['id']);
          if($data['principal']){
            CustomerAddress::where('customer_id', auth()->id())->update(['principal' => 0]);
          }
          $object->fill(request()->all());
          $object->save();  
          $user = User::where('id', auth()->id())->with('address')->first();
          return response()->json(['status' => 'update', 'message' => 'La dirección se actualizó exitósamente', 'user' => $user]);       
      }

      public function delete_address($id){
          $address = CustomerAddress::findOrFail($id); 
          if ($address->principal) {
              CustomerAddress::where('customer_id', auth()->id())->where('id', '!=', $address->id)->limit(1)->update(['principal' => 1]);
          }
          $address->delete();
          $user = User::where('id', auth()->id())->with('address')->first();
          return response()->json(['status' => 'delete', 'message' => 'Se eliminó la dirección correctamente', 'user' => $user]);       
      }

      public function ax_change_password(){
          $data = request()->all();
          $user = User::find(auth()->id());
          if (Hash::check($data['current_password'], $user->password)){
            $user->change_password = 0;
            $user->password = $data['password'];
            $user->save();
            $response = ['status' => 'change', 'message' => 'Se cambió la contraseña exitósamente'];
          }else{
            $response = ['status' => 'error', 'message' => 'La contraseña actual no es correcta'];
          }
          return response()->json($response);       
      }

      public function ax_forgot_password(){
          $data = request()->all();
          $user =  User::where('email', $data['email'])->first();
          if ($user){ 
              $password_temporary = $this->getPasswordTemporary();
              $send =Mail::send(new ForgotPasswordMail($user, $password_temporary));
            if ($send ==  null) {
              $user = User::find($user->id);
              $user->change_password = 1;
              $user->password = $password_temporary;
              $user->save();
              $response = ['status' => 'send', 'message' => 'Se envió al correo ' . $this->getReplaceEmail($user->email)];
            }else{
              $response = ['status' => 'not_send', 'message' => 'Ocurrió un error al enviar el correo con la contraseña temporal'];
            }
           
          }else{
            $response = ['status' => 'error', 'message' => 'El correo electrónico no está registrado'];
          }
          return response()->json($response);       
      }

      public function order_item(){
        $data = request()->all();
        $item = OrderItem::with('product', 'item_devolution')->find($data['id']);
        return response()->json(['item' => $item]); 
      }

      public function create_review(){
        $data = request()->all();
        Review::create($data);
        OrderItem::find($data['_order_item_id'])->update(['has_review'  => 1, 'qualification' => $data['qualification']]);
        $order = Order::whereReference($data['_reference'])->with('items')->firstOrFail();
        return response()->json(['status' => 'save', 'message' => 'Su comentario del producto se ha guardado exitósamente', 'order' => $order]);  

      }

      public function create_devolution(){
        $data = request()->all();
        $object =  ProductDevolution::create($data);
        $object->update([
            'file' => \FlipUpload::save($data['_file'], 'productdevolution')
        ]);
        $devolution = Devolution::find($data['devolution_id']);
        $order_item = OrderItem::find($data['order_item_id']);
        $user = auth()->user();
        $file = $data['_file'];
        $data_mail['name_user'] = $user->name;
        $data_mail['document'] = $user->document;
        $data_mail['email'] = $user->email;
        $data_mail['phone'] = $user->phone;
        $data_mail['mobile'] = $user->mobile;
        $data_mail['name_product'] = $order_item->name;
        $data_mail['reference'] = $data['_reference'];
        $data_mail['codigo'] = $order_item->codigo_product;
        $data_mail['sku'] = $order_item->sku;
        $data_mail['devolution_name'] = $devolution->title;
        $data_mail['devolution_text'] = $data['text'];
        $data_mail['file'] = $file;
        Mail::send(new DevolutionShopMail($data_mail));
        Mail::send(new DevolutionCustomerMail($user));
        $order_item->update(['has_devolution'  => 1]);
        $order = Order::whereReference($data['_reference'])->with('items')->firstOrFail();
        return response()->json(['status' => 'save', 'message' => 'El proceso de devolución se ha iniciado satisfactoriamente', 'order' => $order]);  

      }

      private function getPasswordTemporary(){
        return Str::random(6);
      }

      private function getReplaceEmail($email){
        $mail_segments = explode("@", $email);
        $mail_segments[0] = substr($email,0,3).str_repeat("*", strlen($mail_segments[0]));
        $email = implode("@", $mail_segments);
        return $email;
      }
    
}
