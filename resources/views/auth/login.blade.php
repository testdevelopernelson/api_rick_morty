@extends('layouts.master')

@section('content')

<section id="slider">

        <div class="row">

            <div class="contImg">

                <img src="{{ asset('img/Ingresar.jpg') }}" alt="" class="img-fluid">

            </div>

            <div class="circle">

                <img src="{{ asset('img/circle.png') }}" alt="">

            </div> 

        </div>

    </section>



    <section id="ingresar">

        <div class="cont7">

            <div class="formCont">

                <div class="cont9">

                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                           <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                <div class="row">

                                    <label> {{__('generals.email')}}</label>

                                    @if ($errors->has('email'))

                                    <span>

                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>

                                    </span>

                                    @endif

                                    <input type="email" name="email" placeholder="{{__('generals.data_here')}}">

                                </div>

                                <div class="row">

                            <div class="acepto">
                                <label><a href="{{ route('password.request') }}">{{__('generals.forgot_pass')}}</a></label>
                            </div>

                        </div>

                        <div class="row">

                            <div class="enviar">
                                <input type="submit" value="{{__('generals.log_in')}}">

                            </div>

                        </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                <div class="row">

                                    <label> {{__('generals.password')}}</label>

                                    @if ($errors->has('password'))

                                    <span>

                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>

                                    </span>

                                    @endif

                                    <input type="password" name="password" placeholder="{{__('generals.data_here')}}">

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

@endsection