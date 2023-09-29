<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use PDF;
use Illuminate\Http\Request;

class PdfDownloadController extends Controller
{
    // Generate PDF
    public function downloadMovieDetailsPdf($movie_id)
    {
        // retreive all records from db
        $data = Movie::find($movie_id)->toArray();
        // share data to view
        view()->share('movie', $data);
        // PDF::setOption(['defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('movie_details_pdf', $data);
        // download PDF file with download method
        return $pdf->download('movie-details.pdf');
    }
}
