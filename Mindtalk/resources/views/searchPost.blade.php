@extends('master')

@section('title', 'Search Post')

<style>
    .window{
        text-align:left;
        margin-left: 5em;
        margin-right: 5em;
    }
    .replies{
        /*background-color: white;
        margin-right: 5em;
        padding-right: 50px;
        padding-left: 25px;
        padding-top: 25px;
        padding-bottom: 25px;*/
    }
</style>

@section('content')
    <form action=" {{ url('/searchPost/filter/0') }} " method="POST">
        {{csrf_field()}}
        Filter: <input type="text" name="filter"> <button type="submit">Submit</button>
    </form>

    <div class="window">
        <h2>Recent Posts : {{ count($all) }} </h2>
        <br>
        @foreach ($posts as $post)
            <div class="replies">
                <li><a href="/Mindtalk/public/post/{{ $post->id }}/0" style="all: revert;"><strong>{{$post->title}}</strong></a> <br>
                    {{$post->content}} <br><br>
                    <u>Author: <a href="/Mindtalk/public/profile/{{ $post->publisher }}/0" style="all: revert;">{{$post->publisher}}</a></u> <br>
                    Posted: {{$post->created_at}}<br>
                    Comments: {{$post->comments}}
                    <hr>
                    <br>
                </li>
            </div>
            <!--<a href="post/{'{' $post->id }}">View</a>     --Its the route we do to fetch each post individually-->
        @endforeach

        <div style="text-align: right;margin-bottom: 3em;">
        <?php
            $i = 0;

            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $num = substr($actual_link, -1);

            if(count($all) > 5){
                echo "Pages : ";
                if( !(($num-1) == -1) ){
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($num-1)."\">"."<text> < </text>"."</a>";
                }

                while($i < (count($all)/5)){
                    //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".$i."\"> ".$i." </a>";
                    $i++;
                }

                echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".(0)."\">"."<text> 0 </text>"."</a>";
                //echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($num-1)."\">"."<text> as </text>"."</a>";
                echo "...";
                echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($i-1)."\">"."<text> ".($i-1)." </text>"."</a>";

                if( ($num+1) < $i ){
                    echo "<a style=\"all: revert;\" href=\"/Mindtalk/public/searchPost/".($num+1)."\">"."<text> > </text>"."</a>";
                }
            }
        ?>
        </div>

    </div>
@endsection