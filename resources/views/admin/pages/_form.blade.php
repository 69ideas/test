<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                </div>
                <div class="form-group">
                    <label>Text</label>
                    {!! Form::textarea('content', null, ['class'=>'wysiwyg-admin form-control', 'placeholder'=>'Enter Text']) !!}
                </div>
                <div class="form-group">
                    <label>Category Meta Title</label>
                    {!! Form::text('seo_title', null, ['class'=>'form-control', 'placeholder'=>'Enter Meta Title']) !!}
                </div>
                <div class="form-group">
                    <label>Category Meta Description</label>
                    {!! Form::text('seo_description', null, ['class'=>'form-control', 'placeholder'=>'Enter Meta Description']) !!}
                </div>
                <div class="form-group">
                    <label>Category Keywords</label>
                    {!! Form::text('seo_keywords', null, ['class'=>'form-control', 'placeholder'=>'Enter Keywords']) !!}
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    {!! Form::text('sort_order', null, ['class'=>'form-control', 'placeholder'=>'Enter sort order']) !!}
                </div>
                <div class="form-group">
                    <label>Brief</label>
                    {!! Form::text('brief', null, ['class'=>'form-control', 'placeholder'=>'Enter brief']) !!}
                </div>
                <div class="form-group">
                    <label>Parent</label>
                    {!! Form::select('parent_id',$pages, null,['class'=>"form-control"])!!}
                </div>
                <div class="form-group">
                    {!!  Form::checkbox('manage_pages') !!} Show on menu?
                </div>
                <div class="form-group">
                    {!!  Form::checkbox('on_top') !!} Show on top menu?
                </div>
                <div class="form-group">
                    {!!  Form::checkbox('on_bottom') !!} Show on bottom menu?
                </div>
                <div class="form-group">
                    <label>Menu name</label>
                    {!! Form::text('menu_name', null, ['class'=>'form-control', 'placeholder'=>'Enter menu name']) !!}
                </div>
                @if ((! isset($page->seo_url)))
                    <div class="form-group">
                        <label>Seo URL</label>
                        {!! Form::text('seo_url', null, ['class'=>'form-control', 'placeholder'=>'Enter SEO URL']) !!}
                    </div>
                @endif
            </div>
            <div class="box-footer">
                {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.page.index') }}" class="btn btn-primary"><i
                            class="fa fa-angle-double-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>