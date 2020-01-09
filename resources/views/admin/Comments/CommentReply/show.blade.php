@extends("layouts.admin")

@section('content')


    @if(count($replies)>0)

        <h1>Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post Link</th>
                <th>Replies</th>

            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)


                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{str_limit($reply->body,40)}}</td>
                    <td><a href="{{route('home.post',$reply->comment->post->id)}}">View Post</a></td>
                    <td><a href="{{route('admin.Comments.CommentReply.show',$reply->id)}}">View Replies</a></td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::model($reply,['method'=>'PATCH', 'action'=> ['CommentRepliesController@update',$reply->id],'files'=>true]) !!}

                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}
                        @else

                            {!! Form::model($reply,['method'=>'PATCH', 'action'=> ['CommentRepliesController@update',$reply->id],'files'=>true]) !!}

                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}

                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminCommentsController@destroy',$reply->id],'files'=>true]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}
                    </td>


                </tr>

            @endforeach
            </tbody>
        </table>
    @else <h1 class="text-center">No Comments</h1>

    @endif
@stop