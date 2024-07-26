Simple PHP class to job on FTP protocol

Comands:

->connect
$ftp = New FtpQuery('ftp_host','ftp_login','ftp_password','port=21');

->Read files:
$ftp->readFiles(int: Limit files, 'file_type');
exemle: $ftp->readFiles(100, 'jpg');

return: array filenames to ftp server.







