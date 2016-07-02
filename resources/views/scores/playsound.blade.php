<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

 
    </head>
    <body>
       <script>
           {{$text}}
           
    </script>
    {!! Form::open(array('action' => 'Scores@store')) !!}
    
    <input type="text" name="score" autofocus>
    <input type='hidden' name='freqs' value='{{$freqs}}'>
    <input type='hidden' name='amps' value='{{$amps}}'>
    <input type="submit">
{!! Form::close() !!}
    </body>
</html>