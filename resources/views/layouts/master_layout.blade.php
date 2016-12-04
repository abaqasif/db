
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RELIANCE PAINTS | </title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{asset('assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


      <!-- Custom Theme Style -->
    <link href="{{asset('assets/build/css/custom.min.css')}}" rel="stylesheet">





  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="localhost:8000/home" class="site_title"><i class="fa fa-paw"></i> <span>RELIANCE PAINTS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
               <!--  <h3>General</h3> -->
                <ul class="nav side-menu">
                <!--   <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li> -->
                  <br>
                  <br>
                  <br>
                  

                      
               
                        @if(Auth::user()->Admin==0)
                     @foreach($allrights as $allright)

                  
                     @if(strcmp($allright->page_name,'REGISTER USER')==0)
                     <li><a><i class="fa fa-desktop"></i> USERS<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/register_user_form')}}">Create User</a></li>
                      <li><a href="{{url('/edit_user_form')}}">Edit User</a></li>
                      <li><a href="{{url('/delete_user_form')}}">Delete User</a></li>
                      <li><a href="{{url('/show_user')}}">View User</a></li>
                     
                    </ul>
                  </li> 
                  @endif

                 
                     @if(strcmp($allright->page_name,'CREATE PAGE')==0)

                 <li><a><i class="fa fa-desktop"></i> PAGES <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/create_page_form')}}">Create Page</a></li>
                      <li><a href="{{url('/edit_page_form')}}">Edit Page</a></li>
                      <li><a href="{{url('/delete_page_form')}}">Delete Page</a></li>
                      <li><a href="{{url('/show_page')}} ">View Page</a></li>
                     
                    </ul>
                  </li> 
                  @endif


                     @if(strcmp($allright->page_name,'CREATE RIGHT')==0)

                  <li><a><i class="fa fa-desktop"></i> RIGHTS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/create_right_form')}}">Create Right</a></li>
                      <li><a href="{{url('/edit_right_form')}}">Edit Right</a></li>
                      <li><a href="{{url('/delete_right_form')}}">Delete Right</a></li>
                      <li><a href="{{url('/show_right')}}">View Right</a></li>
                     
                    </ul>
                  </li> 
                  @endif
                         {{--                       CREATE SALES LOGIC                                                   --}}

                         {{--@if(strcmp($allright->page_name,'CREATE SALES')==0)--}}

                             {{--<li><a><i class="fa fa-desktop"></i> Sales <span class="fa fa-chevron-down"></span></a>--}}
                                 {{--<ul class="nav child_menu">--}}
                                     {{--<li><a href="{{url('/create_right_form')}}">Create Right</a></li>--}}
                                     {{--<li><a href="{{url('/edit_right_form')}}">Edit Right</a></li>--}}
                                     {{--<li><a href="{{url('/delete_right_form')}}">Delete Right</a></li>--}}
                                     {{--<li><a href="{{url('/show_right')}}">View Right</a></li>--}}

                                 {{--</ul>--}}
                             {{--</li>--}}
                         {{--@endif--}}

                        @if(strcmp($allright->page_name,'CREATE SUPPLIERS')==0||strcmp($allright->page_name,'CREATE RAW MATERIALS')==0||strcmp($allright->page_name,'SHOW PURCHASE ORDER')==0)   
                    <li><a><i class="fa fa-desktop"></i> PURCHASES <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">


                     @if(strcmp($allright->page_name,'CREATE SUPPLIERS')==0)
                 <li><a href="{{url('/show_suppliers')}}"><i class="fa fa-desktop"></i> SUPPLIERS </span></a>
                    
                  </li> 
                  @endif
                
                
                     @if(strcmp($allright->page_name,'CREATE RAW MATERIALS')==0) 
                  <li><a href="{{url('/show_raw_materials')}}"><i class="fa fa-desktop"></i> RAW MATERIALS </span></a>
                  
                  </li> 
                  @endif



                     @if(strcmp($allright->page_name,'SHOW PURCHASE ORDER')==0)


                  <li><a><i class="fa fa-desktop"></i> PURCHASES <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/view_purchase_order')}}">Purchase Order</a></li>
                      <li><a href="{{url('/view_purchase_receipt')}}">Purchase Receipt</a></li>
                      <li><a href="{{url('/view_purchase_return')}}">Purchase Return</a></li>
                       <li><a href="{{url('/view_purchase_payments')}}">Purchase Payments</a></li>
                    </ul>
                  </li> 

                  @endif
                     </ul>
                   </li>
                    @endif

        @if(strcmp($allright->page_name,'PRODUCTION CRUD')==0)
        <li><a><i class="fa fa-desktop"></i> PRODUCTION <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
        <li><a href="{{ route('batch.index') }}" >Batch Form</a></li>
        <li><a href="{{  route('recipe.index') }}" >Recipe Form</a></li>
        <li><a href="{{ route('wastage.index') }}" >Wastages</a></li>
        <li><a href="{{ url('production/item') }}" >Item</a></li>
       
       
        <li><a href="{{ url('production/dpr') }}" >Daily Production Report</a></li>
        <li><a href="{{ url('production/mixing_paper/select_batch') }}">Mixing Report (Without Cost)</a></li>
        <li><a href="{{ url('production/mixing_cost/select_batch') }}">Mixing Report (With Cost)</a></li>
        @if(strcmp($allright->page_name,'INVENTORY TRANSFER')==0)
        <li><a href="{{ url('/inventory') }}">Inventory (With Cost)</a></li>
        @endif

        </ul>
        </li>
        @endif


                  

                      @endforeach

                    @endif

                      @if(Auth::user()->Admin==1)
                   



                    
                  <li><a><i class="fa fa-desktop"></i> USERS<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/register_user_form')}}">Create User</a></li>
                      <li><a href="{{url('/edit_user_form')}}">Edit User</a></li>
                      <li><a href="{{url('/delete_user_form')}}">Delete User</a></li>
                      <li><a href="{{url('/show_user')}}">View User</a></li>
                     
                    </ul>
                  </li> 
                 <li><a><i class="fa fa-desktop"></i> PAGES <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/create_page_form')}}">Create Page</a></li>
                      <li><a href="{{url('/edit_page_form')}}">Edit Page</a></li>
                      <li><a href="{{url('/delete_page_form')}}">Delete Page</a></li>
                      <li><a href="{{url('/show_page')}}">View Page</a></li>
                     
                    </ul>
                  </li> 


                  <li><a><i class="fa fa-desktop"></i> RIGHTS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/create_right_form')}}">Create Right</a></li>
                      <li><a href="{{url('/edit_right_form')}}">Edit Right</a></li>
                      <li><a href="{{url('/delete_right_form')}}">Delete Right</a></li>
                      <li><a href="{{url('/show_right')}}">View Right</a></li>
                     
                    </ul>
                  </li> 
                   <li><a><i class="fa fa-desktop"></i> PURCHASES <span class="fa fa-chevron-down"></span></a>
                   <ul class="nav child_menu">

                 <li><a href="{{url('/show_suppliers')}}"><i class="fa fa-desktop"></i> SUPPLIERS </span></a>
                    
                  </li> 
                
                 
                  <li><a href="{{url('/show_raw_materials')}}"><i class="fa fa-desktop"></i> RAW MATERIALS </span></a>
                  
                  </li> 


                  <li><a><i class="fa fa-desktop"></i> PURCHASES <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/view_purchase_order')}}">Purchase Order</a></li>
                      <li><a href="{{url('/view_purchase_receipt')}}">Purchase Receipt</a></li>
                      <li><a href="{{url('/view_purchase_return')}}">Purchase Return</a></li>
                       <li><a href="{{url('/view_purchase_payments')}}">Purchase Payments</a></li>
                    </ul>
                  </li> 

                </ul>
                </li>
                      

       
        <li><a><i class="fa fa-desktop"></i> PRODUCTION <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
        <li><a href="{{ route('batch.index') }}" >Batch Form</a></li>
        <li><a href="{{  route('recipe.index') }}" >Recipe Form</a></li>
        <li><a href="{{ route('wastage.index') }}" >Wastages</a></li>
        <li><a href="{{ url('production/item') }}" >Item</a></li>
        <li><a href="{{ url('/inventory') }}">Inventory (With Cost)</a></li>
       
       
        <li><a href="{{ url('production/dpr') }}" >Daily Production Report</a></li>
        <li><a href="{{ url('production/mixing_paper/select_batch') }}">Mixing Report (Without Cost)</a></li>
        <li><a href="{{ url('production/mixing_cost/select_batch') }}">Mixing Report (With Cost)</a></li>


   </ul>
 </li>

         <li><a><i class="fa fa-desktop"></i> SALES <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
        <li><a href="{{ url('party') }}" >Parties</a></li>
        <li><a href="{{  url('salesmen')}}" >Salesmen</a></li>
        <li><a href="{{ url('order') }}" >Sales Order</a></li>
        <li><a href="{{ url('return') }}" >Sales Return</a></li>
        <li><a href="{{ url('payment') }}" >Payments</a></li>
        <li><a href="{{ url('stock') }}">Stock</a></li>

   </ul>
 </li>





                 @endif



                  <!-- <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li> -->
               <!--    <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
                    </ul>
                  </li> -->
               <!--    <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                  <!   <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li> --> 
                 <!--  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a> -->
                  <!--   <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul> -->
                 <!--  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a> -->
               <!--      <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul> -->
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
           <!--  <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   <!--  <li><a href="javascript:;"> Profile</a></li> -->
                    
                     <!--  <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a> -->
                    
                    <li> <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                                 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                </li>
<!-- 
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



        <!-- page content -->
       @yield('content')
   

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            PHP_MY_ADMINS
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('assets/vendors/nprogress/nprogress.js')}}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{asset('assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('assets/build/js/custom.min.js')}}"></script>
     


  
</html>