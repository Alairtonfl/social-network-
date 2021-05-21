@extends('layouts.app')


@section('profile')
<a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}">
    {{ __('Perfil') }}
</a>
@endsection


@section('content')

    <div class="container card" style="">
        <div class="container card mt-3 mb-3" style="border: 1px solid #2a2f32">

        <h1>{{ Auth::user()->name }}</h1>

        <form class="mt-1 mb-1" method="POST" action="{{Route('post.create')}}">
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="titlePost"  placeholder="Informe o assunto do seu post..">
                </div>

                <div class="form-group">
                <textarea class="form-control" name="post" placeholder="No que vc está pensando..." rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Publicar</button>

            </form>

        </div>

    </div>
     


<div class="container card mt-3 mb-3">
    @foreach ($posts as $post)
    @if ($post->id_user == Auth::user()->id)
    <div>
        <form style="" action="{{Route('post.destroy', $post)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este post?')" class=" btn btn-sm btn-danger float-right">DEL</button>
        </form>
    </div>
        
    @endif
    <div class="container card mt-1 mb-3" style="border: 1px solid #000000;">
        <h3><b> Assunto: {{$post->title}}</b>
         <small class="float-right text-secondary"> {{ date("d/m/Y H:i", strtotime( $post->created_at )) }}</small>
        </h3>
        <div>
            <img src="{{$post->user->avatar}}" alt="Avatar" style="border-radius: 50%; width: 50px;">
        <h6 class="text-primary d-inline">
        <b>
            <a href="{{Route('user.profile' , $post->user->id)}}"> Autor: {{$post->user->name}}</a>
        </b>
        </h6>
        </div>
        

        <h4>{{$post->body}}</h4>

        <span class="bg-primary text-white"><b> Comentarios </b></span>

        <div class="container card mb-1 mt-1">

            @foreach ($post->comments()->get() as $comment)
            <div class="container card mt-3">
                @if ($comment->id_user == Auth::user()->id)
                <form style="" action="{{Route('comment.destroy', $comment)}}" method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este comentario?')" class=" btn btn-sm btn-danger float-right">DEL</button>

                </form>
                @endif
                        <h4 class="text-primary"> 
                            <a href="{{ route('user.profile', $comment->user->id)}}"> <b> {{$comment->user->name}} </b></a>
                            <small class="float-right text-secondary"> {{ date("d/m/Y H:i", strtotime( $comment->created_at )) }}</small>
                        </h4>
                        <h5>{{$comment->comment}}</h5>
            </div>
            
            @endforeach
            </div>

            <form action="{{Route('comment.create', $post->id)}}" method="POST">
                @csrf
            <div class="input-group mb-1 mt-1">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-primary text-white" id="">Comente</span>
                </div>
                <input type="text" name="comment" class="form-control">
              </div>
            </form>
    </div>

    @endforeach
            {{$posts->links()}} 
</div>

<style>
    .w-5{
        display: none;
    }
</style>

@endsection
