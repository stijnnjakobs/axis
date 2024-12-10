<x-app-layout clients title="{{ __('Home') }}">
    <script>
        function removeElement(element) {
            element.remove();
            this.error = true;
        }
    </script>

    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between-md g-3">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><span>Welcome,</span></div>
                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                <div>
                                    <h2 class="nk-block-title fw-normal">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                                </div>
                                <div><a href="{{ route('services.index') }}" class="btn btn-white btn-light">My Services <em class="icon ni ni-arrow-long-right ms-2"></em></a></div>
                            </div>
                            <div class="nk-block-des">
                                <p>At a glance summary of your workspace account. Have fun!</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content d-none d-md-block">
                            <div class="nk-slider nk-slider-s1">
                                <div class="slider-init" data-slick='{"dots": true, "arrows": false, "fade": true}'>
                                    <div class="slider-item">
                                        <div class="nk-iv-wg1">
                                            <div class="nk-iv-wg1-sub sub-text">My Active Plans</div>
                                            <h6 class="nk-iv-wg1-info title">VM-FRA1-3</h6>
                                            <a href="#" class="nk-iv-wg1-link link link-light"><em class="icon ni ni-trend-up"></em> <span>Check Details</span></a>
                                            <div class="nk-iv-wg1-progress">
                                                <div class="progress-bar bg-primary" data-progress="80"></div>
                                            </div>
                                        </div>
                                    </div><!-- .slider-item -->
                                    <div class="slider-item">
                                        <div class="nk-iv-wg1">
                                            <div class="nk-iv-wg1-sub sub-text">My Active Plans</div>
                                            <h6 class="nk-iv-wg1-info title">VM-FRA1-4</h6>
                                            <a href="#" class="nk-iv-wg1-link link link-light"><em class="icon ni ni-trend-up"></em> <span>Check Details</span></a>
                                            <div class="nk-iv-wg1-progress">
                                                <div class="progress-bar bg-primary" data-progress="80"></div>
                                            </div>
                                        </div>
                                    </div><!-- .slider-item -->
                                    <div class="slider-item">
                                        <div class="nk-iv-wg1">
                                            <div class="nk-iv-wg1-sub sub-text">My Active Plans</div>
                                            <h6 class="nk-iv-wg1-info title">VM-FRA1-6</h6>
                                            <a href="#" class="nk-iv-wg1-link link link-light"><em class="icon ni ni-trend-up"></em> <span>Check Details</span></a>
                                            <div class="nk-iv-wg1-progress">
                                                <div class="progress-bar bg-primary" data-progress="80"></div>
                                            </div>
                                        </div>
                                    </div><!-- .slider-item -->
                                </div>
                                <div class="slider-dots"></div>
                            </div><!-- .nk-slider -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                @if ($announcements->count() > 0)
                @php
                $latestAnnouncement = $announcements->sortByDesc('created_at')->first();
                @endphp
                <div class="nk-block">
                    <div class="nk-news card card-bordered">
                        <div class="card-inner">
                            <div class="nk-news-list">
                                <a class="nk-news-item" href="https://conxect.numblio.com/discord">
                                    <div class="nk-news-icon">
                                        <em class="icon ni ni-card-view"></em>
                                    </div>
                                    <div class="nk-news-text">
                                        <p><b>{{ $latestAnnouncement->title }}</b><span> {{$latestAnnouncement->announcement}}</span></p>
                                        <em class="icon ni ni-external"></em>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .nk-block -->
                @endif
                <div class="nk-block">
                    <div class="row gy-gs">
                        <div class="col-md-6 col-lg-4">
                            <div class="nk-wg-card is-dark card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-iv-wg2">
                                        <div class="nk-iv-wg2-title">
                                            <h6 class="title">Available Credits <em class="icon ni ni-info"></em></h6>
                                        </div>
                                        <div class="nk-iv-wg2-text">
                                            <div class="nk-iv-wg2-amount"><x-money :amount="Auth::user()->credits" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-lg-4">
                            <div class="nk-wg-card is-s1 card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-iv-wg2">
                                        <div class="nk-iv-wg2-title">
                                            <h6 class="title">Active Services <em class="icon ni ni-info"></em></h6>
                                        </div>
                                        <div class="nk-iv-wg2-text">
                                            <div class="nk-iv-wg2-amount"> {{ $activeProductsCount }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-12 col-lg-4">
                            <div class="nk-wg-card is-s3 card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-iv-wg2">
                                        <div class="nk-iv-wg2-title">
                                            <h6 class="title">Active Domains <em class="icon ni ni-info"></em></h6>
                                        </div>
                                        <div class="nk-iv-wg2-text">
                                            <div class="nk-iv-wg2-amount"> 5
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="nk-refwg">
                            <div class="nk-refwg-invite card-inner">
                                <div class="nk-refwg-head g-3">
                                    <div class="nk-refwg-title">
                                        <h5 class="title">Refer Us & Earn</h5>
                                        <div class="title-sub">Use the bellow link to invite your friends.</div>
                                    </div>
                                    <div class="nk-refwg-action">
                                        <a href="#" class="btn btn-primary">Invite</a>
                                    </div>
                                </div>
                                <div class="nk-refwg-url">
                                    <div class="form-control-wrap">
                                        <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div>
                                        <div class="form-icon">
                                            <em class="icon ni ni-link-alt"></em>
                                        </div>
                                        <input type="text" class="form-control copy-text" id="refUrl" value="https://axis.numblio.com/?ref=4945KD48">
                                    </div>
                                </div>
                            </div>
                            <div class="nk-refwg-stats card-inner bg-lighter">
                                <div class="nk-refwg-group g-3">
                                    <div class="nk-refwg-name">
                                        <h6 class="title">My Referral <em class="icon ni ni-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Referral Informations"></em></h6>
                                    </div>
                                    <div class="nk-refwg-info g-3">
                                        <div class="nk-refwg-sub">
                                            <div class="title">394</div>
                                            <div class="sub-text">Total Joined</div>
                                        </div>
                                        <div class="nk-refwg-sub">
                                            <div class="title">548.49</div>
                                            <div class="sub-text">Referral Earn</div>
                                        </div>
                                    </div>
                                    <div class="nk-refwg-more dropdown mt-n1 me-n1">
                                        <a href="#" class="btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                            <ul class="link-list-plain sm">
                                                <li><a href="#">7 days</a></li>
                                                <li><a href="#">15 Days</a></li>
                                                <li><a href="#">30 Days</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-refwg-ck">
                                    <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>


</x-app-layout>
