<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Throwable;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\CSVFile;
use App\Models\PDFFile;
use App\Models\XLSXFile;
use App\Models\DOCFile;

class FileController extends Controller
{
    public function storeFile(Request $request)
    {
        //Try to acheive the Flow of Process
        try {

            //Requesting the File Using Request Class & Validating the File and Size(Only Upto 5 MB)
            $request->validate([
                'file' => 'required|mimes:csv,xlsx,txt,doc,docx,pdf|max:5120',
            ]);

            //Extract the Name to Store it to the Database 
            $fileName = $request->file->getClientOriginalName();

            //To Get the Extension
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            //Check if the File-extension is CSV
            if ('csv' === $fileExtension) {

                //Extract the Path to Store it to the Database
                $filePath = public_path('uploads/csv') . '/' . $fileName;

                // Check if file already exists
                if (file_exists($filePath)) {

                    //Delete the Old Record if it is present with same name
                    CSVFile::where('filename', $fileName)->delete();

                    // Delete the existing file
                    unlink($filePath);
                }

                //Generation random FileCode
                $fileCode = $fileExtension . random_int(10000, 99999);

                //Checking whether the FileCode Exists
                $record = CSVFile::where('filecode', $fileCode)->first();

                //Looping until New FileCode Generates
                while ($record !== null && $record['filecode'] === $fileCode) {

                    //Generation random FileCode
                    $fileCode = $fileExtension . random_int(10000, 99999);
                }

                //Moving to the CSV Folder
                $request->file->move(public_path('uploads/csv'), $fileName);

                //Creating a new Record in CSV Table
                CSVFile::create(['filecode' => $fileCode, 'filename' => $fileName, 'filepath' => $filePath]);

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'action' => 'File Uploaded', 'code' => $fileCode, 'name' => $fileName]);
            }
            //Check if the File-extension is XLSX
            elseif ('xlsx' === $fileExtension) {

                //Extract the Path to Store it to the Database
                $filePath = public_path('uploads/xlsx') . '/' . $fileName;

                // Check if file already exists
                if (file_exists($filePath)) {

                    //Delete the Old Record if it is present with same name
                    XLSXFile::where('filename', $fileName)->delete();

                    // Delete the existing file
                    unlink($filePath);
                }

                //Generation random FileCode
                $fileCode = $fileExtension . random_int(10000, 99999);

                //Checking whether the FileCode Exists
                $record = XLSXFile::where('filecode', $fileCode)->first();

                //Looping until New FileCode Generates
                while ($record !== null && $record['filecode'] === $fileCode) {

                    //Generation random FileCode
                    $fileCode = $fileExtension . random_int(10000, 99999);
                }

                //Moving to the XLSX Folder
                $request->file->move(public_path('uploads/xlsx'), $fileName);

                //Creating a new Record in XLSX Table
                XLSXFile::create(['filecode' => $fileCode, 'filename' => $fileName, 'filepath' => $filePath]);

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'action' => 'File Uploaded', 'code' => $fileCode, 'name' => $fileName]);
            }
            //Check if the File-extension is PDF
            elseif ('pdf' === $fileExtension) {

                //Extract the Path to Store it to the Database
                $filePath = public_path('uploads/pdf') . '/' . $fileName;

                // Check if file already exists
                if (file_exists($filePath)) {

                    //Delete the Old Record if it is present with same name
                    PDFFile::where('filename', $fileName)->delete();

                    // Delete the existing file
                    unlink($filePath);
                }

                //Generation random FileCode
                $fileCode = $fileExtension . random_int(10000, 99999);

                //Checking whether the FileCode Exists
                $record = PDFFile::where('filecode', $fileCode)->first();

                //Looping until New FileCode Generates
                while ($record !== null && $record['filecode'] === $fileCode) {

                    //Generation random FileCode
                    $fileCode = $fileExtension . random_int(10000, 99999);
                }

                //Moving to the PDF Folder
                $request->file->move(public_path('uploads/pdf'), $fileName);

                //Creating a new Record in PDF Table
                PDFFile::create(['filecode' => $fileCode, 'filename' => $fileName, 'filepath' => $filePath]);

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'action' => 'File Uploaded', 'code' => $fileCode, 'name' => $fileName]);
            }
            //Check if the File-extension is TXT
            elseif ('txt' === $fileExtension) {

                //Extract the Path to Store it to the Database
                $filePath = public_path('uploads/doc') . '/' . $fileName;

                // Check if file already exists
                if (file_exists($filePath)) {

                    //Delete the Old Record if it is present with same name
                    DOCFile::where('filename', $fileName)->delete();

                    // Delete the existing file
                    unlink($filePath);
                }

                //Generation random FileCode
                $fileCode = $fileExtension . random_int(10000, 99999);

                //Checking whether the FileCode Exists
                $record = DOCFile::where('filecode', $fileCode)->first();

                //Looping until New FileCode Generates
                while ($record !== null && $record['filecode'] === $fileCode) {

                    //Generation random FileCode
                    $fileCode = $fileExtension . random_int(10000, 99999);
                }

                //Moving to the DOC Folder
                $request->file->move(public_path('uploads/doc'), $fileName);

                //Creating a new Record in DOC Table
                DOCFile::create(['filecode' => $fileCode, 'filename' => $fileName, 'filepath' => $filePath]);

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'action' => 'File Uploaded', 'code' => $fileCode, 'name' => $fileName]);
            }
            //Check if the File-extension is DOC or DOCX
            elseif ('docx' === $fileExtension || 'doc' === $fileExtension) {

                //Extract the Path to Store it to the Database
                $filePath = public_path('uploads/doc') . '/' . $fileName;

                // Check if file already exists
                if (file_exists($filePath)) {

                    //Delete the Old Record if it is present with same name
                    DOCFile::where('filename', $fileName)->delete();

                    // Delete the existing file
                    unlink($filePath);
                }

                //Generation random FileCode
                $fileCode = $fileExtension . random_int(10000, 99999);

                //Checking whether the FileCode Exists
                $record = DOCFile::where('filecode', $fileCode)->first();

                //Looping until New FileCode Generates
                while ($record !== null && $record['filecode'] === $fileCode) {

                    //Generation random FileCode
                    $fileCode = $fileExtension . random_int(10000, 99999);
                }

                //Moving to the DOC Folder
                $request->file->move(public_path('uploads/doc'), $fileName);

                //Creating a new Record in DOC Table
                DOCFile::create(['filecode' => $fileCode, 'filename' => $fileName, 'filepath' => $filePath]);

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'action' => 'File Uploaded', 'code' => $fileCode, 'name' => $fileName]);
            }
            //Incase of Some Error
            else {

                //Returning the Error View
                return view('error.error');
            }
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }

    public function readFile($fileName, $fileCode)
    {
        //Try to acheive the Flow of Process
        try {

            //To Get the Extension
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

            //Checking whether it is CSV File
            if ('csv' === $fileExtension) {

                //Getting the Path where the File is Stored
                $filePath = public_path('uploads/csv') . '/' . $fileName;

                //Checking whether the File Exists in the Path
                if (file_exists($filePath)) {

                    //Opening the File in Read Mode
                    $file = fopen($filePath, "r");

                    //Creating an Array to Store the Data
                    $fileData = [];

                    //Looping until the End of File
                    while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {

                        //Storing in the Array
                        $fileData[] = $data;
                    }

                    //Closing the File
                    fclose($file);

                    //Checking whether the Data is Set
                    if (isset($fileData) && isset($fileCode) && isset($fileName)) {

                        //Returning it with a View along with Data
                        return view('project.viewcsv', ['fileData' => $fileData, 'fileCode' => $fileCode, 'fileName' => $fileName]);
                    }
                    //Incase of Some Error(Data not set)
                    else {

                        //Returning the Error View
                        return view('error.error');
                    }
                }
                //Incase of Some Error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is XLSX File
            elseif ('xlsx' === $fileExtension) {

                //Getting the Path where the File is Stored
                $filePath = public_path('uploads/xlsx') . '/' . $fileName;

                //Checking whether the File Exists in the Path
                if (file_exists($filePath)) {
                    // Load the XLSX file using PhpSpreadsheet's IOFactory
                    $spreadsheet = IOFactory::load($filePath);

                    // Get the first sheet in the XLSX file
                    $worksheet = $spreadsheet->getActiveSheet();

                    // Convert the sheet to an array
                    $fileData = $worksheet->toArray();

                    //Checking whether the Data is Set
                    if (isset($fileData) && isset($fileCode) && isset($fileName)) {

                        //Returning it with a View along with Data
                        return view('project.viewxlsx', ['fileData' => $fileData, 'fileCode' => $fileCode, 'fileName' => $fileName]);
                    }
                    //Incase of Some Error(Data not set)
                    else {

                        //Returning the Error View
                        return view('error.error');
                    }
                }
                //Incase of Some Error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is TXT File
            elseif ('txt' === $fileExtension) {

                //Getting the Path where the File is Stored
                $filePath = public_path('uploads/doc') . '/' . $fileName;

                //Checking whether the File Exists in the Path
                if (file_exists($filePath)) {

                    //Getting the Contents present in the File
                    $fileData = file_get_contents($filePath);

                    //Getting the Data with the Preserved Format using <br> tags
                    $fileDataWithBreaks = nl2br($fileData);

                    //Checking whether the Data is Set
                    if (isset($fileDataWithBreaks) && isset($fileCode) && isset($fileName)) {

                        //Returning it with a View along with Data
                        return view('project.viewtxt', ['fileData' => $fileDataWithBreaks, 'fileCode' => $fileCode, 'fileName' => $fileName]);
                    }
                    //Incase of Some Error(Data not set)
                    else {

                        //Returning the Error View
                        return view('error.error');
                    }
                }
                //Incase of Some Error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is PDF File
            elseif ('pdf' === $fileExtension) {

                //Getting the Path where the File is Stored
                $filePath = public_path('uploads/pdf') . '/' . $fileName;

                //Returning the PDF Format in Website
                return response()->file($filePath);
            }
            //Checking whether it is DOC or DOCX File
            elseif ('docx' === $fileExtension || 'doc' === $fileExtension) { //Not Working Properly

                //Getting the Path where the File is Stored
                $filePath = public_path('uploads/doc') . '/' . $fileName;

                //Load DOCX or DOC file content
                // $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

                //Save the document as HTML
                // $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

                //Extracting the Filename without Extension
                // $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);

                //Generating the Random Value for HTML File
                // $random = random_int(100, 999);

                //Saving the HTML File converted from DOC or DOCX 
                // $writer->save(public_path('uploads/doc/html/') . $fileNameWithoutExtension . $random . '.html');

                //Convert HTML to PDF using Dompdf
                // $dompdf = new Dompdf();

                //Getting the Saved HTML File Path
                // $htmlpath = public_path('uploads/doc/html/') . $fileNameWithoutExtension . $random . '.html';

                //Loading the HTML File
                // $dompdf->loadHtml(file_get_contents($htmlpath)); //Some Error Occuring in this Part

                //Set the paper size and orientation
                // $dompdf->setPaper('A4', 'portrait');

                //Render the HTML as PDF
                // $dompdf->render();

                //Streaming the PDF in Browser
                // $dompdf->stream();

                //Returning the File (Mostly Download Happens)
                return response()->file($filePath);
            }
            //Incase of Some Error
            else {

                //Returning the Error View
                return view('error.error');
            }
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }

    public function searchFile(Request $request)
    {
        //Try to acheive the Flow of Process
        try {

            //Getting the Filecode from the User
            $fileCode = $request->input('filecode');

            //Extracting the Extension
            $fileExtension = substr($fileCode, 0, 3);

            //Checking whether it is CSV File
            if ($fileExtension === 'csv') {

                //Searching the File with the Filecode
                $fileData = CSVFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Sending Success Response
                    return response()->json(['status' => 'success', 'recorddata' => $fileData]);
                }
                //If record not found
                else {

                    //Sending Error Response
                    return response()->json(['status' => 'error', 'message' => 'File not found']);
                }
            }
            //Checking whether it is XLSX File
            elseif ($fileExtension === 'xls') {

                //Searching the File with the Filecode
                $fileData = XLSXFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Sending Success Response
                    return response()->json(['status' => 'success', 'recorddata' => $fileData]);
                }
                //If record not found
                else {

                    //Sending Error Response
                    return response()->json(['status' => 'error', 'message' => 'File not found']);
                }
            }
            //Checking whether it is PDF File
            elseif ($fileExtension === 'pdf') {

                //Searching the File with the Filecode
                $fileData = PDFFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Sending Success Response
                    return response()->json(['status' => 'success', 'recorddata' => $fileData]);
                }
                //If record not found
                else {

                    //Sending Error Response
                    return response()->json(['status' => 'error', 'message' => 'File not found']);
                }
            }
            //Checking whether it is TXT or DOC or DOCX File
            elseif ($fileExtension === 'txt' || $fileExtension === 'doc') {

                //Searching the File with the Filecode
                $fileData = DOCFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Sending Success Response
                    return response()->json(['status' => 'success', 'recorddata' => $fileData]);
                }
                //If record not found
                else {

                    //Sending Error Response
                    return response()->json(['status' => 'error', 'message' => 'File not found']);
                }
            }
            //Incase of Some Error
            else {

                //Sending Error Response
                return response()->json(['status' => 'error', 'message' => 'File not found']);
            }
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }

    }

    public function downloadFile($fileName, $fileCode)
    {
        //Try to acheive the Flow of Process
        try {

            //Extracting the Extension
            $fileExtension = substr($fileCode, 0, 3);

            //Checking whether it is CSV File
            if ($fileExtension === 'csv') {

                //Searching the File with the Filecode
                $fileData = CSVFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        // Download file
                        return response()->download($filePath, $fileName);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is XLSX File
            elseif ($fileExtension === 'xls') {

                //Searching the File with the Filecode
                $fileData = XLSXFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        // Download file
                        return response()->download($filePath, $fileName);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is PDF File
            elseif ($fileExtension === 'pdf') {

                //Searching the File with the Filecode
                $fileData = PDFFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        // Download file
                        return response()->download($filePath, $fileName);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is DOC or DOCX or TXT File
            elseif ($fileExtension === 'txt' || $fileExtension === 'doc') {

                //Searching the File with the Filecode
                $fileData = DOCFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        // Download file
                        return response()->download($filePath, $fileName);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Incase of some error
            else {

                //Returning the Error View
                return view('error.error');
            }
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }

    public function deleteFile($fileName, $fileCode)
    {
        //Try to acheive the Flow of Process
        try {

            //Extracting the Extension
            $fileExtension = substr($fileCode, 0, 3);

            //Checking whether it is CSV File
            if ($fileExtension === 'csv') {

                //Searching the File with the Filecode
                $fileData = CSVFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        //Delete the file
                        unlink($filePath);

                        //Delete the Record from the Database
                        CSVFile::where('filecode', $fileCode)->delete();

                        //Sending Success Response
                        return response()->json(['status' => 'Success', 'message' => 'File Deleted..!']);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is XLSX File
            elseif ($fileExtension === 'xls') {

                //Searching the File with the Filecode
                $fileData = XLSXFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        //Delete the file
                        unlink($filePath);

                        //Delete the Record from the Database
                        XLSXFile::where('filecode', $fileCode)->delete();

                        //Sending Success Response
                        return response()->json(['status' => 'Success', 'message' => 'File Deleted..!']);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is PDF File
            elseif ($fileExtension === 'pdf') {

                //Searching the File with the Filecode
                $fileData = PDFFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        //Delete the file
                        unlink($filePath);

                        //Delete the Record from the Database
                        PDFFile::where('filecode', $fileCode)->delete();

                        //Sending Success Response
                        return response()->json(['status' => 'Success', 'message' => 'File Deleted..!']);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Checking whether it is DOC or DOCX or TXT File
            elseif ($fileExtension === 'txt' || $fileExtension === 'doc') {

                //Searching the File with the Filecode
                $fileData = DOCFile::where('filecode', $fileCode)->first();

                //Checking whether the record found or not
                if ($fileData !== null) {

                    //Getting the path where the file stored
                    $filePath = $fileData->filepath;

                    //Check if file exists in storage path
                    if (file_exists($filePath)) {

                        //Delete the file
                        unlink($filePath);

                        //Delete the Record from the Database
                        DOCFile::where('filecode', $fileCode)->delete();

                        //Sending Success Response
                        return response()->json(['status' => 'Success', 'message' => 'File Deleted..!']);
                    }
                    //If file not found
                    else {

                        //Returning the Filenotfound View with filecode
                        return view('error.filenotfound')->with('fileCode', $fileCode);
                    }
                }
                //Incase of some error
                else {

                    //Returning the Error View
                    return view('error.error');
                }
            }
            //Incase of some error
            else {

                //Returning the Error View
                return view('error.error');
            }
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }

    public function download($type)
    {
        //Try to acheive the Flow of Process
        try {
            // if ($type === 'pdf') {}elseif ($type==='csv') {}elseif ($type==='xlsx') {}elseif ($type==='txtdocx') {}else{}
            $data = DB::table('csvfiles')->get();

            //Checking whether data is present
            if ($data->count() > 0) {

                //Returning with Success Response
                return response()->json(['status' => 'Success', 'tabledata' => $data]);
            }
            //If No Data Present in the Table
            else {

                //Returing with Error Response
                return response()->json(['status' => 'Fail', 'reason' => 'No Files Present']);
            }

        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }
    public function clearTemp()
    {
        //Try to acheive the Flow of Process
        try {
            $file = new Filesystem;

            //Getting the Path where Temp files Stored
            $tempPath = public_path('uploads/doc/html/');

            //Cleaning the Directory
            $file->cleanDirectory($tempPath);

            //Redirecting to the Home
            return redirect('/');
        }
        //If any Exceptiion Occurs Catch and Display Error View
        catch (Throwable $e) {

            //Returning the Error View
            return view('error.error');
        }
    }
}
