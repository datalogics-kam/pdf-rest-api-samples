<?php

// The /restricted-pdf endpoint can take a single PDF file or id as input.
// This sample demonstrates setting the permissions password to 'password' and adding restrictions.
$restricted_pdf_endpoint_url = 'https://api.pdfrest.com/restricted-pdf';

// Create an array that contains that data that will be passed to the POST request.
$data = array(
    'file' => new CURLFile('/path/to/file','application/pdf', 'file_name'),
    'output' => 'example_restrictedPdf_out',
    'new_permissions_password' => 'password',
    'restrictions[0]' => 'print_low',
    'restrictions[1]' => 'print_high',
    'restrictions[2]' => 'edit_content'
);

$headers = array(
    'Accept: application/json',
    'Content-Type: multipart/form-data',
    'Api-Key: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' // place your api key here
);

// Initialize a cURL session.
$ch = curl_init();

// Set the url, headers, and data that will be sent to restricted-pdf endpoint.
curl_setopt($ch, CURLOPT_URL, $restricted_pdf_endpoint_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

print "Sending POST request to restricted-pdf endpoint...\n";
$response = curl_exec($ch);

print "Response status code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";

if($response === false){
    print 'Error: ' . curl_error($ch) . "\n";
}else{
    print json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    print "\n";
}

curl_close($ch);
?>
