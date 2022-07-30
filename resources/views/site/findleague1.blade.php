<!doctype html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <title>PPN</title>
  <link rel="shortcut icon" href="assets_league/img/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets_league/fonts/stylesheet.css">
  <link rel="stylesheet" href="assets_league/css/all.css">
  <link rel="stylesheet" href="assets_league/css/style.css">
<title>Create Account</title>
</head>

<body class="poppins">
    <section class="">
        <div class="">
            <header class="wrapper bg-dark">
                <nav class="navbar navbar-expand-lg center-nav transparent navbar-dark">
                  <div class="container-fluid flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                      <a href="index.html">
                        <img class="logo-dark" src="assets_leagueimg/logo-white.png" srcset="./assets_leagueimg/logo-dark@2x.png 2x" alt="">
                        <img class="logo-light" src="assets_leagueimg/logo-white.png" srcset="./assets_leagueimg/logo-light@2x.png 2x" alt="">
                      </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                      <div class="offcanvas-header d-lg-none">
                        <h3 class="text-white fs-30 mb-0"><img src="assets_leagueimg/logo-white.png" srcset="./assets_leagueimg/logo-dark@2x.png 2x" alt="" width="150px"></h3>
                        <a href="#" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
                      </div>

                      <div class="offcanvas-body m-auto d-flex flex-column h-100">
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown custmenu_ico">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">About <i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                              <li class="nav-item"><a class="dropdown-item" href="#">About PPN</a></li>
                              <li class="nav-item"><a class="dropdown-item" href="#">Contact</a></li>
                            </ul>
                          </li>
                          <li class="nav-item dropdown custmenu_ico">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Leagues <i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                              <li class="nav-item"><a class="dropdown-item" href="#">Find League</a></li>
                              <li class="nav-item"><a class="dropdown-item" href="#">League Rule</a></li>
                            </ul>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link" href="#">Courts</a>
                          </li>
                          <li class="nav-item dropdown custmenu_ico">
                            <a class="nav-link dropdown-toggle btn-head resdis custmenu_ico" href="#" data-bs-toggle="dropdown">Account <i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                              <li class="nav-item"><a class="dropdown-item" href="#">Profle</a></li>
                              <li class="nav-item"><a class="dropdown-item" href="#">Change Password</a></li>
                              <li class="nav-item"><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                          </li>
                        </ul>
                        <!-- /.offcanvas-footer -->
                      </div>
                      <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->

                    <div class="navbar-other w-100 d-flex ms-auto">
                      <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item d-none d-md-block">
                          <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn-head custmenu_ico" data-toggle="dropdown">Account <i class="fa-solid fa-chevron-down"></i></a>
                            <ul class="dropdown-menu proflnk" role="menu">
                              <li><a href="#">Profile</a></li>
                              <li><a href="#">Change Password</a></li>
                              <li><a href="#">Logout</a></li>
                            </ul>
                          </div>
                        </li>
                        <li class="nav-item d-lg-none">
                          <button class="hamburger offcanvas-nav-btn"><span></span></button>
                        </li>
                      </ul>
                    </div>
                    <!-- /.navbar-other -->
                  </div>
                  <!-- /.container -->
                </nav>
                <!-- /.navbar -->
                <div class="offcanvas offcanvas-top bg-light" id="offcanvas-search" data-bs-scroll="true">
                  <div class="container d-flex flex-row py-6">
                    <form class="search-form w-100">
                      <input id="search-form" type="text" class="form-control" placeholder="Type keyword and hit enter">
                    </form>
                    <!-- /.search-form -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <!-- /.container -->
                </div>
                <!-- /.offcanvas -->
              </header>
        </div>
    </section>
    <section class="container-fluid mainsecpad">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <div class="row mt-0 align-items-center">
                    <div class="col-lg-10 col-md-8">
                        <div class="find-legsearch">
                            <input type="text" class="form-control" id="textSearch" placeholder="Search for leagues">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <a href="#" class="btn-signacc d-block text-center btn-fn-lg">Search</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 findleagueborder findleaguetbl">
                <div class="findleague-leftsec">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" style="padding-top: 0px;" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Location
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="form-check-inline radio">
                                        <ul class="list-unstyled" style="padding-left: 0px;margin-bottom: 0px;">
                                             <li>
                                              <label class="customradio"><span class="radiotextsty">Default</span>
                                                <input type="radio" name="radio">
                                                <span class="checkmark"></span>
                                              </label>
                                            </li>
                                            <li>
                                                <label class="customradio"><span class="radiotextsty">Within</span>
                                                <input type="radio" name="radio">
                                                <span class="checkmark"></span>
                                              </label>
                                            </li>
                                        </ul>
                                  </div>
                                  <div class="row frmgen mt-2 align-items-center">
                                    <div class="col-lg-8">
                                        <div class="selectgroup">
                                            <i class="fa-solid fa-chevron-down"></i>
                                            <select class="form-control">
                                                <option>25 mi</option>
                                                <option>10 mi</option>
                                                <option>50 mi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2"><p>of</p></div>
                                  </div>
                                  <div class="row frmgen mt-2 align-items-center">
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" placeholder="91316">
                                    </div>
                                    <div class="col-lg-2"><a href="#" class="btn-rightarrow"><i class="fas fa-long-arrow-right"></i></a></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Play Type
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div class="form-group">

                                    <div class="excls panel-body" id="type">
                                         <div class="cont checkbox" style="display:none">All
                                           <label> <input type="checkbox" value="all">
                                            <span class="checkmark"></span></label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Singles
                                          <input type="checkbox" value="doubles">
                                          <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox" >
                                            <label class="customcheck font-weight-text">Doubles
                                          <input type="checkbox" value="singles">
                                          <span class="checkmark"></span>
                                        </label>
                                        </div>
                                      
                                    </div>




                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Gender
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                   

                                      <div class="excls form-group panel-body" id="gender">
                                         <div class="cont checkbox" style="display:none">All
                                           <label> <input type="checkbox" value="all">
                                            <span class="checkmark"></span></label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Men
                                            <input type="checkbox" value="male">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Women
                                            <input type="checkbox" value="female">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Mixed
                                            <input type="checkbox" value="mixed">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Age
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                  

                                    <div class="excls form-group panel-body" id="age">
                                         <div class="cont checkbox" style="display:none">All
                                           <label> <input type="checkbox" value="all">
                                            <span class="checkmark"></span></label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">18+
                                            <input type="checkbox" value="18+">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">40+
                                            <input type="checkbox" value="40">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">50+
                                            <input type="checkbox" value="50+">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Rating
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    

                                    <div class="excls form-group panel-body" id="rating">
                                         <div class="cont checkbox" style="display:none">All
                                           <label> <input type="checkbox" value="all">
                                            <span class="checkmark"></span></label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">2.0 - 3.0
                                            <input type="checkbox" value="2.0">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">3.0 - 4.0
                                            <input type="checkbox" value="4.0">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">4.0 - 5.0
                                            <input type="checkbox" value="5.0">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSix">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="more-less fas fa-chevron-down"></i>
                                        Status
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body">
                                 

                                      <div class="excls form-group panel-body" id="statu">
                                         <div class="cont checkbox" style="display:none">All
                                           <label> <input type="checkbox" value="all">
                                            <span class="checkmark"></span></label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Open for Registration
                                            <input type="checkbox" value="open for registration">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">In-Progress
                                            <input type="checkbox" value="In-Progress">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        <div class="cont checkbox">
                                            <label class="customcheck font-weight-text">Complete
                                            <input type="checkbox" value="complete">
                                            <span class="checkmark"></span>
                                        </label>
                                        </div>
                                        
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div><!-- panel-group -->
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row mt-0 align-items-center findright">
                    <div class="col-lg-12">
                        <div class="table-responsive finflgtbl findleaguetbl">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>League Name</th>
                                        <th>Location</th>
                                        <th>Play Type</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Rating</th>
                                        <th>Dates</th>
                                        <th>Teams Registered</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach($leaguelist as $leaguelist)
                                            <tr>
                                                <td>
                                                    <a id="check-league-status" href="{{ route('site.league-registration', $leaguelist->leagueid) }}">{{$leaguelist->league_name}}</a>
                                                </td>
                                                <td>{{$leaguelist->city}}</td>
                                                <td>{{$leaguelist->play_type}} </td>
                                                <td>{{$leaguelist->gender}}</td>
                                                <td>{{$leaguelist->age}}</td>
                                                <td>{{$leaguelist->rating}}</td>
                                                <td>{{ date("m/d/y",strtotime($leaguelist->fromdate))}}-{{ date("m/d/y",strtotime($leaguelist->todate))}}</td>
                                                <td>{{$leaguelist->max_team}}</td>
                                                <td id="league-status-text">{{$leaguelist->status}}</td>
{{--                                                @if($leaguelist->status==1)--}}
{{--                                                    <td>open for registration</td>--}}
{{--                                                @else--}}
{{--                                                    <td>in progress</td>--}}
{{--                                                @endif--}}
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <a href="#" class="logo"><img src="assets_leagueimg/logo-white.png" alt=""></a>
                    <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry.</p>
                </div>
                <div class="col-lg-1 tabnone"></div>
                <div class="col-lg-2 col-md-3">
                    <h4 class="footttl">About</h4>
                    <div class="footttlline"></div>
                    <ul class="footlnksec">
                        <li><a href="#">- Home</a></li>
                        <li><a href="#">- About</a></li>
                        <li><a href="#">- Leagues</a></li>
                        <li><a href="#">- Courts</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h4 class="footttl">Leagues</h4>
                    <div class="footttlline"></div>
                    <ul class="footlnksec">
                        <li><a href="#">- Find a Leagues</a></li>
                        <li><a href="#">- Leagues Rules</a></li>
                    </ul>
                </div>
                <div class="col-lg-1 tabnone"></div>
                <div class="col-lg-3 col-md-4">
                    <h4 class="footttl">Contact</h4>
                    <div class="footttlline"></div>
                    <ul class="footlnksecone">
                        <li>
                            <i class="fa fa-envelope"></i>
                            <b>Email</b>
                            <p>ppnnetwork@gmail.com</p>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <b>Call</b>
                            <p>+91 9456789523</p>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <b>Address</b>
                            <p>130/ Amby Shopping, Opp. Sentosa Heights, USA.</p>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="btmfoot">
            <div class="row align-items-center">
                <div class="col-lg-4"><p class="resp">© 2022 Pickleball Players Network LLC</p></div>
                <div class="col-lg-4">
                    <ul class="footreglink">
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <ul class="soclink">
                        <li><a href="#"><i class="fab fa-reddit-alien"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- <div class="container-fluid notfixedfooter">
        <div class="row">
            <div class="col-lg-9 col-md-7"><h5 class="copy-text">© Pickleball Players Network</h5></div>
            <div class="col-lg-3 col-md-5"><ul class="footlink">
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy</a></li>
            </ul></div>
        </div>
    </div> -->
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/admin/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/admin/dist/pages/datatable/datatable-basic.init.js') }}"></script>
<script src="{{ asset('js/admin/plugins/datatables-responsive/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/admin/plugins/datatables-responsive/responsive.bootstrap4.min.js') }}"></script>

    <!-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    <script src="assets_leaguejs/plugins.js"></script>
  <script src="assets_leaguejs/theme.js"></script>
    <script>
        $(".reveal").on('click',function() {
            var $pwd = $(".pwd");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });
    </script>
    <script>
        function toggleIcon(e) {
            $(e.target)
                .prev('.panel-heading')
                .find(".more-less")
                .toggleClass('fa-chevron-down fa-chevron-up');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
    <!-- <script>
        $(document).ready(function(){
            $(".dropdown").hover(            
                function() {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
                    $(this).toggleClass('open');        
                },
                function() {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
                    $(this).toggleClass('open');       
                }
            );
        });
    </script> -->

<script>
    // Using the module pattern for a jQuery feature
    $(function() {
        var app = (function() {
            var checkboxInput = ' input[type="checkbox"]',
                filters = {},rowData = [],values = [],key, value, show, length, divId;

            var init = function() {
                app.table = $('#example').DataTable({
                    "dom": "lrtip", // hide default DataTable search box
                    "bPaginate": false,
                    "bInfo" : false
                });

                $("#textSearch").on('keyup change', function() {
                    console.log('text search for: ' + $(this).val());
                    app.table.search($(this).val()).draw();
                });

                //$(checkboxInput).prop('checked', true);

                $(checkboxInput).change(function() {
                    var that = $(this);
                    if(that.hasClass('all')) {
                        $('#' + getFilterCategoryId(that) + checkboxInput).prop('checked', that.prop('checked'));
                    } else {
                        var allInput = $('#' + getFilterCategoryId(that) + checkboxInput + ':first');
                        console.log(allInput)
                        if(allInput.is(':checked')) {
                            allInput.prop('checked', false);
                        }
                    }
                    poulateAndApplyFilters();
                });
            };

            var poulateAndApplyFilters = function() {
                populateFilterValues();
                applyFiltersToTable();
            };

            var getFilterCategoryId = function(elem) {
                console.log(elem)
                divId = elem.parent().parent().parent()[0].id;
                console.log('divId is: ' + divId);
                return divId;
            };

            var trimAndLower = function(elem) {
                return elem.toLowerCase().trim();
            };

            var populateFilterValues = function() {
                console.log('Populating filter values');
                $(checkboxInput).each(function() {
                    if ($(this).is(":checked") && $(this).val() !== "all") {
                        value = trimAndLower($(this).val());
                        key = getFilterCategoryId($(this));
                        console.log('key: ' + key + ', value: ' + value);
                        if (filters[key] === undefined) {
                            console.log('Filter category is missing from object. Now creating new filter');
                            values.push(value);
                            filters[key] = values;
                        } else {
                            console.log('Filter category is already existing in object');
                            filters[key].push(value);
                        }
                        values = [];
                    }
                });
                console.log('Filter population complete');
            };

            var populateRowData = function(row) {
                row.find('td').each(function() {
                    console.log('Populating row data with ' + $(this).text());
                    rowData.push(trimAndLower($(this).text()));
                });
            };

            var applyFiltersToTable = function() {
                console.log('Applying filters to table');
                if (filters[key] === undefined) {
                    // show all table rows when no checkboxes are selected
                    $("table tbody tr").show();
                } else {
                    $("table tr").each(function() {
                        // initialize 'show' variable to false for each table row
                        show = false;
                        populateRowData($(this));
                        // make sure 'rowData' array has elements
                        if (rowData.length > 0) {
                            // loop through each key in 'filters' object
                            for (var k in filters) {
                                if (filters.hasOwnProperty(k)) {
                                    console.log('filter key: ' + k);
                                    length = filters[k].length;
                                    // loop through each array value at index 'i'
                                    for (var i = 0; i < length; i++) {
                                        value = filters[k][i];
                                        if (rowData.indexOf(value) !== -1) {
                                            show = true;
                                            break;
                                        }
                                    }
                                    if (show) {
                                        $(this).show();
                                    } else {
                                        $(this).hide();
                                        break;
                                    }
                                    show = false;
                                }
                            }
                        }
                        rowData = [];
                    });
                    filters = {};
                }
            };

            return {
                init: init
            };
        })();

        app.init();
    });


// $(".fa-circle-question").mouseover(function(){

// $('.availability').tooltip('show')
// })
</script>


</body>
</html>
