                                <div class="col-lg-3 col-sm-6">
                    <div class="trending-post style-box" >
                        <div class="section-title">
                            <h6 class="title">Many Views</h6>
                        </div>
                        <div class="post-slider owl-carousel">
                            <div class="item">
                                @foreach($slidebar as $key => $slide)
                                <div class="single-post-list-wrap">
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{asset('storage/images/'.$slide->imagepost )}}" height="50" width="100" alt="img">
                                        </div>
                                        <div class="media-body">
                                            <div class="details">
                                                <div class="post-meta-single">
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i>{{$slide->created_at}}</li>
                                                    </ul>
                                                </div>
                                                <h6 class="title"><a href="{{route('page.post-detail',['slug'=>$slide->slug_post])}}">{{Str::words(strip_tags($slide->title),10)}}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                          
                        </div>
                    </div>