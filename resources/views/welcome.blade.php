<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

 
    </head>
    <body>
     <h1>Welcome!</h1>
     <p>
         The Rundquist research group is trying teach a computer
         what melodic sounds are. We'd love your help. If you hit the link below
         You'll here a 1 second long sound and we'd like you to rate it 0-5 where 0
         sounds like just random noise and 5 sounds like a beautiful tone.
         </p>
         
         <h2>{{link_to_action('Scores@create', "Click here to go to the sounds")}}</h2>
    </body>
</html>