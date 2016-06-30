<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label>Name</label>
                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    {!! Form::text('sort_order', null, ['class'=>'form-control', 'placeholder'=>'Enter Sort Order']) !!}
                </div>
                <div class="form-group">
                    <label>Image</label><br>
                    @if (!empty($photo->image))
                        <img src="/{{$photo->image}}" alt="Current Image"/>
                    @endif
                    <div class="row">
                        &nbsp;
                    </div>
                    {!! Form::file('image') !!}
                </div>
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