<!-- http://localhost/free-bundle-2022/092%20flat-able-lite/dist/form_elements.html -->

<template>
    <div>
        <!-- [ navigation menu ] start -->
        <nav class="pcoded-navbar  ">
            <div class="navbar-wrapper  ">
                <div class="navbar-content scroll-div " >
                    
                    <div class="">
                        <div class="main-menu-header">
                            <!-- <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="User-Profile-Image"> -->
                            <div class="user-details">
                                <span>{{ $auth.user.name }}</span>
                                <!-- <div id="more-details">UX Designer<i class="fa fa-chevron-down m-l-5"></i></div> -->
                            </div>
                        </div>
                        <div class="collapse" id="nav-user-link">
                            <ul class="list-unstyled">
                                <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                                <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                                <li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>

                    <ui-nav :items="$store.state.admin.menu" v-bind="{textColor:'#fff'}"></ui-nav>
                    
                    <!-- <ul class="nav pcoded-inner-navbar ">
                        <li class="nav-item pcoded-menu-caption">
                            <label>Navigation</label>
                        </li>
                        <li class="nav-item">
                            <a href="index.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="layout-vertical.html" target="_blank">Vertical</a></li>
                                <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>UI Element</label>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Basic</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="bc_alert.html">Alert</a></li>
                                <li><a href="bc_button.html">Button</a></li>
                                <li><a href="bc_badges.html">Badges</a></li>
                                <li><a href="bc_breadcrumb-pagination.html">Breadcrumb & paggination</a></li>
                                <li><a href="bc_card.html">Cards</a></li>
                                <li><a href="bc_collapse.html">Collapse</a></li>
                                <li><a href="bc_carousel.html">Carousel</a></li>
                                <li><a href="bc_grid.html">Grid system</a></li>
                                <li><a href="bc_progress.html">Progress</a></li>
                                <li><a href="bc_modal.html">Modal</a></li>
                                <li><a href="bc_spinner.html">Spinner</a></li>
                                <li><a href="bc_tabs.html">Tabs & pills</a></li>
                                <li><a href="bc_typography.html">Typography</a></li>
                                <li><a href="bc_tooltip-popover.html">Tooltip & popovers</a></li>
                                <li><a href="bc_toasts.html">Toasts</a></li>
                                <li><a href="bc_extra.html">Other</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Forms &amp; table</label>
                        </li>
                        <li class="nav-item">
                            <a href="form_elements.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Forms</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="tbl_bootstrap.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Bootstrap table</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Chart & Maps</label>
                        </li>
                        <li class="nav-item">
                            <a href="chart-apex.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Chart</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="map-google.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Maps</span></a>
                        </li>
                        <li class="nav-item pcoded-menu-caption">
                            <label>Pages</label>
                        </li>
                        <li class="nav-item pcoded-hasmenu">
                            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
                            <ul class="pcoded-submenu">
                                <li><a href="auth-signup.html" target="_blank">Sign up</a></li>
                                <li><a href="auth-signin.html" target="_blank">Sign in</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="sample-page.html" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>
                    </ul> -->
                </div>
            </div>
        </nav>
        <!-- [ navigation menu ] end -->
        <!-- [ Header ] start -->
        <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
            
                
                    <div class="m-header">
                        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
                        <a href="#!" class="b-brand">
                            <!-- ========   change your logo hear   ============ -->
                            <img src="assets/images/logo.png" alt="" class="logo">
                            <img src="assets/images/logo-icon.png" alt="" class="logo-thumb">
                        </a>
                        <a href="#!" class="mob-toggler">
                            <i class="feather icon-more-vertical"></i>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                                <div class="search-bar">
                                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                                        Dropdown
                                    </a>
                                    <div class="dropdown-menu profile-notification ">
                                        <ul class="pro-body">
                                            <li><a href="user-profile.html" class="dropdown-item"><i class="fas fa-circle"></i> Profile</a></li>
                                            <li><a href="email_inbox.html" class="dropdown-item"><i class="fas fa-circle"></i> My Messages</a></li>
                                            <li><a href="auth-signin.html" class="dropdown-item"><i class="fas fa-circle"></i> Lock Screen</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown mega-menu">
                                    <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                                        Mega
                                    </a>
                                    <div class="dropdown-menu profile-notification ">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <h6 class="mega-title">UI Element</h6>
                                                <ul class="pro-body">
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Alert</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Button</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Modal</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Tabs & pills</a></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <h6 class="mega-title">Forms</h6>
                                                <ul class="pro-body">
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Elements</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Validation</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Masking</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Wizard</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Picker</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i> Select</a></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <h6 class="mega-title">Application</h6>
                                                <ul class="pro-body">
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-mail"></i> Email</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-clipboard"></i> Task</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-check-square"></i> To-Do</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-image"></i> Gallery</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-help-circle"></i> Helpdesk</a></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <h6 class="mega-title">Extension</h6>
                                                <ul class="pro-body">
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-file-plus"></i> Editor</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-file-minus"></i> Invoice</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-calendar"></i> Full calendar</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-upload-cloud"></i> File upload</a></li>
                                                    <li><a href="#!" class="dropdown-item"><i class="feather icon-scissors"></i> Image cropper</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                        <i class="icon feather icon-bell"></i>
                                        <span class="badge badge-pill badge-danger">5</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right notification">
                                        <div class="noti-head">
                                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                                            <div class="float-right">
                                                <a href="#!" class="m-r-10">mark as read</a>
                                                <a href="#!">clear all</a>
                                            </div>
                                        </div>
                                        <ul class="noti-body">
                                            <li class="n-title">
                                                <p class="m-b-0">NEW</p>
                                            </li>
                                            <li class="notification">
                                                <div class="media">
                                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                                        <p>New ticket Added</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="n-title">
                                                <p class="m-b-0">EARLIER</p>
                                            </li>
                                            <li class="notification">
                                                <div class="media">
                                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                                        <p>Prchace New Theme and make payment</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="notification">
                                                <div class="media">
                                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                                        <p>currently login</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="notification">
                                                <div class="media">
                                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                                        <p>Prchace New Theme and make payment</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="noti-footer">
                                            <a href="#!">show all</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown drp-user">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-user"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                                        <div class="pro-head">
                                            <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                                            <span>John Doe</span>
                                            <a href="auth-signin.html" class="dud-logout" title="Logout">
                                                <i class="feather icon-log-out"></i>
                                            </a>
                                        </div>
                                        <ul class="pro-body">
                                            <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                            <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                                            <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                
        </header>
        <!-- [ Header ] end -->
        
        

    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Form Elements</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!">Form Components</a></li>
                                <li class="breadcrumb-item"><a href="#!">Form Elements</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            
            <nuxt></nuxt>

        </div>
    </section>
    <!-- [ Main Content ] end -->
        <!-- Warning Section start -->
        <!-- Older IE warning message -->
        <!--[if lt IE 11]>
            <div class="ie-warning">
                <h1>Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade
                <br/>to any of the following web browsers to access this website.
                </p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="assets/images/browser/chrome.png" alt="Chrome">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="assets/images/browser/firefox.png" alt="Firefox">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="assets/images/browser/opera.png" alt="Opera">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="assets/images/browser/safari.png" alt="Safari">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="assets/images/browser/ie.png" alt="">
                                <div>IE (11 & above)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->
        <!-- Warning Section Ends -->
    </div>
</template>


<style>
/**======================================================================
=========================================================================
Template Name: Able pro Bootstrap Admin Template
Author: Phoenixcoded
Support: support@phoenixcoded.net
File: style.css
=========================================================================
=================================================================================== */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap');

/*
 * Container style
 */
.ps {
    overflow: hidden !important;
    overflow-anchor: none;
    -ms-overflow-style: none;
    touch-action: auto;
    -ms-touch-action: auto;
}

/*
 * Scrollbar rail styles
 */
.ps__rail-x {
    display: none;
    opacity: 0;
    transition: background-color .2s linear, opacity .2s linear;
    -webkit-transition: background-color .2s linear, opacity .2s linear;
    height: 15px;
  /* there must be 'bottom' or 'top' for ps__rail-x */
    bottom: 0px;
  /* please don't change 'position' */
  position: absolute; }

.ps__rail-y {
  display: none;
  opacity: 0;
  transition: background-color .2s linear, opacity .2s linear;
  -webkit-transition: background-color .2s linear, opacity .2s linear;
  width: 15px;
  /* there must be 'right' or 'left' for ps__rail-y */
  right: 0;
  /* please don't change 'position' */
    position: absolute;
}

.ps--active-x > .ps__rail-x,
.ps--active-y > .ps__rail-y {
    display: block;
    background-color: transparent;
}

.ps:hover > .ps__rail-x,
.ps:hover > .ps__rail-y,
.ps--focus > .ps__rail-x,
.ps--focus > .ps__rail-y,
.ps--scrolling-x > .ps__rail-x,
.ps--scrolling-y > .ps__rail-y {
    opacity: 0.6;
}

.ps .ps__rail-x:hover,
.ps .ps__rail-y:hover,
.ps .ps__rail-x:focus,
.ps .ps__rail-y:focus,
.ps .ps__rail-x.ps--clicking,
.ps .ps__rail-y.ps--clicking {
    background-color: #eee;
    opacity: 0.9;
}

/*
 * Scrollbar thumb styles
 */
.ps__thumb-x {
    background-color: #aaa;
    border-radius: 6px;
    transition: background-color .2s linear, height .2s ease-in-out;
    -webkit-transition: background-color .2s linear, height .2s ease-in-out;
    height: 6px;
  /* there must be 'bottom' for ps__thumb-x */
    bottom: 2px;
  /* please don't change 'position' */
  position: absolute; }

.ps__thumb-y {
  background-color: #aaa;
  border-radius: 6px;
  transition: background-color .2s linear, width .2s ease-in-out;
  -webkit-transition: background-color .2s linear, width .2s ease-in-out;
  width: 6px;
  /* there must be 'right' for ps__thumb-y */
  right: 2px;
  /* please don't change 'position' */
    position: absolute;
}

.ps__rail-x:hover > .ps__thumb-x,
.ps__rail-x:focus > .ps__thumb-x,
.ps__rail-x.ps--clicking .ps__thumb-x {
    background-color: #999;
    height: 11px;
}

.ps__rail-y:hover > .ps__thumb-y,
.ps__rail-y:focus > .ps__thumb-y,
.ps__rail-y.ps--clicking .ps__thumb-y {
    background-color: #999;
    width: 11px;
}

/* MS supports */
@supports (-ms-overflow-style: none) {
    .ps {
        overflow: auto !important;
    }
}

@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
    .ps {
        overflow: auto !important;
    }
}

/*
    description Of variables for build for theme layouts
        1) menu-caption-color
            List of color for sidebar menu caption

        2) brand-background
            List of color for logo background

        3) header-dark-background
            List of color for Dark Header

        4) header-light-background
            List of color for light Header

        5) menu-dark-background
            List of color for Dark sidebar menu

        6) menu-light-background
            List of color for light sidebar menu

        7) menu-active-color
            List of color for Active item highliter

        8) menu-icon-color
            List of color for sidebar menu items icon colors
*/


/*====== border color css ends ======*/
/*====== Card top border css starts ======*/
.card-border-c-blue {
    border-top: 4px solid #1abc9c;
}

.card-border-c-red {
    border-top: 4px solid #e74c3c;
}

.card-border-c-green {
    border-top: 4px solid #2ecc71;
}

.card-border-c-yellow {
    border-top: 4px solid #f1c40f;
}

.card-border-c-purple {
    border-top: 4px solid #536dfe;
}

/*====== Card top border ends ======*/
/*====== Font-size css starts ======*/
.f-10 {
    font-size: 10px;
}

.f-12 {
    font-size: 12px;
}

.f-14 {
    font-size: 14px;
}

.f-16 {
    font-size: 16px;
}

.f-18 {
    font-size: 18px;
}

.f-20 {
    font-size: 20px;
}

.f-22 {
    font-size: 22px;
}

.f-24 {
    font-size: 24px;
}

.f-26 {
    font-size: 26px;
}

.f-28 {
    font-size: 28px;
}

.f-30 {
    font-size: 30px;
}

.f-32 {
    font-size: 32px;
}

.f-34 {
    font-size: 34px;
}

.f-36 {
    font-size: 36px;
}

.f-38 {
    font-size: 38px;
}

.f-40 {
    font-size: 40px;
}

.f-42 {
    font-size: 42px;
}

.f-44 {
    font-size: 44px;
}

.f-46 {
    font-size: 46px;
}

.f-48 {
    font-size: 48px;
}

.f-50 {
    font-size: 50px;
}

.f-52 {
    font-size: 52px;
}

.f-54 {
    font-size: 54px;
}

.f-56 {
    font-size: 56px;
}

.f-58 {
    font-size: 58px;
}

.f-60 {
    font-size: 60px;
}

.f-62 {
    font-size: 62px;
}

.f-64 {
    font-size: 64px;
}

.f-66 {
    font-size: 66px;
}

.f-68 {
    font-size: 68px;
}

.f-70 {
    font-size: 70px;
}

.f-72 {
    font-size: 72px;
}

.f-74 {
    font-size: 74px;
}

.f-76 {
    font-size: 76px;
}

.f-78 {
    font-size: 78px;
}

.f-80 {
    font-size: 80px;
}

/*====== Font-size css ends ======*/
/*====== Font-weight css starts ======*/
.f-w-100 {
    font-weight: 100;
}

.f-w-200 {
    font-weight: 200;
}

.f-w-300 {
    font-weight: 300;
}

.f-w-400 {
    font-weight: 400;
}

.f-w-500 {
    font-weight: 500;
}

.f-w-600 {
    font-weight: 600;
}

.f-w-700 {
    font-weight: 700;
}

.f-w-800 {
    font-weight: 800;
}

.f-w-900 {
    font-weight: 900;
}

/*====== Font-weight css ends ======*/
/*====== text-color, background color css starts ======*/
.bg-facebook {
    background: #3C5A99;
}

.text-facebook {
    color: #3C5A99;
}

.bg-twitter {
    background: #42C0FB;
}

.text-twitter {
    color: #42C0FB;
}

.bg-dribbble {
    background: #EC4A89;
}

.text-dribbble {
    color: #EC4A89;
}

.bg-pinterest {
    background: #BF2131;
}

.text-pinterest {
    color: #BF2131;
}

.bg-youtube {
    background: #E0291D;
}

.text-youtube {
    color: #E0291D;
}

.bg-googleplus {
    background: #C73E2E;
}

.text-googleplus {
    color: #C73E2E;
}

.bg-instagram {
    background: #AA7C62;
}

.text-instagram {
    color: #AA7C62;
}

.bg-viber {
    background: #7B519D;
}

.text-viber {
    color: #7B519D;
}

.bg-behance {
    background: #0057ff;
}

.text-behance {
    color: #0057ff;
}

.bg-dropbox {
    background: #3380FF;
}

.text-dropbox {
    color: #3380FF;
}

.bg-linkedin {
    background: #0077B5;
}

.text-linkedin {
    color: #0077B5;
}

/*====== text-color css ends ======*/
/*====== width, Height css starts ======*/
.wid-20 {
    width: 20px;
}

.hei-20 {
    height: 20px;
}

.wid-25 {
    width: 25px;
}

.hei-25 {
    height: 25px;
}

.wid-30 {
    width: 30px;
}

.hei-30 {
    height: 30px;
}

.wid-35 {
    width: 35px;
}

.hei-35 {
    height: 35px;
}

.wid-40 {
    width: 40px;
}

.hei-40 {
    height: 40px;
}

.wid-45 {
    width: 45px;
}

.hei-45 {
    height: 45px;
}

.wid-50 {
    width: 50px;
}

.hei-50 {
    height: 50px;
}

.wid-55 {
    width: 55px;
}

.hei-55 {
    height: 55px;
}

.wid-60 {
    width: 60px;
}

.hei-60 {
    height: 60px;
}

.wid-65 {
    width: 65px;
}

.hei-65 {
    height: 65px;
}

.wid-70 {
    width: 70px;
}

.hei-70 {
    height: 70px;
}

.wid-75 {
    width: 75px;
}

.hei-75 {
    height: 75px;
}

.wid-80 {
    width: 80px;
}

.hei-80 {
    height: 80px;
}

.wid-85 {
    width: 85px;
}

.hei-85 {
    height: 85px;
}

.wid-90 {
    width: 90px;
}

.hei-90 {
    height: 90px;
}

.wid-95 {
    width: 95px;
}

.hei-95 {
    height: 95px;
}

.wid-100 {
    width: 100px;
}

.hei-100 {
    height: 100px;
}

.wid-105 {
    width: 105px;
}

.hei-105 {
    height: 105px;
}

.wid-110 {
    width: 110px;
}

.hei-110 {
    height: 110px;
}

.wid-115 {
    width: 115px;
}

.hei-115 {
    height: 115px;
}

.wid-120 {
    width: 120px;
}

.hei-120 {
    height: 120px;
}

.wid-125 {
    width: 125px;
}

.hei-125 {
    height: 125px;
}

.wid-130 {
    width: 130px;
}

.hei-130 {
    height: 130px;
}

.wid-135 {
    width: 135px;
}

.hei-135 {
    height: 135px;
}

.wid-140 {
    width: 140px;
}

.hei-140 {
    height: 140px;
}

.wid-145 {
    width: 145px;
}

.hei-145 {
    height: 145px;
}

.wid-150 {
    width: 150px;
}

.hei-150 {
    height: 150px;
}

/*====== width, Height css ends ======*/
/*====== border-width css starts ======*/
.b-wid-1 {
    border-width: 1px;
}

.b-wid-2 {
    border-width: 2px;
}

.b-wid-3 {
    border-width: 3px;
}

.b-wid-4 {
    border-width: 4px;
}

.b-wid-5 {
    border-width: 5px;
}

.b-wid-6 {
    border-width: 6px;
}

.b-wid-7 {
    border-width: 7px;
}

.b-wid-8 {
    border-width: 8px;
}

/*====== border-width css ends ======*/
/* new logo start */
.b-brand {
    display: flex;
    align-items: center;
}

.b-brand .b-bg {
    background: #1abc9c;
    border-radius: 3px;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #fff;
}

.b-brand .b-title {
    margin-left: 10px;
    font-weight: 400;
    color: #fff;
    font-size: 16px;
}

.navbar-collapsed .b-brand .b-title {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.navbar-collapsed .mobile-menu {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.navbar-collapsed:hover .b-brand .b-title {
    transform: rotateY(0deg);
    opacity: 1;
}

.navbar-collapsed:hover .mobile-menu {
    transition-delay: 0.3s;
    transform: rotateY(0deg);
    opacity: 1;
}

/* new logo End  */
/* Pre-loader css start */
.loader-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    z-index: 1035;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
}

.loader-bg .loader-track {
    position: relative;
    height: 3px;
    display: block;
    width: 100%;
    overflow: hidden;
}

.loader-bg .loader-track .loader-fill:after, .loader-bg .loader-track .loader-fill:before {
    content: '';
    background: #fff;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    will-change: left, right;
}

.loader-bg .loader-track .loader-fill:before {
    -webkit-animation: mbar 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    animation: mbar 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
}

.loader-bg .loader-track .loader-fill:after {
    -webkit-animation: m_s 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    animation: m_s 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    -webkit-animation-delay: 1.15s;
    animation-delay: 1.15s;
}

@-webkit-keyframes mbar {
    0% {
        left: -35%;
        right: 100%;
    }

    60% {
        left: 100%;
        right: -90%;
    }

    100% {
        left: 100%;
        right: -35%;
    }
}

@keyframes mbar {
    0% {
        left: -35%;
        right: 100%;
    }

    60% {
        left: 100%;
        right: -90%;
    }

    100% {
        left: 100%;
        right: -35%;
    }
}

@-webkit-keyframes m_s {
    0% {
        left: -200%;
        right: 100%;
    }

    60% {
        left: 107%;
        right: -8%;
    }

    100% {
        left: 107%;
        right: -8%;
    }
}

@keyframes m_s {
    0% {
        left: -200%;
        right: 100%;
    }

    60% {
        left: 107%;
        right: -8%;
    }

    100% {
        left: 107%;
        right: -8%;
    }
}

/* Pre-loader css end */
/* header css start */
.search-bar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05);
    z-index: 1030;
    background: #fff;
    padding: 6px 12px;
}

.search-bar .close {
    position: absolute;
    top: 9px;
    right: 9px;
    padding: 8px 16px;
}

.pcoded-header {
    z-index: 1029;
    position: relative;
    display: flex;
    min-height: 56px;
    padding: 0;
    top: 0;
    background: #fff;
    color: rgba(44, 62, 80, 0.8);
    width: 100%;
    transition: all 0.3s ease-in-out;
}

.pcoded-header .m-header {
    width: 235px;
    position: relative;
    height: 56px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 25px;
}

.pcoded-header .m-header .logo-dark,
    .pcoded-header .m-header .logo-thumb {
    display: none;
}

.pcoded-header .input-group {
    background: transparent;
}

.pcoded-header .input-group .input-group-text {
    margin-right: 0;
}

.pcoded-header .input-group .input-group-text,
  .pcoded-header a,
  .pcoded-header dropdown-toggle {
    color: rgba(44, 62, 80, 0.8);
}

.pcoded-header .input-group .input-group-text:hover,
    .pcoded-header a:hover,
    .pcoded-header dropdown-toggle:hover {
    color: #2c3e50;
}

.pcoded-header #mobile-header {
    display: none;
}

.pcoded-header .navbar-nav {
    padding-left: 0;
    list-style: none;
    margin-bottom: 0;
    display: inline-flex;
    flex-direction: row;
}

.pcoded-header .navbar-nav > li {
    line-height: 56px;
    display: inline-block;
    padding: 0 12px;
}

.pcoded-header .navbar-nav > li .nav-link {
    padding: 0;
}

.pcoded-header .navbar-nav > li:first-child {
    padding-left: 25px;
}

.pcoded-header .navbar-nav > li:last-child {
    padding-right: 25px;
}

.pcoded-header .navbar-nav .dropdown {
    height: 56px;
}

.pcoded-header .mr-auto .dropdown-menu {
    margin-left: -20px;
}

.pcoded-header .ml-auto {
    float: right;
    height: 56px;
}

.pcoded-header .ml-auto .dropdown-menu {
    margin-right: -20px;
}

.pcoded-header .pop-search {
    font-size: 16px;
}

.pcoded-header .dropdown .dropdown-toggle {
    line-height: 56px;
    display: inline-block;
    text-align: center;
    position: relative;
    min-width: 20px;
}

.pcoded-header .dropdown .dropdown-toggle > i {
    font-size: 16px;
}

.pcoded-header .dropdown .dropdown-toggle:after {
    display: none;
}

.pcoded-header .dropdown .dropdown-toggle .badge {
    position: absolute;
    top: 8px;
    right: -11px;
    font-size: 12px;
}

.pcoded-header .dropdown .dropdown-menu {
    position: absolute;
    min-width: 220px;
    margin: 0;
}

.pcoded-header .dropdown .dropdown-menu li {
    line-height: 1.2;
}

.pcoded-header .dropdown .dropdown-menu li a {
    padding: 10px;
    font-size: 14px;
}

.pcoded-header .dropdown .dropdown-menu li a > .fa-circle {
    font-size: 6px;
    opacity: 0.6;
}

.pcoded-header .dropdown .dropdown-menu li.active a, .pcoded-header .dropdown .dropdown-menu li:active a, .pcoded-header .dropdown .dropdown-menu li:focus a, .pcoded-header .dropdown .dropdown-menu li:hover a {
    color: #fff;
}

.pcoded-header .dropdown.mega-menu {
    position: static;
}

.pcoded-header .dropdown.mega-menu .dropdown-menu {
    margin-left: 0;
    left: 235px;
    width: calc(100vw - 235px - 18px);
}

.pcoded-header .dropdown.mega-menu .dropdown-menu .mega-title {
    margin: 25px 0 -10px 20px;
}

.pcoded-header .dropdown.mega-menu .dropdown-menu > .row > .col + .col:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 1px;
    height: 100%;
    background: rgba(226, 229, 232, 0.7);
}

.pcoded-header .dropdown .notification {
    width: 350px;
    padding: 0;
    line-height: 1.4;
    overflow: hidden;
}

.pcoded-header .dropdown .notification a {
    color: #373a3c;
}

.pcoded-header .dropdown .notification a:hover {
    color: #37474f;
}

.pcoded-header .dropdown .notification .noti-head {
    background: #2c3e50;
    padding: 15px 20px;
}

.pcoded-header .dropdown .notification .noti-head h6 {
    color: #fff;
}

.pcoded-header .dropdown .notification .noti-head a {
    color: #fff;
    text-decoration: underline;
    font-size: 13px;
}

.pcoded-header .dropdown .notification .noti-body {
    padding: 0;
    position: relative;
    height: 300px;
}

.pcoded-header .dropdown .notification .noti-body img {
    width: 40px;
    margin-right: 20px;
}

.pcoded-header .dropdown .notification .noti-body li {
    padding: 15px 20px;
    transition: all 0.3s ease-in-out;
}

.pcoded-header .dropdown .notification .noti-body li.n-title {
    padding-bottom: 0;
}

.pcoded-header .dropdown .notification .noti-body li.n-title p {
    margin-bottom: 5px;
}

.pcoded-header .dropdown .notification .noti-body li.notification:hover {
    background: rgba(26, 188, 156, 0.1);
}

.pcoded-header .dropdown .notification .noti-body li p {
    margin-bottom: 5px;
    font-size: 13px;
}

.pcoded-header .dropdown .notification .noti-body li p strong {
    color: #222;
}

.pcoded-header .dropdown .notification .noti-body li .n-time {
    font-size: 80%;
    float: right;
}

.pcoded-header .dropdown .notification .noti-footer {
    border-top: 1px solid #f1f1f1;
    padding: 15px 20px;
    text-align: center;
    background: #e9e9e9;
}

.pcoded-header .dropdown .notification .noti-footer a {
    text-decoration: underline;
    font-size: 13px;
}

