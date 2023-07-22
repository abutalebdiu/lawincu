
@extends("master::layouts.app")

@push("head_tags")
<link rel="stylesheet" type="text/css" href="{{ asset('master/css/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('master/css/slick-theme.css') }}"/>
@endpush

@section("content")

<section class="main_section my-4">
    <div class="container-fluid">
        @foreach ($page_rows as $row)
            <div class="row-parent {{ $row->class_name }}">
                <p class="mb-0">Row: {{ $row->row_index }}</p>
                <div class="row">
                    @foreach ($row->columns as $column)

                        @php
                            $data = $column->{$column->data_type};
                        @endphp

                        <div class="col {{ $column->class_name }}">
                            <div class="border border-1 text-center">
                                <p class="mb-0">Column: {{ $column->column_index }}</p>
                                <p class="mb-0">Bootstrap Grid: col {{ $column->class_name }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center mt-3">
                        <a href="{{ route("page-columns.create", ["page_row_id" => $row->id]) }}" class="text-center btn btn-primary align-items-center">
                            <i class="fas fa-plus"></i>
                            <span class="mx-1"></span>
                            {{ __("Add Column") }}
                        </a>
                    </div>
                </div>
                <hr>
            </div>
        @endforeach
    </div>
</section>


<section class="new-arrivals-area my-4">
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <a href="{{ route("page-rows.create", ["page_id" => request('page_id')]) }}" class="text-center">
                    <div>
                        <i class="fas fa-plus" style="font-size: 30px"></i>
                    </div>
                    {{ __("Add Row") }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection


@push("body_scripts")
    <script type="text/javascript" src="{{ asset("master/js/slick.min.js") }}"></script>
    <script>
        $(document).ready(function() {
            $('.slider-carousel').slick({
                slidesToShow: 1,
                autoplay: false,
                dots: true,
                arrows: true,
                infinite: true,
                vertical: false,
                rtl: @json(session("lang_dir")) == 'rtl' ? true : false,
                rows: 1,
                centerPadding: "0px",
                centerMode: true,
                fade: true,
                slidesToScroll: 1,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ],
            });

        });
    </script>

<script>
    vdata = {
        ...vdata,
        featured_products: [],
        featured_string: ""
    }


    vmethods = {
        ...vmethods,
        async fetchFeaturedProducts(){
            try{

                const response = await axios.get("/api/v1/featured-products", {
                    headers: {
                        'X-Language': @json(session('language')),
                        'X-Currency': @json(session('currency')),
                    }
                });
                vdata.featured_products = response.data.data;

            }catch(err){
                console.log(err);
            }
        },


    }

    vcreated = {
        ...vcreated,
        // function key: function(){}
        run: function(){
            vmethods.fetchFeaturedProducts();
        }
    }

    vmounted = {
        ...vmounted,
        // function key: function(){}
    }
</script>


@endpush
