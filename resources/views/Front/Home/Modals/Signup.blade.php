<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-signup">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                    <h2 class="modal-title card-title text-center" id="myModalLabel">Register</h2>
                </div>
                <div class="modal-body">

                    <div class="social text-center">
                        <a href="{{ url('/login/facebook') }}" class="btn btn-just-icon btn-round btn-facebook">
                            <i class="fa fa-facebook"> </i>
                        </a>
                        <a href="{{ url('/login/twitter') }}" class="btn btn-just-icon btn-round btn-twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="{{ url('/login/facebook') }}" class="btn btn-just-icon btn-round btn-google">
                            <i class="fa fa-google-plus"></i>
                        </a>
                        <h4> or be classical </h4>
                    </div>

                    <form name="signup" class="form" method="POST" action="{{ url('/home/signup') }}" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-6">
                                {{ csrf_field() }}
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <div class="form-group is-empty">
                                                    <input type="text" name="first_name" class="form-control" placeholder="First Name...">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="form-group is-empty">
                                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name...">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-group is-empty">
                                            <input type="email" name="email" class="form-control" placeholder="Email...">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group is-empty">
                                            <input type="password" name="password" placeholder="Password..." class="form-control">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-group is-empty">
                                            <input type="password" name="password_confirmation" placeholder="Confirm Password..." class="form-control">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-content">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">event</i>
                                        </span>
                                        <div class="form-group label-floating is-empty">
                                            <input type="text" name="dob" class="form-control dobpicker" placeholder="Date of Birth">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">place</i>
                                        </span>
                                        <div class="form-group is-empty">
                                            <input type="text" name="address" placeholder="Address..." class="form-control">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                        <div class="form-group is-empty">
                                            <input type="text" name="phone" class="form-control" placeholder="Phone...">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle img-raised">
                                                    <img src="{{URL::asset('front/img/placeholder.jpg')}}" style="width: 50px;">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
                                                <div>
                                                    <span class="btn btn-sm btn-raised btn-round btn-danger btn-file">
                                                        <span class="fileinput-new">Add Avatar</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="image" />
                                                    </span>
                                                    <a href="#pablo" class="btn btn-xs btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="form-group is-empty">
                                                    <select class="selectpicker" name="gender" data-style="btn btn btn-danger btn-round" title="Single Select" data-size="7">
                                                        <option disabled selected>gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            By Pressing 'Sign Up' button below, You Are agree to the <a href="/terms">terms and conditions</a>.
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-round" style="width: 100%">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