.pcoded-header .dropdown .notification ul {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.pcoded-header .dropdown .notification ul li {
    padding: 20px 15px;
}

.pcoded-header .dropdown .profile-notification {
    padding: 0;
    line-height: 1.4;
    overflow: hidden;
}

.pcoded-header .dropdown .profile-notification .pro-head {
    color: #fff;
    padding: 15px;
    position: relative;
    background: #2c3e50;
}

.pcoded-header .dropdown .profile-notification .pro-head img {
    width: 40px;
    margin-right: 10px;
}

.pcoded-header .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
    padding-right: 0;
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pcoded-header .dropdown .profile-notification .pro-body {
    padding: 20px 0;
    margin-bottom: 0;
    list-style: none;
}

.pcoded-header .dropdown .profile-notification .pro-body li {
    margin: 0;
    border-radius: 0;
}

.pcoded-header .dropdown .profile-notification .pro-body li a {
    color: #373a3c;
    font-size: 14px;
    padding: 10px 20px;
}

.pcoded-header .dropdown .profile-notification .pro-body li a i {
    margin-right: 10px;
}

.pcoded-header .dropdown .profile-notification .pro-body li.active, .pcoded-header .dropdown .profile-notification .pro-body li:active, .pcoded-header .dropdown .profile-notification .pro-body li:focus, .pcoded-header .dropdown .profile-notification .pro-body li:hover {
    background: #1abc9c;
}

.pcoded-header .dropdown .profile-notification .pro-body li.active > a, .pcoded-header .dropdown .profile-notification .pro-body li:active > a, .pcoded-header .dropdown .profile-notification .pro-body li:focus > a, .pcoded-header .dropdown .profile-notification .pro-body li:hover > a {
    color: #fff;
    background: transparent;
}

/* header css end */
/* menu[ vartical ] css start */
.mob-toggler,
.mobile-menu {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 37px;
    height: 56px;
    position: absolute;
    right: 0;
    top: 0;
    padding: 0 10px;
}

.mob-toggler span,
  .mobile-menu span {
    position: relative;
    display: block;
    width: 100%;
    height: 2px;
    background-color: rgba(44, 62, 80, 0.8);
    transition: 0.3s cubic-bezier(0.97, 0.75, 0.61, 1.84);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 2px;
}

.mob-toggler span:after, .mob-toggler span:before,
    .mobile-menu span:after,
    .mobile-menu span:before {
    content: "";
    position: absolute;
    left: 0;
    height: 2px;
    background-color: rgba(44, 62, 80, 0.8);
    transition: 0.3s cubic-bezier(0.97, 0.75, 0.61, 1.84);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 2px;
}

.mob-toggler span:after,
    .mobile-menu span:after {
    top: 6px;
    width: 70%;
}

.mob-toggler span:before,
    .mobile-menu span:before {
    top: -6px;
    width: 40%;
}

.mob-toggler:hover span,
  .mobile-menu:hover span {
    background-color: #2c3e50;
}

.mob-toggler:hover span:after, .mob-toggler:hover span:before,
    .mobile-menu:hover span:after,
    .mobile-menu:hover span:before {
    background-color: #2c3e50;
    width: 100%;
}

.mob-toggler {
    right: 5px;
    display: none;
}

.pcoded-header:before,
.pcoded-main-container:before {
    content: "";
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar {
    display: block;
    z-index: 1028;
    position: absolute;
    box-shadow: 0 2px 10px -1px rgba(69, 90, 100, 0.3);
    transition: all 0.3s ease-in-out;
    width: 235px;
    height: calc(100% - 56px);
    margin-top: 56px;
    top: 0;
    background: #2c3e50;
    color: #d0dcda;
}

.pcoded-navbar ul {
    padding-left: 0;
    list-style: none;
    margin-bottom: 0;
}

.pcoded-navbar .scroll-div.navbar-content {
    height: 100%;
}

.pcoded-navbar .header-logo {
    position: relative;
    align-items: center;
    display: inline-flex;
    float: left;
    background: #2c3e50;
    height: 56px;
    text-align: center;
    width: 235px;
    margin-right: 0;
    padding: 10px 25px;
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar .header-logo .logo-dark {
    display: none;
}

.pcoded-navbar .header-logo .logo-thumb {
    transform: rotateY(-90deg);
    opacity: 0;
    position: absolute;
    transition: unset;
}

.pcoded-navbar .header-logo + .scroll-div {
    float: left;
    display: inline-block;
}

.pcoded-navbar .mobile-menu {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 37px;
    height: 56px;
    position: absolute;
    right: 10px;
    top: 0;
    padding: 0 10px;
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar .pcoded-badge {
    font-size: 75%;
    position: relative;
    right: 0;
    top: -1px;
    padding: 2px 7px;
    border-radius: 2px;
    display: inline-block;
    margin-left: 10px;
}

.pcoded-navbar .main-menu-header {
    background: #3e5871;
    position: relative;
    padding: 20px;
    text-align: left;
    display: flex;
    height: 82px;
    align-items: center;
}

.pcoded-navbar .main-menu-header .user-details {
    cursor: pointer;
    display: inline-block;
    margin-left: 10px;
}

.pcoded-navbar .main-menu-header .user-details > div,
      .pcoded-navbar .main-menu-header .user-details > span {
    transition: all 0.2s ease-in-out;
}

.pcoded-navbar .main-menu-header .img-radius {
    width: 40px;
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar .main-menu-header + div .list-group-item {
    cursor: pointer;
    position: relative;
    background: transparent;
    overflow: hidden;
    padding: 0.75rem 1.85rem;
    border: none;
}

.pcoded-navbar .pcoded-inner-navbar {
    flex-direction: column;
}

.pcoded-navbar .pcoded-inner-navbar li {
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li > a {
    text-align: left;
    padding: 5px 10px;
    margin: 0 0 5px;
    display: block;
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li > a .pcoded-mtext {
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li > a > .pcoded-micon {
    font-size: 16px;
    padding: 0;
    margin-right: 5px;
    border-radius: 4px;
    width: 30px;
    display: inline-flex;
    align-items: center;
    height: 30px;
    text-align: center;
    justify-content: center;
}

.pcoded-navbar .pcoded-inner-navbar li > a > .pcoded-micon + .pcoded-mtext {
    position: relative;
    top: 0;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu > a:after {
    content: "\e844";
    font-family: 'feather';
    font-size: 13px;
    border: none;
    position: absolute;
    top: 13px;
    right: 20px;
    transition: 0.3s ease-in-out;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu.pcoded-trigger > a:after {
    transform: rotate(90deg);
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu {
    display: none;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu a:after {
    top: 7px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu.pcoded-trigger.active > .pcoded-submenu {
    display: block;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu.pcoded-trigger.active > a {
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu {
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li {
    position: relative;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li > a {
    text-align: left;
    padding: 7px 7px 7px 45px;
    margin: 0;
    display: block;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li > a:before {
    content: "\e844";
    font-family: 'feather';
    position: absolute;
    top: 10px;
    left: 24px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li .pcoded-submenu:after {
    left: 45px;
    top: -20px;
    height: calc(100% - 15px);
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li .pcoded-submenu > li:after {
    left: 46px;
    width: 20px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li .pcoded-submenu > li > a {
    padding: 7px 7px 7px 65px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li .pcoded-submenu > li > a:before {
    left: 45px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption {
    font-size: 13px;
    font-weight: 600;
    color: #1abc9c;
    padding: 18px 15px 5px;
    text-transform: capitalize;
    position: relative;
    margin-top: 10px;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption:first-child {
    border-top: none;
    margin-top: 0;
}

.pcoded-navbar .pcoded-inner-navbar li.pcoded-menu-caption > label {
    margin-bottom: 0;
}

.pcoded-navbar .pcoded-inner-navbar li.disabled > a {
    cursor: default;
    opacity: 0.5;
}

.pcoded-navbar .pcoded-submenu {
    background: #2c3e50;
    padding: 15px 0;
}

.pcoded-navbar a {
    color: #d0dcda;
}

.pcoded-navbar .navbar-content,
  .pcoded-navbar .navbar-wrapper {
    width: 100%;
    height: 100%;
}

.pcoded-navbar.navbar-collapsed {
    width: 70px;
    height: calc(100% - 56px);
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar.navbar-collapsed .header-logo {
    width: 70px;
    padding: 10px 20px;
}

.pcoded-navbar.navbar-collapsed .header-logo img {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
    transition: unset;
}

.pcoded-navbar.navbar-collapsed .header-logo .logo-thumb {
    transform: rotateY(0deg);
    transform-origin: 0 0;
    opacity: 1;
    left: calc((70px / 2) - 20px);
}

.pcoded-navbar.navbar-collapsed .header-logo .mobile-menu {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
}

.pcoded-navbar.navbar-collapsed .navbar-content.ps {
    overflow: visible;
}

.pcoded-navbar.navbar-collapsed .pcoded-menu-caption {
    position: relative;
    width: 100%;
    height: auto;
    white-space: nowrap;
    overflow: hidden;
}

.pcoded-navbar.navbar-collapsed .pcoded-menu-caption > label {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar.navbar-collapsed .pcoded-menu-caption:after {
    content: "";
    position: absolute;
    top: 32px;
    left: 15px;
    width: calc(100% - 30px);
    height: 1px;
    background: rgba(208, 220, 218, 0.5);
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li > a {
    padding: 7px 20px;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li > a > .pcoded-micon + .pcoded-mtext {
    position: absolute;
    top: 11px;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li > a > .pcoded-mtext {
    transform: rotateY(-90deg);
    transform-origin: 0 0;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-hasmenu > a:after {
    right: 12px;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-hasmenu .pcoded-submenu {
    display: none;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-trigger .pcoded-submenu li a {
    color: transparent;
    white-space: nowrap;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-trigger .pcoded-submenu li + li a {
    border-top: none;
}

.pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-trigger .pcoded-submenu .pcoded-submenu li a:before {
    opacity: 0;
}

.pcoded-navbar.navbar-collapsed ~ .pcoded-header .dropdown.mega-menu .dropdown-menu {
    left: 70px;
    width: calc(100vw - 70px - 15px);
}

.pcoded-navbar.navbar-collapsed ~ .pcoded-main-container {
    margin-left: 70px;
}

.pcoded-navbar.navbar-collapsed .pcoded-badge {
    transform: rotateX(-90deg);
    transform-origin: 50% 50%;
    opacity: 0;
    display: none;
    transition: all 0.15s ease-in-out;
}

.pcoded-navbar.navbar-collapsed:hover {
    width: 235px !important;
}

.pcoded-navbar.navbar-collapsed:hover .header-logo {
    width: 235px;
}

.pcoded-navbar.navbar-collapsed:hover .header-logo img {
    transform: rotateY(0deg);
    opacity: 1;
}

.pcoded-navbar.navbar-collapsed:hover .header-logo .logo-thumb {
    transform: rotateY(-90deg);
    opacity: 0;
}

.pcoded-navbar.navbar-collapsed:hover .header-logo .mobile-menu {
    display: flex;
    right: 10px;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-menu-caption > label {
    transform: rotateY(0deg);
    opacity: 1;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-menu-caption:after {
    background: transparent;
}

.pcoded-navbar.navbar-collapsed:hover .mobile-menu {
    transform: rotateY(0deg);
    opacity: 1;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li > a > .pcoded-mtext {
    transform: rotateY(0deg);
    opacity: 1;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li > a > .pcoded-mtext:after {
    opacity: 1;
    visibility: visible;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li.pcoded-hasmenu > a:after {
    transform: rotateX(0deg);
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li.pcoded-hasmenu.pcoded-trigger > a:after {
    transform: rotateX(0deg) rotate(90deg);
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li.pcoded-trigger .pcoded-submenu li a {
    color: inherit;
}

.pcoded-navbar.navbar-collapsed:hover .pcoded-inner-navbar > li.pcoded-trigger .pcoded-submenu .pcoded-submenu li a:before {
    opacity: 1;
}

.pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li > a {
    transition: all 0.3s ease-in-out;
}

.pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li > a:after {
    display: none;
}

.pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.active > a:before,
    .pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.pcoded-trigger > a:before,
    .pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li:hover > a:before {
    content: "";
    top: 10px;
    left: 31px;
    border-radius: 50%;
    background: #1abc9c;
    padding: 5px;
    box-shadow: 0 0 0 5px #2c3e50;
    z-index: 6;
}

.pcoded-navbar.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu:before {
    content: "";
    width: 2px;
    height: 100%;
    position: absolute;
    top: 0;
    left: calc(70px / 2);
    z-index: 5;
    background: rgba(208, 220, 218, 0.2);
}

.pcoded-navbar.navbar-collapsed:not(:hover) .main-menu-header {
    padding: 25px 15px;
}

.pcoded-navbar.navbar-collapsed:not(:hover) .main-menu-header .user-details > div,
      .pcoded-navbar.navbar-collapsed:not(:hover) .main-menu-header .user-details > span {
    opacity: 0;
    transform: rotateY(-90deg);
}

.pcoded-navbar .pcoded-menu-caption {
    color: #8090a5;
}

.pcoded-navbar .pcoded-inner-navbar li.active > a, .pcoded-navbar .pcoded-inner-navbar li:focus > a, .pcoded-navbar .pcoded-inner-navbar li:hover > a {
    color: #1abc9c;
}

.pcoded-navbar .pcoded-inner-navbar > li.active > a, .pcoded-navbar .pcoded-inner-navbar > li.pcoded-trigger > a {
    background: #1abc9c;
    color: #fff;
}

.pcoded-navbar .pcoded-inner-navbar > .pcoded-menu-caption.active:after, .pcoded-navbar .pcoded-inner-navbar > .pcoded-menu-caption.pcoded-trigger:after {
    display: none;
}

.pcoded-navbar.mob-open ~ .pcoded-header:before,
.pcoded-navbar.mob-open ~ .pcoded-main-container:before, .pcoded-navbar.navbar-collapsed:hover ~ .pcoded-header:before,
.pcoded-navbar.navbar-collapsed:hover ~ .pcoded-main-container:before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

/* ===  scroll bar start  ===== */
.navbar-content {
    position: relative;
}

.ps__rail-y {
    z-index: 5;
}

.ps .ps__rail-x.ps--clicking,
.ps .ps__rail-x:focus,
.ps .ps__rail-x:hover,
.ps .ps__rail-y.ps--clicking,
.ps .ps__rail-y:focus,
.ps .ps__rail-y:hover {
    background: transparent;
}

.ps__thumb-y {
    background: darkgray;
}

.ps__rail-y.ps--clicking .ps__thumb-y,
.ps__rail-y:focus > .ps__thumb-y,
.ps__rail-y:hover > .ps__thumb-y {
    background: #b6b6b6;
}

/* ===  scroll bar End  ===== */
/* menu [ vartical ] css end */
/* menu[ horizontal ] css start */
.pcoded-navbar.theme-horizontal {
    display: block;
    height: 56px;
    width: 100%;
    z-index: 1023;
    position: fixed;
    border-radius: 0;
    top: 56px;
    margin-top: 0;
}

.pcoded-navbar.theme-horizontal .pcoded-badge {
    display: none;
}

.pcoded-navbar.theme-horizontal.top-nav-collapse {
    top: 0;
}

.pcoded-navbar.theme-horizontal.default, .pcoded-navbar.theme-horizontal.default.top-nav-collapse {
    top: 56px;
}

.pcoded-navbar.theme-horizontal.header-hide {
    top: 0;
}

.pcoded-navbar.theme-horizontal.header-hide.top-nav-collapse {
    top: -56px;
}

.pcoded-navbar.theme-horizontal.header-hide ~ .pcoded-main-container {
    margin-top: 56px;
}

.pcoded-navbar.theme-horizontal .header-logo {
    display: none;
}

.pcoded-navbar.theme-horizontal .sidenav-horizontal-wrapper {
    display: flex;
    align-items: center;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar {
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
    white-space: nowrap;
    transition: all 0.5s ease-in-out;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-menu-caption {
    display: none;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li {
    display: inline-flex;
    list-style: outside none none;
    margin: 0;
    padding: 0;
    position: relative;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li > a {
    margin: 0;
    padding: 8px 15px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li > a > .pcoded-mtext {
    position: relative;
    top: 0;
    margin-right: 5px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li > a:after {
    position: relative;
    top: 0;
    right: 0;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.active a, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-trigger a, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li:hover a {
    box-shadow: none;
    color: #fff;
    background: transparent;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.active:before, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.pcoded-trigger:before {
    content: "\6d";
    position: absolute;
    bottom: -27px;
    left: 0;
    font-family: "pct";
    z-index: 1001;
    font-size: 50px;
    line-height: 1;
    padding-left: calc(50% - 25px);
    color: #2c3e50;
    text-shadow: 0 3px 4px rgba(69, 90, 100, 0.3);
    width: 100%;
    height: 40px;
    transform: scaleX(1.2);
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.active > .pcoded-submenu, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.pcoded-trigger > .pcoded-submenu {
    margin-top: 30px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.active:after, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-trigger:after {
    content: "";
    background-color: #1abc9c;
    z-index: 4;
    position: absolute;
    left: 19px;
    top: auto;
    bottom: 5px;
    width: 23px;
    height: 2px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.edge > .pcoded-submenu {
    left: auto;
    right: 0;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu {
    position: relative;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu {
    opacity: 0;
    visibility: hidden;
    transform-origin: 50% 50%;
    transition: transform 0.3s, opacity 0.3s;
    transform-style: preserve-3d;
    transform: rotateX(-90deg);
    position: absolute;
    min-width: 250px;
    display: block;
    z-index: 1;
    top: 100%;
    list-style: outside none none;
    margin: 0;
    border-radius: 4px;
    padding: 15px;
    box-shadow: 0 4px 24px 0 rgba(62, 57, 107, 0.18);
    background: #fff;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu:after {
    display: none;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu a {
    color: #2c3e50;
    padding: 10px 20px 10px 30px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu a:before {
    left: 5px;
    top: 11px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu li + li a {
    border-top-color: #ededed;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu li:after {
    display: none;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu li.active > a, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu li.pcoded-trigger > a, .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu li:hover > a {
    color: #1abc9c;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-submenu {
    position: absolute;
    min-width: 250px;
    z-index: 1;
    left: calc(100% + 10px);
    top: -10px;
    margin: 0 0 0 20px;
    border-radius: 4px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-submenu:before {
    content: "\6a";
    position: absolute;
    top: 8px;
    left: -31px;
    font-family: "pct";
    z-index: 1001;
    font-size: 50px;
    line-height: 1;
    color: #fff;
    width: 40px;
    height: 100%;
    text-shadow: -8px 0 13px rgba(62, 57, 107, 0.08);
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-submenu a {
    color: #2c3e50;
    padding: 10px 20px 10px 30px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-submenu a:before {
    left: 5px;
    top: 11px;
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-hasmenu.edge .pcoded-submenu {
    left: auto;
    margin: 0 20px 0 0;
    right: calc(100% + 10px);
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu .pcoded-submenu .pcoded-hasmenu.edge .pcoded-submenu:before {
    content: '\6b';
    left: auto;
    right: -21px;
    text-shadow: 8px 0 13px rgba(62, 57, 107, 0.08);
}

.pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu.pcoded-trigger > .pcoded-submenu {
    opacity: 1;
    visibility: visible;
    transform: rotateX(0deg);
}

.pcoded-navbar.theme-horizontal .navbar-content {
    display: flex;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header {
    position: fixed;
    top: 0;
    margin-left: 0;
    width: 100%;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .dropdown.mega-menu .dropdown-menu {
    left: 0;
    width: 100vw;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .b-title {
    color: #2c3e50;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*='header-'] .b-title {
    color: #fff;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .m-header {
    display: inline-flex;
    padding: 0 15px;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .m-header .logo-main,
      .pcoded-navbar.theme-horizontal ~ .pcoded-header .m-header .logo-thumb {
    display: none;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .m-header .logo-dark {
    display: inline-block;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header .mobile-menu {
    display: none;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .m-header {
    display: inline-flex;
    padding: 0 15px;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .m-header .logo-dark,
        .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .m-header .logo-thumb {
    display: none;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .m-header .logo-main {
    display: inline-block;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu {
    color: #373a3c;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu a {
    color: #373a3c;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li.active, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:active, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:focus, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:hover {
    background: rgba(26, 188, 156, 0.1);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li.active > a, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:active > a, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:focus > a, .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] a,
      .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown .notification .noti-body li.notification:hover {
    background: rgba(26, 188, 156, 0.1);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown .profile-notification .pro-head {
    color: #fff;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-main-container {
    margin-top: 112px;
    margin-left: 0;
    padding-top: 1px;
    min-height: calc(100vh - 112px);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-main-container .page-header h5 {
    color: #37474f;
}

.pcoded-navbar.theme-horizontal ~ .pcoded-main-container .page-header .page-header-title + .breadcrumb > .breadcrumb-item:before {
    color: rgba(55, 71, 79, 0.8);
}

.pcoded-navbar.theme-horizontal ~ .pcoded-main-container .page-header .page-header-title + .breadcrumb > .breadcrumb-item a {
    color: #37474f;
}

/* menu [ horizontal ] css end */
/* main content start */
.pcoded-content {
    position: relative;
    display: block;
    padding: 25px;
}

.pcoded-main-container {
    position: relative;
    margin: 0 auto;
    padding-top: 0;
    display: block;
    clear: both;
    float: unset;
    right: 0;
    top: 0;
    margin-left: 235px;
    min-height: 100vh;
    transition: all 0.3s ease-in-out;
}

/* main content end*/
/* ==========================    Rsponsive Menu  start   ====================== */
@media only screen and (max-width: 991px) {
    .pcoded-header .input-group-text,
  .pcoded-header a,
  .pcoded-header dropdown-toggle {
        color: #2c3e50;
    }

    .pcoded-header .input-group-text:hover,
    .pcoded-header a:hover,
    .pcoded-header dropdown-toggle:hover {
        color: #1abc9c;
    }

    .pcoded-header #mobile-header {
        display: none;
        right: 20px;
    }

    .pcoded-header .dropdown.mega-menu .dropdown-menu {
        left: 0;
        width: 100vw;
    }

    .pcoded-header > .collapse:not(.show),
  .pcoded-header .container > .collapse:not(.show) {
        background: #fff;
        box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .pcoded-header > .collapse:not(.show) .mob-toggler:after,
    .pcoded-header .container > .collapse:not(.show) .mob-toggler:after {
        content: "\e89a";
        font-family: "feather";
        font-size: 20px;
        color: #2c3e50;
        position: absolute;
        right: 10px;
        top: 0;
        width: 40px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pcoded-header > .collapse:not(.show) .mr-auto,
    .pcoded-header .container > .collapse:not(.show) .mr-auto {
        height: 56px;
        display: flex;
        justify-content: center;
    }

    .pcoded-header > .collapse:not(.show) .ml-auto,
    .pcoded-header .container > .collapse:not(.show) .ml-auto {
        margin-left: auto;
        margin-right: 0 !important;
    }

    .pcoded-header .dropdown-menu,
  .pcoded-header .dropdown-menu a,
  .pcoded-header .search-close .input-group-text {
        color: #2c3e50;
    }

    .pcoded-header .m-header {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 56px;
    }

    .pcoded-header .m-header .mobile-menu {
        right: auto;
        left: 10px;
    }

    .pcoded-header .m-header .mob-toggler {
        display: flex;
    }

    .pcoded-header .full-screen {
        display: none;
    }

    .pcoded-header .navbar-nav > li:last-child {
        padding-right: 20px;
    }

    .pcoded-navbar {
        margin-left: -235px;
        position: absolute;
        height: calc(100% - 56px);
    }

    .pcoded-navbar .scroll-div.navbar-content {
        height: 100%;
    }

    .pcoded-navbar ~ .pcoded-header,
    .pcoded-navbar ~ .pcoded-main-container {
        margin-left: 0;
    }

    .pcoded-navbar ~ .pcoded-header {
        width: 100%;
    }

    .pcoded-navbar .navbar-brand {
        display: none;
    }

    .pcoded-navbar.mob-open {
        margin-left: 0;
    }

    .pcoded-navbar.mob-open .pcoded-main-container ~ .pcoded-header,
      .pcoded-navbar.mob-open ~ .pcoded-main-container {
        margin-left: 0;
    }

    .pcoded-main-container {
        padding-top: 0;
    }
}

@media only screen and (max-width: 575px) {
    .pcoded-header .main-search.open .input-group .search-close {
        display: none;
    }

    .pcoded-header .navbar-nav > li {
        padding: 0 8px;
    }

    .pcoded-header .navbar-nav.ml-auto > li:first-child {
        padding-left: 0;
    }

    .pcoded-header .navbar-nav > li:last-child {
        padding-right: 15px;
    }

    .pcoded-header .navbar-nav.mr-auto li.nav-item:not(.dropdown) {
        display: block;
        padding-right: 0;
    }

    .pcoded-header .navbar-nav.mr-auto li.nav-item:not(.dropdown) .search-close {
        display: none;
    }

    .pcoded-header .dropdown.show {
        position: static;
    }

    .pcoded-header .dropdown.show a:after {
        display: none;
    }

    .pcoded-header .dropdown.show:before {
        display: none;
    }

    .pcoded-header .dropdown.mega-menu {
        position: static;
    }

    .pcoded-header .dropdown.mega-menu .dropdown-menu.profile-notification .pro-body li a {
        padding: 5px 10px;
    }

    .pcoded-header .dropdown .notification {
        width: 100%;
    }

    .pcoded-header .dropdown .dropdown-menu {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
    }

    .header-chat.open,
  .header-user-list.open {
        width: 280px;
    }

    .pcoded-content {
        padding: 25px 15px;
    }

    .card {
        margin-bottom: 15px;
    }
}

@media only screen and (max-width: 1200px) and (min-width: 768px) {
    .pcoded-navbar .header-logo {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed .header-logo img {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed .pcoded-menu-caption > label {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li > a > .pcoded-mtext {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed .pcoded-inner-navbar > li.pcoded-hasmenu > a:after {
        transition: none;
        transition-delay: 0;
    }

    .pcoded-navbar.navbar-collapsed .pcoded-badge {
        transition: none;
    }

    .pcoded-navbar.navbar-collapsed:hover .pcoded-badge {
        transition-delay: 0;
    }
}

@media only screen and (max-width: 1024px) {
    .pcoded-navbar.navbar-collapsed ~ .pcoded-header .dropdown.mega-menu .dropdown-menu {
        left: 70px;
        width: calc(100vw - 70px);
    }
}

@media only screen and (max-width: 350px) {
    .pcoded-header .dropdown.mega-menu {
        display: none;
    }
}

/* responsive horizontal menu */
@media only screen and (max-width: 991px) {
    .pcoded-navbar.theme-horizontal {
        margin-left: 0;
    }

    .pcoded-navbar.theme-horizontal ~ .pcoded-header > .collapse:not(.show),
    .pcoded-navbar.theme-horizontal ~ .pcoded-header .container > .collapse:not(.show) {
        display: inline-flex;
        background: #fff;
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    }

    .pcoded-navbar.theme-horizontal ~ .pcoded-header .b-title {
        color: #fff;
    }

    .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu.pcoded-trigger > .pcoded-submenu .pcoded-trigger > .pcoded-submenu,
    .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu.pcoded-trigger > .pcoded-submenu .pcoded-trigger.edge > .pcoded-submenu {
        position: relative;
        left: 0;
        min-width: 100%;
        margin: 0;
        box-shadow: none;
    }

    .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu.pcoded-trigger > .pcoded-submenu .pcoded-trigger > .pcoded-submenu:before,
      .pcoded-navbar.theme-horizontal .pcoded-inner-navbar .pcoded-hasmenu.pcoded-trigger > .pcoded-submenu .pcoded-trigger.edge > .pcoded-submenu:before {
        display: none;
    }
}

/* ==========================    Rsponsive Menu  end   ====================== */
/* ******************************************************************************* */
/* * Horizontal */
.theme-horizontal .sidenav-horizontal-wrapper {
    flex: 1 1 auto;
    width: 0;
}

.sidenav:not(.sidenav-no-animation) .theme-horizontal .sidenav-horizontal-wrapper .sidenav-inner {
    transition: margin 0.2s;
}

.theme-horizontal .sidenav-horizontal-next,
.theme-horizontal .sidenav-horizontal-prev {
    position: relative;
    display: block;
    flex: 0 0 auto;
    width: 2.25rem;
    background-color: #2c3e50;
    z-index: 9;
}

.theme-horizontal .sidenav-horizontal-next::after,
  .theme-horizontal .sidenav-horizontal-prev::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    display: block;
    width: 0.8rem;
    height: 0.8rem;
    border: 2px solid;
    border-top: 0;
}

.theme-horizontal .sidenav-horizontal-next.disabled,
  .theme-horizontal .sidenav-horizontal-prev.disabled {
    cursor: default !important;
    opacity: 0;
}

.theme-horizontal .sidenav-horizontal-prev::after {
    border-right: 0;
    transform: translate(-50%, -50%) rotate(45deg);
}

.theme-horizontal .sidenav-horizontal-next::after {
    border-left: 0;
    transform: translate(-50%, -50%) rotate(-45deg);
}

.theme-horizontal .sidenav-horizontal:after, .theme-horizontal .sidenav-horizontal:before {
    content: "";
    background: #2c3e50;
    width: 100%;
    position: absolute;
    top: 0;
    height: 100%;
    z-index: 5;
}

@media only screen and (max-width: 991px) {
    .theme-horizontal .sidenav-horizontal:after, .theme-horizontal .sidenav-horizontal:before {
        display: none;
    }
}

.theme-horizontal .sidenav-horizontal:before {
    left: 100%;
}

.theme-horizontal .sidenav-horizontal:after {
    right: 100%;
}

.theme-horizontal.menu-light .sidenav-horizontal:after, .theme-horizontal.menu-light .sidenav-horizontal:before {
    background: #fff;
}

@-webkit-keyframes sidenavDropdownShow {
    0% {
        opacity: 0;
        transform: translateY(-0.5rem);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes sidenavDropdownShow {
    0% {
        opacity: 0;
        transform: translateY(-0.5rem);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.pcoded-navbar .card {
    background: rgba(255, 255, 255, 0.1);
    margin: 20px;
    box-shadow: 0 0 0 1px rgba(226, 229, 232, 0.15);
    color: rgba(255, 255, 255, 0.6);
}

.pcoded-navbar .card h6 {
    color: rgba(255, 255, 255, 0.6);
}

.pcoded-navbar .card .close {
    position: absolute;
    color: #d0dcda;
    position: absolute;
    top: 10px;
    right: 12px;
    opacity: 0.8;
    text-shadow: none;
}

.pcoded-navbar.menu-light .card {
    background: rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 0 1px #e9e9e9;
    color: rgba(0, 0, 0, 0.6);
}

.pcoded-navbar.menu-light .card h6 {
    color: #535763;
}

.pcoded-navbar.menu-light .card .close {
    color: #535763;
}

.pcoded-navbar.navbar-collapsed .card {
    display: none;
}

.menu-styler {
    z-index: 1029;
    position: relative;
    color: #373a3c;
}

.menu-styler h5,
  .menu-styler h6 {
    color: #37474f;
}

.menu-styler hr {
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.menu-styler .style-toggler {
    position: relative;
    z-index: 1028;
}

.menu-styler .style-toggler > a {
    position: fixed;
    right: 0;
    top: 250px;
    z-index: 1031;
    transition: 0.3s ease-in-out;
}

.menu-styler .style-toggler > a:before {
    content: "";
    width: 60px;
    height: 60px;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 1001;
    background: #2c3e50;
    transition: 0.3s ease-in-out;
    border-radius: 4px 0 0 4px;
    box-shadow: 0 0 0 2px #1abc9c;
}

.menu-styler .style-toggler > a:after {
    content: "\e8c3";
    top: 14px;
    font-size: 30px;
    position: absolute;
    right: 12px;
    font-family: "feather";
    z-index: 1029;
    line-height: 1;
    -webkit-animation: mymove 1.3s infinite linear;
    animation: mymove 1.3s infinite linear;
    color: #fff;
    transition: 0.3s ease-in-out;
}

@media all and (-ms-high-contrast: none) {
    .menu-styler .style-toggler > a:after {
        line-height: 0.5;
        top: 18px;
    }
}

.menu-styler.open .style-toggler > a, .menu-styler.prebuild-open .style-toggler > a {
    right: 400px;
    -webkit-animation: sh-shake 0s ease infinite;
    animation: sh-shake 0s ease infinite;
}

.menu-styler.open .style-toggler > a:after, .menu-styler.prebuild-open .style-toggler > a:after {
    content: "\e8f6";
    -webkit-animation: mymove 0s linear infinite;
    animation: mymove 0s linear infinite;
}

.menu-styler.open .prebuild-toggler > .prebuild-group, .menu-styler.prebuild-open .prebuild-toggler > .prebuild-group {
    right: calc(400px - 100px);
}

.menu-styler.open .style-block {
    right: 0;
    box-shadow: -6px 0 12px rgba(0, 0, 0, 0.175);
}

.menu-styler.prebuild-open .style-block-prebuild {
    right: 0;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

.menu-styler .style-block,
  .menu-styler .style-block-prebuild {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    border-radius: 4px 0 0 4px;
    background: #fff;
    z-index: 1030;
    transition: 0.3s ease-in-out;
    padding: 25px 20px 20px;
}

.menu-styler .mst-scroll {
    height: calc(100vh - 175px);
    background-color: rgba(26, 188, 156, 0.03);
    padding: 0 15px;
}

.menu-styler label {
    margin-bottom: 3px;
}

.menu-styler .switch input[type=checkbox] + .cr {
    top: 8px;
}

.menu-styler .radio input[type=radio] + .cr {
    margin-right: 10px;
}

.menu-styler .radio input[type=radio] + .cr:after, .menu-styler .radio input[type=radio] + .cr:before {
    margin-right: 3px;
}

.menu-styler h6 {
    position: relative;
    margin: 20px 0 10px;
}

.menu-styler .nav-pills {
    padding: 0;
    box-shadow: none;
}

.menu-styler .nav-pills li {
    width: calc(100% / 3);
}

.menu-styler .m-style-scroller {
    padding: 15px 20px;
    box-shadow: none;
    background-color: #e9e9e9;
    border-radius: 4px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.24);
}

@media only screen and (max-width: 992px) {
    .menu-styler {
        display: none;
    }
}

@-webkit-keyframes mymove {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

@keyframes mymove {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

@-webkit-keyframes sh-shake {
    0%,
  100%,
  25% {
        transform: scale(1);
    }

    15%,
  3%,
  9% {
        transform: scale(1.1);
    }

    12%,
  20%,
  6% {
        transform: scale(0.9);
    }
}

@keyframes sh-shake {
    0%,
  100%,
  25% {
        transform: scale(1);
    }

    15%,
  3%,
  9% {
        transform: scale(1.1);
    }

    12%,
  20%,
  6% {
        transform: scale(0.9);
    }
}

.lay-customizer .theme-color,
.theme-color {
    display: block;
    position: relative;
    padding: 0;
    margin-bottom: 10px;
}

.lay-customizer .theme-color > a,
  .theme-color > a {
    position: relative;
    width: 45px;
    height: 30px;
    border-radius: 3px;
    display: inline-block;
    background: #e9e9e9;
    overflow: hidden;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.28);
}

.lay-customizer .theme-color > a + a,
    .theme-color > a + a {
    margin-left: 8px;
}

.lay-customizer .theme-color > a span,
    .theme-color > a span {
    width: 100%;
    position: absolute;
}

.lay-customizer .theme-color > a span:after, .lay-customizer .theme-color > a span:before,
      .theme-color > a span:after,
      .theme-color > a span:before {
    content: "";
    height: 100%;
    position: absolute;
}

.lay-customizer .theme-color > a span:before,
      .theme-color > a span:before {
    width: 32%;
    left: 0;
    background: #2c3e50;
}

.lay-customizer .theme-color > a span:after,
      .theme-color > a span:after {
    width: 70%;
    right: 0;
    background: #e9e9e9;
}

.lay-customizer .theme-color > a > span:nth-child(1),
    .theme-color > a > span:nth-child(1) {
    height: 30%;
    top: 0;
}

.lay-customizer .theme-color > a > span:nth-child(1):after,
      .theme-color > a > span:nth-child(1):after {
    background: #fff;
}

.lay-customizer .theme-color > a > span:nth-child(2),
    .theme-color > a > span:nth-child(2) {
    height: 75%;
    bottom: 0;
}

.lay-customizer .theme-color > a > span:nth-child(2):before,
      .theme-color > a > span:nth-child(2):before {
    border-radius: 0 3px 0 0;
}

.lay-customizer .theme-color > a.active:before,
    .theme-color > a.active:before {
    content: "\e83e";
    top: 1px;
    font-size: 20px;
    position: absolute;
    left: 12px;
    font-family: "feather";
    z-index: 1001;
    color: #1abc9c;
    transition: 0.3s ease-in-out;
    text-shadow: 0 1px 3px rgba(26, 188, 156, 0.9), 0 3px 8px rgba(0, 0, 0, 0.1);
}

.lay-customizer .theme-color > a.active:after,
    .theme-color > a.active:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
}

.lay-customizer .theme-color > a[data-value="menu-light"] span:before,
    .theme-color > a[data-value="menu-light"] span:before {
    background: #fff;
}

.lay-customizer .theme-color > a[data-value="dark"] span:after,
    .theme-color > a[data-value="dark"] span:after {
    background: #11181f;
}

.lay-customizer .theme-color > a[data-value="reset"],
    .theme-color > a[data-value="reset"] {
    background: #e74c3c;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    top: -10px;
    width: 135px;
    box-shadow: none;
}

.lay-customizer .theme-color.small > a,
  .theme-color.small > a {
    width: 25px;
    height: 25px;
    border-radius: 50%;
}

.lay-customizer .theme-color.small > a:before,
    .theme-color.small > a:before {
    font-size: 15px;
    left: 5px;
    top: 1px;
}

.lay-customizer .theme-color.small > a > span,
    .theme-color.small > a > span {
    display: none;
}

.lay-customizer .theme-color.header-color > a[data-value="header-blue"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-blue"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-blue"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-blue"] > span:nth-child(1):before {
    background: #1abc9c;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-blue"],
  .theme-color.header-color.small > a[data-value="header-blue"] {
    background: #1abc9c;
}

.lay-customizer .theme-color.header-color > a[data-value="header-red"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-red"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-red"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-red"] > span:nth-child(1):before {
    background: #e74c3c;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-red"],
  .theme-color.header-color.small > a[data-value="header-red"] {
    background: #e74c3c;
}

.lay-customizer .theme-color.header-color > a[data-value="header-purple"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-purple"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-purple"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-purple"] > span:nth-child(1):before {
    background: #536dfe;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-purple"],
  .theme-color.header-color.small > a[data-value="header-purple"] {
    background: #536dfe;
}

.lay-customizer .theme-color.header-color > a[data-value="header-info"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-info"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-info"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-info"] > span:nth-child(1):before {
    background: #3498db;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-info"],
  .theme-color.header-color.small > a[data-value="header-info"] {
    background: #3498db;
}

.lay-customizer .theme-color.header-color > a[data-value="header-green"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-green"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-green"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-green"] > span:nth-child(1):before {
    background: #2ecc71;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-green"],
  .theme-color.header-color.small > a[data-value="header-green"] {
    background: #2ecc71;
}

.lay-customizer .theme-color.header-color > a[data-value="header-dark"] > span:nth-child(1):after, .lay-customizer .theme-color.header-color > a[data-value="header-dark"] > span:nth-child(1):before,
  .theme-color.header-color > a[data-value="header-dark"] > span:nth-child(1):after,
  .theme-color.header-color > a[data-value="header-dark"] > span:nth-child(1):before {
    background: #2c3e50;
}

.lay-customizer .theme-color.header-color.small > a[data-value="header-dark"],
  .theme-color.header-color.small > a[data-value="header-dark"] {
    background: #2c3e50;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-blue"],
  .theme-color.background-color.flat > a[data-value="background-blue"] {
    background: #1abc9c;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-red"],
  .theme-color.background-color.flat > a[data-value="background-red"] {
    background: #e74c3c;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-red"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-purple"],
  .theme-color.background-color.flat > a[data-value="background-purple"] {
    background: #536dfe;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-info"],
  .theme-color.background-color.flat > a[data-value="background-info"] {
    background: #3498db;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-info"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-green"],
  .theme-color.background-color.flat > a[data-value="background-green"] {
    background: #2ecc71;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-green"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-dark"],
  .theme-color.background-color.flat > a[data-value="background-dark"] {
    background: #2c3e50;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):after, .lay-customizer .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):before,
    .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):after,
    .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):before {
    background: transparent;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):before,
    .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):before {
    background: #fff;
}

.lay-customizer .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):after,
    .theme-color.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 8px, #e9e9e9 0%);
}

.doc-img > a {
    position: relative;
    width: 130px;
    height: 80px;
    display: inline-block;
    background: #e9e9e9;
    overflow: hidden;
    box-shadow: 0 0 0 1px #e2e5e8;
}

.doc-img > a span {
    width: 100%;
    position: absolute;
}

.doc-img > a span:after, .doc-img > a span:before {
    content: "";
    height: 100%;
    position: absolute;
}

.doc-img > a span:before {
    width: 30%;
    left: 0;
    background: #2c3e50;
}

.doc-img > a span:after {
    width: 70%;
    right: 0;
    background: #e9e9e9;
}

.doc-img > a > span:nth-child(1) {
    height: 20%;
    top: 0;
}

.doc-img > a > span:nth-child(1):after {
    background: #fff;
}

.doc-img > a > span:nth-child(2) {
    height: 80%;
    bottom: 0;
}

.doc-img > a.active {
    border-color: #1abc9c;
}

.doc-img > a.active:before {
    content: "\e83f";
    top: -4px;
    font-size: 20px;
    position: absolute;
    left: 10px;
    font-family: "feather";
    z-index: 1001;
    color: #1abc9c;
    transition: 0.3s ease-in-out;
    text-shadow: 0 3px 8px rgba(26, 188, 156, 0.9), 0 3px 8px rgba(0, 0, 0, 0.1);
}

.doc-img > a.active:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.65);
}

.doc-img > a[data-value="menu-light"] span:before {
    background: #fff;
}

.doc-img > a[data-value="dark"] span:after {
    background: #11181f;
}

.doc-img.header-color > a[data-value="header-blue"] > span:nth-child(1):after {
    background: #1abc9c;
}

.doc-img.header-color > a[data-value="header-red"] > span:nth-child(1):after {
    background: #e74c3c;
}

.doc-img.header-color > a[data-value="header-purple"] > span:nth-child(1):after {
    background: #536dfe;
}

.doc-img.header-color > a[data-value="header-info"] > span:nth-child(1):after {
    background: #3498db;
}

.doc-img.header-color > a[data-value="header-green"] > span:nth-child(1):after {
    background: #2ecc71;
}

.doc-img.header-color > a[data-value="header-dark"] > span:nth-child(1):after {
    background: #2c3e50;
}

.doc-img.background-color.flat > a[data-value="background-blue"] {
    background: #1abc9c;
}

.doc-img.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-blue"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-blue"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.flat > a[data-value="background-red"] {
    background: #e74c3c;
}

.doc-img.background-color.flat > a[data-value="background-red"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-red"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-red"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-red"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.flat > a[data-value="background-purple"] {
    background: #536dfe;
}

.doc-img.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-purple"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-purple"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.flat > a[data-value="background-info"] {
    background: #3498db;
}

.doc-img.background-color.flat > a[data-value="background-info"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-info"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-info"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-info"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.flat > a[data-value="background-green"] {
    background: #2ecc71;
}

.doc-img.background-color.flat > a[data-value="background-green"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-green"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-green"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-green"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.flat > a[data-value="background-dark"] {
    background: #2c3e50;
}

.doc-img.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):after, .doc-img.background-color.flat > a[data-value="background-dark"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.flat > a[data-value="background-dark"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-blue"] {
    background: linear-gradient(to right, #1abc9c 0%, #00f2fe 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-blue"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-blue"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-blue"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-blue"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-red"] {
    background: linear-gradient(to right, #e74c3c 0%, #ff9a44 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-red"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-red"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-red"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-red"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-purple"] {
    background: linear-gradient(to right, #536dfe 0%, #00adff 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-purple"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-purple"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-purple"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-purple"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-info"] {
    background: linear-gradient(to right, #3498db 0%, #22e1ff 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-info"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-info"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-info"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-info"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-green"] {
    background: linear-gradient(to right, #2ecc71 0%, #00e3ae 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-green"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-green"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-green"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-green"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-dark"] {
    background: linear-gradient(to right, #2c3e50 0%, #1f3054 100%);
}

.doc-img.background-color.gradient > a[data-value="background-grd-dark"] > span:nth-child(1):after, .doc-img.background-color.gradient > a[data-value="background-grd-dark"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.gradient > a[data-value="background-grd-dark"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.gradient > a[data-value="background-grd-dark"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a {
    background-size: cover;
    background-repeat: no-repeat;
}

.doc-img.background-color.image > a[data-value="background-img-1"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-1"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-1"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-1"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a[data-value="background-img-2"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-2"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-2"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-2"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a[data-value="background-img-3"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-3"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-3"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-3"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a[data-value="background-img-4"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-4"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-4"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-4"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a[data-value="background-img-5"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-5"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-5"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-5"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

.doc-img.background-color.image > a[data-value="background-img-6"] > span:nth-child(1):after, .doc-img.background-color.image > a[data-value="background-img-6"] > span:nth-child(1):before {
    background: transparent;
}

.doc-img.background-color.image > a[data-value="background-img-6"] > span:nth-child(2):before {
    background: #fff;
}

.doc-img.background-color.image > a[data-value="background-img-6"] > span:nth-child(2):after {
    background: linear-gradient(to bottom, transparent 20px, #e9e9e9 0%);
}

/* ===================================================================================
 ==========================    Diffrent Layout Styles Start     ====================
 ===================================================================================
 ====== [ light menu style start ] ======== */
.pcoded-navbar.menu-light {
    background-color: #fff;
    color: #535763;
}

.pcoded-navbar.menu-light .header-logo {
    background-color: #2c3e50;
}

.pcoded-navbar.menu-light .header-logo .logo-dark {
    display: none;
}

.pcoded-navbar.menu-light .header-logo .logo-main {
    display: block;
}

.pcoded-navbar.menu-light .main-menu-header {
    background: #f2f2f2;
}

.pcoded-navbar.menu-light .sidenav-horizontal-next,
  .pcoded-navbar.menu-light .sidenav-horizontal-prev {
    background: #fff;
}

.pcoded-navbar.menu-light .mobile-menu span {
    background-color: rgba(255, 255, 255, 0.8);
}

.pcoded-navbar.menu-light .mobile-menu span:after, .pcoded-navbar.menu-light .mobile-menu span:before {
    background-color: rgba(255, 255, 255, 0.8);
}

.pcoded-navbar.menu-light .mobile-menu.on span {
    background-color: transparent;
}

.pcoded-navbar.menu-light .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li.active > a:before, .pcoded-navbar.menu-light .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li.pcoded-trigger > a:before, .pcoded-navbar.menu-light .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li:hover > a:before {
    color: #1abc9c;
}

.pcoded-navbar.menu-light .pcoded-inner-navbar li.pcoded-hasmenu .pcoded-submenu li + li > a {
    border-top-color: #ededed;
}

.pcoded-navbar.menu-light .pcoded-submenu {
    background: #fff;
}

.pcoded-navbar.menu-light a {
    color: #535763;
}

.pcoded-navbar.menu-light.navbar-collapsed .pcoded-menu-caption:after {
    background: rgba(0, 0, 0, 0.1);
}

.pcoded-navbar.menu-light.navbar-collapsed:hover .pcoded-menu-caption:after {
    background: transparent;
}

.pcoded-navbar.menu-light.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.active > a:before,
  .pcoded-navbar.menu-light.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li.pcoded-trigger > a:before,
  .pcoded-navbar.menu-light.navbar-collapsed:not(:hover) .pcoded-inner-navbar > li.pcoded-trigger.pcoded-hasmenu > .pcoded-submenu li:hover > a:before {
    box-shadow: 0 0 0 5px #fff;
}

.pcoded-navbar.menu-light .pcoded-menu-caption {
    color: #535763;
}

.pcoded-navbar.menu-light .pcoded-inner-navbar li.active > a, .pcoded-navbar.menu-light .pcoded-inner-navbar li.pcoded-trigger > a, .pcoded-navbar.menu-light .pcoded-inner-navbar li:hover > a {
    color: #1abc9c;
    background: transparent;
}

.pcoded-navbar.menu-light .pcoded-inner-navbar > li.active > a, .pcoded-navbar.menu-light .pcoded-inner-navbar > li.pcoded-trigger > a {
    background: #1abc9c;
    color: #fff;
}

.pcoded-navbar.menu-light.theme-horizontal .pcoded-inner-navbar > li.active a, .pcoded-navbar.menu-light.theme-horizontal .pcoded-inner-navbar > li.pcoded-trigger a, .pcoded-navbar.menu-light.theme-horizontal .pcoded-inner-navbar > li:hover a {
    color: #535763;
    background: transparent;
}

.pcoded-navbar.menu-light.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.active:before, .pcoded-navbar.menu-light.theme-horizontal .pcoded-inner-navbar > li.pcoded-hasmenu.pcoded-trigger:before {
    color: #fff;
}

/* ====== [ light menu style end ] ======== */
/* ====== [ Header color start ] ======== */
.pcoded-header[class*="header-"] .mobile-menu span {
    background-color: rgba(255, 255, 255, 0.8);
}

.pcoded-header[class*="header-"] .mobile-menu span:after, .pcoded-header[class*="header-"] .mobile-menu span:before {
    background-color: rgba(255, 255, 255, 0.8);
}

.pcoded-header[class*="header-"] .mobile-menu:hover span {
    background-color: #fff;
}

.pcoded-header[class*="header-"] .mobile-menu:hover span:after, .pcoded-header[class*="header-"] .mobile-menu:hover span:before {
    background-color: #fff;
}

@media only screen and (min-width: 992px) {
    .pcoded-header[class*="header-"] .page-header .breadcrumb-item + .breadcrumb-item::before,
  .pcoded-header[class*="header-"] .page-header .page-header-title + .breadcrumb > .breadcrumb-item a,
  .pcoded-header[class*="header-"] .page-header h5 {
        color: #fff;
    }
}

.pcoded-header.header-blue {
    background: #1abc9c;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-blue .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-blue .profile-notification li.active, .pcoded-header.header-blue .profile-notification li:active, .pcoded-header.header-blue .profile-notification li:focus, .pcoded-header.header-blue .profile-notification li:hover {
    background: rgba(26, 188, 156, 0.1);
}

.pcoded-header.header-blue .profile-notification li.active > a, .pcoded-header.header-blue .profile-notification li:active > a, .pcoded-header.header-blue .profile-notification li:focus > a, .pcoded-header.header-blue .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-blue .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-blue .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-blue .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-blue .dropdown-menu > li.active, .pcoded-header.header-blue .dropdown-menu > li:active, .pcoded-header.header-blue .dropdown-menu > li:focus, .pcoded-header.header-blue .dropdown-menu > li:hover {
    background: rgba(26, 188, 156, 0.1);
    color: #373a3c;
}

.pcoded-header.header-blue .dropdown-menu > li.active > a, .pcoded-header.header-blue .dropdown-menu > li:active > a, .pcoded-header.header-blue .dropdown-menu > li:focus > a, .pcoded-header.header-blue .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-blue .input-group .input-group-text,
  .pcoded-header.header-blue a,
  .pcoded-header.header-blue dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-blue .input-group .input-group-text:hover,
    .pcoded-header.header-blue a:hover,
    .pcoded-header.header-blue dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-blue .input-group .input-group-text,
      .pcoded-header.header-blue a,
      .pcoded-header.header-blue dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-blue .input-group .input-group-text:hover,
        .pcoded-header.header-blue a:hover,
        .pcoded-header.header-blue dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-blue .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-blue .main-search .search-close > .input-group-text {
    color: #1abc9c;
}

.pcoded-header.header-blue .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-blue .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-blue .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-blue .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-blue .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-blue .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-blue .main-search.open .input-group .search-btn {
    background: #1abc9c;
    border-color: #1abc9c;
}

.pcoded-header.header-blue .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-blue .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-blue .dropdown .notification .noti-body li.notification:hover {
    background: rgba(26, 188, 156, 0.1);
}

.pcoded-header.header-blue .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #1abc9c;
}

.pcoded-header.header-blue .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-blue .b-bg {
    background: #fff;
    color: #1abc9c;
}

.pcoded-header.header-red {
    background: #e74c3c;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-red .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-red .profile-notification li.active, .pcoded-header.header-red .profile-notification li:active, .pcoded-header.header-red .profile-notification li:focus, .pcoded-header.header-red .profile-notification li:hover {
    background: rgba(231, 76, 60, 0.1);
}

.pcoded-header.header-red .profile-notification li.active > a, .pcoded-header.header-red .profile-notification li:active > a, .pcoded-header.header-red .profile-notification li:focus > a, .pcoded-header.header-red .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-red .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-red .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-red .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-red .dropdown-menu > li.active, .pcoded-header.header-red .dropdown-menu > li:active, .pcoded-header.header-red .dropdown-menu > li:focus, .pcoded-header.header-red .dropdown-menu > li:hover {
    background: rgba(231, 76, 60, 0.1);
    color: #373a3c;
}

.pcoded-header.header-red .dropdown-menu > li.active > a, .pcoded-header.header-red .dropdown-menu > li:active > a, .pcoded-header.header-red .dropdown-menu > li:focus > a, .pcoded-header.header-red .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-red .input-group .input-group-text,
  .pcoded-header.header-red a,
  .pcoded-header.header-red dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-red .input-group .input-group-text:hover,
    .pcoded-header.header-red a:hover,
    .pcoded-header.header-red dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-red .input-group .input-group-text,
      .pcoded-header.header-red a,
      .pcoded-header.header-red dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-red .input-group .input-group-text:hover,
        .pcoded-header.header-red a:hover,
        .pcoded-header.header-red dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-red .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-red .main-search .search-close > .input-group-text {
    color: #e74c3c;
}

.pcoded-header.header-red .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-red .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-red .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-red .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-red .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-red .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-red .main-search.open .input-group .search-btn {
    background: #e74c3c;
    border-color: #e74c3c;
}

.pcoded-header.header-red .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-red .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-red .dropdown .notification .noti-body li.notification:hover {
    background: rgba(231, 76, 60, 0.1);
}

.pcoded-header.header-red .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #e74c3c;
}

.pcoded-header.header-red .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-red .b-bg {
    background: #fff;
    color: #e74c3c;
}

.pcoded-header.header-purple {
    background: #536dfe;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-purple .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-purple .profile-notification li.active, .pcoded-header.header-purple .profile-notification li:active, .pcoded-header.header-purple .profile-notification li:focus, .pcoded-header.header-purple .profile-notification li:hover {
    background: rgba(83, 109, 254, 0.1);
}

.pcoded-header.header-purple .profile-notification li.active > a, .pcoded-header.header-purple .profile-notification li:active > a, .pcoded-header.header-purple .profile-notification li:focus > a, .pcoded-header.header-purple .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-purple .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-purple .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-purple .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-purple .dropdown-menu > li.active, .pcoded-header.header-purple .dropdown-menu > li:active, .pcoded-header.header-purple .dropdown-menu > li:focus, .pcoded-header.header-purple .dropdown-menu > li:hover {
    background: rgba(83, 109, 254, 0.1);
    color: #373a3c;
}

.pcoded-header.header-purple .dropdown-menu > li.active > a, .pcoded-header.header-purple .dropdown-menu > li:active > a, .pcoded-header.header-purple .dropdown-menu > li:focus > a, .pcoded-header.header-purple .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-purple .input-group .input-group-text,
  .pcoded-header.header-purple a,
  .pcoded-header.header-purple dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-purple .input-group .input-group-text:hover,
    .pcoded-header.header-purple a:hover,
    .pcoded-header.header-purple dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-purple .input-group .input-group-text,
      .pcoded-header.header-purple a,
      .pcoded-header.header-purple dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-purple .input-group .input-group-text:hover,
        .pcoded-header.header-purple a:hover,
        .pcoded-header.header-purple dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-purple .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-purple .main-search .search-close > .input-group-text {
    color: #536dfe;
}

.pcoded-header.header-purple .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-purple .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-purple .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-purple .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-purple .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-purple .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-purple .main-search.open .input-group .search-btn {
    background: #536dfe;
    border-color: #536dfe;
}

.pcoded-header.header-purple .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-purple .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-purple .dropdown .notification .noti-body li.notification:hover {
    background: rgba(83, 109, 254, 0.1);
}

.pcoded-header.header-purple .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #536dfe;
}

.pcoded-header.header-purple .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-purple .b-bg {
    background: #fff;
    color: #536dfe;
}

.pcoded-header.header-info {
    background: #3498db;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-info .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-info .profile-notification li.active, .pcoded-header.header-info .profile-notification li:active, .pcoded-header.header-info .profile-notification li:focus, .pcoded-header.header-info .profile-notification li:hover {
    background: rgba(52, 152, 219, 0.1);
}

.pcoded-header.header-info .profile-notification li.active > a, .pcoded-header.header-info .profile-notification li:active > a, .pcoded-header.header-info .profile-notification li:focus > a, .pcoded-header.header-info .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-info .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-info .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-info .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-info .dropdown-menu > li.active, .pcoded-header.header-info .dropdown-menu > li:active, .pcoded-header.header-info .dropdown-menu > li:focus, .pcoded-header.header-info .dropdown-menu > li:hover {
    background: rgba(52, 152, 219, 0.1);
    color: #373a3c;
}

.pcoded-header.header-info .dropdown-menu > li.active > a, .pcoded-header.header-info .dropdown-menu > li:active > a, .pcoded-header.header-info .dropdown-menu > li:focus > a, .pcoded-header.header-info .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-info .input-group .input-group-text,
  .pcoded-header.header-info a,
  .pcoded-header.header-info dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-info .input-group .input-group-text:hover,
    .pcoded-header.header-info a:hover,
    .pcoded-header.header-info dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-info .input-group .input-group-text,
      .pcoded-header.header-info a,
      .pcoded-header.header-info dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-info .input-group .input-group-text:hover,
        .pcoded-header.header-info a:hover,
        .pcoded-header.header-info dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-info .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-info .main-search .search-close > .input-group-text {
    color: #3498db;
}

.pcoded-header.header-info .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-info .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-info .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-info .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-info .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-info .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-info .main-search.open .input-group .search-btn {
    background: #3498db;
    border-color: #3498db;
}

.pcoded-header.header-info .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-info .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-info .dropdown .notification .noti-body li.notification:hover {
    background: rgba(52, 152, 219, 0.1);
}

.pcoded-header.header-info .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #3498db;
}

.pcoded-header.header-info .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-info .b-bg {
    background: #fff;
    color: #3498db;
}

.pcoded-header.header-green {
    background: #2ecc71;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-green .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-green .profile-notification li.active, .pcoded-header.header-green .profile-notification li:active, .pcoded-header.header-green .profile-notification li:focus, .pcoded-header.header-green .profile-notification li:hover {
    background: rgba(46, 204, 113, 0.1);
}

.pcoded-header.header-green .profile-notification li.active > a, .pcoded-header.header-green .profile-notification li:active > a, .pcoded-header.header-green .profile-notification li:focus > a, .pcoded-header.header-green .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-green .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-green .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-green .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-green .dropdown-menu > li.active, .pcoded-header.header-green .dropdown-menu > li:active, .pcoded-header.header-green .dropdown-menu > li:focus, .pcoded-header.header-green .dropdown-menu > li:hover {
    background: rgba(46, 204, 113, 0.1);
    color: #373a3c;
}

.pcoded-header.header-green .dropdown-menu > li.active > a, .pcoded-header.header-green .dropdown-menu > li:active > a, .pcoded-header.header-green .dropdown-menu > li:focus > a, .pcoded-header.header-green .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-green .input-group .input-group-text,
  .pcoded-header.header-green a,
  .pcoded-header.header-green dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-green .input-group .input-group-text:hover,
    .pcoded-header.header-green a:hover,
    .pcoded-header.header-green dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-green .input-group .input-group-text,
      .pcoded-header.header-green a,
      .pcoded-header.header-green dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-green .input-group .input-group-text:hover,
        .pcoded-header.header-green a:hover,
        .pcoded-header.header-green dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-green .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-green .main-search .search-close > .input-group-text {
    color: #2ecc71;
}

.pcoded-header.header-green .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-green .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-green .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-green .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-green .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-green .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-green .main-search.open .input-group .search-btn {
    background: #2ecc71;
    border-color: #2ecc71;
}

.pcoded-header.header-green .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-green .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-green .dropdown .notification .noti-body li.notification:hover {
    background: rgba(46, 204, 113, 0.1);
}

.pcoded-header.header-green .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #2ecc71;
}

.pcoded-header.header-green .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-green .b-bg {
    background: #fff;
    color: #2ecc71;
}

.pcoded-header.header-dark {
    background: #2c3e50;
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-dark .profile-notification li > a {
    color: #373a3c;
}

.pcoded-header.header-dark .profile-notification li.active, .pcoded-header.header-dark .profile-notification li:active, .pcoded-header.header-dark .profile-notification li:focus, .pcoded-header.header-dark .profile-notification li:hover {
    background: rgba(44, 62, 80, 0.1);
}

.pcoded-header.header-dark .profile-notification li.active > a, .pcoded-header.header-dark .profile-notification li:active > a, .pcoded-header.header-dark .profile-notification li:focus > a, .pcoded-header.header-dark .profile-notification li:hover > a {
    background: transparent;
}

.pcoded-header.header-dark .dropdown-menu {
    color: #373a3c;
}

.pcoded-header.header-dark .dropdown-menu a {
    color: #373a3c;
}

.pcoded-header.header-dark .dropdown-menu > li > a {
    color: #373a3c;
}

.pcoded-header.header-dark .dropdown-menu > li.active, .pcoded-header.header-dark .dropdown-menu > li:active, .pcoded-header.header-dark .dropdown-menu > li:focus, .pcoded-header.header-dark .dropdown-menu > li:hover {
    background: rgba(44, 62, 80, 0.1);
    color: #373a3c;
}

.pcoded-header.header-dark .dropdown-menu > li.active > a, .pcoded-header.header-dark .dropdown-menu > li:active > a, .pcoded-header.header-dark .dropdown-menu > li:focus > a, .pcoded-header.header-dark .dropdown-menu > li:hover > a {
    background: transparent;
}

.pcoded-header.header-dark .input-group .input-group-text,
  .pcoded-header.header-dark a,
  .pcoded-header.header-dark dropdown-toggle {
    color: rgba(255, 255, 255, 0.8);
}

.pcoded-header.header-dark .input-group .input-group-text:hover,
    .pcoded-header.header-dark a:hover,
    .pcoded-header.header-dark dropdown-toggle:hover {
    color: #fff;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-dark .input-group .input-group-text,
      .pcoded-header.header-dark a,
      .pcoded-header.header-dark dropdown-toggle {
        color: #535763;
    }

    .pcoded-header.header-dark .input-group .input-group-text:hover,
        .pcoded-header.header-dark a:hover,
        .pcoded-header.header-dark dropdown-toggle:hover {
        color: #3c3f47;
    }
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-dark .m-header > a {
        color: #fff;
    }
}

.pcoded-header.header-dark .main-search .search-close > .input-group-text {
    color: #2c3e50;
}

.pcoded-header.header-dark .main-search.open .input-group {
    background: rgba(255, 255, 255, 0.25);
    border: 0 solid rgba(255, 255, 255, 0.25);
    padding: 2px 2px 2px 20px;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.header-dark .main-search.open .input-group {
        background: #e9e9e9;
    }
}

@media only screen and (min-width: 992px) {
    .pcoded-header.header-dark .main-search.open .input-group .form-control {
        color: #fff;
    }

    .pcoded-header.header-dark .main-search.open .input-group .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }

    .pcoded-header.header-dark .main-search.open .input-group .form-control:-ms-input-placeholder {
        color: #fff;
    }

    .pcoded-header.header-dark .main-search.open .input-group .form-control::-webkit-input-placeholder {
        color: #fff;
    }
}

.pcoded-header.header-dark .main-search.open .input-group .search-btn {
    background: #2c3e50;
    border-color: #2c3e50;
}

.pcoded-header.header-dark .main-search.open .input-group .search-btn .input-group-text {
    color: #fff;
}

.pcoded-header.header-dark .dropdown .notification .noti-head a {
    color: #fff;
}

.pcoded-header.header-dark .dropdown .notification .noti-body li.notification:hover {
    background: rgba(44, 62, 80, 0.1);
}

.pcoded-header.header-dark .dropdown .profile-notification .pro-head {
    color: #fff;
    background: #2c3e50;
}

.pcoded-header.header-dark .dropdown .profile-notification .pro-head .dud-logout {
    color: #fff;
}

.pcoded-header.header-dark .b-bg {
    background: #fff;
    color: #2c3e50;
}

body.background-blue {
    background: #1abc9c;
}

body.background-blue .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #1abc9c;
}

body.background-red {
    background: #e74c3c;
}

body.background-red .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #e74c3c;
}

body.background-purple {
    background: #536dfe;
}

body.background-purple .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #536dfe;
}

body.background-info {
    background: #3498db;
}

body.background-info .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #3498db;
}

body.background-green {
    background: #2ecc71;
}

body.background-green .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #2ecc71;
}

body.background-dark {
    background: #2c3e50;
}

body.background-dark .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: #2c3e50;
}

body.background-grd-blue {
    background: linear-gradient(to right, #1abc9c 0%, #00f2fe 100%);
}

body.background-grd-blue .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #1abc9c 0%, #00f2fe 100%);
}

body.background-grd-red {
    background: linear-gradient(to right, #e74c3c 0%, #ff9a44 100%);
}

body.background-grd-red .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #e74c3c 0%, #ff9a44 100%);
}

body.background-grd-purple {
    background: linear-gradient(to right, #536dfe 0%, #00adff 100%);
}

body.background-grd-purple .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #536dfe 0%, #00adff 100%);
}

body.background-grd-info {
    background: linear-gradient(to right, #3498db 0%, #22e1ff 100%);
}

body.background-grd-info .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #3498db 0%, #22e1ff 100%);
}

body.background-grd-green {
    background: linear-gradient(to right, #2ecc71 0%, #00e3ae 100%);
}

body.background-grd-green .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #2ecc71 0%, #00e3ae 100%);
}

body.background-grd-dark {
    background: linear-gradient(to right, #2c3e50 0%, #1f3054 100%);
}

body.background-grd-dark .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background: linear-gradient(to right, #2c3e50 0%, #1f3054 100%);
}

body[class*='background-img-'] {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top right;
    background-attachment: fixed;
}

body[class*='background-img-'] .pcoded-navbar.theme-horizontal ~ .pcoded-header[class*="header-"] {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top right;
    background-attachment: fixed;
}

/* ====== [ Header color end ] ======== */
/* ====== [ Brand color start ] ======== */
.pcoded-header[class*="brand-"]:not(.brand-default) .mobile-menu span,
.pcoded-header[class*="brand-"]:not(.brand-default) .mobile-menu span:after,
.pcoded-header[class*="brand-"]:not(.brand-default) .mobile-menu span:before {
    background: #fff;
}

.pcoded-header[class*="brand-"]:not(.brand-default) .mobile-menu.on span {
    background: transparent;
}

.pcoded-header[class*="brand-"]:not(.brand-default) .b-bg {
    background: #fff;
    color: #1abc9c;
}

.pcoded-header.brand-blue .m-header,
.pcoded-header[class*="header-"].brand-blue .m-header {
    background: #1abc9c;
}

.pcoded-header.brand-blue .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-blue .m-header .b-bg {
    background: #fff;
    color: #1abc9c;
}

.pcoded-header.brand-red .m-header,
.pcoded-header[class*="header-"].brand-red .m-header {
    background: #e74c3c;
}

.pcoded-header.brand-red .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-red .m-header .b-bg {
    background: #fff;
    color: #e74c3c;
}

.pcoded-header.brand-purple .m-header,
.pcoded-header[class*="header-"].brand-purple .m-header {
    background: #536dfe;
}

.pcoded-header.brand-purple .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-purple .m-header .b-bg {
    background: #fff;
    color: #536dfe;
}

.pcoded-header.brand-info .m-header,
.pcoded-header[class*="header-"].brand-info .m-header {
    background: #3498db;
}

.pcoded-header.brand-info .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-info .m-header .b-bg {
    background: #fff;
    color: #3498db;
}

.pcoded-header.brand-green .m-header,
.pcoded-header[class*="header-"].brand-green .m-header {
    background: #2ecc71;
}

.pcoded-header.brand-green .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-green .m-header .b-bg {
    background: #fff;
    color: #2ecc71;
}

.pcoded-header.brand-dark .m-header,
.pcoded-header[class*="header-"].brand-dark .m-header {
    background: #2c3e50;
}

.pcoded-header.brand-dark .m-header .b-bg,
  .pcoded-header[class*="header-"].brand-dark .m-header .b-bg {
    background: #1abc9c;
    color: #fff;
}

.pcoded-header.brand-default .header-logo,
.pcoded-header[class*="header-"].brand-default .header-logo {
    background: #2c3e50;
}

/* ====== [ Brand color end ] ======== */
/* ====== [ Menu background images start ] ======== */
.pcoded-navbar[class*="navbar-image"] {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center bottom;
}

.pcoded-navbar[class*="navbar-image"] .navbar-brand,
  .pcoded-navbar[class*="navbar-image"] .pcoded-submenu {
    background: transparent;
}

.pcoded-navbar[class*="navbar-image"]:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: rgba(255, 255, 255, 0.7);
}

/* ====== [ Menu background images end ] ========== */
/* ====== [ menu fixed start ] ======== */
.pcoded-navbar.menupos-fixed {
    position: fixed;
    height: 100vh;
    min-height: 100vh;
    border-radius: 0;
}

.pcoded-navbar.menupos-fixed .scroll-div.navbar-content {
    height: calc(100% - 56px);
    min-height: calc(100% - 56px);
}

/* ====== [ menu fixed end ] ======== */
/* ====== [ Header Fixed start ] ======== */
.pcoded-header.headerpos-fixed {
    position: fixed;
    top: 0;
}

.pcoded-header.headerpos-fixed ~ .pcoded-main-container {
    padding-top: 56px;
}

.pcoded-header.headerpos-fixed ~ .pcoded-main-container .page-header h5 {
    color: #37474f;
}

.pcoded-header.headerpos-fixed ~ .pcoded-main-container .page-header .page-header-title + .breadcrumb > .breadcrumb-item:before {
    color: rgba(55, 71, 79, 0.8);
}

.pcoded-header.headerpos-fixed ~ .pcoded-main-container .page-header .page-header-title + .breadcrumb > .breadcrumb-item a {
    color: #37474f;
}

@media only screen and (max-width: 991px) {
    .pcoded-header.headerpos-fixed ~ .pcoded-main-container {
        padding-top: 56px;
    }
}

/* ====== [Header Fixed  end ] ======== */
/* ====== [Box start ] ======== */
body.box-layout {
    position: static;
    background-size: auto;
}

body.box-layout .pcoded-header {
    position: relative;
}

body.box-layout .pcoded-header ~ .pcoded-main-container {
    padding-top: 0;
    background: #e9e9e9;
}

body.box-layout .pcoded-navbar {
    position: fixed;
    border-radius: 0;
    align-content: space-around;
    height: 100%;
}

body.box-layout .pcoded-navbar.theme-horizontal ~ .pcoded-header {
    position: relative;
}

@media only screen and (max-width: 992px) {
    body.box-layout {
        position: relative;
    }
}

@media only screen and (max-width: 992px) {
    .container {
        padding: 0;
    }
}

/* ====== [ Box end ] ======== */
.nav-tabs .nav-item {
    margin-bottom: 0;
}

.nav-tabs .nav-link {
    border: none;
    background: no-repeat center bottom, center 100%;
    background-size: 0 100%, 100% 100%;
    transition: background 0.3s ease-out;
    background-image: linear-gradient(to top, #1abc9c 2px, rgba(255, 255, 255, 0) 2px);
}

.nav-tabs .nav-link.active {
    background-size: 100% 100%, 100% 100%;
}

.page-item .page-link {
    border-radius: 60px;
    margin: 0 5px;
}

.page-item:first-child .page-link {
    margin-left: 0;
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
}

.page-item:last-child .page-link {
    border-top-right-radius: 60px;
    border-bottom-right-radius: 60px;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #1abc9c;
    border-color: #1abc9c;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #dee2e6;
}

.pagination-lg .page-link {
    padding: 0.75rem 1.5rem;
    font-size: 1.25rem;
    line-height: 1.5;
}

.pagination-lg .page-item:first-child .page-link {
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
}

.pagination-lg .page-item:last-child .page-link {
    border-top-right-radius: 60px;
    border-bottom-right-radius: 60px;
}

.pagination-sm .page-link {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
}

.pagination-sm .page-item:first-child .page-link {
    border-top-left-radius: 60px;
    border-bottom-left-radius: 60px;
}

.pagination-sm .page-item:last-child .page-link {
    border-top-right-radius: 60px;
    border-bottom-right-radius: 60px;
}

.fixed-button {
    position: fixed;
    bottom: -50px;
    right: 30px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.35);
    opacity: 0;
    z-index: 9;
    transition: all 0.5s ease;
}

.fixed-button.active {
    bottom: 50px;
    opacity: 1;
}

.social-card {
    color: #fff;
    overflow: hidden;
}

.social-card .social-icon {
    background-color: #fff;
    border-radius: 5px;
    text-align: center;
    padding: 22px 23px;
}

.social-card .download-icon {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.5);
    position: absolute;
    height: 125px;
    width: 125px;
    right: -125px;
    font-size: 35px;
    padding: 40px 22px;
    border-radius: 50%;
    transition: all 0.3s ease-in-out;
}

.social-card:hover .download-icon {
    right: -60px;
}

.total-card {
    overflow: hidden;
}

.total-card .text-left h4 {
    color: #fff;
    font-weight: 400;
    margin-bottom: 5px;
}

.total-card .text-left p {
    color: #fff;
    font-size: 15px;
}

.table-card .card-body {
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
}

.table-card .card-body .table > thead > tr > th {
    border-top: 0;
}

.table-card .card-body .table .chk-option {
    vertical-align: middle;
    width: 30px;
    display: inline-block;
}

.table-card .card-body .table .chk-option .checkbox-fade,
    .table-card .card-body .table .chk-option .checkbox-fade .cr,
    .table-card .card-body .table .chk-option .checkbox-zoom,
    .table-card .card-body .table .chk-option .checkbox-zoom .cr {
    margin-right: 0;
}

.table-card .card-body .table label {
    margin-bottom: 0;
}

.table-card .card-body .table tr td:first-child,
  .table-card .card-body .table tr th:first-child {
    padding-left: 20px;
}

.table-card .card-body .table tr td:last-child,
  .table-card .card-body .table tr th:last-child {
    padding-right: 20px;
}

.latest-update-card .card-body {
    padding-top: 0;
}

.latest-update-card .card-body .latest-update-box {
    position: relative;
}

.latest-update-card .card-body .latest-update-box td {
    border-top: none;
}

.latest-update-card .card-body .latest-update-box:after {
    content: "";
    position: absolute;
    background: #e2e5e8;
    height: 100%;
    width: 1px;
    top: 0;
    left: 110px;
    z-index: 1;
}

.latest-update-card .card-body .latest-update-box .update-meta {
    z-index: 2;
    min-width: 160px;
}

.latest-update-card .card-body .latest-update-box .update-meta .update-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    padding: 12px 13px;
    font-size: 16px;
    color: #fff;
    margin-left: 10px;
}

@media only screen and (max-width: 575px) {
    .latest-update-card .card-body .latest-update-box:after {
        display: none;
    }

    .latest-update-card .card-body .latest-update-box .update-meta {
        z-index: 2;
        min-width: 100%;
        text-align: left !important;
        margin-bottom: 15px;
        border-top: 1px solid #f1f1f1;
        padding-top: 30px;
    }
}

.review-card .review-block .cust-img {
    width: 50px;
    height: 50px;
}

.review-card .review-block > div {
    padding-top: 25px;
    padding-bottom: 25px;
    margin-left: 0;
    margin-right: 0;
    padding-left: 5px;
    padding-right: 5px;
}

.review-card .review-block > div:hover {
    background-color: rgba(26, 188, 156, 0.1);
}

.to-do-list {
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.to-do-list i {
    color: #ccc;
    font-size: 17px;
    opacity: 0;
}

.to-do-list:last-child {
    border: none;
    padding: 0;
    margin: 0;
}

.to-do-list:hover i {
    opacity: 1;
    transition: opacity ease-in 0.3s;
}

.to-do-list p {
    display: inline-block;
}

.to-do-label .checkbox-fade {
    display: block;
}

.to-do-label .checkbox-fade .delete_todo {
    float: right;
    font-size: 24px;
    color: #ccc;
}

.to-do-label .check-task {
    display: block;
}

.to-do-label i {
    cursor: pointer;
}

.done-task .captions,
.done-task span {
    color: #919aa3;
    text-decoration: line-through;
}

.trafic-card .progress {
    height: 7px;
}

.trafic-card .progress.blue {
    background-color: rgba(26, 188, 156, 0.5);
}

.trafic-card .progress.green {
    background-color: rgba(46, 204, 113, 0.5);
}

.trafic-card .progress.red {
    background-color: rgba(231, 76, 60, 0.5);
}

.trafic-card .progress.purple {
    background-color: rgba(83, 109, 254, 0.5);
}

.trafic-card .progress.yellow {
    background-color: rgba(241, 196, 15, 0.5);
}

.user-activity-card .u-img {
    position: relative;
}

.user-activity-card .u-img .cover-img {
    width: 40px;
    height: 40px;
}

.user-activity-card .u-img .profile-img {
    width: 20px;
    height: 20px;
    position: absolute;
    bottom: 0;
    right: -5px;
}

.user-Messages-card .u-img {
    position: relative;
}

.user-Messages-card .u-img .profile-img {
    width: 40px;
    height: 40px;
}

.user-Messages-card .u-img .tot-msg {
    width: 15px;
    height: 15px;
    position: absolute;
    bottom: 0;
    right: -5px;
    background-color: #e74c3c;
    color: #fff;
    font-size: 10px;
    border-radius: 50%;
    text-align: center;
}

.latest-posts-card .latest-posts-img {
    width: 90px;
    height: 80px;
}

.task-card .task-list {
    position: relative;
}

.task-card .task-list:after {
    content: "";
    position: absolute;
    background: #e2e5e8;
    height: 100%;
    width: 2px;
    top: 0;
    left: 10px;
    z-index: 1;
}

.task-card .task-list:before {
    content: "";
    position: absolute;
    background: #e2e5e8;
    height: 15px;
    width: 15px;
    bottom: -14px;
    left: 3px;
    z-index: 2;
    border-radius: 50%;
}

.task-card .task-list li {
    margin-bottom: 30px;
    padding-left: 30px;
    position: relative;
}

.task-card .task-list li .task-icon {
    position: absolute;
    left: 3px;
    top: 1px;
    border-radius: 50%;
    padding: 2px;
    color: #fff;
    min-width: 15px;
    min-height: 15px;
    z-index: 2;
}

.widget-primary-card.flat-card, .flat-card.widget-purple-card {
    border-top: none;
    background-color: #1abc9c;
    color: #fff;
}

.widget-primary-card.flat-card h4, .flat-card.widget-purple-card h4,
  .widget-primary-card.flat-card h6,
  .flat-card.widget-purple-card h6 {
    color: #fff;
}

.widget-primary-card.flat-card .row-table:first-child, .flat-card.widget-purple-card .row-table:first-child {
    border-bottom: none;
}

.widget-primary-card.flat-card .row-table > [class*=col-], .flat-card.widget-purple-card .row-table > [class*=col-] {
    display: inline-block;
    vertical-align: middle;
}

.widget-primary-card.flat-card .row-table > [class*=col-]:first-child, .flat-card.widget-purple-card .row-table > [class*=col-]:first-child {
    background-color: #17a689;
    text-align: center;
}

.widget-primary-card.flat-card .row-table > [class*=col-] .row, .flat-card.widget-purple-card .row-table > [class*=col-] .row {
    display: flex;
    align-items: center;
}

.widget-purple-card.flat-card {
    background-color: #2ecc71;
}

.widget-purple-card.flat-card .row-table:first-child {
    border-bottom: none;
}

.widget-purple-card.flat-card .row-table > [class*=col-]:first-child {
    background-color: #29b765;
}

.latest-activity-card .card-body {
    padding-top: 0;
}

.latest-activity-card .card-body .latest-update-box {
    position: relative;
}

.latest-activity-card .card-body .latest-update-box .update-meta {
    z-index: 2;
    min-width: 160px;
}

.latest-activity-card .card-body .latest-update-box .update-meta .update-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    padding: 12px 13px;
    font-size: 16px;
    color: #fff;
    margin-left: 10px;
}

@media only screen and (max-width: 575px) {
    .latest-activity-card .card-body .latest-update-box .update-meta {
        z-index: 2;
        min-width: 100%;
        text-align: left !important;
        margin-bottom: 15px;
        border-top: 1px solid #f1f1f1;
        padding-top: 30px;
    }
}

.feed-card h6 {
    margin-top: 7px;
}

.feed-card .feed-icon {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 8px;
}

.latest-activity-card .table td {
    vertical-align: middle;
}

.order-visitor-card {
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.order-visitor-card h4,
  .order-visitor-card h6,
  .order-visitor-card p {
    transition: all 0.3s ease-in-out;
}

.form-icon {
    position: absolute;
    bottom: 8px;
    right: 8px;
}

.form-icon .btn.btn-icon {
    width: 35px;
    height: 35px;
}

.widget-statstic-card {
    position: relative;
    overflow: hidden;
}

.widget-statstic-card .st-icon {
    color: #fff;
    font-size: 23px;
    padding: 40px 40px 20px 20px;
    border-radius: 50%;
    position: absolute;
    top: -30px;
    right: -30px;
    transition: all 0.3s ease-in-out;
}

.widget-statstic-card h2 {
    font-weight: 600;
    display: inline-block;
}

.widget-statstic-card span {
    border-radius: 30px;
    padding: 5px 20px;
    color: #fff;
    font-weight: 600;
}

.widget-statstic-card:hover .st-icon {
    font-size: 50px;
}

.widget-visitor-card {
    overflow: hidden;
    padding: 10px 0;
}

.widget-visitor-card i {
    color: #fff;
    font-size: 80px;
    position: absolute;
    bottom: -10px;
    opacity: 0.3;
    left: -10px;
    transform: rotate(15deg);
    transition: all 0.3s ease-in-out;
}

.widget-visitor-card:hover i {
    transform: rotate(0deg) scale(1.4);
    opacity: 0.5;
}

.app-design .btn {
    padding: 5px 8px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 5px;
}

.app-design .team-section img {
    width: 35px;
    border-radius: 5px;
}

.app-design .progress-box p {
    margin-bottom: 0;
}

.app-design .progress-box .progress {
    width: calc(100% - 80px);
    height: 8px;
    text-align: center;
    margin: 0 auto;
    background-color: #E5E5E5;
    border-radius: 30px;
    position: relative;
    overflow: inherit;
}

.app-design .progress-box .progress .progress-bar {
    border-radius: 30px;
}

.app-design .progress-box .progress .progress-bar label {
    position: absolute;
    top: -24px;
    right: 0;
    font-weight: 600;
    font-size: 13px;
}

.order-card {
    color: #fff;
    overflow: hidden;
}

.order-card .card-icon {
    position: absolute;
    right: -17px;
    font-size: 100px;
    top: 20px;
    opacity: 0.5;
}

.statustic-card .card-body {
    position: relative;
}

.statustic-card .card-body .progress {
    position: absolute;
    bottom: 0;
    width: 100%;
    left: 0;
    height: 5px;
    overflow: visible;
}

.statustic-card .card-body .progress .progress-bar {
    position: relative;
}

.statustic-card .card-body .progress .progress-bar:before {
    content: "";
    height: 5px;
    width: 5px;
    border-radius: 50%;
    position: absolute;
    right: 0;
    background: inherit;
}

.statustic-card .card-body .progress .progress-bar.bg-c-blue:before {
    -webkit-animation: blue-blink-bar 0.5s linear infinite;
    animation: blue-blink-bar 0.5s linear infinite;
}

.statustic-card .card-body .progress .progress-bar.bg-c-green:before {
    -webkit-animation: green-blink-bar 0.5s linear infinite;
    animation: green-blink-bar 0.5s linear infinite;
}

.statustic-card .card-body .progress .progress-bar.bg-c-red:before {
    -webkit-animation: red-blink-bar 0.5s linear infinite;
    animation: red-blink-bar 0.5s linear infinite;
}

.statustic-card .card-body .progress .progress-bar.bg-c-yellow:before {
    -webkit-animation: yellow-blink-bar 0.5s linear infinite;
    animation: yellow-blink-bar 0.5s linear infinite;
}

@-webkit-keyframes blue-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(26, 188, 156, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(26, 188, 156, 0.3);
    }
}

@keyframes blue-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(26, 188, 156, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(26, 188, 156, 0.3);
    }
}

@-webkit-keyframes green-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(46, 204, 113, 0.3);
    }
}

@keyframes green-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(46, 204, 113, 0.3);
    }
}

@-webkit-keyframes red-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(231, 76, 60, 0.3);
    }
}

@keyframes red-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(231, 76, 60, 0.3);
    }
}

@-webkit-keyframes yellow-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(241, 196, 15, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(241, 196, 15, 0.3);
    }
}

@keyframes yellow-blink-bar {
    0% {
        box-shadow: 0 0 0 0 rgba(241, 196, 15, 0.1);
    }

    50% {
        box-shadow: 0 0 0 6px rgba(241, 196, 15, 0.3);
    }
}

.statustic-progress-card .progress {
    height: 5px;
}

.client-map img {
    vertical-align: top;
    width: 90px;
}

.client-map .client-detail {
    margin-bottom: 20px;
}

.client-map .client-detail img {
    border-radius: 5px;
}

.client-map .client-profile {
    float: left;
}

.client-map .client-contain {
    display: inline-block;
    margin-left: 20px;
}

.client-map .client-contain h5 {
    display: block;
    text-transform: capitalize;
    font-weight: 600;
    font-size: 18px;
    padding-bottom: 10px;
}

.client-map .client-card-box {
    border: 1px solid #ccc;
    border-radius: 5px;
}

.client-map .client-card-box .client-border {
    border-right: 1px solid #ccc;
}

.client-map .client-card-box .client-border-card {
    border-top: 1px solid #ccc;
}

.flat-card .row-table {
    display: table;
    align-items: center;
    table-layout: fixed;
    height: 100%;
    width: 100%;
    margin: 0;
}

.flat-card .row-table:first-child {
    border-bottom: 1px solid #ddd;
}

.flat-card .row-table .br {
    border-right: 1px solid #ccc;
}

.flat-card .row-table i {
    font-size: 28px;
}

.flat-card .row-table span {
    text-transform: uppercase;
    font-size: 12px;
}

.flat-card .row-table h5 {
    display: block;
    margin-bottom: 0.3em;
    margin-right: 0;
}

.flat-card .row-table > [class*=col-] {
    display: table-cell;
    float: none;
    table-layout: fixed;
    vertical-align: middle;
}

.flat-card .row-table > [class*=col-] .row {
    display: flex;
    align-items: center;
}

.flat-card[class*="widget-"] .row-table {
    display: flex;
}

.table-card .card-body {
    padding-left: 0;
    padding-right: 0;
    padding-top: 0;
}

.table-card .card-body .table > thead > tr > th {
    border-top: 0;
}

.table-card .card-body .table tr td:first-child,
  .table-card .card-body .table tr th:first-child {
    padding-left: 25px;
}

.table-card .card-body .table tr td:last-child,
  .table-card .card-body .table tr th:last-child {
    padding-right: 25px;
}

.table-card .card-body .table.without-header tr:first-child td {
    border-top: none;
}

.stastic-slider-full-card .carousel-item {
    transition: transform 12s linear;
}

.statstic-data-card .active.carousel-item-right,
.statstic-data-card .carousel-item-next:not(.carousel-item-left) {
    transform: translateY(100%);
}

.statstic-data-card .active.carousel-item-left,
.statstic-data-card .carousel-item-prev:not(.carousel-item-right) {
    transform: translateY(-100%);
}

.statstic-data-card .card-body {
    border-top: 2px solid transparent;
}

.statstic-data-card .card-body.level-down {
    border-color: #e74c3c;
}

.statstic-data-card .card-body.level-up {
    border-color: #2ecc71;
}

.social-widget-card {
    border-top: none;
    color: #fff;
}

.social-widget-card:hover i {
    opacity: 1;
    transform: scale(1.1);
}

.social-widget-card i {
    position: absolute;
    right: 10px;
    bottom: 10px;
    font-size: 48px;
    opacity: 0.4;
    transition: all ease-in 0.3s;
}

.ticket-card .lbl-card {
    border-radius: 50px;
    padding: 5px 15px;
    display: inline-block;
}

.widget-profile-card-1 {
    position: relative;
    margin-bottom: 50px;
}

.widget-profile-card-1 .middle-user {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    margin: 0 auto;
    text-align: center;
    bottom: -60px;
}

.widget-profile-card-1 .middle-user img {
    width: 115px;
    border-radius: 50%;
}

.widget-profile-card-1 ~ .card-footer [class*=col-] {
    border-right: 1px solid #fff;
}

.widget-profile-card-1 ~ .card-footer [class*=col-]:last-child {
    border: none;
}

@media only screen and (max-width: 767px) {
    .widget-profile-card-1 ~ .card-footer [class*=col-]:nth-child(2) {
        border: 0;
    }

    .widget-profile-card-1 ~ .card-footer [class*=col-]:last-child {
        margin-top: 10px;
    }
}

.widget-profile-card-2 img.user-img {
    width: 115px;
}

.widget-profile-card-2 a {
    color: #fff;
    transition: all ease-in 0.3s;
}

.widget-profile-card-2 a:hover {
    opacity: 0.7;
}

.widget-profile-card-3 {
    /* background-image: url("../images/widget/slider5.jpg"); */
    background-size: cover;
    padding: 50px 0;
    text-align: center;
}

.widget-profile-card-3 img {
    width: 120px;
    border-radius: 50%;
}

.profile-card {
    position: relative;
    min-height: 410px;
    overflow: hidden;
}

.profile-card img {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.profile-card .card-body {
    text-align: center;
    color: #fff;
    position: absolute;
    bottom: 0;
    text-align: center;
    width: 100%;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.72));
}

.profile-card .card-body h3 {
    font-weight: 600;
}

.profile-card ~ .card-footer [class*="col-"] {
    padding: 10px;
    border-right: 1px solid rgba(255, 255, 255, 0.57);
}

.profile-card ~ .card-footer [class*="col-"] h4 {
    font-size: 18px;
    font-weight: 600;
}

.profile-card ~ .card-footer [class*="col-"]:last-child {
    border: none;
}

.profile-card ~ .card-footer [class*="col-"] span {
    text-transform: uppercase;
}

@media only screen and (max-width: 767px) {
    .profile-card ~ .card-footer [class*="col-"]:nth-child(2) {
        border: none;
    }
}

.blur-user-card {
    color: #fff;
    text-align: center;
    padding-top: 45px;
    /* background-image: url("../images/widget/blur-bg.png"); */
    background-size: cover;
}

.blur-user-card h3 {
    margin-top: 10px;
    font-size: 30px;
    font-weight: 600;
}

.blur-user-card p {
    font-size: 18px;
    font-weight: 300;
}

.blur-user-card .blur-footer [class*="col-"] {
    padding: 1em;
    border-right: 1px solid #fff;
    margin-top: 30px;
    margin-bottom: 30px;
}

.blur-user-card .blur-footer [class*="col-"]:last-child {
    border-right: none;
}

@media only screen and (max-width: 767px) {
    .blur-user-card .blur-footer [class*="col-"]:nth-child(2) {
        border: 0;
    }

    .blur-user-card .blur-footer [class*="col-"]:last-child {
        margin-top: 0;
        padding-top: 0;
    }
}

.weather-bg-card {
    position: relative;
}

.weather-bg-card img {
    width: 100%;
}

.weather-bg-card .card-body {
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
}

.weather-bg-card h5 {
    color: #fff;
}

.weather-bg-card .card-body.alt {
    position: absolute;
    top: 0;
}

.weather-bg-card .card-body.alt span {
    color: #fff;
}

.weather-bg-card .weather-temp {
    font-size: 70px;
    color: #fff;
}

.weather-bg-card ~ .card-footer {
    border-top: none;
}

@media only screen and (max-width: 575px) {
    .weather-bg-card ~ .card-footer [class*="col-"] {
        margin-bottom: 10px;
    }
}

.new-cust-card img {
    width: 40px;
}

.new-cust-card h6 {
    margin-bottom: 0;
}

.new-cust-card .align-middle {
    position: relative;
}

.new-cust-card .align-middle .status {
    position: absolute;
    right: 0;
    top: 19px;
    font-size: 13px;
}

.new-cust-card .align-middle .status.active {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #2ecc71;
}

.latest-update-card.update-card .card-body .latest-update-box:after {
    left: 19px;
}

.testimonial-card .progress {
    height: 5px;
}

.testimonial-card .review-block .cust-img {
    width: 40px;
    height: 40px;
}

.testimonial-card .review-block > div {
    padding-top: 15px;
    padding-bottom: 9px;
    margin-left: 0;
    margin-right: 0;
    padding-left: 5px;
    padding-right: 5px;
}

.testimonial-card .review-block > div:hover {
    background-color: rgba(26, 188, 156, 0.1);
}

.widget-chat-box .card-header i {
    font-size: 17px;
    color: #263238;
    position: relative;
}

.widget-chat-box .card-header .pop-up:after {
    content: '';
    position: absolute;
    background-color: #e74c3c;
    height: 8px;
    width: 8px;
    border-radius: 50px;
    right: -3px;
}

.widget-chat-box .send-chat, .widget-chat-box .receive-chat {
    position: relative;
    background: #81eed8;
    padding: 7px;
    border-radius: 0 10px 10px 10px;
    font-size: 13px;
    margin-bottom: 30px;
}

.widget-chat-box .send-chat:before, .widget-chat-box .receive-chat:before {
    content: '';
    position: absolute;
    height: 12px;
    width: 12px;
    border: 6px solid transparent;
    border-top: 6px solid #81eed8;
    border-right: 6px solid #81eed8;
    left: -12px;
    top: 0;
}

.widget-chat-box .send-chat .time, .widget-chat-box .receive-chat .time {
    position: absolute;
    bottom: -20px;
    left: 0;
}

.widget-chat-box .receive-chat {
    background-color: #1abc9c;
    color: #fff;
    border-radius: 10px;
}

.widget-chat-box .receive-chat:before {
    display: none;
}

.widget-chat-box .receive-chat .time {
    color: #666;
}

.widget-chat-box .rc-10 {
    margin-bottom: 10px;
}

.chat-card .msg {
    margin-bottom: 5px;
    display: inline-block;
    padding: 10px;
    position: relative;
}

.chat-card .msg img {
    width: 60px;
    border-radius: 5px;
    margin-bottom: 5px;
    margin-top: 5px;
    margin-right: 10px;
}

.chat-card .received-chat .msg {
    background: #81eed8;
    border-radius: 0 5px 5px 5px;
}

.chat-card .received-chat .msg:after {
    content: "";
    position: absolute;
    left: -7px;
    top: -7px;
    transform: rotate(45deg);
    border: 7px solid transparent;
    border-bottom-color: #81eed8;
}

.chat-card .send-chat, .chat-card .widget-chat-box .receive-chat, .widget-chat-box .chat-card .receive-chat {
    text-align: right;
}

.chat-card .send-chat .msg, .chat-card .widget-chat-box .receive-chat .msg, .widget-chat-box .chat-card .receive-chat .msg {
    background: #1abc9c;
    color: #fff;
    border-radius: 5px 0 5px 5px;
}

.chat-card .send-chat .msg:after, .chat-card .widget-chat-box .receive-chat .msg:after, .widget-chat-box .chat-card .receive-chat .msg:after {
    content: "";
    position: absolute;
    right: -7px;
    top: -7px;
    transform: rotate(45deg);
    border: 7px solid transparent;
    border-right-color: #1abc9c;
}

.nav {
    position: relative;
    z-index: 1;
}

.feed-card h6 {
    margin-top: 7px;
    font-size: 14px;
}

.feed-card .feed-icon {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    color: #fff;
    text-align: center;
    padding: 8px 9px;
}

.mrr-card {
    position: relative;
}

.mrr-card .bottom-chart {
    bottom: 0;
}

.swal-icon--error {
    border-color: #e74c3c;
}

.swal-icon--error__line {
    background-color: #e74c3c;
}

.swal-icon--warning {
    border-color: #f1c40f;
}

.swal-icon--warning__body {
    background-color: #f1c40f;
}

.swal-icon--warning__dot {
    background-color: #f1c40f;
}

@-webkit-keyframes pulseWarning {
    0% {
        border-color: #f2ca27;
    }

    to {
        border-color: #f1c40f;
    }
}

@keyframes pulseWarning {
    0% {
        border-color: #f2ca27;
    }

    to {
        border-color: #f1c40f;
    }
}

.swal-icon--success {
    border-color: #2ecc71;
}

.swal-icon--success__ring {
    border: 4px solid rgba(46, 204, 113, 0.2);
}

.swal-icon--success__line {
    background-color: #2ecc71;
}

.swal-icon--info {
    border-color: #00acc1;
}

.swal-icon--info:after, .swal-icon--info:before {
    background-color: #00acc1;
}

.swal-title {
    color: rgba(0, 0, 0, 0.65);
}

.swal-text {
    color: rgba(0, 0, 0, 0.64);
}

.swal-button {
    background-color: #1abc9c;
}

.swal-button:not([disabled]):hover {
    background-color: #17a689;
}

.swal-button:active {
    background-color: #17a689;
}

.swal-button:focus {
    box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(26, 188, 156, 0.29);
}

.swal-button--cancel {
    color: #555;
    background-color: #efefef;
}

.swal-button--cancel:not([disabled]):hover {
    background-color: #e8e8e8;
}

.swal-button--cancel:active {
    background-color: #d7d7d7;
}

.swal-button--cancel:focus {
    box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(116, 136, 150, 0.29);
}

.swal-button--danger {
    background-color: #e74c3c;
}

.swal-button--danger:not([disabled]):hover {
    background-color: #e43725;
}

.swal-button--danger:active {
    background-color: #e43725;
}

.swal-button--danger:focus {
    box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(231, 76, 60, 0.29);
}

.swal-footer {
    text-align: center;
}

.swal-content__input:focus {
    border-color: rgba(26, 188, 156, 0.29);
}

.swal-content__textarea:focus {
    border-color: rgba(26, 188, 156, 0.29);
}

.lb-data .lb-caption a {
    color: #1abc9c;
}

.alert-dismissable .close,
.alert-dismissible .close {
    color: inherit;
    text-shadow: none;
}

@-webkit-keyframes progress-bar-stripes {
    from {
        background-position: 40px 0;
    }

    to {
        background-position: 0 0;
    }
}

@keyframes progress-bar-stripes {
    from {
        background-position: 40px 0;
    }

    to {
        background-position: 0 0;
    }
}

.alert-inverse {
    background-color: #333;
    border-color: transparent;
    color: #fff;
}

.alert-inverse .close {
    position: relative;
    top: -2px;
    right: -21px;
    color: #fff;
    text-shadow: none;
}

.alert-inverse .alert-link {
    color: #e6e6e6;
}

.growl-animated.alert-inverse {
    box-shadow: 0 0 5px rgba(51, 51, 51, 0.5);
}

.growl-animated.alert-info {
    box-shadow: 0 0 5px rgba(26, 188, 156, 0.5);
}

.growl-animated.alert-success {
    box-shadow: 0 0 5px rgba(46, 204, 113, 0.5);
}

.growl-animated.alert-warning {
    box-shadow: 0 0 5px rgba(241, 196, 15, 0.5);
}

.growl-animated.alert-danger {
    box-shadow: 0 0 5px rgba(231, 76, 60, 0.5);
}

[data-notify="progressbar"] {
    margin-bottom: 0;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 5px;
}

[ui-pnotify].ui-pnotify.stack-bar-top {
    width: 100%;
}

[ui-pnotify].ui-pnotify.stack-bar-bottom {
    width: 100%;
}

[ui-pnotify].ui-pnotify .brighttheme-notice {
    background-color: #f8e287;
}

[ui-pnotify].ui-pnotify .brighttheme-notice div,
  [ui-pnotify].ui-pnotify .brighttheme-notice h4 {
    color: #614f06;
}

[ui-pnotify].ui-pnotify .brighttheme-info {
    background-color: #6bebd1;
}

[ui-pnotify].ui-pnotify .brighttheme-info div,
  [ui-pnotify].ui-pnotify .brighttheme-info h4 {
    color: #07362c;
}

[ui-pnotify].ui-pnotify .brighttheme-success {
    background-color: #93e7b6;
}

[ui-pnotify].ui-pnotify .brighttheme-success div,
  [ui-pnotify].ui-pnotify .brighttheme-success h4 {
    color: #124f2c;
}

[ui-pnotify].ui-pnotify .brighttheme-error {
    background-color: #f5b4ae;
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
}

[ui-pnotify].ui-pnotify .brighttheme-error div,
  [ui-pnotify].ui-pnotify .brighttheme-error h4 {
    color: danger(#e74c3c, 30%);
}

[ui-pnotify].ui-pnotify .brighttheme-icon-notice {
    background-color: #614f06;
    color: #f8e287;
}

[ui-pnotify].ui-pnotify .brighttheme-icon-info {
    background-color: #07362c;
    color: #6bebd1;
}

[ui-pnotify].ui-pnotify .brighttheme-icon-success {
    background-color: #124f2c;
    color: #93e7b6;
}

[ui-pnotify].ui-pnotify .brighttheme-icon-error {
    width: 0;
    height: 0;
    font-size: 0;
    line-height: 0;
    border-radius: 0;
    border-left: 0.6rem solid transparent;
    border-right: 0.6rem solid transparent;
    border-bottom: 1.2rem solid danger(#e74c3c, 30%);
    color: #f5b4ae;
}

[ui-pnotify].ui-pnotify .brighttheme-icon-error:after {
    position: absolute;
    top: 0.1rem;
    left: -.25rem;
    font-size: 0.9rem;
    font-weight: 700;
    line-height: 1.4rem;
    font-family: "Courier New", Courier, monospace;
    content: "!";
}

[ui-pnotify].ui-pnotify .brighttheme {
    border-radius: 0;
}

[ui-pnotify].ui-pnotify .brighttheme.ui-pnotify-container {
    padding: 1.3rem;
}

[ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-confirm,
[ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-text,
[ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-title {
    margin-left: 1.8rem;
}

[dir=rtl] [ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-confirm,
[dir=rtl] [ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-text,
[dir=rtl] [ui-pnotify].ui-pnotify-with-icon .brighttheme .ui-pnotify-title {
    margin-right: 1.8rem;
    margin-left: 0;
}

[ui-pnotify].ui-pnotify .brighttheme-icon-notice:after {
    content: "!";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-info:after {
    content: "i";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-success:after {
    content: "\002713";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-error:after {
    content: "!";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-closer:after {
    content: "\002715";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-sticker:after {
    top: -1px;
    content: "\002016";
}

[ui-pnotify].ui-pnotify .brighttheme-icon-sticker.brighttheme-icon-stuck:after {
    content: "\00003E";
}

.br-theme-bars-1to10 .br-widget a {
    background-color: #f9e8a0;
}

.br-theme-bars-1to10 .br-widget a.br-active, .br-theme-bars-1to10 .br-widget a.br-selected {
    background-color: #f1c40f;
}

.br-theme-bars-1to10 .br-widget .br-current-rating {
    color: #f1c40f;
}

.br-theme-bars-1to10 .br-readonly a.br-active, .br-theme-bars-1to10 .br-readonly a.br-selected {
    background-color: #f1c40f;
}

.br-theme-bars-1to10 .br-readonly .br-current-rating {
    color: #f7dc6f;
}

.br-theme-bars-horizontal .br-widget a {
    background-color: #f9e8a0;
}

.br-theme-bars-horizontal .br-widget a.br-active, .br-theme-bars-horizontal .br-widget a.br-selected {
    background-color: #f1c40f;
}

.br-theme-bars-horizontal .br-widget .br-current-rating {
    color: #f1c40f;
}

.br-theme-bars-horizontal .br-readonly a.br-active, .br-theme-bars-horizontal .br-readonly a.br-selected {
    background-color: #f9e8a0;
}

.br-theme-bars-horizontal .br-readonly .br-current-rating {
    color: #f9e8a0;
}

.br-theme-bars-movie .br-widget {
    height: auto;
}

.br-theme-bars-movie .br-widget a {
    background-color: #81eed8;
}

.br-theme-bars-movie .br-widget a.br-active, .br-theme-bars-movie .br-widget a.br-selected {
    background-color: #1abc9c;
}

.br-theme-bars-movie .br-widget .br-current-rating {
    color: #1abc9c;
}

.br-theme-bars-movie .br-readonly a.br-active, .br-theme-bars-movie .br-readonly a.br-selected {
    background-color: #55e7ca;
}

.br-theme-bars-movie .br-readonly .br-current-rating {
    color: #55e7ca;
}

.br-theme-bars-pill .br-widget a {
    background-color: #e6f9ee;
    color: #2ecc71;
}

.br-theme-bars-pill .br-widget a.br-active, .br-theme-bars-pill .br-widget a.br-selected {
    background-color: #2ecc71;
}

.br-theme-bars-pill .br-readonly a.br-active, .br-theme-bars-pill .br-readonly a.br-selected {
    background-color: #54d98c;
}

.br-theme-bars-reversed .br-widget a {
    background-color: #a8f5ff;
    color: #00acc1;
}

.br-theme-bars-reversed .br-widget a.br-active, .br-theme-bars-reversed .br-widget a.br-selected {
    background-color: #00acc1;
}

.br-theme-bars-reversed .br-widget .br-current-rating {
    color: #00acc1;
    width: 100%;
    padding: 0;
    margin-top: 15px;
}

.br-theme-bars-reversed .br-readonly a.br-active, .br-theme-bars-reversed .br-readonly a.br-selected {
    background-color: #00d9f4;
}

.br-theme-bars-reversed .br-readonly .br-current-rating {
    color: #00d9f4;
}

.br-theme-bars-square .br-widget a {
    border: 2px solid #f5b4ae;
    color: #f5b4ae;
}

.br-theme-bars-square .br-widget a.br-active, .br-theme-bars-square .br-widget a.br-selected {
    border: 2px solid #e74c3c;
    color: #e74c3c;
}

.br-theme-bars-square .br-readonly a.br-active, .br-theme-bars-square .br-readonly a.br-selected {
    border: 2px solid #ed7669;
    color: #ed7669;
}

.br-theme-bootstrap-stars .br-widget a:after {
    color: #e1e1e1;
}

.br-theme-css-stars .br-widget a:after {
    color: #e1e1e1;
}

.br-theme-css-stars .br-widget a.br-active:after, .br-theme-css-stars .br-widget a.br-selected:after {
    color: #f1c40f;
}

.br-theme-fontawesome-stars .br-widget a {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 18px;
}

.br-theme-fontawesome-stars .br-widget a:after {
    content: "\f005";
    color: #e1e1e1;
}

.br-theme-fontawesome-stars .br-widget a.br-active:after, .br-theme-fontawesome-stars .br-widget a.br-selected:after {
    color: #f1c40f;
}

.br-theme-fontawesome-stars-o .br-widget a {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 18px;
}

.br-theme-fontawesome-stars-o .br-widget a:after {
    content: "\f005";
    color: #e1e1e1;
}

.br-theme-fontawesome-stars-o .br-widget a.br-active:after, .br-theme-fontawesome-stars-o .br-widget a.br-selected:after {
    color: #2ecc71;
}

.br-theme-fontawesome-stars-o .br-widget a.br-fractional:after {
    content: "\f5c0";
    color: #2ecc71;
}

.slider.slider-horizontal .slider-handle.triangle,
.slider.slider-horizontal .slider-tick.triangle {
    border-bottom-color: #1abc9c;
}

.slider.slider-vertical .slider-handle.triangle,
.slider.slider-vertical .slider-tick.triangle {
    border-left-color: #1abc9c;
    border-right-color: #1abc9c;
}

.slider.slider-disabled .slider-handle {
    background-image: linear-gradient(to bottom, #dfdfdf 0, #bebebe 100%);
    background-repeat: repeat-x;
}

.slider.slider-disabled .slider-track {
    background-image: linear-gradient(to bottom, #e9e9e9 0, #e9e9e9 100%);
    background-repeat: repeat-x;
}

.slider-track {
    background-image: linear-gradient(to bottom, #e9e9e9 0, #e9e9e9 100%);
    background-repeat: repeat-x;
}

.slider-selection {
    background-image: linear-gradient(to bottom, #6bebd1 0, #6bebd1 100%);
    background-repeat: repeat-x;
}

.slider-selection.tick-slider-selection {
    background-image: linear-gradient(to bottom, #55e7ca 0, #55e7ca 100%);
    background-repeat: repeat-x;
}

.slider-handle {
    background-color: #1abc9c;
    background-image: linear-gradient(to bottom, #1abc9c 0, #1abc9c 100%);
    background-repeat: repeat-x;
}

.slider-tick {
    background-image: linear-gradient(to bottom, #f9f9f9 0, #f5f5f5 100%);
    background-repeat: repeat-x;
}

.slider-tick.in-selection {
    background-image: linear-gradient(to bottom, #55e7ca 0, #55e7ca 100%);
    background-repeat: repeat-x;
}

#ex7-enabled {
    position: relative;
    top: 4px;
    height: 18px;
    width: 18px;
}

#RGB {
    height: 10px;
    background: gray;
}

#RC .slider-selection {
    background: #FF8282;
}

#RC .slider-handle {
    background: red;
}

#GC .slider-selection {
    background: #428041;
}

#GC .slider-handle {
    background: green;
}

#BC .slider-selection {
    background: #8283FF;
}

#BC .slider-handle {
    border-bottom-color: blue;
}

#B,
#G,
#R {
    width: 300px;
}

.slider-handle.custom {
    background: transparent none;
}

.slider-handle.custom::before {
    line-height: 15px;
    font-size: 28px;
    content: '\2605';
    color: #726204;
}

#slider12a .slider-track-high,
#slider12c .slider-track-high {
    background: #2ecc71;
}

#slider12b .slider-track-low {
    background: #e74c3c;
}

#slider12c .slider-track-low {
    background: #e74c3c;
}

#slider12c .slider-selection {
    background: #f1c40f;
}

#slider22 .slider-rangeHighlight {
    background: #f70616;
}

#slider22 .slider-rangeHighlight.category1 {
    background: #FF9900;
}

#slider22 .slider-rangeHighlight.category2 {
    background: #99CC00;
}

.daterangepicker {
    font-family: "Open Sans", sans-serif;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 0 25px rgba(26, 188, 156, 0.15);
    background-color: #fff;
}

.daterangepicker .calendar-table {
    border: 1px solid #fff;
    background-color: #fff;
}

.daterangepicker .calendar-table td,
    .daterangepicker .calendar-table th {
    color: #6c757d;
}

.daterangepicker .calendar-table .next span,
    .daterangepicker .calendar-table .prev span {
    border-color: #adb5bd;
}

.daterangepicker td.in-range {
    background-color: #8aefdb;
    color: #495057;
}

.daterangepicker td.off, .daterangepicker td.off.end-date, .daterangepicker td.off.in-range, .daterangepicker td.off.start-date {
    background-color: #fff;
    color: #373a3c;
    opacity: 0.5;
}

.daterangepicker td.active, .daterangepicker td.active:hover {
    background-color: #1abc9c;
    color: #fff;
}

.daterangepicker td.available:hover,
  .daterangepicker th.available:hover {
    background-color: #1abc9c;
    color: #fff;
}

.daterangepicker td.available:hover > span,
    .daterangepicker th.available:hover > span {
    border-color: #fff;
}

.daterangepicker:after {
    border-bottom: 6px solid #fff;
}

.daterangepicker:before {
    border-bottom: 7px solid rgba(0, 0, 0, 0.15);
}

.daterangepicker .ranges ul {
    padding-top: 15px;
    padding-bottom: 15px;
}

@media (min-width: 564px) {
    .daterangepicker .ranges ul {
        width: 160px;
    }
}

.daterangepicker .ranges ul li {
    margin: 5px 10px;
    transition: all 0.2s ease-in-out;
}

.daterangepicker .ranges ul li.active {
    background-color: #1abc9c;
}

.daterangepicker .ranges ul li:hover {
    box-shadow: 0 15px 8px -9px rgba(0, 0, 0, 0.25);
    background-color: #1abc9c;
    color: #fff;
}

.daterangepicker .drp-buttons {
    border-top: 1px solid rgba(0, 0, 0, 0.15);
}

.daterangepicker.show-ranges .drp-calendar.left {
    border-left: 1px solid rgba(0, 0, 0, 0.15);
}

.bootstrap-tagsinput {
    padding: 5px 10px;
    background: #e9e9e9;
    border: 1px solid #e3eaef;
    border-radius: 2px;
    width: 100%;
}

.bootstrap-tagsinput .tag {
    background: #1abc9c;
    color: #fff;
    border-radius: 2px;
}

.bootstrap-maxlength {
    background: #1abc9c;
    border-radius: 2px;
    padding: 5px 10px;
    color: #fff;
}

.bootstrap-maxlength.label-danger {
    background: #e74c3c;
}

.bootstrap-maxlength.label-success {
    background: #2ecc71;
}

.bootstrap-maxlength.label-warning {
    background: #f1c40f;
}

.bt-wizard .nav {
    background: #e9e9e9;
}

.bt-wizard .nav .nav-link.active {
    box-shadow: 0px 0px 5px 2px rgba(26, 188, 156, 0.3);
}

.select2-container .select2-selection--single {
    height: calc(1.5em + 0.75rem + 2px);
}

.select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    padding-left: 8px;
    padding-right: 20px;
}

.select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered {
    padding-right: 8px;
    padding-left: 20px;
}

.select2-container .select2-selection--multiple {
    min-height: 32px;
}

.select2-container .select2-selection--multiple .select2-selection__rendered {
    padding-left: 8px;
}

.select2-dropdown {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: calc(1.5em + 0.75rem + 2px);
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(1.5em + 0.75rem + 2px);
}

.select2-container--default .select2-selection--multiple {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #1abc9c;
    border: 1px solid #1abc9c;
    color: #fff;
    border-radius: 3px;
    padding: 2px 10px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
    margin-right: 8px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #fff;
}

.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
    margin-left: 8px;
    margin-right: auto;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid rgba(0, 0, 0, 0.15) 1px;
    outline: 0;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid rgba(0, 0, 0, 0.15);
}

.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #e9e9e9;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #1abc9c;
    color: #fff;
}

.select2-container--classic .select2-selection--single {
    background-color: #f7f7f7;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
    outline: 0;
}

.select2-container--classic .select2-selection--single:focus {
    border: 1px solid #1abc9c;
}

.select2-container--classic .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: calc(1.5em + 0.75rem + 2px);
}

.select2-container--classic .select2-selection--single .select2-selection__arrow {
    background-color: #e9e9e9;
    border-left: 1px solid rgba(0, 0, 0, 0.15);
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
    height: calc(1.5em + 0.75rem + 2px);
}

.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__arrow {
    border-right: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
}

.select2-container--classic.select2-container--open .select2-selection--single {
    border: 1px solid #1abc9c;
}

.select2-container--classic .select2-selection--multiple {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
}

.select2-container--classic .select2-selection--multiple:focus {
    border: 1px solid #1abc9c;
}

.select2-container--classic .select2-selection--multiple .select2-selection__choice {
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 3px;
}

.select2-container--classic.select2-container--open .select2-selection--multiple {
    border: 1px solid #1abc9c;
}

.select2-container--classic .select2-search--dropdown .select2-search__field {
    border: 1px solid rgba(0, 0, 0, 0.15);
}

.select2-container--classic .select2-results__option--highlighted[aria-selected] {
    background-color: #3875d7;
    color: #fff;
}

.select2-container--classic.select2-container--open .select2-dropdown {
    border-color: #1abc9c;
}

/**  =====================
      Data Tables css start
==========================  **/
.table td,
.table th {
    border-top: 1px solid #e2e5e8;
    white-space: nowrap;
    padding: 1.05rem 0.75rem;
}

.table thead th {
    border-bottom: 1px solid #e2e5e8;
    font-size: 13px;
    color: #37474f;
    background: #f6f6f6;
    text-transform: uppercase;
}

.table tbody + tbody {
    border-top: 2px solid #e2e5e8;
}

.table.table-dark thead th {
    background-color: #11171a;
}

.table.dataTable[class*="table-"] thead th {
    background: #f6f6f6;
}

/* Border versions */
.table-bordered {
    border: 1px solid #e2e5e8;
}

.table-bordered td,
  .table-bordered th {
    border: 1px solid #e2e5e8;
}

/* Zebra-striping */
.table-striped tbody tr:nth-of-type(2n+1) {
    background-color: rgba(26, 188, 156, 0.03);
}

/* Hover effect */
.table-hover tbody tr:hover {
    background-color: rgba(26, 188, 156, 0.03);
}

/* Table backgrounds */
.table .thead-dark th {
    color: #fff;
    background-color: #263238;
    border-color: #11171a;
}

.table-dark {
    color: #fff;
    background-color: #263238;
}

.table-dark td,
  .table-dark th,
  .table-dark thead th {
    border-color: #11171a;
}

.table-dark.table-striped tbody tr:nth-of-type(odd) {
    background-color: #222d32;
}

.table-dark.table-hover tbody tr:hover {
    background-color: #1c2429;
}

.table-dark thead th {
    color: #fff;
}

/* fixed header position */
table.dataTable.fixedHeader-floating {
    top: 0 !important;
}

@media screen and (max-width: 992px) {
    table.dataTable.fixedHeader-floating {
        display: none !important;
    }
}

@media screen and (max-width: 992px) {
    .fixedHeader-locked {
        display: none !important;
    }
}

/**  =====================
      Foo-table css start
==========================  **/
.footable .pagination > .active > a,
.footable .pagination > .active > span {
    background-color: #1abc9c;
    border-color: #1abc9c;
}

.footable .pagination > .active > a:focus, .footable .pagination > .active > a:hover,
  .footable .pagination > .active > span:focus,
  .footable .pagination > .active > span:hover {
    background-color: #1abc9c;
    border-color: #1abc9c;
}

.footable .pagination > li > a,
.footable .pagination > li > span {
    color: #222;
}

.footable-details.table,
.footable.table {
    margin-bottom: 0;
}

table.footable > tfoot > tr.footable-paging > td > span.label {
    margin-bottom: 0;
}

table.footable-paging-center > tfoot > tr.footable-paging > td {
    padding-bottom: 0;
}

.table-columned > tbody > tr > td {
    border: 0;
    border-left: 1px solid #e2e5e8;
}

.table-columned > tbody > tr > th {
    border: 0;
}

/**====== Foo-table css end ======**/
/**======= basic table css start =======**/
.table.table-xl td,
.table.table-xl th {
    padding: 1.25rem 2rem;
}

.table.table-lg td,
.table.table-lg th {
    padding: 0.9rem 2rem;
}

.table.table-de td,
.table.table-de th {
    padding: 0.75rem 2rem;
}

.table.table-sm td,
.table.table-sm th {
    padding: 0.6rem 2rem;
}

.table.table-xs td,
.table.table-xs th {
    padding: 0.4rem 2rem;
}

/**======= basic table css end ======**/
#row-delete .selected,
#row-select .selected {
    background-color: #1abc9c;
    color: #fff;
}

table.dataTable tbody > tr.selected,
table.dataTable tbody > tr > .selected {
    background: #1abc9c;
}

table.dataTable tbody > tr.selected table.dataTable tbody > tr > .selected td.select-checkbox:after,
  table.dataTable tbody > tr.selected table.dataTable tbody > tr.selected.select-checkbox:after,
  table.dataTable tbody > tr.selected th.select-checkbox:after,
  table.dataTable tbody > tr > .selected table.dataTable tbody > tr > .selected td.select-checkbox:after,
  table.dataTable tbody > tr > .selected table.dataTable tbody > tr.selected.select-checkbox:after,
  table.dataTable tbody > tr > .selected th.select-checkbox:after {
    text-shadow: 1px 1px #e4f2fe, -1px -1px #e4f2fe, 1px -1px #e4f2fe, -1px 1px #e4f2fe;
}

table.dataTable tbody .selected td.select-checkbox:before,
table.dataTable tbody .selected th.select-checkbox:before {
    border-color: #fff;
}

table.dataTable tbody > tr > .selected td.select-checkbox:after,
table.dataTable tbody > tr > .selected th.select-checkbox:after,
table.dataTable tbody > tr.selected td.select-checkbox:after,
table.dataTable tbody > tr.selected th.select-checkbox:after {
    content: '\2714';
    margin-top: -11px;
    margin-left: -4px;
    text-align: center;
}

div.dt-button-info {
    position: fixed;
    top: 50%;
    left: 50%;
    width: 400px;
    margin-top: -100px;
    margin-left: -200px;
    background-color: #81eed8;
    color: #1abc9c;
    border: 2px solid #1abc9c;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3);
    border-radius: 3px;
    text-align: center;
    z-index: 21;
}

div.dt-button-info h2 {
    padding: 0.5em;
    margin: 0;
    font-weight: normal;
    color: #fff;
    border-bottom: 1px solid #1abc9c;
    background-color: #1abc9c;
}

div.dt-button-info > div {
    padding: 1em;
}

.dt-buttons {
    margin-bottom: 5px;
}

table.dataTable tbody td.focus,
table.dataTable tbody th.focus {
    box-shadow: inset 0 0 1px 2px #1abc9c;
}

div.dtk-focus-alt table.dataTable tbody td.focus,
div.dtk-focus-alt table.dataTable tbody th.focus {
    box-shadow: inset 0 0 1px 2px #f1c40f;
    background: rgba(241, 196, 15, 0.15);
    color: #f1c40f;
}

/**====== Data Tables css end ======**/
.highcharts-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
    text-align: left;
    line-height: normal;
    z-index: 0;
    font-size: 12px;
}

.highcharts-root {
    display: block;
}

.highcharts-root text {
    stroke-width: 0;
}

.highcharts-strong {
    font-weight: bold;
}

.highcharts-emphasized {
    font-style: italic;
}

.highcharts-anchor {
    cursor: pointer;
}

.highcharts-background {
    fill: #ffffff;
}

.highcharts-label-box,
.highcharts-plot-background,
.highcharts-plot-border {
    fill: none;
}

.highcharts-button-box {
    fill: inherit;
}

.highcharts-tracker-line {
    stroke-linejoin: round;
    stroke: rgba(192, 192, 192, 0.0001);
    stroke-width: 22;
    fill: none;
}

.highcharts-tracker-area {
    fill: rgba(192, 192, 192, 0.0001);
    stroke-width: 0;
}

/* Titles */
.highcharts-title {
    fill: #333333;
    font-size: 1.5em;
}

.highcharts-subtitle {
    fill: #666666;
}

/* Axes */
.highcharts-axis-line {
    fill: none;
    stroke: #ccd6eb;
}

.highcharts-yaxis .highcharts-axis-line {
    stroke-width: 0;
}

.highcharts-axis-title {
    fill: #666666;
}

.highcharts-axis-labels {
    fill: #666666;
    cursor: default;
    font-size: 0.9em;
}

.highcharts-grid-line {
    fill: none;
    stroke: #e6e6e6;
}

.highcharts-xaxis-grid .highcharts-grid-line {
    stroke-width: 0;
}

.highcharts-tick {
    stroke: #ccd6eb;
}

.highcharts-yaxis .highcharts-tick {
    stroke-width: 0;
}

.highcharts-minor-grid-line {
    stroke: #f2f2f2;
}

.highcharts-crosshair-thin {
    stroke-width: 1px;
    stroke: #cccccc;
}

.highcharts-crosshair-category {
    stroke: #ccd6eb;
    stroke-opacity: 0.25;
}

/* Credits */
.highcharts-credits {
    cursor: pointer;
    fill: #999999;
    font-size: 0.7em;
    transition: fill 250ms, font-size 250ms;
}

.highcharts-credits:hover {
    fill: black;
    font-size: 1em;
}

/* Tooltip */
.highcharts-tooltip {
    cursor: default;
    pointer-events: none;
    white-space: nowrap;
    transition: stroke 150ms;
}

.highcharts-tooltip text {
    fill: #333333;
}

.highcharts-tooltip .highcharts-header {
    font-size: 0.85em;
}

.highcharts-tooltip-box {
    stroke-width: 1px;
    fill: #f7f7f7;
    fill-opacity: 0.85;
}

.highcharts-tooltip-box .highcharts-label-box {
    fill: #f7f7f7;
    fill-opacity: 0.85;
}

.highcharts-selection-marker {
    fill: #1abc9c;
    fill-opacity: 0.25;
}

.highcharts-graph {
    fill: none;
    stroke-width: 2px;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.highcharts-state-hover .highcharts-graph {
    stroke-width: 3;
}

.highcharts-state-hover path {
    transition: stroke-width 50;
  /* quick in */
}

.highcharts-state-normal path {
    transition: stroke-width 250ms;
  /* slow out */
}

/* Legend hover affects points and series */
.highcharts-data-labels,
.highcharts-markers,
.highcharts-point,
g.highcharts-series {
    transition: opacity 250ms;
}

.highcharts-legend-point-active .highcharts-point:not(.highcharts-point-hover),
.highcharts-legend-series-active g.highcharts-series:not(.highcharts-series-hover) {
    opacity: 0.2;
}

.highcharts-legend-series-active .highcharts-data-labels:not(.highcharts-series-hover),
.highcharts-legend-series-active .highcharts-markers:not(.highcharts-series-hover) {
    opacity: 0.2;
}

/* Series options */
/* Default colors */
.highcharts-color-0 {
    fill: #1abc9c;
    stroke: #1abc9c;
}

.highcharts-color-1 {
    fill: #343a40;
    stroke: #343a40;
}

.highcharts-color-2 {
    fill: #2ecc71;
    stroke: #2ecc71;
}

.highcharts-color-3 {
    fill: #e74c3c;
    stroke: #e74c3c;
}

.highcharts-color-4 {
    fill: #6610f2;
    stroke: #6610f2;
}

.highcharts-color-5 {
    fill: #e83e8c;
    stroke: #e83e8c;
}

.highcharts-color-6 {
    fill: #f1c40f;
    stroke: #f1c40f;
}

.highcharts-color-7 {
    fill: #20c997;
    stroke: #20c997;
}

.highcharts-color-8 {
    fill: #fd7e14;
    stroke: #fd7e14;
}

.highcharts-color-9 {
    fill: #00acc1;
    stroke: #00acc1;
}

.highcharts-area {
    fill-opacity: 0.75;
    stroke-width: 0;
}

.highcharts-markers {
    stroke-width: 1px;
    stroke: #ffffff;
}

.highcharts-point {
    stroke-width: 1px;
}

.highcharts-dense-data .highcharts-point {
    stroke-width: 0;
}

.highcharts-data-label {
    font-size: 0.9em;
    font-weight: bold;
}

.highcharts-data-label-box {
    fill: none;
    stroke-width: 0;
}

.highcharts-data-label text,
text.highcharts-data-label {
    fill: #333333;
}

.highcharts-data-label-connector {
    fill: none;
}

.highcharts-halo {
    fill-opacity: 0.25;
    stroke-width: 0;
}

.highcharts-markers .highcharts-point-select,
.highcharts-series:not(.highcharts-pie-series) .highcharts-point-select {
    fill: #cccccc;
    stroke: #000000;
}

.highcharts-column-series rect.highcharts-point {
    stroke: #ffffff;
}

.highcharts-column-series .highcharts-point {
    transition: fill-opacity 250ms;
}

.highcharts-column-series .highcharts-point-hover {
    fill-opacity: 0.75;
    transition: fill-opacity 50ms;
}

.highcharts-pie-series .highcharts-point {
    stroke-linejoin: round;
    stroke: #ffffff;
}

.highcharts-pie-series .highcharts-point-hover {
    fill-opacity: 0.75;
    transition: fill-opacity 50ms;
}

.highcharts-funnel-series .highcharts-point,
.highcharts-pyramid-series .highcharts-point {
    stroke-linejoin: round;
    stroke: #ffffff;
}

.highcharts-funnel-series .highcharts-point-hover,
.highcharts-pyramid-series .highcharts-point-hover {
    fill-opacity: 0.75;
    transition: fill-opacity 50ms;
}

.highcharts-funnel-series .highcharts-point-select,
.highcharts-pyramid-series .highcharts-point-select {
    fill: inherit;
    stroke: inherit;
}

.highcharts-solidgauge-series .highcharts-point {
    stroke-width: 0;
}

.highcharts-treemap-series .highcharts-point {
    stroke-width: 1px;
    stroke: #e6e6e6;
    transition: stroke 250ms, fill 250ms, fill-opacity 250ms;
}

.highcharts-treemap-series .highcharts-point-hover {
    stroke: #999999;
    transition: stroke 25ms, fill 25ms, fill-opacity 25ms;
}

.highcharts-treemap-series .highcharts-above-level {
    display: none;
}

.highcharts-treemap-series .highcharts-internal-node {
    fill: none;
}

.highcharts-treemap-series .highcharts-internal-node-interactive {
    fill-opacity: 0.15;
    cursor: pointer;
}

.highcharts-treemap-series .highcharts-internal-node-interactive:hover {
    fill-opacity: 0.75;
}

/* Legend */
.highcharts-legend-box {
    fill: none;
    stroke-width: 0;
}

.highcharts-legend-item > text {
    fill: #333333;
    font-weight: bold;
    font-size: 1em;
    cursor: pointer;
    stroke-width: 0;
}

.highcharts-legend-item:hover text {
    fill: #000000;
}

.highcharts-legend-item-hidden * {
    fill: #cccccc !important;
    stroke: #cccccc !important;
    transition: fill 250ms;
}

.highcharts-legend-nav-active {
    fill: #1abc9c;
    cursor: pointer;
}

.highcharts-legend-nav-inactive {
    fill: #cccccc;
}

circle.highcharts-legend-nav-active, circle.highcharts-legend-nav-inactive {
  /* tracker */
    fill: rgba(192, 192, 192, 0.0001);
}

.highcharts-legend-title-box {
    fill: none;
    stroke-width: 0;
}

/* Bubble legend */
.highcharts-bubble-legend-symbol {
    stroke-width: 2;
    fill-opacity: 0.5;
}

.highcharts-bubble-legend-connectors {
    stroke-width: 1;
}

.highcharts-bubble-legend-labels {
    fill: #333333;
}

/* Loading */
.highcharts-loading {
    position: absolute;
    background-color: #ffffff;
    opacity: 0.5;
    text-align: center;
    z-index: 10;
    transition: opacity 250ms;
}

.highcharts-loading-hidden {
    height: 0 !important;
    opacity: 0;
    overflow: hidden;
    transition: opacity 250ms, height 250ms step-end;
}

.highcharts-loading-inner {
    font-weight: bold;
    position: relative;
    top: 45%;
}

/* Plot bands and polar pane backgrounds */
.highcharts-pane,
.highcharts-plot-band {
    fill: #000000;
    fill-opacity: 0.05;
}

.highcharts-plot-line {
    fill: none;
    stroke: #999999;
    stroke-width: 1px;
}

/* Highcharts More and modules */
.highcharts-boxplot-box {
    fill: #ffffff;
}

.highcharts-boxplot-median {
    stroke-width: 2px;
}

.highcharts-bubble-series .highcharts-point {
    fill-opacity: 0.5;
}

.highcharts-errorbar-series .highcharts-point {
    stroke: #000000;
}

.highcharts-gauge-series .highcharts-data-label-box {
    stroke: #cccccc;
    stroke-width: 1px;
}

.highcharts-gauge-series .highcharts-dial {
    fill: #000000;
    stroke-width: 0;
}

.highcharts-polygon-series .highcharts-graph {
    fill: inherit;
    stroke-width: 0;
}

.highcharts-waterfall-series .highcharts-graph {
    stroke: #333333;
    stroke-dasharray: 1, 3;
}

.highcharts-sankey-series .highcharts-point {
    stroke-width: 0;
}

.highcharts-sankey-series .highcharts-link {
    transition: fill 250ms, fill-opacity 250ms;
    fill-opacity: 0.5;
}

.highcharts-sankey-series .highcharts-point-hover.highcharts-link {
    transition: fill 50ms, fill-opacity 50ms;
    fill-opacity: 1;
}

.highcharts-venn-series .highcharts-point {
    fill-opacity: 0.75;
    stroke: #cccccc;
    transition: stroke 250ms, fill-opacity 250ms;
}

.highcharts-venn-series .highcharts-point-hover {
    fill-opacity: 1;
    stroke: #cccccc;
}

/* Highstock */
.highcharts-navigator-mask-outside {
    fill-opacity: 0;
}

.highcharts-navigator-mask-inside {
    fill: #1abc9c;
  /* navigator.maskFill option */
    fill-opacity: 0.25;
    cursor: ew-resize;
}

.highcharts-navigator-outline {
    stroke: #cccccc;
    fill: none;
}

.highcharts-navigator-handle {
    stroke: #cccccc;
    fill: #f2f2f2;
    cursor: ew-resize;
}

.highcharts-navigator-series {
    fill: #1abc9c;
    stroke: #1abc9c;
}

.highcharts-navigator-series .highcharts-graph {
    stroke-width: 1px;
}

.highcharts-navigator-series .highcharts-area {
    fill-opacity: 0.05;
}

.highcharts-navigator-xaxis .highcharts-axis-line {
    stroke-width: 0;
}

.highcharts-navigator-xaxis .highcharts-grid-line {
    stroke-width: 1px;
    stroke: #e6e6e6;
}

.highcharts-navigator-xaxis.highcharts-axis-labels {
    fill: #999999;
}

.highcharts-navigator-yaxis .highcharts-grid-line {
    stroke-width: 0;
}

.highcharts-scrollbar-thumb {
    fill: #cccccc;
    stroke: #cccccc;
    stroke-width: 1px;
}

.highcharts-scrollbar-button {
    fill: #e6e6e6;
    stroke: #cccccc;
    stroke-width: 1px;
}

.highcharts-scrollbar-arrow {
    fill: #666666;
}

.highcharts-scrollbar-rifles {
    stroke: #666666;
    stroke-width: 1px;
}

.highcharts-scrollbar-track {
    fill: #f2f2f2;
    stroke: #f2f2f2;
    stroke-width: 1px;
}

.highcharts-button {
    fill: #f7f7f7;
    stroke: #cccccc;
    cursor: default;
    stroke-width: 1px;
    transition: fill 250ms;
}

.highcharts-button text {
    fill: #333333;
}

.highcharts-button-hover {
    transition: fill 0;
    fill: #e6e6e6;
    stroke: #cccccc;
}

.highcharts-button-hover text {
    fill: #333333;
}

.highcharts-button-pressed {
    font-weight: bold;
    fill: #e6ebf5;
    stroke: #cccccc;
}

.highcharts-button-pressed text {
    fill: #333333;
    font-weight: bold;
}

.highcharts-button-disabled text {
    fill: #333333;
}

.highcharts-range-selector-buttons .highcharts-button {
    stroke-width: 0;
}

.highcharts-range-label rect {
    fill: none;
}

.highcharts-range-label text {
    fill: #666666;
}

.highcharts-range-input {
    stroke-width: 1px;
    stroke: #cccccc;
}

.highcharts-range-input rect {
    fill: none;
}

.highcharts-range-input text {
    fill: #333333;
}

input.highcharts-range-selector {
    position: absolute;
    border: 0;
    width: 1px;
  /* Chrome needs a pixel to see it */
    height: 1px;
    padding: 0;
    text-align: center;
    left: -9em;
  /* #4798 */
}

.highcharts-crosshair-label text {
    fill: #ffffff;
    font-size: 1.1em;
}

.highcharts-crosshair-label .highcharts-label-box {
    fill: inherit;
}

.highcharts-candlestick-series .highcharts-point {
    stroke: #000000;
    stroke-width: 1px;
}

.highcharts-candlestick-series .highcharts-point-up {
    fill: #ffffff;
}

.highcharts-ohlc-series .highcharts-point-hover {
    stroke-width: 3px;
}

.highcharts-flags-series .highcharts-point .highcharts-label-box {
    stroke: #999999;
    fill: #ffffff;
    transition: fill 250ms;
}

.highcharts-flags-series .highcharts-point-hover .highcharts-label-box {
    stroke: #000000;
    fill: #ccd6eb;
}

.highcharts-flags-series .highcharts-point text {
    fill: #000000;
    font-size: 0.9em;
    font-weight: bold;
}

/* Highmaps */
.highcharts-map-series .highcharts-point {
    transition: fill 500ms, fill-opacity 500ms, stroke-width 250ms;
    stroke: #cccccc;
}

.highcharts-map-series .highcharts-point-hover {
    transition: fill 0ms, fill-opacity 0;
    fill-opacity: 0.5;
    stroke-width: 2px;
}

.highcharts-mapline-series .highcharts-point {
    fill: none;
}

.highcharts-heatmap-series .highcharts-point {
    stroke-width: 0;
}

.highcharts-map-navigation {
    font-size: 1.3em;
    font-weight: bold;
    text-align: center;
}

.highcharts-coloraxis {
    stroke-width: 0;
}

.highcharts-coloraxis-marker {
    fill: #999999;
}

.highcharts-null-point {
    fill: #f7f7f7;
}

/* 3d charts */
.highcharts-3d-frame {
    fill: transparent;
}

/* Exporting module */
.highcharts-contextbutton {
    fill: #ffffff;
  /* needed to capture hover */
    stroke: none;
    stroke-linecap: round;
}

.highcharts-contextbutton:hover {
    fill: #e6e6e6;
    stroke: #e6e6e6;
}

.highcharts-button-symbol {
    stroke: #666666;
    stroke-width: 3px;
}

.highcharts-menu {
    border: 1px solid #999999;
    background: #ffffff;
    padding: 5px 0;
    box-shadow: 3px 3px 10px #888;
}

.highcharts-menu-item {
    padding: 0.5em 1em;
    background: none;
    color: #333333;
    cursor: pointer;
    transition: background 250ms, color 250ms;
}

.highcharts-menu-item:hover {
    background: #1abc9c;
    color: #ffffff;
}

/* Drilldown module */
.highcharts-drilldown-point {
    cursor: pointer;
}

.highcharts-drilldown-axis-label,
.highcharts-drilldown-data-label text,
text.highcharts-drilldown-data-label {
    cursor: pointer;
    fill: #1abc9c;
    font-weight: bold;
    text-decoration: underline;
}

/* No-data module */
.highcharts-no-data text {
    font-weight: bold;
    font-size: 12px;
    fill: #666666;
}

/* Drag-panes module */
.highcharts-axis-resizer {
    cursor: ns-resize;
    stroke: black;
    stroke-width: 2px;
}

/* Bullet type series */
.highcharts-bullet-target {
    stroke-width: 0;
}

/* Lineargauge type series */
.highcharts-lineargauge-target,
.highcharts-lineargauge-target-line {
    stroke-width: 1px;
    stroke: #333333;
}

/* Annotations module */
.highcharts-annotation-label-box {
    stroke-width: 1px;
    stroke: #000000;
    fill: #000000;
    fill-opacity: 0.75;
}

.highcharts-annotation-label text {
    fill: #e6e6e6;
}

/* Gantt */
.highcharts-treegrid-node-collapsed,
.highcharts-treegrid-node-expanded {
    cursor: pointer;
}

.highcharts-point-connecting-path {
    fill: none;
}

.highcharts-grid-axis .highcharts-axis-line,
.highcharts-grid-axis .highcharts-tick {
    stroke-width: 1px;
}

.peity-chart + .peity {
    width: 100%;
    height: 250px;
}

/**  =====================
      Authentication css start
==========================  **/
.auth-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    min-width: 100%;
    min-height: 100vh;
    background: #1abc9c;
    /* background-image: url("../images/auth/img-auth-big.jpg"); */
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

@media (min-width: 1200px) {
    .auth-wrapper .container {
        max-width: 1140px;
    }
}

@media (-ms-high-contrast: none), (-ms-high-contrast: active) {
    .auth-wrapper {
        display: block;
        margin: 0 auto;
    }

    .auth-wrapper > .row {
        min-height: 100vh;
    }

    .auth-wrapper > .row > .aut-bg-img {
        min-height: 100vh;
    }
}

.auth-wrapper .saprator {
    position: relative;
    margin: 8px 0;
}

.auth-wrapper .saprator span {
    background: #fff;
    position: relative;
    padding: 0 10px;
    z-index: 5;
    font-size: 20px;
}

.auth-wrapper .saprator:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 0;
    width: 100%;
    height: 1px;
    background: #e2e5e8;
    z-index: 1;
}

.auth-wrapper a,
  .auth-wrapper p > a {
    color: #37474f;
    font-weight: 600;
}

.auth-wrapper .input-group {
    background: transparent;
}

.auth-wrapper .card {
    margin-bottom: 0;
    padding: 8px;
    border-radius: 8px;
}

.auth-wrapper .card .card-body {
    padding: 20px 25px 20px 40px;
}

@media (-ms-high-contrast: none), (-ms-high-contrast: active) {
    .auth-wrapper .card {
        display: block;
    }
}

.auth-wrapper > div {
    z-index: 5;
}

.auth-wrapper .auth-content {
    position: relative;
    padding: 15px;
    z-index: 5;
}

.auth-wrapper .auth-content:not(.container) {
    width: 400px;
}

.auth-wrapper .auth-content:not(.container) .card-body {
    padding: 40px 35px;
}

@media (-ms-high-contrast: none), (-ms-high-contrast: active) {
    .auth-wrapper .auth-content {
        margin: 0 auto;
    }
}

.auth-wrapper .auth-side-img {
    padding-right: 400px;
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
    justify-content: center;
}

@media only screen and (max-width: 991px) {
    .auth-wrapper .auth-side-img {
        display: none;
    }
}

.auth-wrapper .auth-side-form {
    position: relative;
    min-height: 100%;
    background: #fff;
    display: inline-flex;
    align-items: center;
    left: auto;
    float: right;
}

.auth-wrapper .auth-side-form > * {
    position: relative;
    z-index: 5;
}

@media only screen and (max-width: 991px) {
    .auth-wrapper .auth-side-form {
        width: 100%;
        justify-content: center;
    }

    .auth-wrapper .auth-side-form .auth-content:not(.container) {
        max-width: 350px;
    }
}

@media (-ms-high-contrast: none), (-ms-high-contrast: active) {
    .auth-wrapper.aut-bg-img .auth-side-form {
        height: 100vh;
    }
}

@media only screen and (max-width: 767px) {
    .auth-wrapper .card .card-body {
        padding: 30px 15px;
    }
}

.auth-wrapper.offline {
    background-image: none;
}

.auth-wrapper.offline h1 {
    font-size: 87px;
    font-weight: 700;
}

.auth-wrapper.offline:before {
    display: none;
}

.auth-wrapper .card-body .carousel-indicators {
    margin: 15px 0 10px;
    bottom: 0;
}

.auth-wrapper .card-body .carousel-indicators li {
    width: 50px;
    background-color: rgba(26, 188, 156, 0.4);
    border-radius: 5px;
    height: 4px;
}

.auth-wrapper .card-body .carousel-indicators li.active {
    background-color: #1abc9c;
}

.auth-wrapper .img-logo-overlay {
    position: absolute;
    top: 40px;
    left: 50px;
}

/* image varient start */
.aut-bg-img {
    /* background-image: url("../images/auth/img-auth-big.jpg"); */
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

.aut-bg-img .auth-content {
    padding: 70px 40px;
}

/* image varient End */
/**====== Authentication css end ======**/
/**  =====================
      Authentication css start
==========================  **/
.auth-wrapper.maintance {
    background: #e9e9e9;
}

.auth-wrapper.offline {
    background: radial-gradient(#94acbe, #253653);
}

.auth-wrapper.offline .offline-wrapper {
    position: relative;
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
}

.auth-wrapper.offline .offline-wrapper > svg {
    width: 100%;
    position: absolute;
    bottom: 0;
    left: 0;
}

.auth-wrapper.offline .offline-wrapper .boat-img {
    -webkit-animation: boatanim 12s ease-in-out infinite;
    animation: boatanim 12s ease-in-out infinite;
}

.auth-wrapper.offline .s-img-1,
  .auth-wrapper.offline .s-img-2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}

.auth-wrapper.offline .s-img-1 {
    -webkit-animation: sparcle 3.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    animation: sparcle 3.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
}

.auth-wrapper.offline .s-img-2 {
    -webkit-animation: sparcle 3.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    animation: sparcle 3.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    -webkit-animation-delay: 1.19s;
    animation-delay: 1.19s;
}

.auth-wrapper.offline .moon {
    background: rgba(255, 255, 255, 0.4);
    position: absolute;
    top: 12%;
    left: 40%;
    width: 150px;
    height: 150px;
    border-radius: 50%;
}

.auth-wrapper.offline .moon:after, .auth-wrapper.offline .moon:before {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
    box-shadow: inset 0 0 20px 5px rgba(255, 255, 255, 0.4);
}

.auth-wrapper.offline .moon:after {
    -webkit-animation: sunwawe 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    animation: sunwawe 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
}

.auth-wrapper.offline .moon:before {
    -webkit-animation: sunwawe 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    animation: sunwawe 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    -webkit-animation-delay: 1.15s;
    animation-delay: 1.15s;
}

.auth-wrapper.offline .sark .img-sark {
    width: 300px;
    position: absolute;
    right: -200px;
    -webkit-animation: sark 12s ease-in-out infinite;
    animation: sark 12s ease-in-out infinite;
}

.auth-wrapper.offline .sark .bubble {
    background: rgba(255, 255, 255, 0);
    position: absolute;
    top: 12%;
    left: 60%;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    -webkit-animation: bubble 12s ease-in-out infinite;
    animation: bubble 12s ease-in-out infinite;
}

.auth-wrapper.offline .sark .bubble:after, .auth-wrapper.offline .sark .bubble:before {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
    box-shadow: inset 0 0 20px 5px rgba(255, 255, 255, 0.4);
}

.auth-wrapper.offline .sark .bubble:after {
    -webkit-animation: sunwawe 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
    animation: sunwawe 2.1s cubic-bezier(0.65, 0.815, 0.735, 0.395) infinite;
}

.auth-wrapper.offline .sark .bubble:before {
    -webkit-animation: sunwawe 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    animation: sunwawe 2.1s cubic-bezier(0.165, 0.84, 0.44, 1) infinite;
    -webkit-animation-delay: 1.15s;
    animation-delay: 1.15s;
}

.auth-wrapper.offline .off-main {
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
}

.auth-wrapper.offline .off-main .off-content {
    position: absolute;
    width: 100%;
    bottom: 5%;
    left: 0;
    z-index: 5;
}

@media only screen and (max-width: 575px) {
    .auth-wrapper.offline .sark {
        display: none;
    }

    .auth-wrapper.offline .offline-wrapper > svg {
        height: 95%;
    }

    .auth-wrapper.offline .off-main .off-content {
        bottom: 0%;
    }

    .auth-wrapper.offline .off-main .off-content h1 {
        font-size: 45px;
    }

    .auth-wrapper.offline .moon {
        top: 12%;
        width: 50px;
        height: 50px;
    }
}

@-webkit-keyframes bubble {
    0%, 30% {
        opacity: 0;
    }

    31% {
        opacity: 1;
    }

    59% {
        opacity: 1;
    }

    60%, 100% {
        opacity: 0;
    }
}

@keyframes bubble {
    0%, 30% {
        opacity: 0;
    }

    31% {
        opacity: 1;
    }

    59% {
        opacity: 1;
    }

    60%, 100% {
        opacity: 0;
    }
}

@-webkit-keyframes sark {
    0% {
        transform: rotate(-10deg) translate(245px, 46px);
    }

    30% {
        transform: rotate(-13deg) translate(-329px, -80px);
    }

    60% {
        transform: rotate(-13deg) translate(-329px, -80px);
    }

    100% {
        transform: rotate(-26deg) translate(-887px, -80px);
    }
}

@keyframes sark {
    0% {
        transform: rotate(-10deg) translate(245px, 46px);
    }

    30% {
        transform: rotate(-13deg) translate(-329px, -80px);
    }

    60% {
        transform: rotate(-13deg) translate(-329px, -80px);
    }

    100% {
        transform: rotate(-26deg) translate(-887px, -80px);
    }
}

@-webkit-keyframes boatanim {
    0% {
        transform: rotate(-10deg) translate(95px, -14px);
    }

    50% {
        transform: rotate(5deg) translate(-65px, -14px);
    }

    100% {
        transform: rotate(-10deg) translate(95px, -14px);
    }
}

@keyframes boatanim {
    0% {
        transform: rotate(-10deg) translate(95px, -14px);
    }

    50% {
        transform: rotate(5deg) translate(-65px, -14px);
    }

    100% {
        transform: rotate(-10deg) translate(95px, -14px);
    }
}

@-webkit-keyframes sunwawe {
    0% {
        transform: scale(1);
        opacity: 1;
    }

    100% {
        transform: scale(4);
        opacity: 0;
    }
}

@keyframes sunwawe {
    0% {
        transform: scale(1);
        opacity: 1;
    }

    100% {
        transform: scale(4);
        opacity: 0;
    }
}

@-webkit-keyframes sparcle {
    0% {
        opacity: 0.5;
    }

    50% {
        opacity: 0;
    }
}

@keyframes sparcle {
    0% {
        opacity: 0.5;
    }

    50% {
        opacity: 0;
    }
}

/**====== Authentication css end ======**/
/* ===================== to do page start ======================================= */
#task-container ul {
    overflow: hidden;
    padding: 0;
}

#task-container li {
    float: left;
    width: 49%;
    overflow: auto;
    height: auto;
    min-height: 10px;
    background: #fff;
    display: inline-block;
    padding: 20px;
    border: 1px solid #ccc;
    color: #666;
    border-top: 5px solid #1abc9c;
    cursor: pointer;
    margin-bottom: 20px;
    margin-right: 2%;
    transition: all 0.3s;
    position: relative;
}

#task-container li:nth-child(2n) {
    margin-right: 0;
}

#task-container li.complete {
    opacity: 1;
    border-top: 9px solid #e74c3c;
    transition: all ease-in 0.3s;
}

#task-container li.complete:before {
    /* background: url("../images/complete.png") no-repeat; */
    position: absolute;
    top: 5px;
    right: 5px;
    content: "";
    width: 55px;
    height: 55px;
    background-size: 100%;
}

#task-container li.complete p {
    text-decoration: line-through;
}

@media screen and (max-width: 580px) {
    #task-container li {
        width: 100%;
    }
}

.new-task .to-do-list .cr {
    float: left;
    top: 0;
    margin-right: 16px;
}

.new-task label input[type=checkbox] {
    display: none;
}

.checkbox-fade .cr {
    border-radius: 6px;
    border: 1px solid #e3e3e3;
    cursor: pointer;
    display: inline-block;
    float: left;
    height: 24px;
    margin-right: 0.5em;
    position: relative;
    width: 24px;
    margin-right: 16px;
    top: 0;
}

.task-panel .to-do-label {
    margin-bottom: 15px;
}

.task-panel .to-do-label:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding: 0;
}

.done-task .captions,
.done-task span {
    color: #919aa3;
    text-decoration: line-through;
}

.to-do-list i {
    color: #ccc;
    font-size: 17px;
    opacity: 0;
}

.to-do-list:hover i {
    opacity: 1;
    transition: opacity ease-in 0.3s;
}

.to-do-list h6 {
    display: inline-block;
}

.to-do-list .done-task {
    opacity: 0.7;
}

.to-do-list .done-task > div {
    -webkit-filter: grayscale(0.8);
    filter: grayscale(0.8);
}

.to-do-list .done-task h6,
  .to-do-list .done-task p,
  .to-do-list .done-task span {
    text-decoration: line-through;
}

.to-do-list .checkbox-fade .check-task {
    display: block;
}

.to-do-list .checkbox-fade .to-content {
    display: inline-block;
}

.to-do-list .checkbox-fade .cr {
    border-radius: 6px;
    border: 1px solid #e3e3e3;
    cursor: pointer;
    display: inline-block;
    float: left;
    height: 24px;
    margin-right: 0.5em;
    position: relative;
    width: 24px;
    margin: 0;
    top: 5px;
}

.to-do-list .checkbox-fade .cr .cr-icon {
    color: #fff;
    font-size: 0.8em;
    left: 0;
    line-height: 0;
    position: absolute;
    right: 0;
    text-align: center;
    top: 50%;
}

.to-do-list .checkbox-fade label input[type=checkbox] {
    display: none;
}

.to-do-list .checkbox-fade label input[type=checkbox] + .cr > .cr-icon {
    transform: scale(3) rotateZ(-20deg);
    opacity: 0;
    transition: all 0.3s ease-in;
}

.to-do-list .checkbox-fade label input[type=checkbox]:checked + .cr > .cr-icon {
    transform: scale(1) rotateZ(0deg);
    opacity: 1;
}

.to-do-list .checkbox-fade label input[type=checkbox]:checked + .cr {
    background: #1abc9c;
    border: 0;
}

new-task .to-do-list .cr {
    float: left;
    top: 0;
    margin-right: 16px;
}

new-task label input[type=checkbox] {
    display: none;
}

/* ===================== to do page end =========================================*/
/* ===================== Gallery-masonry page start ============================= */
.gallery-masonry .card-columns {
    -webkit-column-count: 4;
    -moz-column-count: 4;
    column-count: 4;
}

@media screen and (max-width: 1400px) {
    .gallery-masonry .card-columns {
        -webkit-column-count: 3;
        -moz-column-count: 3;
        column-count: 3;
    }
}

@media screen and (max-width: 992px) {
    .gallery-masonry .card-columns {
        -webkit-column-count: 2;
        -moz-column-count: 2;
        column-count: 2;
    }
}

@media screen and (max-width: 575px) {
    .gallery-masonry .card-columns {
        -webkit-column-count: 1;
        -moz-column-count: 1;
        column-count: 1;
    }
}

.job-meta-data i {
    margin-right: 5px;
    color: #1abc9c;
}

/* ===================== Gallery-masonry page end ============================= */
/* ===================== Task-list page start ============================= */
.task-data img {
    width: 40px;
    box-shadow: none;
}

.task-data i {
    color: #37474f;
}

.task-data .dropdown-toggle:after {
    color: #37474f;
}

.task-board-left .task-right-header-revision,
.task-board-left .task-right-header-status,
.task-board-left .task-right-header-users {
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom: 1px solid #f1f1f1;
    cursor: pointer;
}

.task-board-left .taskboard-right-progress,
.task-board-left .taskboard-right-revision,
.task-board-left .taskboard-right-users {
    padding-top: 10px;
}

.task-board-left .taskboard-right-progress .progress {
    height: 9px;
    margin-bottom: 25px;
}

.task-board-left .user-box .media-object {
    height: 50px;
    width: 50px;
    cursor: pointer;
}

.task-board-left .user-box .media-left {
    position: relative;
}

.task-board-left .user-box .btn.btn-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.task-board-left .live-status {
    height: 8px;
    width: 8px;
    position: absolute;
    bottom: 0;
    right: 0;
    border-radius: 100%;
    top: 5px;
}

.filter-bar .navbar {
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    padding: 0.5rem 1rem;
}

@media screen and (max-width: 557px) {
    .filter-bar .navbar .f-text {
        display: block;
        width: 100%;
    }

    .filter-bar .navbar .f-view {
        padding-left: 24px;
    }

    .filter-bar .navbar .f-view span {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
}

.filter-bar .label {
    border-radius: 4px;
    font-size: 13px;
    padding: 3px 7px;
}

.filter-bar .task-detail {
    margin-bottom: 5px;
}

.filter-bar .card-task .task-list-table {
    display: inline-block;
}

.filter-bar .card-task .task-list-table img {
    width: 40px;
    box-shadow: none;
}

.filter-bar .card-task .task-list-table i {
    color: #37474f;
}

.filter-bar .card-task .task-board {
    float: right;
    margin-top: 5px;
}

.filter-bar .card-task .task-board .dropdown {
    display: inline-block;
}

.filter-bar .card-task .task-board .btn {
    padding: 4px 10px;
    font-size: 10px;
    margin: 0;
}

.assign-user img,
.task-comment img {
    width: 45px;
    box-shadow: none;
}

/* ===================== Task-list page end ===================================== */
/* ===================== Invoice page start ===================================== */
.invoice-contact {
    display: flex;
    margin-bottom: 30px;
    padding-top: 30px;
    align-items: center;
}

@media screen and (max-width: 767px) {
    .invoice-contact {
        margin-bottom: 0;
    }
}

.invoice-table.table td {
    border: 0;
    padding: 4px 0;
}

.invoive-info {
    display: flex;
    margin-bottom: 30px;
}

.invoive-info h6 {
    margin-bottom: 20px;
    text-transform: uppercase;
}

.invoive-info .invoice-order.table {
    padding-left: 0;
}

.invoive-info .invoice-order.table th {
    border: 0;
    padding: 4px 0;
}

.invoive-info .invoice-order.table th:first-child {
    padding-left: 0;
    width: 80px;
}

.invoice-total.table {
    background: #f3f3f3;
    padding: 30px 0;
}

.invoice-total.table th {
    border: 0;
    padding: 4px 0;
    text-align: right;
}

.invoice-total.table td {
    text-align: right;
}

.invoice-total.table tbody {
    padding-right: 20px;
    float: right;
}

.invoice-summary .label {
    border-radius: 5px;
    padding: 3px 10px;
    font-size: 12px;
}

.invoice-list .btn {
    padding: 5px 10px;
    font-size: 12px;
}

.invoice-list .task-list-table {
    display: inline-block;
}

/* ===================== Invoice page end ======================================= */
/* ==============================================================
                     email-page  Start
====================================================== */
.email-card .tab-content {
    box-shadow: none;
}

.email-card .tab-content .btn {
    border: none;
}

.email-card .tab-content .btn i {
    font-size: 18px;
    line-height: 1.4;
}

.email-card .tab-content .table tr {
    transition: all 0.12s ease-in-out;
}

.email-card .tab-content .table tr td,
    .email-card .tab-content .table tr th {
    padding: 0.65rem 0.75rem;
}

.email-card .tab-content .table tr td .checkbox,
      .email-card .tab-content .table tr th .checkbox {
    padding: 12px 0;
}

.email-card .tab-content .table tr td label,
      .email-card .tab-content .table tr th label {
    margin-bottom: 0;
}

.email-card .tab-content .table tr.unread {
    font-weight: 600;
}

.email-card .tab-content .table tr.read {
    background: rgba(233, 233, 233, 0.7);
}

.email-card .tab-content .table tr:hover {
    background: #e9e9e9;
    box-shadow: 0 1px 3px 0 #e2e5e8;
}

.email-card .tab-content .nav-pills {
    margin-left: 0;
    border-top: 1px solid #e2e5e8;
    padding: 15px 0 0;
}

.email-card .tab-content .nav-pills > li .nav-link {
    border-radius: 0;
    border: none;
    padding: 5px 12px 22px;
    position: relative;
}

.email-card .tab-content .nav-pills > li .nav-link::after {
    content: "";
    width: calc(100% - 24px);
    height: 3px;
    position: absolute;
    left: 12px;
    bottom: 0;
    border-radius: 3px 3px 0 0;
}

.email-card .tab-content .nav-pills > li .nav-link.active {
    background: transparent;
    color: #e74c3c;
}

.email-card .tab-content .nav-pills > li .nav-link.active:after {
    background: #e74c3c;
}

.email-card .nav-pills {
    padding: 0;
    margin-left: -20px;
}

.email-card .nav-pills > li .nav-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    padding: 8px 25px;
    border-radius: 0 20px 20px 0;
    text-transform: capitalize;
    border: 1px solid transparent;
    border-left: none;
    color: #373a3c;
}

.email-card .nav-pills > li .nav-link i {
    padding: 0;
    margin-right: 10px;
    font-size: 16px;
    display: inline-block;
    position: relative;
    top: 2px;
}

.email-card .nav-pills > li .nav-link.active,
  .email-card .nav-pills > li .show > .nav-link {
    font-weight: 600;
    background: rgba(231, 76, 60, 0.1);
    color: #e74c3c;
    border-color: rgba(231, 76, 60, 0.1);
}

.email-card .email-more-link {
    font-size: 16px;
}

.email-card .email-more-link i {
    line-height: 1.1;
}

.email-card .mail-body-content a {
    color: #373a3c;
}

.email-card .mail-body-content .mail-attach {
    display: inline-block;
    border: 1px solid #e2e5e8;
    border-radius: 50px;
    padding: 5px 15px;
    margin-top: 10px;
}

.email-card .email-btn .btn {
    border: none;
}

.email-card .email-btn .btn.dropdown-toggle::after {
    display: none;
}

@media screen and (max-width: 767px) {
    .email-card .input-group {
        margin-top: 20px;
    }
}

.email-content {
    border-bottom: 1px solid #e2e5e8;
    padding-bottom: 15px;
}

.email-read {
    display: flex;
    align-items: flex-start;
}

@media screen and (max-width: 575px) {
    .email-read {
        display: inline-block;
    }

    .email-read .photo-table {
        margin-bottom: 10px;
    }

    .email-contant {
        margin: 0 !important;
        padding: 0 !important;
    }
}

/* ==================  email-page  End  =================== */
/* ==============================================================
                     image-cropper  Start
====================================================== */
.docs-buttons .btn {
    margin-bottom: 10px !important;
}

.docs-data .input-group {
    background: transparent;
    margin-bottom: 10px;
}

.docs-data > .input-group > label {
    min-width: 80px;
}

.docs-data .input-group > span {
    min-width: 50px;
}

.img-container {
    min-height: 200px;
    max-height: 516px;
    margin-bottom: 20px;
}

.img-container > img {
    max-width: 100%;
}

@media (min-width: 768px) {
    .img-container {
        min-height: 516px;
    }
}

.docs-preview {
    margin-right: -15px;
}

.docs-preview .img-preview {
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
    overflow: hidden;
}

.docs-preview .img-preview > img {
    max-width: 100%;
}

.docs-preview .preview-lg {
    width: 100% !important;
}

.docs-preview .preview-md {
    width: 139px;
    height: 78px;
}

.docs-preview .preview-sm {
    width: 69px;
    height: 39px;
}

.docs-preview .preview-xs {
    width: 35px;
    height: 20px;
    margin-right: 0;
}

.docs-buttons > .btn,
.docs-buttons > .btn-group,
.docs-buttons > .form-control {
    margin-right: 5px;
}

.docs-toggles > .btn,
.docs-toggles > .btn-group,
.docs-toggles > .dropdown {
    margin-bottom: 10px;
}

.docs-tooltip {
    display: block;
    margin: -6px -12px;
    padding: 6px 12px;
}

.docs-tooltip > .icon {
    margin: 0 -3px;
    vertical-align: top;
}

.tooltip-inner {
    white-space: normal;
}

.btn-upload .tooltip-inner {
    white-space: nowrap;
}

@media (max-width: 400px) {
    .btn-group-crop {
        margin-right: -15px !important;
    }

    .btn-group-crop > .btn {
        padding-left: 5px;
        padding-right: 5px;
    }

    .btn-group-crop .docs-tooltip {
        margin-left: -5px;
        margin-right: -5px;
        padding-left: 5px;
        padding-right: 5px;
    }
}

.docs-options .dropdown-menu {
    width: 100%;
}

.docs-options .dropdown-menu > li {
    padding: 3px 20px;
    font-size: 14px;
}

.docs-options .dropdown-menu > li:hover {
    background-color: #f7f7f7;
}

.docs-options .dropdown-menu > li > label {
    display: block;
}

.docs-cropped .modal-body {
    text-align: center;
}

.docs-cropped .modal-body > canvas,
  .docs-cropped .modal-body > img {
    max-width: 100%;
}

.card-block .docs-options .dropdown-menu {
    top: inherit;
}

/* ==================  image-cropper end  ======================================= */
/**  =====================
      Help Desk Application css start
==========================  **/
.hd-body .excerpt {
    padding: 15px;
    background: #e9e9e9;
    border: 1px solid #e2e5e8;
}

.hd-body .ticket-customer,
.hd-body .ticket-type-icon {
    display: block;
    text-transform: capitalize;
}

.hd-body:hover .hover-blk {
    transform: scale(1);
}

.sm-view .card-body .excerpt,
.sm-view .card-body ul.list-inline {
    display: none;
}

.md-view .excerpt {
    display: none;
}

.md-view .col-auto ul li:nth-child(1),
.md-view .col-auto ul li:nth-child(3),
.sm-view .col-auto ul li:nth-child(1),
.sm-view .col-auto ul li:nth-child(3) {
    display: none;
}

.hover-blk {
    background: #fff;
    width: 270px;
    left: calc(100% + 10px);
    transform: scale(0);
    z-index: 5;
    transition: all 0.1s ease-out;
}

.hover-blk .img-txt p {
    display: inline-block;
}

.topic-name h1 {
    float: left;
    font-weight: normal;
}

.topic-name .btn-star {
    float: right;
}

.dicon-blk {
    top: 0;
    right: 0;
}

.dicon-blk li {
    display: inline-block;
}

.hd-detail .col-right .edit-del {
    opacity: 0;
}

.hd-detail .col-right .edit-del i {
    opacity: 0.2;
}

.hd-detail .col-right .edit-del i:hover {
    opacity: 1;
}

.hd-detail:hover .edit-del {
    opacity: 1;
}

.hdd-user i {
    bottom: 0;
}

.ticket-block .hd-body {
    border-left: 3px solid #ccc;
}

.ticket-block .col.border-right {
    border-color: #ccc !important;
}

.ticket-block .ticket-type-icon {
    font-weight: 500;
    color: #111;
}

.ticket-block .excerpt h6 {
    color: #686c71;
    font-weight: 500;
}

.ticket-block .excerpt h6 a {
    color: #686c71;
}

.ticket-block .excerpt h6 a:hover {
    text-decoration: underline !important;
    color: #111;
}

.ticket-block.open-tic .hd-body {
    border-color: #ea394a;
}

.ticket-block.close-tic .hd-body {
    border-color: #5AC17F;
}

.right-col .card-footer label {
    font-weight: 500;
}

.q-view {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1030;
    top: 0;
    right: 0;
    visibility: hidden;
}

.q-view .overlay {
    background-color: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.q-view .content {
    width: 585px;
    height: 100vh;
    z-index: 5;
    position: absolute;
    top: 0;
    background-color: #fff;
    padding-top: 20px;
    box-shadow: 0 0 100px rgba(0, 0, 0, 0.3);
    right: -765px;
    transition: right 0.195s ease-in, visibility 0s linear 0.195s;
    min-height: 100vh;
    overflow: auto;
}

.q-view.active {
    visibility: visible;
}

.q-view.active .content {
    right: 0;
    transition: right 0.225s ease-out;
}

.select2-container--default {
    margin-bottom: 10px;
}

.select2-container--default .select2-selection {
    border-color: #e2e5e8;
}

.hdd-right-side {
    width: 495px;
}

.hdd-right-side .hdd-right-inner {
    position: fixed;
    width: 465px;
}

.span-content a {
    padding: 0 7px;
}

.file-btn {
    position: relative;
    overflow: hidden;
}

.file-btn input {
    position: absolute;
    font-size: 50px;
    opacity: 0;
    right: 0;
    top: 0;
}

@media (max-width: 992px) {
    .hd-detail .col-right .edit-del {
        opacity: 1;
    }
}

@media only screen and (max-width: 767px) {
    .hdd-right-side {
        width: 100%;
    }

    .hdd-right-side .hdd-right-inner {
        position: static;
        width: 100%;
    }
}

@media (max-width: 575px) {
    .q-view .content {
        width: 450px;
    }
}

@media (max-width: 380px) {
    .q-view .content {
        width: 300px;
    }
}

/**====== Help Desk Application css start ======**/
.fc-view {
    margin-top: 30px;
}

.none-border .modal-footer {
    border-top: none;
}

.fc-toolbar {
    margin: 15px 0 5px;
}

.fc-toolbar h2 {
    font-size: 1.25rem;
    line-height: 1.875rem;
    text-transform: uppercase;
}

.fc-day-grid-event .fc-time {
    font-weight: 700;
}

.fc-day {
    background: transparent;
}

.fc-toolbar .fc-state-active,
.fc-toolbar .ui-state-active,
.fc-toolbar .ui-state-hover,
.fc-toolbar button:focus,
.fc-toolbar button:hover {
    z-index: 0;
}

.fc th.fc-widget-header {
    background: #1abc9c;
    color: #fff;
    border-color: #1abc9c;
    font-size: 13px;
    line-height: 20px;
    padding: 10px 0;
    text-transform: uppercase;
}

.fc-unthemed .fc-divider,
.fc-unthemed .fc-popover,
.fc-unthemed .fc-row,
.fc-unthemed tbody,
.fc-unthemed td,
.fc-unthemed th,
.fc-unthemed thead {
    border-color: #f0f2f3;
}

.fc-today-button,
.fc-button {
    background: #f0f2f3;
    border: none;
    color: #343a40;
    text-shadow: none;
    text-transform: capitalize;
    box-shadow: none;
    border-radius: 3px;
    margin: 0.375rem 0.75rem;
    padding: 0.375rem 0.75rem !important;
    height: auto !important;
}

.fc-text-arrow {
    font-family: inherit;
    font-size: 1rem;
}

.fc-state-hover {
    background: #e9ecef;
}

.fc-state-highlight {
    background: #dee2e6;
}

.fc-state-active,
.fc-state-disabled,
.fc-state-down {
    background-color: #1abc9c;
    color: #fff;
    text-shadow: none;
}

.fc-cell-overlay {
    background: #dee2e6;
}

.fc-unthemed td.fc-today {
    background: #f8f9fa;
}

.fc-unthemed .fc-divider,
.fc-unthemed .fc-list-heading td,
.fc-unthemed .fc-popover .fc-header {
    background: #f8f9fa;
}

.fc-event,
.fc-event:not([href]) {
    background-color: #1abc9c;
    border-color: #1abc9c;
    color: #fff;
    padding: 5px 10px;
    border-radius: 2px;
    margin-bottom: 5px;
    cursor: move;
}

.external-event {
    cursor: move;
    margin: 10px 0;
    padding: 8px 10px;
    color: #fff;
}

.fc-basic-view td.fc-week-number span {
    padding-right: 8px;
}

.fc-basic-view td.fc-day-number {
    padding-right: 8px;
}

.fc-basic-view .fc-content {
    color: #fff;
}

.fc-time-grid-event .fc-content {
    color: #fff;
}

.fc-today-button,
.fc .fc-button-group > * {
    margin-bottom: 4px;
    margin-left: 10px;
    border-radius: 2px;
    font-size: 1rem;
}

.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
    float: right;
    height: 20px;
    width: 20px;
    text-align: center;
    line-height: 20px;
    background-color: #f0f2f3;
    border-radius: 2px;
    margin: 5px;
    font-size: 12px;
    border: 1px solid #ebedef;
}

.fc-scroller {
    overflow: visible !important;
    height: auto !important;
}

@media (max-width: 767.98px) {
    .fc-toolbar .fc-center,
  .fc-toolbar .fc-left,
  .fc-toolbar .fc-right {
        float: none;
        display: block;
        clear: both;
        margin: 10px 0;
    }

    .fc .fc-toolbar > * > * {
        float: none;
    }

    .fc-today-button {
        display: none;
    }
}

/**  =====================
      Icon layouts css start
==========================  **/
.i-main .i-block {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    margin: 5px;
    border: 1px solid #f1f1f1;
    position: relative;
    cursor: pointer;
}

.i-main .i-block i {
    font-size: 30px;
}

.i-main .i-block label {
    margin-bottom: 0;
    display: none;
}

.i-main .i-block span.ic-badge {
    position: absolute;
    bottom: 0;
    right: 0;
}

.i-main .i-block .flag-icon-background {
    width: 40px;
    height: 40px;
}

.sample-icon .i-block {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    margin: 5px;
    border-radius: 50%;
    border: 1px solid #f1f1f1;
    position: relative;
    cursor: pointer;
}

.sample-icon .i-block i {
    font-size: 28px;
}

.sample-icon .i-block:nth-child(1) {
    border-color: #1abc9c;
    background: rgba(26, 188, 156, 0.1);
}

.sample-icon .i-block:nth-child(1) i {
    color: #1abc9c;
}

.sample-icon .i-block:nth-child(2) {
    border-color: #6610f2;
    background: rgba(102, 16, 242, 0.1);
}

.sample-icon .i-block:nth-child(2) i {
    color: #6610f2;
}

.sample-icon .i-block:nth-child(3) {
    border-color: #6f42c1;
    background: rgba(111, 66, 193, 0.1);
}

.sample-icon .i-block:nth-child(3) i {
    color: #6f42c1;
}

.sample-icon .i-block:nth-child(4) {
    border-color: #e83e8c;
    background: rgba(232, 62, 140, 0.1);
}

.sample-icon .i-block:nth-child(4) i {
    color: #e83e8c;
}

.sample-icon .i-block:nth-child(5) {
    border-color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.sample-icon .i-block:nth-child(5) i {
    color: #e74c3c;
}

.sample-icon .i-block:nth-child(6) {
    border-color: #fd7e14;
    background: rgba(253, 126, 20, 0.1);
}

.sample-icon .i-block:nth-child(6) i {
    color: #fd7e14;
}

.sample-icon .i-block:nth-child(7) {
    border-color: #f1c40f;
    background: rgba(241, 196, 15, 0.1);
}

.sample-icon .i-block:nth-child(7) i {
    color: #f1c40f;
}

.sample-icon .i-block:nth-child(8) {
    border-color: #2ecc71;
    background: rgba(46, 204, 113, 0.1);
}

.sample-icon .i-block:nth-child(8) i {
    color: #2ecc71;
}

.sample-icon .i-block:nth-child(9) {
    border-color: #20c997;
    background: rgba(32, 201, 151, 0.1);
}

.sample-icon .i-block:nth-child(9) i {
    color: #20c997;
}

.sample-icon .i-block:nth-child(10) {
    border-color: #00acc1;
    background: rgba(0, 172, 193, 0.1);
}

.sample-icon .i-block:nth-child(10) i {
    color: #00acc1;
}

.sample-icon .i-block:nth-child(11) {
    border-color: #1abc9c;
    background: rgba(26, 188, 156, 0.1);
}

.sample-icon .i-block:nth-child(11) i {
    color: #1abc9c;
}

.sample-icon .i-block:nth-child(12) {
    border-color: #6610f2;
    background: rgba(102, 16, 242, 0.1);
}

.sample-icon .i-block:nth-child(12) i {
    color: #6610f2;
}

.sample-icon .i-block:nth-child(13) {
    border-color: #6f42c1;
    background: rgba(111, 66, 193, 0.1);
}

.sample-icon .i-block:nth-child(13) i {
    color: #6f42c1;
}

.sample-icon .i-block:nth-child(14) {
    border-color: #e83e8c;
    background: rgba(232, 62, 140, 0.1);
}

.sample-icon .i-block:nth-child(14) i {
    color: #e83e8c;
}

.sample-icon .i-block:nth-child(15) {
    border-color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.sample-icon .i-block:nth-child(15) i {
    color: #e74c3c;
}

.sample-icon .i-block:nth-child(16) {
    border-color: #fd7e14;
    background: rgba(253, 126, 20, 0.1);
}

.sample-icon .i-block:nth-child(16) i {
    color: #fd7e14;
}

.sample-icon .i-block:nth-child(17) {
    border-color: #f1c40f;
    background: rgba(241, 196, 15, 0.1);
}

.sample-icon .i-block:nth-child(17) i {
    color: #f1c40f;
}

.sample-icon .i-block:nth-child(18) {
    border-color: #2ecc71;
    background: rgba(46, 204, 113, 0.1);
}

.sample-icon .i-block:nth-child(18) i {
    color: #2ecc71;
}

.sample-icon .i-block:nth-child(19) {
    border-color: #20c997;
    background: rgba(32, 201, 151, 0.1);
}

.sample-icon .i-block:nth-child(19) i {
    color: #20c997;
}

.sample-icon .i-block:nth-child(20) {
    border-color: #00acc1;
    background: rgba(0, 172, 193, 0.1);
}

.sample-icon .i-block:nth-child(20) i {
    color: #00acc1;
}

.sample-icon .i-block:nth-child(21) {
    border-color: #1abc9c;
    background: rgba(26, 188, 156, 0.1);
}

.sample-icon .i-block:nth-child(21) i {
    color: #1abc9c;
}

.sample-icon .i-block:nth-child(22) {
    border-color: #6610f2;
    background: rgba(102, 16, 242, 0.1);
}

.sample-icon .i-block:nth-child(22) i {
    color: #6610f2;
}

.sample-icon .i-block:nth-child(23) {
    border-color: #6f42c1;
    background: rgba(111, 66, 193, 0.1);
}

.sample-icon .i-block:nth-child(23) i {
    color: #6f42c1;
}

.sample-icon .i-block:nth-child(24) {
    border-color: #e83e8c;
    background: rgba(232, 62, 140, 0.1);
}

.sample-icon .i-block:nth-child(24) i {
    color: #e83e8c;
}

.sample-icon .i-block:nth-child(25) {
    border-color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.sample-icon .i-block:nth-child(25) i {
    color: #e74c3c;
}

.sample-icon .i-block:nth-child(26) {
    border-color: #fd7e14;
    background: rgba(253, 126, 20, 0.1);
}

.sample-icon .i-block:nth-child(26) i {
    color: #fd7e14;
}

.sample-icon .i-block:nth-child(27) {
    border-color: #f1c40f;
    background: rgba(241, 196, 15, 0.1);
}

.sample-icon .i-block:nth-child(27) i {
    color: #f1c40f;
}

.sample-icon .i-block:nth-child(28) {
    border-color: #2ecc71;
    background: rgba(46, 204, 113, 0.1);
}

.sample-icon .i-block:nth-child(28) i {
    color: #2ecc71;
}

.sample-icon .i-block:nth-child(29) {
    border-color: #20c997;
    background: rgba(32, 201, 151, 0.1);
}

.sample-icon .i-block:nth-child(29) i {
    color: #20c997;
}

.sample-icon .i-block:nth-child(30) {
    border-color: #00acc1;
    background: rgba(0, 172, 193, 0.1);
}

.sample-icon .i-block:nth-child(30) i {
    color: #00acc1;
}

.sample-icon .i-block:nth-child(31) {
    border-color: #1abc9c;
    background: rgba(26, 188, 156, 0.1);
}

.sample-icon .i-block:nth-child(31) i {
    color: #1abc9c;
}

.sample-icon .i-block:nth-child(32) {
    border-color: #6610f2;
    background: rgba(102, 16, 242, 0.1);
}

.sample-icon .i-block:nth-child(32) i {
    color: #6610f2;
}

.sample-icon .i-block:nth-child(33) {
    border-color: #6f42c1;
    background: rgba(111, 66, 193, 0.1);
}

.sample-icon .i-block:nth-child(33) i {
    color: #6f42c1;
}

.sample-icon .i-block:nth-child(34) {
    border-color: #e83e8c;
    background: rgba(232, 62, 140, 0.1);
}

.sample-icon .i-block:nth-child(34) i {
    color: #e83e8c;
}

.sample-icon .i-block:nth-child(35) {
    border-color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.sample-icon .i-block:nth-child(35) i {
    color: #e74c3c;
}

.sample-icon .i-block:nth-child(36) {
    border-color: #fd7e14;
    background: rgba(253, 126, 20, 0.1);
}

.sample-icon .i-block:nth-child(36) i {
    color: #fd7e14;
}

.sample-icon .i-block:nth-child(37) {
    border-color: #f1c40f;
    background: rgba(241, 196, 15, 0.1);
}

.sample-icon .i-block:nth-child(37) i {
    color: #f1c40f;
}

.sample-icon .i-block:nth-child(38) {
    border-color: #2ecc71;
    background: rgba(46, 204, 113, 0.1);
}

.sample-icon .i-block:nth-child(38) i {
    color: #2ecc71;
}

.sample-icon .i-block:nth-child(39) {
    border-color: #20c997;
    background: rgba(32, 201, 151, 0.1);
}

.sample-icon .i-block:nth-child(39) i {
    color: #20c997;
}

.sample-icon .i-block:nth-child(40) {
    border-color: #00acc1;
    background: rgba(0, 172, 193, 0.1);
}

.sample-icon .i-block:nth-child(40) i {
    color: #00acc1;
}

/**====== Icon layouts css end ======**/
/**  =====================
      user card css start
==========================  **/
.user-card .cover-img-block {
    position: relative;
}

.user-card .cover-img-block .change-cover {
    position: absolute;
    top: 30px;
    left: 30px;
    z-index: 5;
    opacity: 0;
    transition: all 0.3s ease-in-out;
}

.user-card .cover-img-block .change-cover .dropdown-toggle {
    color: #fff;
    background: rgba(0, 0, 0, 0.6);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-card .cover-img-block .change-cover .dropdown-toggle:after {
    display: none;
}

.user-card .cover-img-block .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 1;
    background: rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease-in-out;
}

.user-card .cover-img-block:hover .change-cover,
  .user-card .cover-img-block:hover .overlay {
    opacity: 1;
}

.user-card .user-about-block {
    margin-top: -30px;
}

.user-card .user-about-block img {
    box-shadow: 0 0 0 5px #fff;
}

.user-card .user-about-block .certificated-badge {
    position: absolute;
    bottom: -5px;
    right: -5px;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    background: #fff;
    padding: 5px 3px;
}

.user-card .user-about-block .certificated-badge .bg-icon {
    font-size: 22px;
}

.user-card .user-about-block .certificated-badge .front-icon {
    font-size: 11px;
    position: absolute;
    top: 11px;
    left: 9px;
}

.user-card .hover-data {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(36, 46, 62, 0.92);
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    transform: scale(0);
    transition: all 0.3s ease-in-out;
}

.user-card:hover .hover-data {
    transform: scale(1);
}

.user-card .change-profile .dropdown-toggle::after {
    display: none;
}

.user-card .change-profile .profile-dp {
    position: relative;
    overflow: hidden;
    padding: 5px;
    width: 110px;
    height: 110px;
    border-radius: 50%;
}

.user-card .change-profile .profile-dp .overlay {
    position: absolute;
    top: 5px;
    left: 5px;
    width: calc(100% - 10px);
    height: calc(100% - 10px);
    border-radius: 50%;
    opacity: 0;
    z-index: 1;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease-in-out;
}

.user-card .change-profile .profile-dp .overlay span {
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    position: absolute;
    bottom: 0;
    width: 100%;
    text-align: center;
    border-top: 1px solid rgba(255, 255, 255, 0.4);
    padding: 0 0 5px;
}

.user-card .change-profile .profile-dp:hover .overlay {
    opacity: 1;
}

@media only screen and (max-width: 992px) {
    .user-card .user-about-block {
        margin-top: -10px;
    }

    .user-card .wid-80 {
        width: 60px;
    }

    .user-card .change-profile .profile-dp {
        width: 90px;
        height: 90px;
    }

    .user-card.user-card-2.shape-right .cover-img-block {
        -webkit-clip-path: none;
        clip-path: none;
    }

    .user-card .cover-img-block .change-cover .dropdown-toggle {
        padding: 5px 7px;
    }
}

.user-card-2 .cover-img-block {
    -webkit-clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 80%);
    clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 80%);
}

.user-card-2.shape-right .cover-img-block {
    -webkit-clip-path: polygon(0 0, 100% 0%, 100% 80%, 0% 100%);
    clip-path: polygon(0 0, 100% 0%, 100% 80%, 0% 100%);
}

.user-card-2.shape-center .cover-img-block {
    -webkit-clip-path: polygon(0 0, 100% 0%, 100% 80%, 50% 100%, 0% 80%);
    clip-path: polygon(0 0, 100% 0%, 100% 80%, 50% 100%, 0% 80%);
}

.user-card-3 .certificated-badge {
    position: absolute;
    bottom: 5px;
    right: 5px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    background: #fff;
    padding: 5px 3px;
}

.user-card-3 .certificated-badge .bg-icon {
    font-size: 30px;
}

.user-card-3 .certificated-badge .front-icon {
    font-size: 14px;
    position: absolute;
    top: 14px;
    left: 13px;
}

.user-card-3 .social-top-link {
    position: absolute;
    top: 20px;
    left: 20px;
}

.user-card-3.social-hover .social-top-link {
    top: 20px;
    left: 20px;
    overflow: hidden;
}

.user-card-3.social-hover .social-top-link .btn,
  .user-card-3.social-hover .social-top-link li {
    margin-left: -100px;
    transition: all 0.2s ease-in-out;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(1),
    .user-card-3.social-hover .social-top-link li:nth-child(1) {
    transition-delay: 0.05s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(2),
    .user-card-3.social-hover .social-top-link li:nth-child(2) {
    transition-delay: 0.1s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(3),
    .user-card-3.social-hover .social-top-link li:nth-child(3) {
    transition-delay: 0.15s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(4),
    .user-card-3.social-hover .social-top-link li:nth-child(4) {
    transition-delay: 0.2s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(5),
    .user-card-3.social-hover .social-top-link li:nth-child(5) {
    transition-delay: 0.25s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(6),
    .user-card-3.social-hover .social-top-link li:nth-child(6) {
    transition-delay: 0.3s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(7),
    .user-card-3.social-hover .social-top-link li:nth-child(7) {
    transition-delay: 0.35s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(8),
    .user-card-3.social-hover .social-top-link li:nth-child(8) {
    transition-delay: 0.4s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(9),
    .user-card-3.social-hover .social-top-link li:nth-child(9) {
    transition-delay: 0.45s;
}

.user-card-3.social-hover .social-top-link .btn:nth-child(10),
    .user-card-3.social-hover .social-top-link li:nth-child(10) {
    transition-delay: 0.5s;
}

.user-card-3.social-hover:hover .social-top-link .btn,
.user-card-3.social-hover:hover .social-top-link li {
    margin-left: 0;
}

.user-profile {
    margin-top: -25px;
    margin-left: -25px;
    margin-right: -25px;
    background: #fff;
}

.user-profile .card-body {
    position: relative;
    z-index: 1;
    box-shadow: 0 2px 4px -2px rgba(54, 80, 138, 0.3);
}

.user-profile .card-body .overlay > span {
    cursor: pointer;
}

.user-profile .cover-img-block:hover > img {
    -webkit-filter: grayscale(1) blur(1px);
    filter: grayscale(1) blur(1px);
}

.user-profile .profile-dp .overlay {
    text-align: left;
}

.user-profile .user-about-block .certificated-badge {
    bottom: 8px;
    right: 0;
    z-index: 2;
}

.user-profile .profile-tabs {
    border-bottom: 0;
    margin-top: 30px;
}

.user-profile .profile-tabs .nav-item {
    margin-bottom: -0px;
}

.user-profile .profile-tabs .nav-item .nav-link {
    position: relative;
}

.user-profile .profile-tabs .nav-item .nav-link:after {
    content: "";
    background: #1abc9c;
    position: absolute;
    transition: all 0.3s ease-in-out;
    left: 50%;
    right: 50%;
    bottom: -1px;
    height: 2px;
    border-radius: 2px 2px 0 0;
}

.user-profile .profile-tabs .nav-link:hover {
    border-color: transparent;
}

.user-profile .profile-tabs .nav-item.show .nav-link,
    .user-profile .profile-tabs .nav-link.active {
    border-color: transparent;
}

.user-profile .profile-tabs .nav-item.show .nav-link:after,
      .user-profile .profile-tabs .nav-link.active:after {
    left: 0;
    right: 0;
}

@media only screen and (max-width: 575px) {
    .user-profile {
        margin-top: -30px;
        margin-left: -15px;
        margin-right: -15px;
    }
}

.user-profile-list table {
    border-spacing: 0 10px;
    width: calc(100% - 10px);
    margin: 0 5px;
}

.user-profile-list table tbody tr {
    box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05);
    border-radius: 2px;
    position: relative;
}

.user-profile-list table tbody tr .overlay-edit {
    position: absolute;
    opacity: 0;
    top: 0;
    right: 0;
    background: #1abc9c;
    bottom: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-profile-list table tbody tr .overlay-edit .btn {
    border-radius: 50%;
    margin: 0 3px;
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.user-profile-list table tbody tr:hover {
    box-shadow: 0 0 6px 0 #1abc9c;
}

.user-profile-list table tbody tr:hover td {
    cursor: pointer;
    color: #fff;
    background: #1abc9c;
}

.user-profile-list table tbody tr:hover td h6 {
    color: #fff;
}

.user-profile-list table tbody tr:hover td .overlay-edit {
    opacity: 1;
}

.user-profile-list table tr td,
  .user-profile-list table tr th {
    vertical-align: middle;
    border: none;
}

.user-profile-list table tr td {
    background: #fff;
    position: relative;
}

.user-profile-list table tr td:first-child {
    border-top-left-radius: 2px;
    border-bottom-left-radius: 2px;
}

.user-profile-list table tr td:last-child {
    border-top-right-radius: 2px;
    border-bottom-right-radius: 2px;
}
</style>