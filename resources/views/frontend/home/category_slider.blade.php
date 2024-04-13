<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                id="carausel-10-columns-arrows"></div>
        </div>

        @php
        $category_data = App\Models\Category::orderBy('category_name', 'ASC')->get(); 
        @endphp

        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">

               
                @foreach($category_data as $item)
                <div class="card-2 bg-12 wow animate__animated animate__fadeInUp" data-wow-delay="1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="/product/category/{{$item->id}}/{{$item->category_slug}}"><img src="{{ asset($item->category_image) }}"
                                alt="" /></a>
                    </figure>
                    <h6><a href="/product/category/{{$item->id}}/{{$item->category_slug}}">{{ $item->category_name }}</a></h6>

                    @php
                        $product = App\Models\Product::where('category_id', $item->id)->get();
                    @endphp



                    <span>{{ count($product) }} items</span>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
</section>
<!--End category slider-->