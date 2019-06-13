@extends('adminlte::page')

@section('content')

        <div class="d-flex justify-content-end">
           
            <a href="{{ route('posts.create')}}" class="btn btn-success float-right ">
                 Add Posts
            </a>
        </div>

        <div class="card card-default">
            <div class="card card-header">
                 
            </div>
            <div class="card card-body">
                @if($posts->count()>0)
                <table class="table" id="post">
                     <thead>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th></th>
                        
                     </thead>
                        @foreach($posts as $post)
                     <tbody>
                    <tr>
                        <td>{{ $post->title}}</td>
                        <td>
                          <img src="{{ asset($post->image) }}" alt="" width="90px">
                        </td>
                        <td>{{ $post->category->name}}</td>
                       @if($post->trashed())
                        <td>
                            <form action="{{ route('restore-posts', $post->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info btn-sm"> RESTORE </button>
                            </form>
                        </td>
                        @else
                       @can('update', $post)
                        <td>
                            <a href=" {{ route('posts.edit', $post->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            @endcan

                            @can('delete', $post)
    
                            <form onsubmit="return confirm('Are you sure you want to delete?')" action="{{ route('posts.destroy' ,$post->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i></button>
                            </form>
                            @endcan
                        </td>
                      
                       @endif
                      
                    </tr>
                @endforeach
             </tbody>
         </table>
                @else
                <h3 class="text-center">
                    No Post Yet
                </h3>
                @endif
            </div>
        </div>

@endsection

@section('scripts')
<script>
 $(function () {
$("#post").DataTable();
});
</script>
@endsection