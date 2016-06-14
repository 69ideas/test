<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label>Question</label>
                    {!! Form::text('question', null, ['class'=>'form-control', 'placeholder'=>'Enter question']) !!}
                </div>

                <div class="form-group">
                    <label>Answer</label>
                    {!! Form::textarea('answer', null, ['class'=>'form-control', 'placeholder'=>'Type answer']) !!}
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    {!! Form::text('sort_order', null, ['class'=>'form-control', 'placeholder'=>'Enter sort order']) !!}
                </div>

            </div>
            <div class="box-footer">
                {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
                <a href="{{ route('admin.faq.index') }}" class="btn btn-primary"><i
                            class="fa fa-angle-double-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>