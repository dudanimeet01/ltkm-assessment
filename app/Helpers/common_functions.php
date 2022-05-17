<?php

use Illuminate\Support\Facades\File;

/**
 * Get the all txt file list in directory
 *
 * @param  null
 * @return array
 */
function getFileList()
{
    $txt_files_list = scandir(public_path('assets/text_files'));

    $txt_files_list = array_filter($txt_files_list, function ($value) {
        $file_detail = pathinfo($value);
        if (@$file_detail['extension'] == 'txt') {
            return $value;
        }
    });
    return array_values($txt_files_list);
}

/**
 * Get the all txt file content as array
 *
 * @param  string , array optional
 * @return array
 */
function readFileContent($filename, $file_details = [])
{
    $file_content = explode("\n", file_get_contents(public_path('assets/text_files/' . trim($filename))));
    $file_content = array_map('trim', $file_content);
    $check_file_content = $file_content;

    if(array_key_exists($filename,$file_details) && count($check_file_content) != count(array_filter($check_file_content, 'is_numeric'))){
        return ['error'=>'File recursion in infinite mode. Please check the files.'];
    }

    $file_details[$filename] = $file_content;
    foreach ($file_content as $key => $value) {
        if (!is_numeric($value) && File::exists(public_path('assets/text_files/' . trim($value)))) {
            $file_details = readFileContent($value, $file_details);
        }
    }
    return $file_details;
}


/**
 * Calcualte the sum of each recursive file
 *
 * @param  array
 * @return array
 */
function calculateSum($files_content)
{
    $files_content = array_reverse($files_content);
    foreach ($files_content as $key => $value) {
        if (count($value) === count(array_filter($value, 'is_numeric'))) {
            $files_content[$key] = array_sum($value);
        } else {
            $files_content[$key] = array_map(function ($value) use ($files_content) {
                if (!is_numeric($value)) {
                    return isset($files_content[$value]) ? $files_content[$value] : 0;
                } else {
                    return $value;
                }
            }, $files_content[$key]);
            $files_content[$key] = array_sum($files_content[$key]);
        }
    }
    return array_reverse($files_content);
}
