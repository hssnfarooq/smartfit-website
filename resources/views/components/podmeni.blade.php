<nav id="podmeni">

   <a href="javascript:;" onclick="podmeniOut()" style="position: absolute; top:30px; right:30px">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-x" viewBox="0 0 16 16">
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
      </svg>
   </a>
    @foreach($links as $link)
        @php
            if(!empty($link->description))
                $url = $link->description;
            else
                $url = $link->getRelated('page')->first()->slugBaza.'/'.$link->getRelated('page')->first()->slug;    
            
            if($url == '/home-page') $url = '/';
        @endphp
        
        <div class="list-group list-group-flush pm_linkovi" id="podmeni{{$link->id}}">
            <!--<a href="{{$url}}" class="list-group-item list-group-item-action list-group-item-success" style="margin-bottom: 50px">{{$link->title}}</a>-->

            <h3>{{$link->title}}</h3>

            @foreach ($link->getRelated('page')->first()->children as $podmeni)
                <a href="{{substr($podmeni->slug,0,1) != '/' ? '/' : ''}}{{$podmeni->slug}}" class="list-group-item list-group-item-action list-group-item-success">{{$podmeni->title}}</a>         
            @endforeach 
            @foreach ($link->children as $podmeni)
                @php
                if(!empty($podmeni->description))
                    $url = $podmeni->description;
                else
                    $url = $podmeni->getRelated('page')->first()->slugBaza.'/'.$podmeni->getRelated('page')->first()->slug;
                @endphp
                <a href="{{$url}}" class="list-group-item list-group-item-action list-group-item-success">{{$podmeni->title}}</a>
            @endforeach  
        </div>


    @endforeach

</nav>