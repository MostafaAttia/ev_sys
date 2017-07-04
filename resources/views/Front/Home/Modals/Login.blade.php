<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>

                    <div class="header header-primary text-center">
                        <h4 class="card-title">Log in</h4>
                        <div class="social-line">
                            <a href="{{ url('/login/facebook') }}" class="btn btn-just-icon btn-simple">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="{{ url('login/twitter') }}" class="btn btn-just-icon btn-simple">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="{{ url('login/google') }}" class="btn btn-just-icon btn-simple">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form" method="POST" action="{{ url('/home/login') }}">
                        {{ csrf_field() }}

                        <p class="description text-center">Or Be Classical</p>
                        <div class="card-content">

                            <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">email</i>
								</span>
                                <div class="form-group is-empty"><input type="email" name="email" class="form-control" placeholder="Email..."><span class="material-input"></span></div>
                            </div>

                            <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
                                <div class="form-group is-empty"><input type="password" name="password" placeholder="Password..." class="form-control"><span class="material-input"></span></div>
                            </div>

                            <!-- If you want to add a checkbox to this form, uncomment this code

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="optionsCheckboxes" checked>
                                    Subscribe to newsletter
                                </label>
                            </div> -->
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary btn-simple btn-wd btn-lg">Get Started</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>