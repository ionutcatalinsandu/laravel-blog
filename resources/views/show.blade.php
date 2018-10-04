



@extends('layouts.master') 


@section('content')

    <div class="col-sm-8 blog-main">

        
        <h1>  {{$post->title }} </h1> 

        @if( count($post->tags)) 

            <ul>
                @foreach ( $post->tags as $tag ) 

                    <li> <a href = "/posts/tags/{{$tag->name}}">
                    
                        {{ $tag->name  }}  
                
                    </a> </li>

                @endforeach 

            </ul>

        @endif

        <p> 

            {{$post->body}}

        </p> 

        <br> 



        <ul class="list-group"> 

            @foreach( $post->comments as $comment)
            
                <li class="list-group-item"> 
                    
                    <strong>  {{ $comment->created_at->diffForHumans() }} </strong> 
                    
                    &nbsp; - &nbsp; 
                    
                    
                    @if( $comment->user )

                           <strong> {{ $comment->user->name }}   </strong> 

                    @else 
                          <strong>   {{ 'Guest' }}  </strong>
                        
                    @endif 

                    :

                    
                    {{ $comment->body }}
                    
                </li>

            @endforeach 


        </ul>

        <hr> 

        <div class="card">     

            <div class ="card-block"> 

                <form method="POST" action="/posts/{{$post->id}}/comments" class="form-group"  required>
                    @csrf
                    <div class="form-group">

                       <textarea class="form-control" name="body" placeholder="Your comment here" ></textarea> 

                    </div> 

                    <div class="form-group">

                            <button type="submit" class="btn btn-primary">Add Comment</button>

                    </div>

                </form>

            </div>

        </div> 

         @include('layouts.errors')

    </div>

@endsection


