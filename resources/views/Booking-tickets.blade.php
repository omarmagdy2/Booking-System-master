<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>

    <div class="background">

        <div class="container">

            <h1 class="flex-center">Book Ticket</h1>

            @if(Session()->has('booked_successfully')) <p class="flex-center btn btn-success"> {{session('booked_successfully')}}</p> @endif
            @if(Session()->has('student_ticket')) <p class="flex-center btn btn-danger"> {{session('student_ticket')}}</p> @endif
            @if(Session()->has('normal_ticket')) <p class="flex-center btn btn-danger"> {{session('normal_ticket')}}</p> @endif

            {!! Form::open(['method' => 'POST', 'action' => 'TicketsController@store']) !!}

                <div class = "form-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    @if($errors->has('name')) <span class="error">{{$errors->first('name') }}</span> @endif
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class = "form-group">
                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                    @if($errors->has('email')) <span class="error">{{$errors->first('email') }}</span> @endif
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class = "form-group">
                    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
                    @if($errors->has('phone')) <span class="error">{{$errors->first('phone') }}</span> @endif
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>

                <div class = "form-group">

                    <label class= 'label-control'>Ticket @if($errors->has('ticket_type')) <span class="error">{{$errors->first('ticket_type') }}</span> @endif</label>

                    <label class="control-label label-mar">
                        Student Ticket <br>
                        {!! Form::radio('ticket_type', 'student', null,  ['id' => 'Student Ticket', 'class' =>'flex-center']) !!}
                        200 EGP
                    </label>

                    <label class="control-label label-mar">
                        Normal Ticket <br>
                        {!! Form::radio('ticket_type', 'normal', null,  ['id' => 'Normal Ticket', 'class' =>'flex-center']) !!}
                        400 EGP
                    </label>
                </div>

                <div class = "flex-center">
                    {!! Form::submit('Book Ticket',['class' => "btn btn-success"]) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/libs.js')}}"></script>
</body>
</html>
