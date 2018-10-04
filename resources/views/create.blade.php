


@extends('layouts.master')


@section('content')

     <div class="col-sm-8 blog-main">


        <h1>Publish a post</h1>
        

        <form method="POST" action="/posts">

             @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>

                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "title"  >
                
                
                <small id="emailHelp" class="form-text text-muted">I hope it will be a great post</small>


            </div>


            <div class="form-group">


                <label for="exampleInputPassword1">Body</label>


                <textarea name="body"  rows="13" class="form-control" > </textarea>


            </div> 
        
            @include('layouts.errors')


            <button type="submit" class="btn btn-primary">Publish</button>


            </form>


     </div>

@endsection