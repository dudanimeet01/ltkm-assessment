<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Display a home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $txt_files_list = getFileList();
        return view('home', [
            'txt_files_list' => $txt_files_list,
        ]);
    }

    /**
     * Get the calculation of selected file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON
     */
    public function get_the_count(Request $request)
    {
        $txt_files_list = getFileList();
        $rules = [
            'rules' => [
                'filename' => 'required|in:' . implode(',', $txt_files_list),
            ],
            'messages' => [
                'filename' => 'Please select valid file.',
            ],

        ];
        $validator = Validator::make($request->all(), $rules['rules'], $rules['messages']);
        if ($validator->fails()) {
            return response()->json(["status" => 422, "msg" => $validator->errors()->first(), "result" => array()]);
        }

        // Call recursive function to get the content of file and subfiles
        $files_content = readFileContent($request->filename);

        // Get the sum of all files and subfiles
        $sum_of_files = calculateSum($files_content);

        return response()->json(["status" => 200, "msg" => "Count fetched successfully.", "data" => $sum_of_files]);
    }

    public function all_file_list()
    {
        $txt_files_list = getFileList();
        return view('all_file_list', [
            'txt_files_list' => $txt_files_list,
        ]);
    }

    public function upload_file()
    {
        return view('upload_file');
    }

    public function store_upload_file(Request $request)
    {
        $txt_files_list = getFileList();
        $rules = [
            'rules' => [
                'file' => 'required|file|mimes:txt',
            ],
            'messages' => [
                'file.*' => 'Please select txt valid file.',
            ],

        ];
        $validator = Validator::make($request->all(), $rules['rules'], $rules['messages']);
        if ($validator->fails()) {
            Session::flash('error_msg', $validator->errors()->first());
            return redirect()->back();
        }

        $file = $request->file('file');
        $file->move(public_path('assets/text_files/'),$file->getClientOriginalName());
        Session::flash('success_msg', 'File uploaded successfully.');
        return redirect()->route('all.file.list');
    }

    public function delete_file($id)
    {
        try {
            $decrypted_file_name = Crypt::decryptString($id);
            File::delete(public_path('assets/text_files/' . $decrypted_file_name));
            Session::flash('success_msg', $decrypted_file_name . ' has been deleted successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('error_msg', 'Something went wrong, Please try again later.');
            return redirect()->back();
        }
    }

}
