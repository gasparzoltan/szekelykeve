@extends('admin/main')

@section('content')

    <div class="">
        <div class="">
            <h3>Cikkek</h3>            
            <hr>        
                <?php 
      $df = round(disk_free_space("/var/www") / 1024 / 1024 / 1024);
      print("Free space: $df GB");
    ?>
    <hr>
    <?php 
        $uptime = shell_exec("uptime");
        echo $uptime;
    ?>
        </div>
        <div class="">
            <div class="row">
                <div class="col-xs-12">
                <ul class="nav nav-pills" role="tablist">
                    <li class="@if(!in_array(request('cat_id'), [1,2,3,4,5])) active @endif">
                        <a href="{{ route('admin.cikkek') }}" >
                            Összes <span class="badge" id="count-badge">{{ $articles_count }}</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <?php $r = Request::except(['cat_id', 'page']); ?>
                        <?php $r = array_merge($r, ['cat_id' => $category->id]); ?>                        
                        <li class="@if(request('cat_id') == $category->id) active @endif">
                            <a href="{{ route('admin.cikkek', $r) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>                     
                </div>               
            </div>  
            <hr>
            <div class="row" id="articles-list">
                <div class="col-xs-12">
                    @foreach($articles as $article)                    
                        <div class="row">
                            <div class="col-md-6"  id="article-wrap-{{$article->id}}">
                                <div class="panel panel-default card">
                                    <div class="panel-heading">
                                        <h5>{{ $article->title }}</h5>
                                    </div>
                                    <div class="panel-body">                                        
                                        <img src="/images/article/{{ $article->image }}" width="50%">
                                        <div>
                                            <small style="color: #006600">{{ $article->created_at  }}</small> - 
                                            <small class="label label-success label-xs">{{ $article->category->name }}</small>
                                        </div>
                                        @foreach($article->pictures as $i) 
                                            {{ $i->name }}
                                        @endforeach
                                    </div>
                                    <div class="panel-footer">
                                        <a 
                                            href="{{route('admin.cikk.szerkesztes', $article->key)}}" 
                                            class="btn btn-primary btn-sm btn-fill">Módosítás</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="btn btn-danger btn-sm btn-fill" @click.prevent="onShowDeleteDialog({{$article->id}})">Törlés</a>
                                        <div id="dialog-{{$article->id}}" style="display: none">
                                            <hr>
                                            <center>
                                                <h4><i class="fa fa-exclamation-triangle" style="color:red"></i> &nbsp;Biztosan törli a cikket?</h4>                                  
                                                <a 
                                                    class="btn btn-danger btn-sm"
                                                    @click.prevent="onDeleteArticle({{$article->id}}, '{{route('admin.cikk.torles', $article->id)}}')">&nbsp;&nbsp;&nbsp;IGEN&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;
                                                <a 
                                                    href="#" class="btn btn-sm"
                                                    @click.prevent="onHideDeleteDialog({{$article->id}})"><small>&nbsp;&nbsp;&nbsp;MÉGSEM&nbsp;&nbsp;&nbsp;</small></a>
                                            </center>  <br>                              
                                        </div>
                                    </div>
                                </div>                    
                            </div>
                        </div>                           
                    @endforeach                  
                </div>
             </div>
            <div class="row">
                <center>{{ $articles->appends(Request::except('page'))->links() }}</center>
            </div>            
        </div>  
       
    </div> 

@endsection

@push('javascript')
    <script type="text/javascript" src="{{ asset('dashboard/assets/js/articles-list.js') }}"></script>
@endpush