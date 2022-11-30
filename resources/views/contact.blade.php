@extends('main_layouts.master')

@section('title', 'Blog | İletişim ')

@section('content')

    <div class="colorlib-contact">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12 animate-box">
                    <h2>Contact Information</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> 198 West 21th Street, <br> Suite 721 New
                                        York NY 10016</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355
                                            98</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-paperplane"></i></span> <a
                                            href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Mesajınız</h2>
                </div>

                <x-blog.message :status="'success'" />

                <div class="col-md-6">
                    <form onsubmit="return false;" autocomplete="off" method="POST">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6">
                                <x-blog.form.input name="first_name" placeholder="İsim" value="{{ old('first_name') }}" />
                                <small class="error text-danger first_name"></small>
                            </div>
                            <div class="col-md-6">
                                <x-blog.form.input name="last_name" placeholder="Soyİsim"
                                    value="{{ old('last_name') }}" />
                                <small class="error text-danger last_name"></small>


                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input type='email' name="email" placeholder="Email"
                                    value="{{ old('email') }}" />
                                <small class="error text-danger email"></small>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input name="subject" required="false" placeholder="Konu"
                                    value="{{ old('subject') }}" />
                                <small class="error text-danger subject"></small>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <!-- <label for="message">Message</label> -->
                                <x-blog.form.textarea name="message" value="{{ old('message') }}"
                                    placeholder="Mesajınız..." />
                                <small class="error text-danger message"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Gönder" class="btn btn-primary send-message-btn">
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div id="map" class="colorlib-map"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')

    <script>
        $(document).on('click', '.send-message-btn', (e) => {
            e.preventDefault();
            let $this = e.target;
            let csrf_token = $($this).parents("form").find("input[name='_token']").val()
            let first_name = $($this).parents("form").find("input[name='first_name']").val()
            let last_name = $($this).parents("form").find("input[name='last_name']").val()
            let email = $($this).parents("form").find("input[name='email']").val()
            let subject = $($this).parents("form").find("input[name='subject']").val()
            let message = $($this).parents("form").find("textarea[name='message']").val()
            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('email', email);
            formData.append('subject', subject);
            formData.append('message', message);
            console.log(csrf_token)
            $.ajax({
                url: '{{ route('contact.store') }}',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                }
            })
        })
    </script>

@endsection