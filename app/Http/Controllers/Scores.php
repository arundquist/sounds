<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Scores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      //  return view('scores/welcome');
      return "hi there";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $n=5;
        $freqs=[];
        $amps=[];
        for ($i=1; $i<=$n; $i++) {
            $freqs[]=mt_rand(100,1000);
            $amps[]=mt_rand(200,1000)/1000;
        };
        
        
        $text='context = new AudioContext;';
        foreach ($freqs as $key => $value) {
            # code...
            $text.="oscillator$key = context.createOscillator();
            gainNode$key = context.createGain();
            oscillator$key.frequency.value = $value;
            //oscillator$key.connect(context.destination);
            
            currentTime = context.currentTime;
            oscillator$key.connect(gainNode$key); // Connect sound source 2 to gain node 2
            gainNode$key.connect(context.destination); // Connect gain node 2 to output
            gainNode$key.gain.value = $amps[$key];
            oscillator$key.start(currentTime);
            oscillator$key.stop(currentTime + 1);

";
        };
        $freqstring="{";
        $freqstring.=implode($freqs, ", ");
        $freqstring.="}";
        $ampstring="{";
        $ampstring.=implode($amps, ", ");
        $ampstring.="}";
        
        return view('scores/playsound',
        ['text'=>$text,
        'freqs'=>$freqstring,
        'amps'=>$ampstring]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = $request->input('score');
        $freqs = $request->input('freqs');
        $amps = $request->input('amps');
        $score=new \App\Score;
        $score->frequencies=$freqs;
        $score->amplitudes=$amps;
        $score->score=$s;
        $score->save();
        return redirect()->action('Scores@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function mathematica()
    {
        $all=\App\Score::all();
        $textlist=[];
        foreach ($all AS $value) {
            $text="{";
            $text.=$value->frequencies;
            $text.=", ";
            $text.=$value->amplitudes;
            $text.="}->";
            $text.=$value->score;
            $textlist[]=$text;
        };
        $full="{";
        $full.=implode($textlist,", ");
        $full.="}";
        return $full;
    }
}
