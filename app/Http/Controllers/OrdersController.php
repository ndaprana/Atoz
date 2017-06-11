<?php

namespace App\Http\Controllers;

use App\Home;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Order;
use Input;
use Validator;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prepaid()
    {
        
        $data['user'] = Auth::user();

        return view('prepaid')->with($data);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postPrepaid()
    {
        $data['user'] = Auth::user();
        $model = new Order;
        $validator = Validator::make(Input::all(), array(
                    'phone' => 'required|numeric|digits_between:7,12',
                    'value' => 'required'
        ));

        if ($validator->passes()) {
            $model->id_user = Auth::id();
            $model->id_order = $this->generateOrderId( 10 );
            $model->product = 'Prepaid Balance';
            $model->shipping = Input::get('phone');
            $model->value = Input::get('value');
            $model->price = Input::get('value') + (Input::get('value') * 5/100);
            $model->created_date = time();
            $model->status = 1;
            $model->save();
        } else {
            return redirect('/prepaid-balance')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($model){
            return redirect('/order/'.$model->id_order);
        } else {
            return redirect('/');
        }
    }

    function generateOrderId($length = 10) {
      $characters = '0123456789';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $data['user'] = Auth::user();

        return view('product')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postProduct()
    {
        $data['user'] = Auth::user();
        $model = new Order;
        $validator = Validator::make(Input::all(), array(
                    'product' => 'required|between:10,150',
                    'shipping' => 'required|between:10,150',
                    'value' => 'required|numeric'
        ));

        if ($validator->passes()) {
            $model->id_user = Auth::id();
            $model->id_order = $this->generateOrderId( 10 );
            $model->product = Input::get('product');
            $model->shipping = Input::get('shipping');
            $model->value = Input::get('value');
            $model->price = Input::get('value') + 10000;
            $model->created_date = time();
            $model->status = 1;
            $model->save();
        } else {
            return redirect('/product')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($model){
            return redirect('/order/'.$model->id_order);
        } else {
            return view('product')->with($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderSucccess($id)
    {
        if(!Auth::id()) return redirect( '/');

        $data['user'] = Auth::user();

        $data['order'] = Order::select('id_user','id_order','product', 'shipping', 'value', 'price', 'status', 'created_date')
                        ->where('id_user', Auth::id())->where('id_order', $id)->where('status', 1)->first();

        if($data['order']){
            return view('success')->with($data);
        } else {
            $data['message'] = 'Order Number not found';
            return view('success')->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderList()
    {
        if(!Auth::id()) return redirect( '/');

        $data['user'] = Auth::user();

        $data['order'] = Order::select('id_user','id_order','product', 'shipping', 'value', 'price', 'created_date', 'status', 'code')
                        ->where('id_user', Auth::id())->where('status', '!=' , 0)->orderBy('id', 'desc')->paginate(20);

        if($data['order']){
            return view('list')->with($data);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderPay($id = 0)
    {
        if(!Auth::id()) return redirect( '/');
        
        $data['user'] = Auth::user();

        $order = Order::select('id_user','id_order','product', 'shipping', 'value', 'price', 'created_date', 'code')
                        ->where('id_user', Auth::id())->where('id_order', $id)->where('created_date', '>=', strtotime("-5 Minutes", time()))->first();
        if(!isset($order)){
            $data['message'] = 'Order Failed';
            return view('success')->with($data);
        }

        $update = Order::where('id_user', Auth::id())->where('id_order', $id)
            ->update(['status' => 2]);

        if($order->product != 'Prepaid Balance'){
            $code = $this->shippingCode(8);
            $shipping = Order::where('id_user', Auth::id())->where('id_order', $id)
            ->update(['code' => $code]);
        }

        if($update == 1){
            return redirect('/order');
        } else {
            $data['message'] = 'Order Failed';
            return view('success')->with($data);
        }

    }

    function shippingCode($l = 8) {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderSearch()
    {
        if(!Auth::id()) return redirect( '/');

        $data['user'] = Auth::user();

        $data['order'] = Order::select('id_user','id_order','product', 'shipping', 'value', 'price', 'created_date', 'status', 'code')
                        ->where('id_user', Auth::id())->where('id_order', 'like', '%'.Input::get('order').'%')->where('status', '!=' , 0)->orderBy('id', 'desc')->paginate(20);

        if($data['order']){
            return view('list')->with($data);
        } else {
            $data['message'] = 'Order Number not found';
            return view('success')->with($data);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        if(!Auth::id()) return redirect( '/');
        
        $data['user'] = Auth::user();

        return view('payment')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderPayment()
    {
        if(!Auth::id()) return redirect( '/');
        
        $data['user'] = Auth::user();

        return redirect('/order/pay/'.Input::get('order'));
    }
}
