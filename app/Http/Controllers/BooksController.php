<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use DataTables;

class BooksController extends Controller
{

    /**
     * INSTRUCTIONS
     * 
     * - Clone this repository into a new one
     * - Create the Books Model with Migrations, Factory and Seeder
     * - Table books columns: id,title,category,author,realease_date,publish_date
     * - php artisan db:seed should populate the User and Books tables
     * - The index page should show a datatable using ajax loading using JQUERY
     * - The datatable should get the info from BooksController@api
     * - The dates should be shown in the format d/M/y
     * - Extra points for bootstrap 4 styling
     * - Push your changes into your new repository in Github
     * - Share your github URL
     * 
     */


    /**
     * Show index page
     */
    public function index()
    {
        return view('books.index');
    }

    /**
     * Return user books via AJAX API REQUEST [json]
     */
    public function api(Request $request)
    {
        $books = Books::select([
                    'books.id',
                    'books.title',
                    'books.category',
                    'books.author',
                    'books.release_date',
                    'books.publish_date',
        ]);
        return Datatables::of($books)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('title') && !empty($request->title)) {
                                $query->where('books.title', 'like', "%{$request->get('title')}%")->first('id');
                            }
                            if ($request->has('category') && !empty($request->category)) {
                                $query->where('books.category', 'like', "%{$request->get('category')}%")->first('id');
                            }
                            if ($request->has('author') && !empty($request->author)) {
                                $query->where('books.author', 'like', "%{$request->get('author')}%")->first('id');
                            }
                        })
                        ->addColumn('release_date1', function ($books) {
                            return date('d/M/y', strtotime($books->release_date));
                        })
                        ->addColumn('publish_date1', function ($books) {
                            return date('d/M/y', strtotime($books->release_date));
                        })
                        ->setRowId(function($books) {
                            return 'companyDtRow' . $books->id;
                        })
                        ->toJson();
    }
}
