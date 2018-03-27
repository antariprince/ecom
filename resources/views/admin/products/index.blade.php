@extends('layouts.app')

@section('content')

<a href="{{ route('products.create') }}" class="form-control btn btn-primary">Create a new products</a><br><br>
    <div class="panel panel-default">
        <div class="panel-heading text-center">Published posts</div>
        <div class="panel-body">

    <table class="table table-hover">
        <thead>
            <th>
                Image
            </th>

            <th>
                Name
            </th>

            <th>
                Price
            </th>

            <th>
                Edit
            </th>
            <th>
                Trash
            </th>
        </thead>
        <tbody>
            @if($products->count() > 0)
            @foreach($products as $p)
                <tr>
                    <td>
                        <img src="{{ $p->image }}" alt="{{ $p->name }}" width="90px">
                    </td>
                    <td>
                        {{ $p->name }}
                    </td>

                    <td>
                        {{ $p->price }}
                    </td>

                    <td>
                        <a href="{{ route('products.edit',['id' => $p->id]) }}" class="btn btn-xs btn-info">
                            Edit
                        </a>
                        
                    </td>


                    <td>

                        <form action="{{ route('products.destroy',['product' => $p->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-xs btn-danger" type="submit">DELETE</button>

                        </form>
                        
                    </td>
                    
                </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">No published posts</td>
            </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
@stop