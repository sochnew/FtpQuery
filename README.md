Simple PHP class to job on FTP protocol

Comands:

->connect
$ftp = New FtpQuery('ftp_host','ftp_login','ftp_password','port=21');


->Read files:

$ftp->readFiles(int: Limit files, 'file_type');

exemle: $ftp->readFiles(100, 'jpg');


return: array filenames to ftp server.


->Download File:

$ftp->downloadFile('filename on FTP server', 'save dir');

exemle: $ftp->downloadFile('123.jpg', '/test_dir');


return: true or false

->Load file to FTP server

$ftp->loadFile('dir file');

exemle: $ftp->loadFile('/test_dir/files/123.jpg');


return: true or false

->Delete file on FTP server

$ftp->deliteFile('file');

exemle: $ftp->deliteFile('/test_dir/files/123.jpg');

return: true or false







