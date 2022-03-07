@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow m-4">


                <form action="{{route('product.stats.search')}}" method="POST">
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
                            <button class="btn btn-success" type="submit">Rechercher</button>
                        </div>
                    </div>

        {{--        </form>--}}
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Products Order Lists</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($tops as $top)
                        <tr>
                            <td>{{ $top->product->title }}</td>

                            @php
                                $carts = \App\Models\Cart::where('product_id', $top->product_id )->where('order_id','!=',null)->get();
                                $count = 0;
                                $total = 0;
                                foreach ($carts as $cart){
                                    $count += $cart->quantity;
                                    $total += $cart->amount;
                                }

                            @endphp
                            <td>{{ $count }}</td>
                            <td>{{ $total }} DZA</td>
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
