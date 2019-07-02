@extends('backend.admin_master')
@section('admin_main_content')

<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h5 class="mr-0 mr-r-5">Dashboard</h5>
            <!--<p class="mr-0 text-muted d-none d-md-inline-block">statistics, charts, events and reports</p>-->
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
<!--            <div class="d-none d-sm-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-outline-primary mr-l-20 btn-sm btn-rounded hidden-xs hidden-sm ripple" target="_blank">Buy Now</a>
            </div>-->
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <!-- Counters -->
        <div class="row">
            <!-- Counter: Sales -->
            <div class="col-md-3 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg bg-primary text-inverse">
                    <div class="widget-body">
                        <div class="widget-counter">
                            <h6>Total Sales <small class="text-inverse">Last week</small></h6>
                            <h3 class="h1">&dollar;<span class="counter">741</span></h3><i class="material-icons list-icon">add_shopping_cart</i>
                        </div>
                        <!-- /.widget-counter -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Counter: Subscriptions -->
            <div class="col-md-3 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg bg-color-scheme text-inverse">
                    <div class="widget-body clearfix">
                        <div class="widget-counter">
                            <h6>New Subscriptions <small class="text-inverse">Last month</small></h6>
                            <h3 class="h1"><span class="counter">346</span></h3><i class="material-icons list-icon">event_available</i>
                        </div>
                        <!-- /.widget-counter -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Counter: Users -->
            <div class="col-md-3 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="widget-counter">
                            <h6>New Users <small>Last 7 days</small></h6>
                            <h3 class="h1"><span class="counter">625</span></h3><i class="material-icons list-icon">public</i>
                        </div>
                        <!-- /.widget-counter -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
            <!-- Counter: Pageviews -->
            <div class="col-md-3 col-sm-6 widget-holder widget-full-height">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <div class="widget-counter">
                            <h6>Total PageViews <small>Last 24 Hours</small></h6>
                            <h3 class="h1"><span class="counter">2748</span></h3><i class="material-icons list-icon">show_chart</i>
                        </div>
                        <!-- /.widget-counter -->
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->

        <!-- Other Widgets -->
        <div class="row">
            <!-- Calender -->
            <div class="col-lg-4 col-md-6 col-sm-12 widget-holder">
                <div class="widget-bg bg-color-scheme color-white pd-0">
                    <div class="widget-body clearfix">
                        <div id="custom-clndr" data-toggle="clndr">
                            <script type="text/template" class="template">
                                <div class="clndr-controls mr-b-20 clearfix">
                                <h5 class="clndr-title float-left mr-tb-0">Time Machine</h5>
                                <div class="float-right">
                                <div class="clndr-previous-button float-left"><i class="material-icons">chevron_left</i></div>
                                <div class="clndr-next-button float-right"><i class="material-icons">chevron_right</i></div>
                                </div>
                                <div class="text-right current-month text-uppercase"><%= month.substr(0,3) %> <%= year %></div>
                                </div>
                                <div class="clndr-grid">
                                <div class="days"> <% _.each(days, function(day) { %> <div class="text-center <%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div> <% }); %> </div>
                                </div><!-- /.clndr-grid --> <% if( !_.isEmpty(extras.selectedDay.events) ) { %> <div class="event-listing row">
                                <div class="col-3 col-sm-3">
                                <div class="selected-date">
                                <span class="date"><%= moment(extras.selectedDay.date._d).format("D") %></span>
                                <span class="color-color-scheme"><%= moment(extras.selectedDay.date._d).format("Do").substr(-2) %></span>
                                </div><!-- /.selected-date -->
                                </div><!-- /.col-3 -->
                                <div class="col-9 col-sm-9"> <% _.each(extras.selectedDay.events, function(event) { %> <div class="event-item">
                                <span class="event-item-time"><%= moment(event.date).format("kk:mm") %></span>
                                <span class="event-item-title"><%= event.title %></span>
                                <span class="event-item-icon color-color-scheme"><i class="material-icons md-18"><%= event.icon%></i></span>
                                </div> <% }); %> </div><!-- /.col-9 -->
                                </div><!-- /.event-listing --> <% } %>
                            </script>
                            <script type="text/json" class="events">
                                {
                                "events" : [
                                {
                                "date": "2017-08-14T13:00:00+05:30",
                                "title": "Friends Golf Meet",
                                "icon": "golf_course"
                                },
                                {
                                "date": "2017-08-25T10:00:00+05:30",
                                "title": "Alumini Awards",
                                "icon": "school"
                                },
                                {
                                "date": "2017-08-25T13:00:00+05:30",
                                "title": "Meeting",
                                "icon": "business_center"
                                },
                                {
                                "date": "2017-08-04T08:00:00+05:30",
                                "title": "Friends Reunion",
                                "icon": "face"
                                },
                                {
                                "date": "2017-08-04T21:00:00+05:30",
                                "title": "Beach Party",
                                "icon": "beach_access"
                                },
                                {
                                "date": "2017-08-13T13:00:00+05:30",
                                "title": "Friends Golf Meet",
                                "icon": "golf_course"
                                },
                                {
                                "date": "2017-08-26T10:00:00+05:30",
                                "title": "Alumini Awards",
                                "icon": "school"
                                },
                                {
                                "date": "2017-08-24T10:00:00+05:30",
                                "title": "Alumini Awards",
                                "icon": "school"
                                },
                                {
                                "date": "2017-08-24T13:00:00+05:30",
                                "title": "Meeting",
                                "icon": "business_center"
                                }
                                ]
                                }
                            </script>
                        </div>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.widget-list -->
</main>

@endsection