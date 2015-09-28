@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br>
        <a href="{{route('admin.orders.create')}}" class="btn btn-default">Nova Pedido</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->client->name}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->status}}</td>
                    <td>{{$order->total}}</td>
                    <td>
                        <a href="{{route('admin.orders.edit', ['id'=> $order->id])}}" class="btn btn-default">Editar</a>
                        <a href="{{route('admin.orders.itens.index', ['id'=> $order->id])}}" class="btn btn-default">Itens</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        {!! $orders->render() !!}

    </div>
@stop()