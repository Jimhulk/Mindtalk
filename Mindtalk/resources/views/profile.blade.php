@extends('master')

@section('title', 'My Profile')

<style>
    .window{
        text-align:left;
        margin-left: 5em;
        margin-right: 5em;
    }
</style>

@section('content')
    <div class="window">
        <h2>My Profile</h2>
        <table>
            <tr>
                <td><strong>Name:</strong> {{ $data->fname }} {{ $data->lname }}</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> {{ $data->email }}</td>
            </tr>
            <tr>
                <td><strong>Username:</strong> {{ $data->username }}</td>
            </tr>
            <tr>
                <td><strong>Number of posts:</strong> {{ $data->num_posts }} </td>
            </tr>
        </table>
        <br>
        <form action=" {{ route('newPostPage') }} ">
            <button type="submit">Create new post</button>
        </form>

        <br>
        <h3>Recent Posts</h3>
        @foreach ($posts as $post)
        <li><a href="/Mindtalk/public/post/{{ $post->id }}/0" style="all: revert;"><strong>{{$post->title}}</strong></a> <br> 
            {{$post->content}} <br>
            Posted: {{$post->created_at}}<br>
            Comments: {{$post->comments}}
        </li>
        <!--<a href="message/{"{" $post->id }}">View</a>       --Its the route we do to fetch each post individually-->
        <hr>
        <br>
        @endforeach

        <div style="text-align: right;margin-bottom: 3em;">
            <?php
                $i = 0;
    
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $num = substr($actual_link, -1);
    
                if(count($all) > 5){
                    echo "Pages : ";
                    if( !(($num-1) == -1) ){
                        echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/myProfile/".($num-1)."\">"."<text> < </text>"."</a>";
                    }
        
                    while($i < (count($all)/5)){
                        //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".$i."\"> ".$i." </a>";
                        $i++;
                    }
        
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/myProfile/".(0)."\">"."<text> 0 </text>"."</a>";
                    //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($num-1)."\">"."<text> as </text>"."</a>";
                    echo "...";
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/myProfile/".($i-1)."\">"."<text> ".($i-1)." </text>"."</a>";
        
                    if( ($num+1) < $i ){
                        echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/myProfile/".($num+1)."\">"."<text> > </text>"."</a>";
                    }
                }

            ?>
            </div>

    </div>
@endsection