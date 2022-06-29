@extends('client.global')


@section('content')
    @include('partials.app.page-header', ['title' => $title])

    <div class="py-12">
        <div class="container">
            @include('client.order.inc.header', ['order' => $order])
            
            
            <div class="mt-5">
                <div class="md:grid md:grid-cols-5 md:gap-6">
                    <div class="mt-5 md:mt-0 md:col-span-4">
                        @include('client.order.inc.menu', ['order' => $order])

                        <div class="mt-5 md:col-span-2">
                            <h2>HISTORY</h2>
                            <div class="timeline timeline-2">
                                <div class="timeline-bar"></div>
                                <div class="timeline-item">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            <a href="#">12 new users registered and pending for activation</a> <span class="label label-light-success font-weight-bolder">8</span>
                                        </span>
                                        <span class="text-muted text-right">3 hrs ago</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-badge bg-red-100"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            Scheduled system reboot completed.
                                            <span class="label label-inline label-light-primary font-weight-bolder">new</span>
                                            <span class="label label-inline label-light-danger font-weight-bolder">hot</span>
                                        </span>
                                        <span class="text-muted font-italic text-right">6 hrs ago</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-badge"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            New order has been placed and pending for processing.
                                        </span>
                                        <span class="text-muted text-right">2 days ago</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-badge bg-red-300"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            Database server overloaded 80% and requires quick reboot <span class="label label-inline label-danger font-weight-bolder">pending</span>
                                        </span>
                                        <span class="text-muted text-right">3 days ago</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-badge bg-red-600"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            System error occured and hard drive has been shutdown.
                                        </span>
                                        <span class="text-muted font-italic text-right">5 days ago</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-badge bg-red-900"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            Production server is rebooting.
                                        </span>
                                        <span class="text-muted text-right">1 month ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="py-5">
                                <div class="border-t border-gray-400"></div>
                            </div>
                            <div class="timeline timeline-1">
                                    <div class="timeline-sep bg-primary-opacity-20"></div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-label">7:45 am</div>
                                        <div class="timeline-badge">
                                            <span class="svg-icon svg-icon-warning svg-icon-md">
                                                <x-icon.attachement/>
                                            </span>
                                        </div>
                                        <div class="timeline-content text-muted font-weight-normal">
                                            Database server overloaded 80% and requires quick reboot.
                                            <span class="label label-inline label-light-primary font-weight-bolder">new</span>
                                        </div>
                                      
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-label">7:45 am</div>
                                        <div class="timeline-badge">
                                            <span class="svg-icon svg-icon-primary svg-icon-md">
                                                <x-icon.group-chat/>

                                            </span>

                                        </div>
                                        <div class="timeline-content text-muted font-weight-normal">
                                        To start a blog, think of a topic about and first brainstorm ways to write details

                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-label">3:12 PM</div>
                                        <div class="timeline-badge">
                                            <span class="svg-icon svg-icon-success svg-icon-md">
                                                <x-icon.library/>
                                            </span>

                                        </div>
                                        <div class="timeline-content text-muted font-weight-normal">
                                        To start a blog, think of a topic about and first brainstorm ways to write details
                                           
                                        </div>
                                    </div>
                                   
                                    <div class="timeline-item">
                                        <div class="timeline-label">7:05 PM</div>
                                        <div class="timeline-badge">
                                            <span class="svg-icon svg-icon-danger svg-icon-md">
                                                <x-icon.chair/>

                                            </span>
                                        </div>
                                        <div class="timeline-content text-muted font-weight-normal">
                                        To start a blog, think of a topic about and first brainstorm ways to write details
                                           
                                        </div>
                                    </div>

                                
                            </div>
                            <div class="py-5">
                                <div class="border-t border-gray-400"></div>
                            </div>
                            <div class="timeline timeline-5">
                                <div class="timeline-items">
                                   
                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Icon-->
                                        <div class="timeline-media bg-pink-50">
                                            <span class="svg-icon svg-icon-warning svg-icon-md">
                                                <x-icon.attachement/>
                                            </span>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Info-->
                                        <div class="timeline-desc timeline-desc-light-warning">
                                            <span class="font-weight-bolder text-warning">2:45 PM</span>
                                            <p class="font-normal text-black  pt-1 pb-2">
                                                To start a blog, think of a topic about and first brainstorm ways to write details
                                            </p>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Icon-->
                                        <div class="timeline-media bg-pink-50">
                                            <span class="svg-icon svg-icon-primary svg-icon-md">
                                            <x-icon.group-chat/>

                                            </span>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Info-->
                                        <div class="timeline-desc timeline-desc-light-warning">
                                            <span class="font-weight-bolder text-warning">2:45 PM</span>
                                            <p class="font-normal text-black  pt-1 pb-2">
                                                To start a blog, think of a topic about and first brainstorm ways to write details
                                            </p>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Icon-->
                                        <div class="timeline-media bg-light-success">
                                        <span class="svg-icon svg-icon-success svg-icon-md">
                                            <x-icon.library/>
                                        </span>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Info-->
                                        <div class="timeline-desc timeline-desc-light-success">
                                            <span class="font-weight-bolder text-success">3:12 PM</span>
                                            <p class="font-normal text-black  pt-1 pb-2">
                                                To start a blog, think of a topic about and first brainstorm ways to write details
                                            </p>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="timeline-item">
                                        <!--begin::Icon-->
                                        <div class="timeline-media bg-light-danger">
                                        <span class="svg-icon svg-icon-danger svg-icon-md">
                                            <x-icon.chair/>

                                        </span>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Info-->
                                        <div class="timeline-desc timeline-desc-light-danger">
                                            <span class="font-weight-bolder text-danger">7:05 PM</span>
                                            <p class="font-normal text-black  pt-1">
                                                To start a blog, think of a topic about and first brainstorm ways to write details
                                            </p>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        @include('client.order.inc.sidebar', ['order' => $order])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
