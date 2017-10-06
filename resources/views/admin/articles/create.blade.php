@extends('admin/main')

@section('content')
<div id="createArticleWrapper">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" v-cloak>
             <form 
                method="POST"                 
                @submit.prevent="saveArticle('{{route('admin.save.article', $key)}}')"
                id="frmArticle">
                <div class="card">
                    
                    <div class="header">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 class="title">Új cikk szerkesztése</h4>
                            </div>
                            <div class="col-xs-6" style="text-align: right">
                                <input 
                                    type="checkbox" 
                                    name="status" 
                                    data-on-text="Aktív" 
                                    data-off-text="Piszkozat"
                                    data-size="mini"                                
                                    @if($article->published_at != null) checked @endif>                                                 
                            </div>
                        </div>          
                    </div>
                    <div class="content">
                         

                    	 
                        <input type="hidden" name="key" value="{{$key}}" id="key">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Cím</label>

                                    
                                   
                                    <input 
                                        name="title"                                        
                                        type="text" 
                                        autocomplete="off" 
                                        class="form-control" 
                                        placeholder="Cím"
                                        value="{{$article->title}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Tartalom</label>
                                    
                                    <textarea 
                                        name="content" 
                                        class="form-control" 
                                        placeholder="Tartalom"
                                        id="txtContent"
                                        rows="20">{{$article->content}}</textarea>
                                </div>
                            </div>
                        </div>                    

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kategória</label>
                                    
                                    <select 
                                        name="category_id"
                                        class="form-control">
                                    	<option value="0">Kategória</option>
                                    	@foreach($categories as $category)
                                    		<option 
                                                value="{{ $category->id }}"
                                                @if($category->id == $article->category_id) selected @endif>{{ $category->name }}</option>
                                    	@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>    

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <input 
                                            type="checkbox" 
                                            name="highlighted" 
                                            @if($article->highlighted == 1) checked @endif> Kiemelt cikk
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-danger" v-if="hasErrors">
                                    <ul>
                                        <li v-for="error in errorMessages">@{{error}}</li>
                                    </ul>
                                </div>
    			                <div class="form-group">                               
    			                    <button 
    			                    	type="submit" 
    			                    	class="btn btn-info btn-fill pull-right"
                                        v-if="!uploadStarted">
    			                    	Mentés
    			                    </button>
    			                    <div class="clearfix"></div>
    			                </div> 
                            </div>
                        </div>                                    
                        
                    </div>
                </div>
            </form>
        </div>  
    </div>
    <div class="row">
        <div class="col-xs-12"  v-cloak>
            <div class="card" style="background: #ededed">
                <div class="content">
                    <form 
                        @submit.prevent="onUploadImages('{{route('admin.upload.images', $key)}}')" 
                        method="POST"
                        id="frmUpload"
                        enctype="multipart/form-data">          
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group"> 
                                    <input type="hidden" name="key" value="{{$key}}">  
                                    <input 
                                        type="hidden" 
                                        id="getImagesRoute" 
                                        value="{{route('admin.get.images', $key)}}">  

                                    <div style="padding-bottom: 20px">
                                        <label @click.prevent="getImages">Fényképek</label>
                                    </div>                             
                                    <input 
                                        v-if="!uploadStarted" 
                                        type="file" 
                                        name="images[]" 
                                        id="images" 
                                        multiple> 
                                        <p v-if="uploadStarted"><strong>Feltöltés folyamatban...</strong></p>                         
                                </div> 
                                <div>
                                    <button 
                                        v-if="!uploadStarted" 
                                        class="btn btn-primary btn-sm btn-fill" 
                                        type="submit">Feltöltés indítása</button>                            
                                </div>

                                <div class="progress" v-if="uploadStarted">
                                    <div 
                                        class="progress-bar progress-bar-info progress-bar-striped" 
                                        role="progressbar"
                                        aria-valuenow="50" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100" 
                                        :style="{ width: uploadProgress + '%'}">
                                        @{{Math.round(uploadProgress)}} %
                                    </div>
                                </div>                                                  
                            </div>
                        </div>          
                    </form>
                </div>            
            </div>       
        </div>        
    </div>
    <div class="row">
        
        <div id="imagesWrapper" style="padding: 15px; background: #f9f9f9" v-html="imagesHtml"></div>
       
    </div>
</div>
@endsection

@push('javascript')
	<script type="text/javascript" src="{{ asset('dashboard/assets/js/create-article.js') }}"></script>
    <script>tinymce.init({
    selector: "#txtContent",
    plugins: "image table",   
    language: 'hu_HU',
    forced_root_block : "",
    force_p_newlines : false,
    /*menubar: 'edit format table',    */

    style_formats_merge: true,
    style_formats: [
    {
        title: 'Kép balra',
        selector: 'img',
        styles: {
            'float': 'left', 
            'margin': '0 10px 0 10px'
        }
     },
     {
         title: 'Kép jobbra',
         selector: 'img', 
         styles: {
             'float': 'right', 
             'margin': '0 0 10px 10px'
         }
     }
    ],
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});</script>
@endpush