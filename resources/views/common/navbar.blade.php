<header ng-controller="HeaderController" class="container">
    <nav class="navbar navbar-expand-md fixed-top border-bottom-1 shadow bg-white-transparent">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-th-list"></i>
            </button>
            <!--        <a class="navbar-brand" href="#">Fixed navbar</a> -->
            <img alt="Homely" src="resources/img/homely-logo.png" class="navbar-brand homely-logo" ng-click="navigate('/')" />

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                </ul>
                <!--            <ul class="navbar-nav mr-auto"> -->
                <!--                <li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li> -->
                <!--                <li class="nav-item"><a class="nav-link" href="#">Link</a></li> -->
                <!--                <li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a></li> -->
                <!--            </ul> -->
                <!--            <form class="form-inline mt-2 mt-md-0"> -->
                <!--                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
                <!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                <!--            </form> -->
                <ul class="navbar-nav">
                    <li class="nav-item" ng-if="getCurrentUser().guest">
                        <button class="homely-btn homely-btn-primary" ng-click="navigate('/listing')"  >
                            listing.create.free | translate
                        </button>
                    </li>
                    
                    <li class="nav-item" ng-if="getCurrentUser().guest">
                        <button class="btn btn-link homely-color-1" ng-click="navigate('/register')">
                            header.sign.up | translate
                        </button>
                    </li>
                    <li class="nav-item" ng-if="getCurrentUser().guest">
                        <span class="nav-link homely-color-1">|</span>
                    </li>
                    <li class="nav-item" ng-if="getCurrentUser().guest">
                        <button class="btn btn-link homely-color-1" ng-click="navigate('/login')">
                            header.log.in | translate
                        </button>
                    </li>
                    
                    <li class="nav-item" ng-if="!getCurrentUser().guest">
                        <div uib-dropdown>
                            <button class="btn btn-link" uib-dropdown-toggle >
                                <i> getCurrentUser().displayName</i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" uib-dropdown-menu>
                                <button class="dropdown-item" type="button" ng-click="navigate('/profile')">
                                    <i class="menu-icon fas fa-user-tie"></i> header.menu.profile | translate
                                </button>
                                
                                <button class="dropdown-item" type="button" ng-click="navigate('/listings')" ng-if="hasRole('ROLE_LANDLORD')">
                                    <i class="menu-icon fas fa-building"></i> header.menu.listings | translate
                                </button>

                                <button class="dropdown-item" type="button" ng-click="navigate('/payment-methods/' + currentUser.guid)" ng-if="hasRole('ROLE_LANDLORD')">
                                    <i class="menu-icon far fa-credit-card"></i> header.menu.payment.methods | translate
                                </button>

                                <button class="dropdown-item" type="button" ng-click="navigate('/messages')" ng-if="hasRole('ROLE_LANDLORD')">
                                    <i class="menu-icon far fa-comment-dots"></i> header.menu.messages | translate
                                </button>

                                <button class="dropdown-item" type="button" ng-click="navigate('/bookings')" ng-if="hasRole('ROLE_LANDLORD')">
                                    <i class="menu-icon far fa-handshake"></i> header.menu.bookings | translate
                                </button>

                                <button class="dropdown-item" type="button" ng-click="navigate('/tenant/bookings')" ng-if="hasRole('ROLE_TENANT')">
                                    <i class="menu-icon far fa-handshake"></i> header.menu.bookings' | translate
                                </button>

                                <div class="dropdown-divider"></div>
                                
                                <button class="dropdown-item" type="button" ng-click="logout();">
                                    <i class="menu-icon fas fa-sign-out-alt"></i> header.log.out
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">

                        <div uib-dropdown>
                            <button id="single-button" type="button" class="btn btn-link" uib-dropdown-toggle>
                                getCurrentLanguage() <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" uib-dropdown-menu>
                                <button class="dropdown-item" type="button" ng-click="setLanguage('da')">
                                    header.select.language.da
                                </button>
                                <button class="dropdown-item" type="button" ng-click="setLanguage('en')">
                                    header.select.language.en
                                </button>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="spacer-5"></div>
    <div class="spacer-5"></div>
</header>