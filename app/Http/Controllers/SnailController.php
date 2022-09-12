<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SnailLog;

class SnailController extends Controller
{
    /**
     * Gets all the attempts performed by the snail. That is, all of the calls made to the service to check 
     * if the snail would make it out of the well with the corresponding parameters. 
     * 
     * @return \Illuminate\View\View records of attempts to climb out of the well 
     *         and their results performed by the snail
     * 
     */
    public function index() {
        $snailAttemtps = SnailLog::get()->toJson(JSON_PRETTY_PRINT);
        return response($snailAttemtps, 200);
    }

    /**
     * Perform the database insert. 
     * 
     * @param  int  $h height of the well in feet
     * @param  int  $u distance in feet that the snail can climb during the day
     * @param  int  $d distance in feet that the snail slides down during the night
     * @param  int  $f fatigue factor expressed as a percentage
     * 
     * @return void 
     * 
     */
    protected function store($h, $u, $d, $f, $resultString) {
        SnailLog::create([
            'DATE' => Carbon::now(),
            'H' => $h,
            'U' => $u,
            'D' => $d,
            'F' => $f,
            'result' => $resultString,
        ]);
    }

    /**
     * Solves the snail problem with the given parameters by determining if the snail eventually makes it
     * out of the well (success) or slides down back to the bottom (failure). It stores the result, along 
     * with its corresponding values, into the database. 
     * 
     * @param Request sent by the user containing parameters for the problem
     * 
     * @return \Illuminate\View\View 
     * 
     */
    public function snailCheck(Request $request) {
        $request->validate([
            'h' => 'required',
            'u' => 'required',
            'd' => 'required',
            'f' => 'required',
        ]);

        // Problem parameters
        $h = $request->h;
        $u = $request->u;
        $d = $request->d;
        $f = $request->f;
        $fatigueFactor = $u * ($f / 100);

        // Variables to determine solution
        $snailHeight = 0;
        $uWithFatigue = $u;
        $dayCounter = 0;
        $resultString = '';
        $successFlag = false; 

        // Snail keeps trying until it escapes the well or fails by sliding all the way back
        while ($snailHeight >= 0 && $snailHeight <= $h) {
            // Progress during the day
            $snailHeight += $uWithFatigue;
            // Break loop if snail managed to escape 
            if ($snailHeight <= $h) {       
                // Account for distance that snail slides during the night
                $snailHeight -= $d;
            }
            // Keep track of fatigue and number of days 
            $uWithFatigue -= $fatigueFactor;
            $dayCounter++;
        }

        // Set the result achieved by the snail
        if ($snailHeight < 0) {
            $resultString = 'failure on day '. $dayCounter;
        } else {
            $successFlag = true;
            $resultString = 'success on day '. $dayCounter;
        }
        
        // Save to db
        $this->store($h, $u, $d, $f, $resultString);

        // Provide response
        $data = [
            'snailSuccess' => $successFlag,
            'resultString' => $resultString,
        ];
        return response($data, 200);
    }
}
