@extends('frontend.layout')
@section('content')
    <div class="entry-content">
        <div class="et_pb_section  et_pb_section_0 et_section_regular">


            <div class=" et_pb_row et_pb_row_0" style="background-color: #2a5294;">

                <div class="et_pb_column et_pb_column_4_4  et_pb_column_0">

                    <div class="et_pb_text et_pb_module et_pb_bg_layout_dark et_pb_text_align_center  et_pb_text_0">

                        <h3 style="text-align: center;"><span style="color: #ffffff;">Frequently Asked Questions</span>
                        </h3>

                    </div> <!-- .et_pb_text -->
                </div> <!-- .et_pb_column -->

            </div> <!-- .et_pb_row -->
            <div class=" et_pb_row et_pb_row_1">

                <div class="et_pb_column et_pb_column_4_4  et_pb_column_1">

                    <div class="et_pb_module et_pb_accordion  et_pb_accordion_0">
                        @foreach($faqs as $faq)
                        <div class="et_pb_module et_pb_toggle et_pb_toggle_open  et_pb_accordion_item_{{$faq->id}}">
                            <h5 class="et_pb_toggle_title">{{$faq->question}}</h5>
                            <div class="et_pb_toggle_content clearfix">
                                {!!  $faq->answer!!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
    
@endsection