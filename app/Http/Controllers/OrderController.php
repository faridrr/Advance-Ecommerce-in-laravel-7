<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = null;
        $orders = Order::orderBy('updated_at', 'desc')->get();
        return view('backend.order.index')->with('orders', $orders)->with('status', $status);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {


        $orders = Order::query();
        if ($request->start_at) {
            $orders = $orders->where('created_at', '>=', $request->start_at);
        }
        if ($request->end_at) {
            $orders = $orders->where('created_at', '<=', $request->end_at);
        }
        if ($request->status) {
            $orders = $orders->where('status', $request->status);
        }
        $orders = $orders->get();
        return view('backend.order.index')->with('orders', $orders)->with('status', $request->status)->with('start_at', $request->start_at)->with('end_at', $request->end_at);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('backend.order.create')->with('products', $products);
    }

    public function storeAdmin(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'address1' => 'string|required',
            'phone' => 'numeric|required',
        ]);




        $order = new Order();

        $last_id = Order::whereMonth('created_at', Carbon::now()->month)->latest()->count();
        $last_id = $last_id == 0 ? 1 : $last_id + 1;
        $order_data = $request->all();

        for ($i=1; $i <= 6; $i++){
            if ($request['file_' . $i]) {
                $file = time() . '-file-' . $i . '.' .$request['file_' . $i]->extension();
                $request['file_' . $i]->move(public_path('orders'), $file);
                $order_data['file_' . $i] = $file;
            }

        }

        $order_data['order_number'] = Carbon::now()->format('m') . '-' . str_pad($last_id, 4, '0', STR_PAD_LEFT);

        $order_data['user_id'] = Auth::id();
        $order_data['shipping_id'] = $request->wilaya;
        $shipping = ($request->shipping == null) ? 0 : $request->shipping;
        $order_data['sub_total'] = $request->price;
        $order_data['quantity'] = 1;

        if ($request->shipping) {
            $order_data['total_amount'] = $request->price + $shipping[0];
        } else {
            $order_data['total_amount'] = $request->price;
        }
        $order_data['status'] = $request->status;
        $order_data['payment_method'] = 'cod';
        $order_data['payment_status'] = 'Unpaid';
        $date = date('Y-m-d');
        switch ($request->status){
            case 'Prise de commande':
                $order_data['pri_commande'] = $date;
                break;
            case 'En Fabrication':
                $order_data['fabrication'] = $date;
                break;
            case 'Préparation Alger':
                $order_data['pre_alger'] = $date;
                break;
            case 'Livraison Alger':
                $order_data['liv_alger'] = $date;
                break;
            case 'Préparation Yalidine':
                $order_data['pre_yalidine'] = $date;
                break;
            case 'Livraison Yalidine':
                $order_data['liv_yalidine'] = $date;
                break;
            case 'Livré':
                $order_data['livre'] = $date;
                break;
            case 'Terminer':
                $order_data['terminer'] = $date;
                break;
            case 'Récup Magasin':
                $order_data['récup_magasin'] = $date;
                break;
            case 'Annuler':
                $order_data['annuler'] = $date;
                break;
            case 'Échouer':
                $order_data['echouer'] = $date;
                break;
            case 'Erreur':
                $order_data['erreur'] = $date;
                break;
            case 'Retour':
                $order_data['retour'] = $date;
                break;
        }


        $order->fill($order_data);
        $order->save();

        $cart = new Cart;
        $cart->text = $request->text;
        $cart->options = $request->options;
        $cart->price = $request->price;
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product;
        $cart->quantity = 1;
        $cart->variation = $request->color;
        $cart->taille = $request->size;
        $cart->amount = $request->price;
        $cart->order_id = $order->id;
        $cart->save();

        request()->session()->flash('success', 'Votre commande passée avec succès');
        return redirect()->route('order.index');
    }


        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public
        function store(Request $request)
        {
            $this->validate($request, [
                'first_name' => 'string|required',
                'last_name' => 'string|required',
                'address1' => 'string|required',
                'address2' => 'string|nullable',
                'coupon' => 'nullable|numeric',
                'phone' => 'numeric|required',
            ]);
            // return $request->all();

            if (empty(Cart::where('user_id', $request->session()->token())->where('order_id', null)->first())) {
                request()->session()->flash('error', 'Le panier est vide!');
                return back();
            }
            $session = $request->session()->token();


            $order = new Order();


            $last_id = Order::whereMonth('created_at', Carbon::now()->month)->latest()->count();
            $last_id = $last_id == 0 ? 1 : $last_id + 1;
            $order_data = $request->all();
            $order_data['order_number'] = Carbon::now()->format('m') . '-' . str_pad($last_id, 4, '0', STR_PAD_LEFT);

            $order_data['user_id'] = $session;
            $order_data['shipping_id'] = $request->shipping;
            $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
            // return session('coupon')['value'];
            $order_data['sub_total'] = Helper::totalCartPrice();
            $order_data['quantity'] = Helper::cartCount();
            if (session('coupon')) {
                $order_data['coupon'] = session('coupon')['value'];
            }
            if ($request->shipping) {
                if (session('coupon')) {
                    $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
                } else {
                    $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0];
                }
            } else {
                if (session('coupon')) {
                    $order_data['total_amount'] = Helper::totalCartPrice() - session('coupon')['value'];
                } else {
                    $order_data['total_amount'] = Helper::totalCartPrice();
                }
            }
            // return $order_data['total_amount'];
            $order_data['status'] = "Commande";

            if (request('payment_method') == 'paypal') {
                $order_data['payment_method'] = 'paypal';
                $order_data['payment_status'] = 'paid';
            } else {
                $order_data['payment_method'] = 'cod';
                $order_data['payment_status'] = 'Unpaid';
            }
            $order->fill($order_data);
            $status = $order->save();
            if ($order)
                // dd($order->id);
                $users = User::where('role', 'admin')->first();
            $details = [
                'title' => 'New order created',
                'actionURL' => route('order.show', $order->id),
                'fas' => 'fa-file-alt'
            ];
            Notification::send($users, new StatusNotification($details));
            if (request('payment_method') == 'paypal') {
                return redirect()->route('payment')->with(['id' => $order->id]);
            } else {
                session()->forget('cart');
                session()->forget('coupon');
            }
            Cart::where('user_id', $request->session()->token())->where('order_id', null)->update(['order_id' => $order->id]);

            // dd($users);
            request()->session()->flash('success', 'Votre commande passée avec succès');
            return redirect()->route('home');
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function show($id)
        {
            $order = Order::find($id);
            // return $order;
            return view('backend.order.show')->with('order', $order);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function edit($id)
        {
            $order = Order::find($id);
            return view('backend.order.edit')->with('order', $order);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request, $id)
        {
            $order = Order::find($id);
            $this->validate($request, [
                'status' => 'required'
            ]);
            $data = $request->all();
            // return $request->status;

            foreach ($order->cart as $cart) {
                $cart->status = $request->status;
                $cart->save();
            }

            $date = date('Y-m-d');
            switch ($request->status){
                case 'Prise de commande':
                    $data['pri_commande'] = $date;
                    break;
                case 'En Fabrication':
                    $data['fabrication'] = $date;
                    break;
                case 'Préparation Alger':
                    $data['pre_alger'] = $date;
                    break;
                case 'Livraison Alger':
                    $data['liv_alger'] = $date;
                    break;
                case 'Préparation Yalidine':
                    $data['pre_yalidine'] = $date;
                    break;
                case 'Livraison Yalidine':
                    $data['liv_yalidine'] = $date;
                    break;
                case 'Livré':
                    $data['livre'] = $date;
                    break;
                case 'Terminer':
                    $data['terminer'] = $date;
                    break;
                case 'Récup Magasin':
                    $data['récup_magasin'] = $date;
                    break;
                case 'Annuler':
                    $data['annuler'] = $date;
                    break;
                case 'Échouer':
                    $data['echouer'] = $date;
                    break;
                case 'Erreur':
                    $data['erreur'] = $date;
                    break;
                case 'Retour':
                    $data['retour'] = $date;
                    break;
            }

            $status = $order->fill($data)->save();
            if ($status) {
                request()->session()->flash('success', 'Successfully updated order');
            } else {
                request()->session()->flash('error', 'Error while updating order');
            }
            return redirect()->route('order.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            $order = Order::find($id);
            if ($order) {
                $status = $order->delete();
                if ($status) {
                    request()->session()->flash('success', 'Order Successfully deleted');
                } else {
                    request()->session()->flash('error', 'Order can not deleted');
                }
                return redirect()->route('order.index');
            } else {
                request()->session()->flash('error', 'Order can not found');
                return redirect()->back();
            }
        }

        public
        function orderTrack()
        {
            return view('frontend.pages.order-track');
        }

        public
        function productTrackOrder(Request $request)
        {
            // return $request->all();
            $order = Order::where('user_id', auth()->user()->id)->where('order_number', $request->order_number)->first();
            if ($order) {
                if ($order->status == "new") {
                    request()->session()->flash('success', 'Your order has been placed. please wait.');
                    return redirect()->route('home');

                } elseif ($order->status == "process") {
                    request()->session()->flash('success', 'Your order is under processing please wait.');
                    return redirect()->route('home');

                } elseif ($order->status == "delivered") {
                    request()->session()->flash('success', 'Your order is successfully delivered.');
                    return redirect()->route('home');

                } else {
                    request()->session()->flash('error', 'Your order canceled. please try again');
                    return redirect()->route('home');

                }
            } else {
                request()->session()->flash('error', 'Invalid order numer please try again');
                return back();
            }
        }

        // PDF generate
        public
        function pdf(Request $request)
        {
            $order = Order::getAllOrder($request->id);
            // return $order;
            $file_name = $order->order_number . '-' . $order->first_name . '.pdf';
            // return $file_name;
            $pdf = PDF::loadview('backend.order.pdf', compact('order'));
            return $pdf->download($file_name);
        }

        // Income chart
        public
        function incomeChart(Request $request)
        {
            $year = \Carbon\Carbon::now()->year;
            // dd($year);
            $items = Order::with(['cart_info'])->whereYear('created_at', $year)->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->created_at)->format('m');
                });
            // dd($items);
            $result = [];
            foreach ($items as $month => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($month);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }

        public
        function incomeChart1(Request $request)
        {
            $year = \Carbon\Carbon::now()->year;
            // dd($year);
            $items = Order::with(['cart_info'])->whereYear('updated_at', $year)->where('status', 'Livré')->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->created_at)->format('m');
                });
            // dd($items);
            $result = [];
            foreach ($items as $month => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($month);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }

        public
        function incomeChart2(Request $request)
        {
            $year = \Carbon\Carbon::now()->year;
            // dd($year);
            $items = Order::with(['cart_info'])->whereYear('updated_at', $year)->where('status', 'Annuler')->orwhere('status', 'Retour')->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->created_at)->format('m');
                });
            // dd($items);
            $result = [];
            foreach ($items as $month => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($month);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthName = date('F', mktime(0, 0, 0, $i, 1));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }

        public
        function incomeChartMonth($month)
        {
            $year = \Carbon\Carbon::now()->year;
            $dt = "$year-$month-01";
            $last_day = date("t", strtotime($dt));
            $items = Order::with(['cart_info'])->whereMonth('created_at', $month)->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->created_at)->format('d');
                });
            $result = [];
            foreach ($items as $day => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($day);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= $last_day; $i++) {
                $monthName = date('d', mktime(0, 0, 0, 0, $i));
                $data['     ' . $monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }

        public
        function incomeChartMonth1($month)
        {
            $year = \Carbon\Carbon::now()->year;
            $dt = "$year-$month-01";
            $last_day = date("t", strtotime($dt));
            $items = Order::with(['cart_info'])->whereMonth('updated_at', $month)->where('status', 'Livré')->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->updated_at)->format('d');
                });
            $result = [];
            foreach ($items as $day => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($day);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= $last_day; $i++) {
                $monthName = date('d', mktime(0, 0, 0, 0, $i));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }

        public
        function incomeChartMonth2($month)
        {
            $year = \Carbon\Carbon::now()->year;
            $dt = "$year-$month-01";
            $last_day = date("t", strtotime($dt));
            // dd($year);
            $items = Order::with(['cart_info'])->whereMonth('updated_at', $month)->where('status', 'Annuler')->orwhere('status', 'Retour')->get()
                ->groupBy(function ($d) {
                    return \Carbon\Carbon::parse($d->updated_at)->format('d');
                });
            $result = [];
            foreach ($items as $day => $item_collections) {
                foreach ($item_collections as $item) {
                    $amount = $item->cart_info->sum('amount');
                    // dd($amount);
                    $m = intval($day);
                    // return $m;
                    isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
                }
            }
            $data = [];
            for ($i = 1; $i <= $last_day; $i++) {
                $monthName = date('d', mktime(0, 0, 0, 0, $i));
                $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
            }
            return $data;
        }
    }
