<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Contribution::orderBy('id','desc')->join('users','u_id','=','users.id')->select('users.name','contributions.*')->get();
    }

    public function create()
    {
        $cont=Contribution::create([
            'u_id'=>request()->u_id,
            'amount'=>request()->amount,
            'description'=>request()->description,
            'status'=>request()->status
        ]);
        $user=User::findOrFail(request()->u_id);
        $data = [
            'name' => $user->name,
            'account' => request()->description,
            'serial' => 'WSM/'.time().'/'.($cont->id),
            'sum' => request()->amount,
        ];
        
        $pdf = Pdf::loadView('mail.receipt', $data);
        $pdf->setPaper('A5', 'landscape');
        Mail::send(
            'mail.message',
            $data,
            function ($message) use ($pdf, $user) {
                $message->to($user->email, $user->name)->subject('Receipt for ' . date('d/m/Y'))
                    ->attachData($pdf->output(), date('d/m/Y') . "_receipt.pdf");
            }
        );
        return response()->json(['message'=>($user->name).' Contribution record success']);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Contribution::where('u_id',$id)->orderBy('id','desc')->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contribution $contribution)
    {
        //
    }

    public function update(Request $request, Contribution $contribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribution $contribution)
    {
        //
    }
}
