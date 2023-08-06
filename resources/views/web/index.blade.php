@php
    $locale = app()->getLocale();
@endphp
@extends('web.layouts.app')
@section('title', __('homepage.homepage'))
@section('content')


    <section class="py-5 pages-banner" style="background-image: url({{ asset('uploads/sliders/slider-01.png') }})">
        <div class="container">
            <div class="row">
                <div class="slider-content my-md-5">
                    <h1>To Get Tax Solution in <br> Tax Incubator</h1>
                    <p class="col-12 col-md-6">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima incidunt magni similique vero
                        voluptatibus ratione voluptatem, veniam a sequi in omnis corrupti, at facere perspiciatis harum
                        nobis? Fugiat, sed impedit?</p>
                    <a href="" class="btn btn-info">Get Free Consultation</a>
                </div>
            </div>
        </div>
    </section>


    <section class="py-2 my-5">
        <div class="container">
            <div class="row px-5 searchingdiv py-4">
                <div class="agency-search d-md-flex mx-auto">
                    <select name="" id="" class="form-select  py-3">
                        <option value="">Advisor</option>
                    </select>
                    <select name="" id="" class="form-select py-3">
                        <option value="">Location</option>
                    </select>
                    <input type="text" class="form-control py-3">
                    <button class="btn btn-info text-white py-3">Search</button>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/radio.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Radio Consultancy</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/jone.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Jane Cooper</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/russel.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Dianne Russell</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image.png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Devon Lane</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (1).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Kristin Watson</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (2).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Courtney Henry</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (3).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Robert Fox agency</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (4).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Bessie Cooper</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (5).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Robert Fox</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (6).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Devon Lane</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (7).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Dianne Russell</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-5">
                    <div class="agency">
                        <div class="card border-0">
                            <img src="{{ asset('uploads/agency/image (8).png') }}" class="card-img-top" alt="">
                            <div class="card-body px-0">
                                <h4>Radio Consultancy</h4>
                                <p>Personal Legal Advisor, Corporate Tax Specialist</p>
                            </div>
                            <div class="text-center">
                                <a href="" class="btn btn-primary">Contact</a>
                                <a href="" class="btn btn-outline-dark">Get Schedule </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 pages-banner" style="background-image: url({{ asset('images/Corporatelegal.png') }})">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5">
                    <h2 class="col-12 col-md-4">Corporate legal aid Services and Tax Papers Completion </h2>
                    <p class="col-12 col-md-6 mt-3"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsum pariatur consequuntur commodi
                        molestiae, vero corporis alias ipsam rem saepe voluptas reprehenderit doloribus suscipit. Recusandae
                        dolore perspiciatis corrupti expedita quaerat ducimus!</p>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5 ourservices">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title mb-md-5 mt-md-4">
                        <h2>Our Services</h2>
                        <p class="md-12 col-md-8 mx-auto mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis nobis quos rem deserunt
                            minus quis dolor tempora dignissimos impedit tempore! Officiis eum nesciunt nostrum, sit sequi
                            rerum minima aperiam quo?</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/General tax solution.png') }}" alt="">
                        <h3>General Tax Solution</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/International tax solution.png') }}" alt="">
                        <h3>International Tax</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/Inheritance tax.png') }}" alt="">
                        <h3>Inheritance Tax</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/Indirect tax.png') }}" alt="">
                        <h3>Indirect Tax</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/Large corporation tax.png') }}" alt="">
                        <h3>Large Corporation Tax</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4  mb-2 mb-md-3">
                    <div class="ourserviceitem text-center p-2 p-md-3 bg-white rounded">
                        <img src="{{ asset('uploads/services-icon/Personal tax solution.png') }}" alt="">
                        <h3>Personal Tax Solution</h3>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur exercitationem quasi explicabo
                            provident aut totam est doloribus ut, suscipit rerum molestias officia quae eum officiis nostrum
                            facilis quas error et?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="specialist">
                        <p class="arespecialist">Are your Tax Specialist?</p>
                        <h2>Join with us to provide your tax related services</h2>

                        <p>Lorem ipsum dolor sit amet consectetur. Nibh mauris dolor orci viverra nisi diam vel tincidunt
                            leo. Gravida lorem leo mattis tempor mi. </p>

                        <p> Feugiat mauris risus aliquam donec morbi cursus massa eget semper. Eget a vulputate suscipit
                            blandit in ullamcorper pellentesque volutpat nunc. Tristique ut ipsum ut dignissim feugiat
                            suspendisse feugiat. Elit sed enim convallis donec non justo donec. Id sagittis aliquet arcu
                            tellus nulla potenti et neque. </p>

                        <p> Pulvinar ipsum quis curabitur praesent laoreet eget mi erat ultricies. Est in libero fermentum
                            euismod nibh. </p>

                        <div class="mt-md-5">
                            <a href="" class="btn btn-primary px-4">Sign In</a>
                            <a href="" class="text-decoration-underline text-info ms-3">Help Center </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="specialist-img">
                        <img src="{{ asset('images/Join with us to provide your tax related services.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title py-4">
                        <h3>Our Blog</h3>
                        <p class="col-12 col-md-8 mx-auto">Lorem ipsum dolor sit amet consectetur. Vitae metus nulla mauris est tristique ultrices
                            ultricies. Ipsum quam adipiscing sed scelerisque eget pharetra dolor nisl. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="blog-item">
                        <img src="{{ asset('uploads/blogs/images/blog-01.png') }}" class="w-100" alt="">
                        <p class="d-flex py-2 mt-2">
                            <span>22 July 2023</span>
                            <span class="px-1">|</span>
                            <span>Admin</span>
                        </p>
                        <h6>This program helps small business incubators leverage</h6>
                        <p>Lorem ipsum dolor sit amet consectetur. Nec egestas volutpat tellus varius leo placerat. Turpis id a at sed libero. Viverra sed elementum odio eu sit.</p>
                        <a href="" class="btn btn-info text-white btn-sm">Read More</a>
                    </div>

                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="blog-item">
                        <img src="{{ asset('uploads/blogs/images/blog-02.png') }}" class="w-100" alt="">
                        <p class="d-flex py-2 mt-2">
                            <span>22 July 2023</span>
                            <span class="px-1">|</span>
                            <span>Admin</span>
                        </p>
                        <h6>This program helps small business incubators leverage</h6>
                        <p>Lorem ipsum dolor sit amet consectetur. Nec egestas volutpat tellus varius leo placerat. Turpis id a at sed libero. Viverra sed elementum odio eu sit.</p>
                        <a href="" class="btn btn-info text-white btn-sm">Read More</a>
                    </div>

                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="blog-item">
                        <img src="{{ asset('uploads/blogs/images/blog-03.png') }}" class="w-100" alt="">
                        <p class="d-flex py-2 mt-2">
                            <span>22 July 2023</span>
                            <span class="px-1">|</span>
                            <span>Admin</span>
                        </p>
                        <h6>This program helps small business incubators leverage</h6>
                        <p>Lorem ipsum dolor sit amet consectetur. Nec egestas volutpat tellus varius leo placerat. Turpis id a at sed libero. Viverra sed elementum odio eu sit.</p>
                        <a href="" class="btn btn-info text-white btn-sm">Read More</a>
                    </div>

                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="blog-item">
                        <img src="{{ asset('uploads/blogs/images/blog-04.png') }}" class="w-100" alt="">
                        <p class="d-flex py-2 mt-2">
                            <span>22 July 2023</span>
                            <span class="px-1">|</span>
                            <span >Admin</span>
                        </p>
                        <h6>This program helps small business incubators leverage</h6>
                        <p>Lorem ipsum dolor sit amet consectetur. Nec egestas volutpat tellus varius leo placerat. Turpis id a at sed libero. Viverra sed elementum odio eu sit.</p>
                        <a href="" class="btn btn-info text-white btn-sm">Read More</a>
                    </div>

                </div>
            </div>
        </div>
    </section>








@endsection
