<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label>Title</label>
                    {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter the Title']) !!}
                </div>

                <div class="form-group">
                    <label>Text</label>
                    {!! Form::textarea('text', null, ['class'=>'wysiwyg form-control']) !!}
                </div>

                <div class="form-group">
                    <label>Type of media</label>
                    <div class="radio">
                        <label>
                            {!! Form::radio('resource_type', 'image', true) !!} Image
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            {!! Form::radio('resource_type', 'youtube') !!} Video from YouTube
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Media</label>
                    {!! $article->media_object_tag !!}

                    <div class="media_upload_image" style="display: none">
                        {!! Form::file('image') !!}
                    </div>

                    <div class="media_youtube_link"  style="display: none">
                        {!! Form::text('youtube', $article->resource_type == 'youtube' ? $article->resource_path : null, ['class'=>'form-control', 'placeholder'=>'Link']) !!}
                    </div>
                </div>

            </div>
            <div class="box-footer">
                {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>