<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use PDF;

class PdfController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function post(Post $post)
    {
/*$pdf->setOption('enable-javascript', true);
$pdf->setOption('javascript-delay', 13500);
$pdf->setOption('enable-smart-shrinking', true);
$pdf->setOption('no-stop-slow-scripts', true);*/

        /*$pdf = PDF::loadView('pdf.post', ['post' => $post]);
        return $pdf->download('Beitrag.pdf');*/
        return view('pdf.post', compact('post'));
    }
}
