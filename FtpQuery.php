class FtpQuery
{
    public $ftp_host;
    public $ftp_port;
    public $ftp_login;
    public $ftp_password;

    public function __construct($ftp_host=null,$ftp_login=null,$ftp_password=null,$ftp_port=21)
    {
        if(($ftp_host == null || $ftp_port == null || $ftp_login == null || $ftp_password == null)){
            echo 'No data connect!';
            return  false;
        }

        $this->ftp_login = $ftp_login;
        $this->ftp_port = $ftp_port;
        $this->ftp_host = $ftp_host;
        $this->ftp_password = $ftp_password;
    }

    public function readFiles($limit=0,$file_type = null){

        $conn_id = ftp_connect($this->ftp_host);
        $login_result = ftp_login($conn_id, $this->ftp_login, $this->ftp_password);
        ftp_pasv($conn_id, true);

        $contents = ftp_nlist($conn_id, '');

        ftp_close($conn_id);

        if($limit>0) {
            $contents =  array_slice($contents, 0, $limit);
        }

        if($file_type != null) {
            foreach ($contents as $k => $v) {
                $file_info = pathinfo($v);
                if($file_info['extension'] != $file_type)
                {
                    unset($contents[$k]);
                }
            }
            sort($contents);
        }


        return $contents;
    }

    public function downloadFile($file,$save_dir=__DIR__ . '/'){
        if($file == null) return 'ERROR! function downloadFile, file name is empty!';
        // Установка соединения
        $conn_id = ftp_connect($this->ftp_host);
        $login_result = ftp_login($conn_id, $this->ftp_login, $this->ftp_password);
       ftp_pasv($conn_id, true);

        $handle = fopen($save_dir . $file, 'w');

        if (ftp_fget($conn_id, $handle, $file)) {
            $request =  true;
        } else {
            $request =  false;
        }

        fclose($handle);
        ftp_close($conn_id);

        return $request;
    }

    public function loadFile($file){
// Установка соединения
        $conn_id = ftp_connect($this->ftp_host);
        $login_result = ftp_login($conn_id, $this->ftp_login, $this->ftp_password);
        ftp_pasv($conn_id, true);

        if (ftp_put($conn_id, basename($file), $file)) {
            $request = true;
        } else {
            $request = false;
        }

        ftp_close($conn_id);

        return $request;
    }
    public function deliteFile($file){

        $conn_id = ftp_connect($this->ftp_host);
        $login_result = ftp_login($conn_id, $this->ftp_login, $this->ftp_password);
        ftp_pasv($conn_id, true);

        if (ftp_delete($conn_id, $file)) {
            $request = true;
        } else {
            $request = false;
        }

        ftp_close($conn_id);

        return $request;
    }

}
