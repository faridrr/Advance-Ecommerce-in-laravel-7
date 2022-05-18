@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow m-4">


        <form action="{{route('order.search')}}" method="POST">
            @csrf
            <div class="row m-2">
                <div class="col-md-12">
                    @include('backend.layouts.notification')
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        @php $max = Date('Y-m-d') @endphp
                        <input @if(isset($start_at)) value="{{ $start_at }}" @endif  class="form-control" type="date" name="start_at" id="start_at">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input  @if(isset($end_at)) value="{{ $end_at }}" @endif  class="form-control" type="date" name="end_at" id="end_at">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select name="status" id="" class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="Prise de commande" {{(($status=='Prise de commande')? 'selected' : '')}}>Prise de commande</option>
                            <option value="En Fabrication" {{(($status=='En Fabrication')? 'selected' : '')}}>En Fabrication</option>
                            <option value="Préparation Alger" {{(($status=='Préparation Alger')? 'selected' : '')}}>Préparation Alger</option>
                            <option value="Livraison Alger" {{(($status=='Livraison Alger')? 'selected' : '')}}>Livraison Alger</option>
                            <option value="Préparation Yalidine" {{(($status=='Préparation Yalidine')? 'selected' : '')}}>Préparation Yalidine</option>
                            <option value="Livraison Yalidine" {{(($status=='Livraison Yalidine')? 'selected' : '')}}>Livraison Yalidine</option>
                            <option value="Livré" {{(($status=='Livré')? 'selected' : '')}}>Livré</option>
                            <option value="Terminer" {{(($status=='Terminer')? 'selected' : '')}}>Terminer</option>
                            <option value="Récup Magasin" {{(($status=='Récup Magasin')? 'selected' : '')}}>Récup Magasin</option>
                            <option value="Annuler" {{(($status=='Annuler')? 'selected' : '')}}>Annuler</option>
                            <option value="Échouer" {{(($status=='Échouer')? 'selected' : '')}}>Échouer</option>
                            <option value="Erreur" {{(($status=='Erreur')? 'selected' : '')}}>Erreur</option>
                            <option value="Retour" {{(($status=='Retour')? 'selected' : '')}}>Retour</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <select name="selected">
                            <option value="">--Select Product--</option>

                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{(( $selected == $product->id) ? 'selected' : '')}}>{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </div>
            </div>

        </form>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
            <a href="{{ route('order.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Charge</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Commande</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Order No.</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Charge</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Commande</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($orders as $order)
                            @php
                                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                            @endphp
                            <tr @if($order->status=='Prise de commande')
                                style="background-color: aliceblue"
                                @elseif($order->status=='En Fabrication')
                                style="background-color: antiquewhite"
                                @elseif($order->status=='Préparation Alger')
                                style="background-color: bisque"
                                @elseif($order->status=='Livraison Alger')
                                style="background-color: darkseagreen"
                                @elseif($order->status=='Préparation Yalidine')
                                style="background-color: whitesmoke"
                                @elseif($order->status=='Livraison Yalidine')
                                style="background-color: thistle"
                                @elseif($order->status=='Livré')
                                style="background-color: #3fa571"
                                @elseif($order->status=='Terminer')
                                style="background-color: #76b776"
                                @elseif($order->status=='Récup Magasin')
                                style="background-color: #607d8b"
                                @elseif($order->status=='Annuler')
                                style="background-color: lightgray"
                                @elseif($order->status=='Échouer')
                                style="background-color: lightgray"
                                @elseif($order->status=='Erreur')
                                style="background-color: #ff5747b3"
                                @elseif($order->status=='Retour')
                                style="background-color: darkgoldenrod"
                                @endif>
                                <td>{{$order->order_number}}-{{$order->first_name}}-{{$order->last_name}}</td>
                                <td>
                                    {{$order->first_name}} {{$order->last_name}}
                                    <br>
                                    {{$order->phone}}
                                    <br>
                                    {{$order->shipping->type}}
                                    <br>
                                    {{$order->address1}}

                                </td>
                                <td>{{$order->quantity}}</td>
                                <td>
                                    @foreach($shipping_charge as $data) {{number_format($data,2)}} DZD @endforeach
                                </td>
                                <td>{{number_format($order->total_amount,2)}} DZD</td>
                                <td>
                                    @if($order->status=='Prise de commande')
                                        <span class="badge badge-success">{{$order->status}}</span>
                                    @elseif($order->status=='En Fabrication')
                                        <span class="badge badge-warning">{{$order->status}}</span>
                                    @elseif($order->status=='Préparation Alger')
                                        <span class="badge badge-primary">{{$order->status}}</span>
                                    @elseif($order->status=='Livraison Alger')
                                        <span class="badge badge-primary">{{$order->status}}</span>
                                    @elseif($order->status=='Préparation Yalidine')
                                        <span class="badge badge-info">{{$order->status}}</span>
                                    @elseif($order->status=='Livraison Yalidine')
                                        <span class="badge badge-info">{{$order->status}}</span>
                                    @elseif($order->status=='Livré')
                                        <span class="badge badge-dark">{{$order->status}}</span>
                                    @elseif($order->status=='Terminer')
                                        <span class="badge badge-secondary">{{$order->status}}</span>
                                    @elseif($order->status=='Récup Magasin')
                                        <span class="badge badge-light">{{$order->status}}</span>
                                    @elseif($order->status=='Annuler')
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @elseif($order->status=='Échouer')
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @elseif($order->status=='Erreur')
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @elseif($order->status=='Retour')
                                        <span class="badge badge-danger">{{$order->status}}</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d-m-Y h:i') }}</td>
                                <td>
                                    <a href="{{route('order.show',$order->id)}}"
                                       class="btn btn-warning btn-sm float-left mr-1"
                                       style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                       title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('order.edit',$order->id)}}"
                                       class="btn btn-primary btn-sm float-left mr-1"
                                       style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                       title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn"
                                                data-id={{$order->id}} style="height:30px;width:30px;border-radius:50%"
                                                data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }
        td {
            color: black;
        }
    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>

        $('#order-dataTable').DataTable({
            "columnDefs": [
                {
                    "orderable": false,
                }
            ],
            "ordering": false,
            "pageLength": 50
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function (e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
