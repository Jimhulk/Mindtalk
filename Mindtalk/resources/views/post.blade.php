@extends('master')

@section('title', $post->title)

<style>
    .window, .replies, .reply{
        text-align:left;
        margin-left: 5em;
        margin-right: 5em;
    }
</style>

@section('content')
    <div class="window">
        <h1>Topic :</h1>
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <u>Author: <a href="/Mindtalk/public/profile/{{ $post->publisher }}/0" style="all: revert;">{{$post->publisher}}</u></a> <br>
        {{ $post->created_at }}<br>
        <?php
            if($data == null){

            }else if( ($data->username == $post->publisher) || ($data->id == 1) ){
                echo "<a href=\"/Mindtalk/public/delete/".$post->id."\">Delete</a>";
                //echo " <a href=\"/Mindtalk/public/edit/".$post->id."\">Edit</a>";
            }
        ?>
        <br>
        <hr>
    </div>

    <br>

    <div class="reply">
        <strong>Post a reply</strong> 
        <form id="form" action="/Mindtalk/public/reply/{{ $post->id }}" method="POST">
            {{csrf_field()}}
            <textarea rows="10" cols="84" name="content" form="form" placeholder="Enter text here..." required></textarea>
            <br>
            <button type="submit" style="margin-left: 43.5em">Submit</button>
        </form>
    </div>

    <br>
    <br>

    <div class="replies" style="">
        <h3>Comments :</h3>
        @foreach ($replies as $reply)
            <li><a href="/Mindtalk/public/profile/{{ $reply->publisher }}/0" style="all: revert;"><u><strong>{{$reply->publisher}}</a> said:</strong></u> <br> 
                {{$reply->content}} <br><br>
                Posted: {{$reply->created_at}}
            </li>
            <!--<a href="post/{'{' $post->id }}">View</a>     --Its the route we do to fetch each post individually-->
            <?php
                if($data == null){

                }else if( ($data->username == $reply->publisher) || ($data->id == 1) ){
                    echo "<a href=\"/Mindtalk/public/deleteCom/".$reply->id."/".$post->id."\">Delete</a>";
                    //echo " <a href=\"/Mindtalk/public/edit/".$post->id."\">Edit</a>";
                }
            ?>
            <hr>
            <br>
        @endforeach
    </div>

    <br>
    <br>

    <div style="text-align: right;margin-bottom: 3em;margin-right: 5em;">
        <?php
            $i = 0;

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $num = substr($actual_link, -1);

            if(count($all) > 5){
                echo "Pages : ";
                if( !(($num-1) == -1) ){
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/post/".$post->id."/".($num-1)."\">"."<text> < </text>"."</a>";
                }

                while($i < (count($all)/5)){
                    //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".$i."\"> ".$i." </a>";
                    $i++;
                }

                echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/post/".$post->id."/0\">"."<text> 0 </text>"."</a>";
                //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($num-1)."\">"."<text> as </text>"."</a>";
                echo "...";
                echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/post/".$post->id."/".($i-1)."\">"."<text> ".($i-1)." </text>"."</a>";

                if( ($num+1) < $i ){
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/post/".$post->id."/".($num+1)."\">"."<text> > </text>"."</a>";
                }
            }

        ?>
        </div>

    @if(Session::has('success'))
		<div>{{Session::get('success')}}</div>
	@endif
	@if(Session::has('fail'))
		<div>{{Session::get('fail')}}</div>
	@endif
@endsection